@extends('layouts.app')

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

<div class="container">
    <h1>Результаты поиска для "{{ $query }}"</h1>

    <!-- проверка на результаты поиска -->
    @if($products->isEmpty())
        <p>Ничего не найдено.</p>
    @else
        <div class="products">
            <!-- отображение всех найденных продуктов -->
            @foreach($products as $product)
                <div class="product">
                   
                    <img src="{{ $product->picture }}" alt="{{ $product->name_product }}">
                    
                    <h2>{{ $product->name_product }}</h2>
                   
                    <p>Цена: {{ $product->price }} руб.</p>
                    <div>
                       
                        <a href="{{ route('shop.product.show', $product->id_product) }}">Подробнее</a>
                        
                        
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
        </div>
    @endif
</div>
@endsection