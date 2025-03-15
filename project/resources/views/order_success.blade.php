@extends('layouts.app')

@section('content')
<div class="order-success-page">
    <div class="order-success-content">
        <h1 class="order-success-title">Заказ успешно оформлен!</h1>
        <p class="order-success-message">Ваш заказ был успешно оформлен. Вы можете оплатить его наличными во время получения.</p>
        <a href="{{ route('shop.catalog') }}" class="order-success-button">Вернуться в каталог</a>
    </div>
     <!-- Контейнер для стилизции -->
    <div class="order-success-decor">
        <div class="decor-item"></div>
        <div class="decor-item"></div>
        <div class="decor-item"></div>
    </div>
</div>

<style>
    /* Основной контейнер страницы */
    .order-success-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        background: #f9e7e7; /* Розовый фон*/
    }
/* Контейнер для содержимого */
    .order-success-content {
        text-align: center;
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
/* Заголовок страницы */
    .order-success-title {
        font-size: 2rem;
        color: #d35400; /* Оранжевый цвет*/
        margin-bottom: 1rem;
    }
 /* Текст */
    .order-success-message {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 2rem;
    }
/* Кнопка "Вернуться в каталог" */
    .order-success-button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: #2ecc71; /* Зеленый цвет кнопки */
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }
 
    .order-success-button:hover {
        background: #27ae60; /* Темнее зеленый цвет при наведении */
    }
     /* Контейнер для стиля */
    .order-success-decor {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .decor-item {
        position: absolute;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
    }

    .decor-item:nth-child(1) {
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .decor-item:nth-child(2) {
        top: 20%;
        left: 70%;
        animation-delay: 2s;
    }

    .decor-item:nth-child(3) {
        top: 60%;
        left: 30%;
        animation-delay: 4s;
    }


</style>
@endsection