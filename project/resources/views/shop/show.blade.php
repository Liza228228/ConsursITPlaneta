@extends('layouts.app')

@section('content')
<style>
    .product-container {
        max-width: 1500px;
        margin: 70px;
        border: 2px solid #ccc;
        padding: 50px;
        display: flex;
        align-items: center;
    }

    .product-image {
        flex: 1;
        padding-right: 20px;
    }

    .product-image img {
        max-width: 100%;
        height: auto;
    }

    .product-details {
        flex: 2;
        text-align: left;
    }

    .product-details h1 {
        margin: 0 0 20px 0;
    }

    .product-details p {
        margin: 10px 0;
    }

    .product-actions {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .product-actions a, .product-actions button {
        display: inline-block;
        padding: 10px 20px;
        color: #000000;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .product-actions a {
        background-color: #FFB6C1;
    }

    .product-actions a:hover {
        background-color: #FF69B4;
    }

    .product-actions button {
        background-color: #FF1493; 
        margin-left: 10px;
    }

    .product-actions button:hover {
        background-color: #C71585; 
    }
</style>

<div class="product-container">
    <div class="product-image">
        <img src="{{ asset($product->picture) }}" alt="{{ $product->name_product }}">
    </div>
    <div class="product-details">
        <h1>{{ $product->name_product }}</h1>
        <p>{{ $product->description }}</p>
        <p>Цена: {{ $product->price }} руб.</p>
        <p>Вес: {{ $product->weight }} кг</p>
        <div class="product-actions">
            <a href="{{ route('shop.catalog') }}">Назад к каталогу</a>
            <form action="{{ route('shop.cart.add', $product->id_product) }}" method="POST">
                @csrf
                @if(auth()->check() && auth()->user()->role != 1)
                    <button type="submit">Добавить в корзину</button>
                @elseif(!auth()->check())
                    <button type="submit">Добавить в корзину</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection