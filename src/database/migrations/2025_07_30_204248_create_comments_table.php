<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            // ユーザーとのリレーション
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // 商品とのリレーション
            $table->foreignId('item_id')
                ->constrained()
                ->onDelete('cascade');

            // コメント本文
            $table->text('comment');

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