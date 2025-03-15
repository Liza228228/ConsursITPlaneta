<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order_item';//первичный ключ

    protected $fillable = [
        'id_order', 
        'id_product',
        'quantity',
        'price',
    ];

    public function product()
    {
         // Указываем связь "belongsTo"(один ко многим) с моделью Product
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}

