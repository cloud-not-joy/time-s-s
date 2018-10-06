<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id')->comment('用于ID');
            $table->string('nickname', 32)->comment('用户昵称');
            $table->string('name', 32)->comment('用户名');
            $table->text('original')->comment('原数据源');
            $table->string('status', 16)->default('deactivated')->comment('状态("activated-可用；deactivated-不可用")');
            $table->dateTime('created_at')->default(\Db::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
            $table->dateTime('updated_at')->default(\Db::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新时间');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        App::isLocal() && Schema::dropIfExists('users');
    }
}
