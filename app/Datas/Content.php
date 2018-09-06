<?php
/**
 * Created by PhpStorm.
 * User: zain
 * Date: 10/06/18
 * Time: 14:26
 */

namespace App\Datas;

use App\Helpers\Helper;
use DB;

class Content
{
    public static function data_post($id = null, $slug = null, $status = null, $menu = null, $category = null, $search = null, $list = null, $popular = null)
    {
        $dataPosts = DB::table('posts')
            ->select('posts.id', 'posts.slug', 'name', 'posts.title', 'posts.content',
                'posts.image', 'posts.seo', 'posts.keyword', 'posts.status', 'posts.view',
                'posts.plugin', 'posts.created_at', 'category_id', 'menu_id')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id');
        if ($popular) {
            $dataPosts->orderBy('view', 'desc');
        } else {
            $dataPosts->orderBy('id', 'desc');
        }
        if ($id) {
            $dataPosts->where('id', $id);
        }
        if ($slug) {
            $dataPosts->where('slug', $slug);
        }
        if ($status) {
            $dataPosts->where('status', $status);
        }
        if ($search) {
            $dataPosts->where('title', 'like', '%' . $search . '%');
        }
        if ($category) {
            $dataPosts->where('category_id', $category);
        }
        if ($menu) {
            $dataPosts->where('menu_id', $menu);
        }
        $dataPosts = $dataPosts->get();

        $post = [];
        foreach ($dataPosts as $d) {

            $dataCategory = DB::table('categories')
                ->select('id', 'slug', 'title')
                ->where('module', 'post')
                ->where('id', $d->category_id)
                ->first();

            $dataMenu = DB::table('pages')
                ->select('id', 'slug', 'title')
                ->where('id', $d->menu_id)
                ->first();

            if(isset($dataCategory) or isset($dataMenu)){
                if ($list) {
                    $post[] = [
                        'id' => $d->id,
                        'slug' => $d->slug,
                        'name' => $d->name,
                        'title' => $d->title,
                        'content' => $d->content,
                        'image' => asset('media/images/' . $d->image),
                        'thumb' => asset('media/thumb/' . $d->image),
                        'view' => $d->view,
                        'status' => $d->status,
                        'created_at' => $d->created_at,
                        'category' => !empty($dataCategory) ? $dataCategory : null,
                        'menu' => !empty($dataMenu) ? $dataMenu : null,
                    ];
                } else {
                    $post[] = [
                        'id' => $d->id,
                        'slug' => $d->slug,
                        'category_id' => $d->category_id,
                        'name' => $d->name,
                        'title' => $d->title,
                        'content' => $d->content,
                        'image' => asset('media/images/' . $d->image),
                        'thumb' => asset('media/thumb/' . $d->image),
                        'seo' => $d->seo,
                        'keyword' => $d->keyword,
                        'status' => $d->status,
                        'view' => $d->view,
                        'plugin' => $d->plugin,
                        'created_at' => $d->created_at,
                        'category' => !empty($dataCategory) ? $dataCategory : null,
                        'menu' => !empty($dataMenu) ? $dataMenu : null,
                    ];
                }
            }
        }

        return Helper::array_to_object($post);
    }

    public static function post($search = null, $menu = null, $category = null, $status = null)
    {
        return self::data_post(null, null, $status, $menu, $category, $search, 1);
    }

    public static function show_post($slug)
    {
        return self::data_post(null, $slug);
    }

    public static function list_post()
    {
        return self::data_post(null, null, 1, null, null, null, 1);
    }

    public static function search_post($search)
    {
        return self::data_post(null, null, 1, null, null, $search, 1, null);
    }

    public static function menu_post($menu)
    {
        return self::data_post(null, null, 1, $menu, null, null, 1, null);
    }

    public static function category_post($category)
    {
        return self::data_post(null, null, 1, null, $category, null, 1, null);
    }

    public static function popular_post()
    {
        return self::data_post(null, null, 1, null, null, null, 1, 1);
    }


    public static function data_page($id = null, $slug = null, $status = null, $search = null, $list = null)
    {
        $dataPage = DB::table('pages')
            ->select('id', 'slug', 'title', 'content', 'image', 'seo', 'keyword',
                'status', 'plugin', 'template', 'created_at')
            ->orderBy('id', 'desc');
        if ($id) {
            $dataPage->where('id', $id);
        }
        if ($slug) {
            $dataPage->where('slug', $slug);
        }
        if ($status) {
            $dataPage->where('status', $status);
        }
        if ($search) {
            $dataPage->where('title', 'like', '%' . $search . '%');
        }
        $dataPage = $dataPage->get();

        $page = [];
        foreach ($dataPage as $d) {

            if ($list) {
                $page[] = [
                    'id' => $d->id,
                    'slug' => $d->slug,
                    'title' => $d->title,
                    'content' => $d->content,
                    'image' => asset('images/' . $d->image),
                    'thumb' => asset('thumb/' . $d->image),
                    'status' => $d->status,
                    'created_at' => $d->created_at,
                    'template' => $d->template,
                ];
            } else {
                $page[] = [
                    'id' => $d->id,
                    'slug' => $d->slug,
                    'title' => $d->title,
                    'content' => $d->content,
                    'image' => asset('images/' . $d->image),
                    'thumb' => asset('thumb/' . $d->image),
                    'seo' => $d->seo,
                    'keyword' => $d->keyword,
                    'status' => $d->status,
                    'plugin' => $d->plugin,
                    'created_at' => $d->created_at,
                    'template' => $d->template,
                ];
            }
        }

        return Helper::array_to_object($page);
    }

    public static function page($menu = null, $search = null, $status = null)
    {
        return self::data_page(null, $status, $menu, $search, 1);
    }

    public static function list_page()
    {
        return self::data_page(null, null, 1, null, 1);
    }

    public static function show_page($slug)
    {
        return self::data_page(null, $slug, 1, null, null);
    }

    public static function search_page($search)
    {
        return self::data_page(null, null, 1, $search, 1);
    }

}
