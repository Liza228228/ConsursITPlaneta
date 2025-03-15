<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;//для даты и времени

class Order extends Model
{
    use HasFactory;
 
    protected $primaryKey = 'id_order';//первичный ключ

    protected $fillable = [
        'id_user',
        'total_amount',
        'status',
    ];

    protected $dates = [
        'order_date',
    ];

    // Аксессор для преобразования order_date в объект Carbon для даты
    public function getOrderDateAttribute($value)
    {
        return Carbon::parse($value);
    }
    
    public function items()
    {
        //связь один ко многим, заказможет содержать несколько элементов заказа
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

