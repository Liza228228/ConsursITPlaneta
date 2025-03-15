<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('id_order_item');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');//при удалении заказа так же будут удалены и элементы заказа 
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');//при удалении продукта связянный с ним заказ так же будет удален
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
