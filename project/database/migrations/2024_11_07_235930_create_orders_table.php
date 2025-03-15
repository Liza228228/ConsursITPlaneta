<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_user');
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('total_amount', 10, 2); 
            $table->enum('status', ['Создан', 'Принят', 'В процессе', 'Готов к выдаче', 'Отменён'])->default('Создан');
            $table->foreign('id_user')
            ->references('id')
                ->on('users')
                ->onDelete('cascade');//все связи с пользователем будут удалены
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
