<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();

            // 外部キー制約の追加
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // 外部キー制約の削除
            $table->dropForeign(['user_id']);

            // カラムの削除
            $table->dropColumn('user_id');
        });
    }
};
