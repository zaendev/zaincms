<?php
/**
 * Created by PhpStorm.
 * User: zain
 * Date: 11/08/18
 * Time: 18:14
 */

namespace App\Http\Controllers\Site;


class Config
{
    public static function template()
    {
        $data = [
            'blog' => 'site.blog'
        ];

        return $data;
    }
}