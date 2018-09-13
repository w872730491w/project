<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id');
            $table->string('cover')->nullable()->comment('封面');
            $table->enum('sex', [1,0])->nullable()->comment('性别 1 为男 0 为女');
            $table->string('introduction', 40)->nullable()->comment('一句话简介');
            $table->string('place')->nullable()->comment('居住地');
            $table->string('industry')->nullable()->comment('所在行业');
            $table->string('career')->nullable()->comment('职业经历');
            $table->string('education')->nullable()->comment('教育经历');
            $table->string('describe')->nullable()->comment('描述');
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
        Schema::dropIfExists('profiles');
    }
}
