<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'user_id' => 1,
            'site_title' => 'Zain CMS',
            'telp' => '085707509221',
            'fb' => 'https://www.facebook.com/kimzukazama',
            'instagram' => 'https://www.instagram.com/_zain_3_',
            'seo' => 'Zain CMS',
            'keyword' => 'Zain CMS',
            'image' => 'sSTVXuVFabgLEHSGvQr56KkSj0jLH0BW65oCg41v.jpg',
        ]);
    }
}
