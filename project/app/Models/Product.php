<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; 

    protected $primaryKey = 'id_product'; //первичный ключ
    protected $table = 'products';

    // Указываем, какие поля можно заполнять
    protected $fillable = [
        'name_product',
        'description',
        'picture',
        'weight',
        'price',
        'available',
        'quantity',
        'id_category',
    ];

    // Указываем типы для полей, который требуют изменения
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'available' => 'boolean',
    ];

    /**
     * Связь с категорией продукта.
     */
    public function category()
    {
        // Указываем связь "belongsTo(один ко многим)" с моделью Category
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    /**
     * Связь с `OrderItem`, чтобы получить заказы, связанные с продуктом.
     */
    public function orderItems()
    {
        // Указываем связь "hasMany(один ко многим)" с моделью OrderItem
        return $this->hasMany(OrderItem::class, 'id_product', 'id_product');
    }
}

