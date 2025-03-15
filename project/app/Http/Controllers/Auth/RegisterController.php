<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;//получение данных из формы
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        //проверка входящих данных
        $request->validate([
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20|unique:users,phone',// проверка на уникальность 
            'login' => 'required|string|max:20|unique:users,login',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'phone.unique' => 'Номер телефона уже зарегистрирован',
            'login.unique' => 'Логин занят',
            'password.confirmed' => 'Введённые пароли не совпадают',
            'password.min' => 'Длина пароля не может быть меньше 8 символов',
        ]);
    
        User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,//!!!!!!!!!!
            'phone' => $request->phone,
            'login' => $request->login,
            'password' => Hash::make($request->password),//хэшируется
        ]);
    
        return redirect()->route('login')->with('status', 'Регистрация успешна!');
    }
    
}

