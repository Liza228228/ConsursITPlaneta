@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
<style>
    .products {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.product {
    border: 1px solid #ccc;
    padding: 10px;
    width: 300px;
    height: 400px; /* Фиксированная высота для карточек */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
}

.product img {
    width: 100%;
    height: 250px; /* Фиксированная высота для изображений */
    object-fit: cover; /* Чтобы изображения не искажались */
}

.product h2 {
    margin: 10px 0;
    font-size: 18px;
}

.product p {
    margin: 5px 0;
    font-size: 16px;
    flex-grow: 1; /* Чтобы цена была посередине */
}

.product a, .product form {
    margin-top: 10px;
}

.product a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.product a:hover {
    background-color: #0056b3;
}

.product form {
    display: inline-block;
}

.product button {
    padding: 5px 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.product button:hover {
    background-color: #218838;
}
</style>
    
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}  <!-- Вывод сообщения об успешном добавлении в корзину -->
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }} 
    </div>
@endif

<!-- Вывод названия категории -->
@foreach($categories as $category)
    <h1>{{ $category->name_category }}</h1>  

    <div class="products">
        <!-- Проверка для вывода продукции в категории -->
        @if(isset($productsByCategory[$category->id_category]) && $productsByCategory[$category->id_category]->count() > 0)
            @foreach($productsByCategory[$category->id_category] as $product)
                <div class="product">
                    <img src="{{ asset($product->picture) }}" alt="{{ $product->name_product }}">  
                    <h2>{{ $product->name_product }}</h2>  
                    <p>Цена: {{ $product->price }} руб.</p>  
                    <div>
                       
                        <a href="{{ route('shop.product.show', $product->id_product) }}">Подробнее</a>
                        
                        <!-- Проверка пользователя на роль для админа -->
                        @if(auth()->check() && auth()->user()->role != 1)
                            <!--  добавление продукции в корзину для пользователей, кроме администратора -->
                            <form action="{{ route('shop.cart.add', $product->id_product) }}" method="POST">
                                @csrf
                                <button type="submit">Добавить в корзину</button>
                            </form>
                        @elseif(!auth()->check())
                        
                            <form action="{{ route('shop.cart.add', $product->id_product) }}" method="POST">
                                @csrf
                                <button type="submit">Добавить в корзину</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <!--  если в категории нет продукции -->
            <p>Нет доступных продуктов в этой категории.</p> 
        @endif
    </div>
@endforeach
@endsection
