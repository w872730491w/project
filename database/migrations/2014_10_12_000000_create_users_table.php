<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
             $table->increments('id');
            $table->string('settings')->nullable()->comment('用户属性');
            $table->string('name')->comment('昵称');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('confirmation_token')->comment('配合激活邮箱验证');
            $table->string('avatar')->default('/images/avatar/avatar.png')->comment('头像');
            $table->smallInteger('is_active')->default(0)->comment('用户是否激活');
            $table->integer('answers_count')->default(0)->comment('回答数量');
            $table->integer('questions_count')->default(0)->comment('问题数量');
            $table->integer('comments_count')->default(0)->comment('评论数量');
            $table->integer('favorites_count')->default(0)->comment('收藏数量');
            $table->integer('followers_count')->default(0)->comment('关注数量');
            $table->integer('followings_count')->default(0)->comment('被关注数量');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
