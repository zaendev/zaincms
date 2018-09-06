<?php

namespace App\Http\Controllers\Admin;

use App\Datas\Menu;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class MenuController extends Controller
{
    public function index()
    {
        $meta = [
            'title' => 'Menu',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.menu.index',
            [
                'meta' => $meta,
            ]);
    }

    public function view()
    {
        return Menu::get_build_menu(Menu::get_menu());
    }

    public function show(Request $request)
    {
        $data = DB::table('pages')
            ->where('id', $request->id)
            ->first();

        return response()->json($data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'slug' => 'max:100',
        ]);
        if ($validator->passes()) {

            if ($request->id != '') {

                if (empty($request->slug)) {
                    $slug = Helper::slug('update', 'pages', null, $request->title, null, null);
                } else {
                    $slug = Helper::slug('update', 'pages', $request->slug, null, $request->id, 1);
                }


                DB::table('pages')
                    ->where('id', $request->id)
                    ->update(
                        [
                            'slug' => $slug,
                            'title' => $request->title,
                        ]
                    );

                $arr['type'] = 'edit';
                $arr['id'] = $request->id;
                $arr['slug'] = $request->slug;
                $arr['title'] = $request->title;
                
            } else {


                if (empty($request->slug)) {
                    $slug = Helper::slug('post', 'pages', null, $request->title, null, null);
                } else {
                    $slug = Helper::slug('post', 'pages', $request->slug, null, null, 1);
                }

                $lastId = DB::table('pages')
                    ->insertGetId(
                        [
                            'slug' => $slug,
                            'title' => $request->title,
                        ]
                    );

                $arr['menu'] = '<li class="dd-item dd3-item" data-id="' . $lastId . '" >
	                    <div class="dd-handle dd3-handle">Drag</div>
	                    <div class="dd3-content"><span id="title_show' . $lastId . '">' . $request->title . '</span>
	                        <span class="span-right"> &nbsp;&nbsp; 
	                        	<a class="edit-button" id="' . $lastId . '" ><i class="fa fa-pencil"></i></a>
                           		<a class="del-button" id="' . $lastId . '"><i class="fa fa-trash"></i></a>
	                        </span> 
	                    </div>';

                $arr['type'] = 'add';

            }
            return json_encode($arr);

        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function update(Request $request)
    {
        $data = json_decode($request->data);

        $readbleArray = Helper::parseJsonArray($data);

        foreach ($readbleArray as $key => $row) {
            DB::table('pages')
                ->where('id', $row['id'])
                ->update(
                    [
                        'parent' => $row['parentID'],
                        'sort' => $key,
                    ]
                );
        }
    }

    public function destroy(Request $request)
    {
        $query = DB::table('pages')
            ->where('parent', $request->id)
            ->get();
	    
	DB::table('posts')
            ->where('menu_id', $request->id)
            ->update(['menu_id' => 0]);

        if (count($query) > 0) {
            foreach ($query as $q) {
                DB::table('pages')
                    ->where('id', $q->id)
                    ->delete();
		    
		DB::table('posts')
                    ->where('menu_id', $q->id)
                    ->update(['menu_id' => 0]);
            }
        }

        DB::table('pages')
            ->where('id', $request->id)
            ->delete();
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu' => 'required|max:100',
        ]);

        if ($validator->passes()) {
            $data['title'] = $request->menu;
            $data['slug'] = Helper::slug('post', 'pages', null, $request->menu, null, null);
            $data['parent'] = $request->parent;

            DB::table('pages')
                ->insert($data);

            return view('admin.menu.view',
                [
                    'menu' => Menu::get_select_menu(Menu::get_menu())
                ]
            );
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

}
