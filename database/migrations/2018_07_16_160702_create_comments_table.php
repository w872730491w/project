<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body')->comment('评论内容');
            $table->integer('user_id')->comment('评论用户id');
            $table->integer('to_comment_id')->comment('回复的id');
            $table->integer('vote_counts')->default(0)->comment('点赞次数');
            $table->integer('commentable_id')->comment('多态id');
            $table->string('commentable_type')->comment('多态关系');
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
        Schema::dropIfExists('comments');
    }
}
