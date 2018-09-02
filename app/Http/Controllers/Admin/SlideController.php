<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Rslide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use App\Model\Slide;
use Image;
use DB;
use Auth;

class SlideController extends Controller
{

    public function index(Request $request)
    {
        $data = DB::table('slides');
        if ($request->search) {
            $data->where('title', 'like', '%' . $request->search . '%');
        }
        $data = $data->paginate(10);

        $meta = [
            'title' => 'Slide',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];

        return view('admin.slide.index',
            [
                'data' => $data,
                'meta' => $meta,
            ]);

    }

    public function create()
    {
        $meta = [
            'title' => 'Create Slide',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];
        return view('admin.slide.create',
            [
                'meta' => $meta
            ]);
    }

    public function store(Rslide $request)
    {

        $data = new slide;
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

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->publish;
        $data->save();

        return redirect(route('slide.index'))->with('message', 'Selide Save ');
    }

    public function edit($id)
    {
        $data = slide::findOrFail($id);

        $meta = [
            'title' => 'Edit Slide',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];
        return view('admin.slide.edit',
            [
                'data' => $data,
                'meta' => $meta,
            ]);
    }


    public function update(Request $request, $id)
    {
        $data = Slide::findOrFail($id);

        if ($image = Input::file('image')) {
            $filename = $image->hashName();
            $path_thumb = public_path('media/thumb/' . $filename);
            Image::make($image->getRealPath())->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(350, 177)->save($path_thumb);

            $path = public_path('media/images/' . $filename);
            Image::make($image->getRealPath())->save($path);

            $oldImage = $data->img;
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

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->publish;
        $data->save();

        return redirect(route('slide.index'))->with('message', 'Success Update');
    }

    public function destroy($id)
    {
        $data = slide::findOrFail($id);
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