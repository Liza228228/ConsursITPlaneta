<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name_product', 100);
            $table->text('description')->nullable();
            $table->string('picture',255)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('available')->default(true);
            $table->integer('quantity');
            $table->unsignedBigInteger('id_category')->nullable();
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('set null');//при удалении категории значение в продукте будет отсутствовать
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
