<?php

namespace App\Http\Controllers\Site;

use App\Datas\Category;
use App\Datas\Content;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slide;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('site.index',
            [
                'slide' => Slide::all(),
                'post' => Content::list_post(),
            ]
        );
    }

    public function page($page)
    {
        if (count((array)Content::show_page($page)) == 0) {
            return abort(404);
        }

        $menu = Content::show_page($page)->{0};

        $meta = [
            'title' => $menu->title,
            'seo' => $menu->seo,
            'keyword' => $menu->keyword,
        ];

        $template = $menu->template;

        return view('site.' . $template,
            [
                'data' => $menu,
                'post' => Helper::paginate(Content::menu_post($menu->id), 10),
                'oPost' => Content::popular_post(),
                'meta' => $meta
            ]
        );
    }

    public function search(Request $request)
    {
        $meta = [
            'title' => $request->search
        ];

        return view('site.search',
            [
                'meta' => $meta,
                'post' => Helper::paginate(Content::search_post($request->search), 10),
            ]
        );
    }

    public function show($page, $slug)
    {
        if (count((array)Content::show_page($page)) == 0) {
            return 404;
        }

        if (count((array)Content::show_post($slug)) == 0) {
            return 404;
        }

        $template = Content::show_page($page)->{0};
        $post = Content::show_post($slug)->{0};

        if ($template->template == 'blog') {
            DB::table('posts')
                ->where('id', $post->id)
                ->update(['view' => $post->view + 1]);

            $meta = [
                'title' => $post->title,
                'seo' => $post->seo,
                'keyword' => $post->keyword,
            ];

            return view('site.show-blog',
                [
                    'data' => $post,
                    'meta' => $meta,
                    'oPost' => Content::menu_post($template->id),
                    'category' => Category::get_category('post')
                ]
            );
        }
    }

}
