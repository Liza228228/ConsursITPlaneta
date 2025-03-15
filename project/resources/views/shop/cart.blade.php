@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<style>
    .cart {
        width: 100%;
        background-color: peachpuff; /* Персиковый цвет */
        padding: 20px;
        box-sizing: border-box;
    }

    .cart h1 {
        margin: 20px 0;
        text-align: center;
    }

    .cart .product {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .cart .product-image {
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }

    .cart .product-details {
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    .cart .product-name {
        font-weight: bold;
        margin-right: 20px;
    }

    .cart .product-price {
        color: #8139ED;
        margin-right: 20px;
    }

    .cart .product-total {
        font-weight: bold;
        margin-right: 20px;
    }

    .cart .quantity-controls {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .cart .quantity-controls button {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background-color: #8139ED;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    .cart .quantity-controls input {
        width: 40px;
        height: 30px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 0 10px;
    }

    .cart .product-actions {
        display: flex;
        align-items: center;
    }

    .cart .product-actions button,
    .cart .checkout-button {
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .cart .product-actions button:hover,
    .cart .checkout-button:hover {
        background-color: #218838;
    }

    .cart p {
        margin: 10px 0;
        text-align: center;
    }

    .cart a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #8139ED;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
    }

    .cart a:hover {
        background-color: #8139ED;
    }
</style>

<div class="cart">
    <h1>Корзина</h1>
<!-- проверка есть ли в корзине продукция -->
    @if(isset($cart) && count($cart) > 0)
        @foreach($cart as $id => $item)
            <div class="product">
                <div class="product-details">
                    <div class="product-name">{{ $item['name'] }}</div>
                    <div class="product-price">{{ $item['price'] }} руб.</div>
                    <div class="quantity-controls">
                        <form action="{{ route('shop.cart.update', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ max($item['quantity'] - 1, 1) }}">
                            <button type="submit" @if($item['quantity'] == 1) disabled @endif>-</button>
                        </form>
                         <input type="number" value="{{ $item['quantity'] }}" min="1" max="{{ $item['max_quantity'] }}" readonly><!--нельзя редактировать -->
                        <form action="{{ route('shop.cart.update', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ min($item['quantity'] + 1, $item['max_quantity']) }}">
                            <button type="submit" @if($item['quantity'] == $item['max_quantity']) disabled @endif>+</button>
                        </form>
                    </div>
                    
                </div>
                <div class="product-actions">
                    <form action="{{ route('shop.cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
        <p>Итого: <span class="product-total">{{ $total }} руб.</span></p>

        <form action="{{ route('shop.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="checkout-button">Оформить заказ</button>
        </form>
    @else
        <p>Ваша корзина пуста.</p>
    @endif

    <a href="{{ route('shop.catalog') }}">Перейти к каталогу</a>
</div>
@endsection