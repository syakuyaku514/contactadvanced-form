<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // 役割とユーザーの中間テーブル
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
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
        // まず外部キー制約を解除する
    Schema::table('role_user', function (Blueprint $table) {
        $table->dropForeign(['role_id']);
        $table->dropForeign(['user_id']);
    });

    // その後、中間テーブルを削除する
    Schema::dropIfExists('role_user');

    // 最後にrolesテーブルを削除する
    Schema::dropIfExists('roles');
    }
}
