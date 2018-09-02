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

class Category
{
    public static function get_category($module = null)
    {
        $category = DB::table('categories')
            ->select('id', 'parent', 'slug', 'title', 'description')
            ->orderBy('sort');
        if ($module) {
            $category->where('module', $module);
        }
        $category = $category->get();

        return Helper::build_tree_obj($category);
    }

    public static function get_select_category($data)
    {
        if ($data) {
            $html = '';

            foreach ($data as $key => $d) {

                $selected = old('dataCategory') == $d->id ? 'selected' : '';

                $html .= '<option class="list" value="' . $d->id . '"' . $selected . '>' . $d->title;
                if (array_key_exists('childs', $d)) {
                    $html .= self::get_select_category($d->childs);
                }
                $html .= '</option>';
            }
            $html .= '';

            return $html;
        }
    }

    public static function get_build_category($data, $class = 'dd-list')
    {
        $html = "<ol class='" . $class . "' id='category-id'>";

        foreach ($data as $key => $d) {
            $html .= '<li class="dd-item dd3-item" data-id="' . $d->id . '" >
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content"><span id="category_show' . $d->id . '">' . $d->title . '</span> 
                        <span class="span-right"> &nbsp;&nbsp; 
                            <a class="edit-button" id="' . $d->id . '"><i class="fa fa-pencil"></i></a>
                            <a class="del-button" id="' . $d->id . '"><i class="fa fa-trash"></i></a></span> 
                    </div>';
            if (array_key_exists('childs', $d)) {
                $html .= self::get_build_category($d->childs, 'child');
            }
            $html .= "</li>";
        }
        $html .= "</ol>";

        return $html;
    }

}