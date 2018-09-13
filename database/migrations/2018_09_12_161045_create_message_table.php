<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('内容');
            $table->integer('from_user_id')->comment('发送人id');
            $table->integer('to_user_id')->comment('接受人id');
            $table->integer('inbox_id')->comment('聊天id');
            $table->string('has_reading', 8)->default('N')->comment('是否查看');
            $table->string('read_at')->nullable()->comment('查看时间');
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
        Schema::dropIfExists('messages');
    }
}
