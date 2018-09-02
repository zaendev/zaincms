<?php
/**
 * Created by PhpStorm.
 * User: zain
 * Date: 10/06/18
 * Time: 14:26
 */

namespace App\Helpers;

use DB;

class Helper
{
    // for object
    public static function build_tree_obj($items)
    {
        $childs = array();
        foreach ($items as $item)
            $childs[$item->parent][] = $item;
        foreach ($items as $item) if (isset($childs[$item->id]))
            $item->childs = $childs[$item->id];

        if (!empty($childs[0])) {
            return $childs[0];
        }
    }

// or array version
    public static function build_tree($items)
    {
        $childs = array();
        foreach ($items as &$item) $childs[$item['parent']][] = &$item;
        unset($item);
        foreach ($items as &$item) if (isset($childs[$item['id']]))
            $item['childs'] = $childs[$item['id']];

        if (!empty($childs[0])) {
            return $childs[0];
        }
    }

    public static function array_to_object(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::array_to_object($value);
            }
        }
        return (object)$array;
    }

    public static function object_to_array($obj)
    {
        // Not an object or array
        if (!is_object($obj) && !is_array($obj)) {
            return $obj;
        }

        // Parse array
        foreach ($obj as $key => $value) {
            $arr[$key] = self::object_to_array($value);
        }

        // Return parsed array
        return $arr;
    }

    public static function parseJsonArray($jsonArray, $parentID = 0)
    {
        $data = [];
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = [];
            if (isset($subArray->children)) {
                $returnSubSubArray = self::parseJsonArray($subArray->children, $subArray->id);
            }

            $data[] = ['id' => $subArray->id, 'parentID' => $parentID];
            $data = array_merge($data, $returnSubSubArray);
        }
        return $data;
    }

    public static function slug($method, $table, $slug, $alt, $id, $empty)
    {

        if ($method == 'post') {
            if (empty($empty)) {
                $check = DB::table($table)
                    ->where('slug', str_slug($alt, '-'))
                    ->count();
                if ($check >= 1) {
                    $data = str_slug($alt, '-') . '-' . rand(0, 10);
                } else {
                    $data = str_slug($alt, '-');
                }
            } else {
                $check = DB::table($table)
                    ->where('slug', str_slug($slug, '-'))
                    ->count();
                if ($check >= 1) {
                    $data = str_slug($slug, '-') . '-' . rand(0, 10);
                } else {
                    $data = str_slug($slug, '-');
                }
            }
        }

        if ($method == 'update') {
            if (empty($empty)) {
                $check = DB::table($table)
                    ->where('slug', str_slug($alt, '-'))
                    ->count();
                if ($check >= 1) {
                    $data = str_slug($alt, '-') . '-' . rand(0, 10);
                } else {
                    $data = str_slug($alt, '-');
                }
            } else {
                $check = DB::table($table)
                    ->where('id', $id)
                    ->first();
                if ($check->slug == $slug) {
                    $data = $slug;
                } else {
                    $check = DB::table($table)
                        ->where('slug', str_slug($slug, '-'))
                        ->count();
                    if ($check >= 1) {
                        $data = str_slug($slug, '-') . '-' . rand(0, 10);
                    } else {
                        $data = str_slug($slug, '-');
                    }
                }
            }
        }

        return $data;
    }

    public static function paginate($items, $perPage, $page = null)
    {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof \Illuminate\Support\Collection ? $items : \Illuminate\Support\Collection::make($items);
        return new \Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]);
    }
}