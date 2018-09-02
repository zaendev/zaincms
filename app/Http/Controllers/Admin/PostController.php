<?php

namespace App\Http\Controllers\Admin;

use App\Datas\Category;
use App\Datas\Menu;
use App\Helpers\Helper;
use App\Http\Requests\Rpost;
use App\Model\Post;
use App\Datas\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Image;
use Auth;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $meta = [
            'title' => 'Post',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.post.index',
            [
                'data' => Helper::paginate(Content::post($request->search, $request->category), 10),
                'meta' => $meta
            ]
        );
    }

    public function create()
    {
        $meta = [
            'title' => 'Create Post',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.post.create',
            [
                'menu' => Menu::get_select_menu(Menu::get_menu()),
                'category' => Category::get_select_category(Category::get_category('post')),
                'meta' => $meta
            ]
        );
    }

    public function store(Rpost $request)
    {
        $data = new Post;
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
            $slug = Helper::slug('post', 'posts', null, $request->title, null, null);
        } else {
            $slug = Helper::slug('post', 'posts', $request->slug, null, null, 1);
        }

        $data->slug = $slug;
        $data->title = $request->title;
        $data->user_id = Auth::user()->id;
        $data->category_id = $request->dataCategory;
        $data->menu_id = $request->dataMenu;
        $data->content = $request->description;
        $data->status = $request->publish;
        $data->plugin = $request->dataPlugin;
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

        return redirect(route('post.index'))->with('message', 'Post ' . $status);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Post::findOrFail($id);

        $meta = [
            'title' => 'Edit Post',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.post.edit',
            [
                'data' => $data,
                'menu' => Menu::get_select_menu(Menu::get_menu()),
                'category' => Category::get_select_category(Category::get_category('post')),
                'meta' => $meta
            ]
        );
    }

    public function update(Rpost $request, $id)
    {
        $data = Post::findOrFail($id);

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
            $slug = Helper::slug('update', 'posts', null, $request->title, null, null);
        } else {
            $slug = Helper::slug('update', 'posts', $request->slug, null, $id, 1);
        }

        $data->slug = $slug;
        $data->title = $request->title;
        $data->user_id = Auth::user()->id;
        $data->category_id = $request->dataCategory;
        $data->menu_id = $request->dataMenu;
        $data->content = $request->description;
        $data->status = $request->publish;
        $data->plugin = $request->dataPlugin;
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

        return redirect(route('post.index'))->with('message', 'Success Update');
    }

    public function destroy($id)
    {
        $data = Post::findOrFail($id);
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
