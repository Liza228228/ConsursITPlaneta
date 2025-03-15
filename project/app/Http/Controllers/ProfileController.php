<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // Получаем заказы пользователя и элементы заказа
        $orders = Order::where('id_user', $user->id)
            ->with('items')
            ->orderBy('order_date', 'desc')
            ->get();

        return view('profile.profile', compact('user', 'orders'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Валидируем и обновляем данные
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',//!!!!!!!
            'phone' => 'required|string|max:20',
        ]);
        //обнавление данных
        $user->update($validatedData);

        return redirect()->route('profile/profile.show')->with('status', 'Данные успешно обновлены');
    }
}
