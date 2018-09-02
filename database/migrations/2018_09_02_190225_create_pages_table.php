<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent', false, true)->default(0)->length(10);
            $table->string('slug');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('image', 50)->nullable();
            $table->text('seo')->nullable();
            $table->string('keyword')->nullable();
            $table->tinyInteger('status', false, true)->default(1)->length(2);
            $table->integer('view', false, true)->length(10)->nullable();
            $table->string('plugin')->nullable();
            $table->string('template')->nullable();
            $table->integer('sort', false, true)->default(0)->length(10);
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
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
}
