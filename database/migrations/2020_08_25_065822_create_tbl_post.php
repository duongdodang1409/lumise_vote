<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_post', function (Blueprint $table) {
            $table->increments('post_id');
            $table->bigInteger('tag_id');
            $table->integer('user_create');
            $table->string('post_title');
            $table->text('post_content');
            $table->text('post_image');
            $table->text('post_vote_ids');
            $table->integer('post_vote_count');
            $table->string('post_status');
            $table->dateTime('post_create', 0);
           
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
        Schema::dropIfExists('tbl_post');
    }
}
