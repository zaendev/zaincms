<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Rconfig;
use App\Model\Config;
use App\Http\Controllers\Controller;
use DB;
use Image;
use Auth;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller
{
    public function index()
    {
        $data = Config::findOrFail(Auth::user()->id);

        $meta = [
            'title' => 'Config',
            'keyword' => 'dasboard',
            'description' => 'dasboard',
        ];
        return view('admin.config.index',
            [
                'meta' => $meta,
                'data' => $data
            ]
        );
    }

    public function update(Rconfig $request, $id)
    {
        $data = Config::findOrFail($id);

        DB::beginTransaction();
        try {

            if ($image = Input::file('image')) {
                $filename = $image->hashName();
                $path_thumb = public_path('media/thumb/' . $filename);
                Image::make($image->getRealPath())->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_thumb);
                $path = public_path('media/images/' . $filename);
                Image::make($image->getRealPath())->save($path);

                $oldImage = $data->image;
                if ($oldImage) {
                    if (file_exists(public_path('media/images/' . $oldImage))) {
                        unlink('media/images/' . $oldImage);
                    } elseif (file_exists(public_path('media/thumb/' . $oldImage))) {
                        unlink('media/thumb/' . $oldImage);
                    }
                }
                $data->image = $filename;
            }

            $data->site_title = $request->site_title;
            $data->user_id = Auth::user()->id;
            $data->keyword = $request->keyword;
            $data->seo = $request->seo;
            $data->lat = $request->lat;
            $data->lng = $request->lng;
            $data->fb = $request->fb;
            $data->pinterest = $request->pinterest;
            $data->twitter = $request->twitter;
            $data->instagram = $request->instagram;
            $data->gplus = $request->gplus;
            $data->address = $request->address;
            $data->telp = $request->telp;
            $data->save();

            $user['email'] = $request->email;
            $user['name'] = $request->author;
            if (!empty($request->password)) {
                $user['password'] = bcrypt($request->password);
            }

            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update($user);

            DB::commit();

            return back()->with('message', 'Success Update');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'Failed Update');
        }
    }

}
