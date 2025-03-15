<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)// добавление товара в корзину
{
    //получение продукта и корзины из сессии
    $product = Product::findOrFail($id);
    $cart = Session::get('cart', []);
    //добавление продукта и увеличение колличества
    if (isset($cart[$id])) {
        if ($cart[$id]['quantity'] < $product->quantity) {
            $cart[$id]['quantity']++;
        } else {
            return redirect()->route('shop.catalog')->with('error', 'Невозможно добавить больше товаров, чем доступно в наличии.');
        }
    } else {//если товара нет то просто добавляем и колличество будет 1
        $cart[$id] = [
            'name' => $product->name_product,
            'price' => $product->price,
            'quantity' => 1,
            'max_quantity' => $product->quantity,
        ];
    }
    //сохранение обновленной корзины в сессии
    Session::put('cart', $cart);

    return redirect()->route('shop.catalog')->with('success', 'Продукт добавлен в корзину!');
}

    public function showCart()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $id => $item) {//вычисляем общую сумму
            $product = Product::find($id);
            $cart[$id]['max_quantity'] = $product->quantity;
            $total += $item['price'] * $item['quantity'];
        }

        return view('shop.cart', compact('cart', 'total'));
    }

    public function updateCart(Request $request, $id)//обновление колличества в корзине
    {
        $cart = Session::get('cart', []);
        $product = Product::find($id);

        if ($product && $request->quantity <= $product->quantity) {//если колличество превышает, то выдается ошибка
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        } else {
            return redirect()->route('shop.cart.show')->with('error', 'Невозможно установить количество больше, чем доступно в наличии.');
        }

        return redirect()->route('shop.cart.show')->with('success', 'Количество товара обновлено.');
    }

    public function removeFromCart($id)//удаление товара из корзины
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('shop.cart.show')->with('success', 'Товар удален из корзины.');
    }

    public function getCartCount()//получение итогового колличества
    {
        $cart = Session::get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return response()->json(['count' => $count]);
    }
}