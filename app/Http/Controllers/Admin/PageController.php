<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Site\Config;
use App\Http\Requests\Rpage;
use App\Model\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Datas\Content;
use Image;
use Auth;
use Illuminate\Support\Facades\Input;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $meta = [
            'title' => 'Page',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.page.index',
            [
                'data' => Helper::paginate(Content::page($request->search, $request->category), 10),
                'meta' => $meta
            ]
        );
    }

    public function create()
    {
        $meta = [
            'title' => 'Create Page',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.page.create',
            [
                'meta' => $meta,
                'template' => Config::template()
            ]
        );
    }

    public function store(Rpage $request)
    {
        $data = new page;
        if ($image = Input::file('image')) {
            $filename = $image->hashName();
            $path_thumb = public_path('media/thumb/' . $filename);
            Image::make($image->getRealPath())->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(350, 177)->save($path_thumb);

            $path = public_path('media/images/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $data->image = $filename;
        }

        if (empty($request->slug)) {
            $slug = Helper::slug('post', 'pages', null, $request->title, null, null);
        } else {
            $slug = Helper::slug('post', 'pages', $request->slug, null, null, 1);
        }

        $data->slug = $slug;
        $data->title = $request->title;
        $data->content = $request->description;
        $data->status = $request->publish;
        $data->plugin = $request->dataPlugin;
        $data->template = $request->template;
        if (empty($request->seo)) {
            $data->seo = strip_tags(str_limit($request->description, 150));
        } else {
            $data->seo = $request->seo;
        }
        if (empty($request->keyword)) {
            $data->keyword = $request->title;
        } else {
            $data->keyword = $request->keyword;
        }
        $data->save();

        if ($request->publish == 1) {
            $status = 'Publish';
        } elseif ($request->publish == 0) {
            $status = 'Draft';
        }

        return redirect(route('page.index'))->with('message', 'page ' . $status);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Page::findOrFail($id);

        $meta = [
            'title' => 'Edit Page',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.page.edit',
            [
                'data' => $data,
                'template' => Config::template(),
                'meta' => $meta
            ]
        );
    }

    public function update(Rpage $request, $id)
    {
        $data = page::findOrFail($id);

        if ($image = Input::file('image')) {
            $filename = $image->hashName();
            $path_thumb = public_path('media/thumb/' . $filename);
            Image::make($image->getRealPath())->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(350, 177)->save($path_thumb);

            $path = public_path('media/images/' . $filename);
            Image::make($image->getRealPath())->save($path);

            $oldImage = $data->image;
            if ($oldImage) {
                if (file_exists(public_path('media/images/' . $oldImage))) {
                    unlink('media/images/' . $oldImage);
                }
                if (file_exists(public_path('media/thumb/' . $oldImage))) {
                    unlink('media/thumb/' . $oldImage);
                }
            }
            $data->image = $filename;
        } elseif ($request->updateImg1 == '0') {
            $oldImage = $data->image;
            if ($oldImage) {
                if (file_exists(public_path('media/images/' . $oldImage))) {
                    unlink('media/images/' . $oldImage);
                }
                if (file_exists(public_path('media/thumb/' . $oldImage))) {
                    unlink('media/thumb/' . $oldImage);
                }
            }
            $data->image = null;
        }

        if (empty($request->slug)) {
            $slug = Helper::slug('update', 'pages', null, $request->title, null, null);
        } else {
            $slug = Helper::slug('update', 'pages', $request->slug, null, $id, 1);
        }

        $data->slug = $slug;
        $data->title = $request->title;
        $data->content = $request->description;
        $data->status = $request->publish;
        $data->plugin = $request->dataPlugin;
        $data->template = $request->template;
        if (empty($request->seo)) {
            $data->seo = strip_tags(str_limit($request->description, 150));
        } else {
            $data->seo = $request->seo;
        }
        if (empty($request->keyword)) {
            $data->keyword = $request->title;
        } else {
            $data->keyword = $request->keyword;
        }
        $data->save();

        return redirect(route('page.index'))->with('message', 'Success Update');
    }

    public function destroy($id)
    {
        $data = page::findOrFail($id);
        
        DB::table('posts')
            ->where('menu_id', $id)
            ->update(['menu_id' => 0]);
        
        $oldImage = $data->image;
        if ($oldImage) {
            if (file_exists(public_path('media/images/' . $oldImage))) {
                unlink('media/images/' . $oldImage);
            }
            if (file_exists(public_path('media/thumb/' . $oldImage))) {
                unlink('media/thumb/' . $oldImage);
            }
        }
        $data->delete();

        return back()->with('message', 'Success Delete');
    }
}
