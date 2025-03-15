<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;//получение данных из формы
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Валидация данных формы
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('login', 'password');

        // Проверка, существует ли пользователь с данным логином
        $userExists = User::where('login', $credentials['login'])->exists();
        if (!$userExists) {
            return back()->withErrors(['login' => 'Пользователь с таким логином не найден'])->withInput();
        }

        // Попытка аутентификации
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Регистрация новой сессии
            return redirect()->intended('/'); // Переход на главную страницу
        }

        // Сообщение об ошибке в случае неверного пароля
        return back()->withErrors(['password' => 'Неверный пароль'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
