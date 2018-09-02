<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('user_id', false, true)->length(10);
            $table->integer('category_id', false, true)->length(10)->nullable();
            $table->integer('menu_id', false, true)->length(10);
            $table->string('title');
            $table->longText('content');
            $table->string('image', 50)->nullable();
            $table->text('seo')->nullable();
            $table->string('keyword')->nullable();
            $table->tinyInteger('status', false, true)->length(2);
            $table->integer('view', false, true)->length(10)->nullable();
            $table->string('plugin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
