<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->length(10);
            $table->string('site_title');
            $table->string('telp')->nullable();
            $table->text('address')->nullable();
            $table->string('fb')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('gplus')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('lng')->nullable();
            $table->string('lat')->nullable();
            $table->text('seo')->nullable();
            $table->string('keyword')->nullable();
            $table->string('image')->nullable();
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
        Schema::table('configs', function (Blueprint $table) {
            //
        });
    }
}
