<?php

namespace App\Http\Controllers\Admin;

use App\Datas\Category;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $meta = [
            'title' => 'Category',
            'keyword' => 'dasboard',
            'description' => 'Admin',
        ];
        return view('admin.category.index',
            [
                'meta' => $meta,
            ]);
    }

    public function view($module)
    {
        return Category::get_build_category(Category::get_category($module));
    }

    public function show(Request $request)
    {
        $data = DB::table('categories')
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
                    $slug = Helper::slug('update', 'categories', null, $request->title, null, null);
                } else {
                    $slug = Helper::slug('update', 'categories', $request->slug, null, $request->id, 1);
                }

                DB::table('categories')
                    ->where('id', $request->id)
                    ->update(
                        [
                            'slug' => $slug,
                            'title' => $request->title,
                            'description' => $request->description,
                            'module' => $request->module,
                        ]
                    );

                $arr['type'] = 'edit';
                $arr['id'] = $request->id;
                $arr['slug'] = $request->slug;
                $arr['title'] = $request->title;
                $arr['description'] = $request->description;
                $arr['module'] = $request->module;

            } else {

                if (empty($request->slug)) {
                    $slug = Helper::slug('post', 'categories', null, $request->title, null, null);
                } else {
                    $slug = Helper::slug('post', 'categories', $request->slug, null, null, 1);
                }

                $lastId = DB::table('categories')
                    ->insertGetId(
                        [
                            'slug' => $slug,
                            'title' => $request->title,
                            'description' => $request->description,
                            'module' => $request->module,
                        ]
                    );

                $arr['category'] = '<li class="dd-item dd3-item" data-id="' . $lastId . '" >
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
            DB::table('categories')
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
        $query = DB::table('categories')
            ->where('parent', $request->id)
            ->get();
	    
	DB::table('posts')
            ->where('category_id', $request->id)
            ->update(['category_id' => 0]);

        if (count($query) > 0) {
            foreach ($query as $q) {
                DB::table('categories')
                    ->where('id', $q->id)
                    ->delete();
		  
		DB::table('posts')
                    ->where('category_id', $q->id)
                    ->update(['category_id' => 0]);
            }
        }

        DB::table('categories')
            ->where('id', $request->id)
            ->delete();
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|max:100',
        ]);
        if ($validator->passes()) {
            $data['module'] = $request->module;
            $data['title'] = $request->category;
            $data['slug'] = Helper::slug('post', 'categories', null, $request->category, null, null);
            $data['parent'] = $request->parent;

            DB::table('categories')
                ->insert($data);
            
            return view('admin.category.view',
                [
                    'category' => Category::get_select_category(Category::get_category($request->module))
                ]
            );
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

}
