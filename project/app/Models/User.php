<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'last_name',
        'first_name',
        'phone',
        'login',
        'password',
        'role',
    ];

    protected $hidden = [
        'password', // Пароль пользователя скрывается 
    ];

    public function isAdmin()
    {
        return $this->role === 1; //если роль 1, то пользователь администратор
    }
}
