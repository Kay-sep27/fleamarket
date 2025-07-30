<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            // 購入者（ユーザー）とのリレーション
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // 購入対象（商品）とのリレーション
            $table->foreignId('item_id')
                ->constrained()
                ->onDelete('cascade');

            // 支払い方法（コンビニ or カード）
            $table->enum('payment_method', ['convenience', 'card']);

            // 配送先情報
            $table->string('shipping_zip');
            $table->string('shipping_address');
            $table->string('shipping_building')->nullable();

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
        Schema::dropIfExists('purchases');
    }
}