<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_category';//первичный ключ
    protected $table = 'categories';

    protected $fillable = [
        'name_category',
        'available',
    ];

    public function products()
    {
        //связь "один ко многим"
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
}
