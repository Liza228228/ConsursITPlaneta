<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkout()
    {
        // Получаем корзину из сессии
        $cart = Session::get('cart', []);
    
        // Проверяем, что корзина не пуста
        if (empty($cart)) {
            return redirect()->route('shop.cart.show')->with('error', 'Ваша корзина пуста.');
        }
    
        // Создаем новый заказ
        $order = new Order();
        $order->id_user = Auth::id();
        $order->total_amount = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
        $order->save();
    
        // Добавляем товары в заказ и обновляем количество товаров
        foreach ($cart as $productId => $item) {
            $orderItem = new OrderItem();
            $orderItem->id_order = $order->id_order;
            $orderItem->id_product = $productId;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();
    
            // Уменьшаем количество товара в базе данных
            $product = Product::find($productId);
            if ($product) {
                $product->quantity -= $item['quantity'];
                if ($product->quantity <= 0) {
                    $product->quantity = 0;
                    $product->available = false;
                }
                $product->save();
            }
        }
    
        // Очищаем корзину
        Session::forget('cart');
    
        // Перенаправляем на страницу успешного оформления заказа
        return redirect()->route('order.success');
    }

    public function success()
    {
        return view('order_success');
    }
}