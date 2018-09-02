<?php
/**
 * Created by PhpStorm.
 * User: zain
 * Date: 10/06/18
 * Time: 14:26
 */

namespace App\Datas;

use DB;

class Config
{
    public static function get_config()
    {
        $data = DB::table('configs')
            ->select('name as author', 'email', 'site_title', 'telp', 'address', 'fb', 'twitter', 'instagram', 'gplus', 'pinterest',
                'lng', 'lat', 'seo', 'keyword', 'image')
            ->leftJoin('users', 'users.id', '=', 'configs.user_id')
            ->first();

        return $data;
    }

}