@extends('layouts.app')

@section('content')
<style>
    .main-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        padding: 20px;
        margin: 0 auto;
        min-height: 60vh;
        box-sizing: border-box;
    }
     /* Контейнер для изображений */
    .image-container {
        flex: 1;
        max-width: 450px;
    }
    /* Стили для изображений */
    .image-container img {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
      /* Контейнер для текста */
    .text-container {
        flex: 2;
        max-width: 600px;
        text-align: center;
        padding: 0 20px; /* Внутренние отступы слева и справа */
    }
     /* Заголовок */
    h1 {
        color: #333;
        font-size: 2.5em;
        margin-bottom: 20px;
    }
    /* Текст */
    p {
        color: #000;
        font-size: 1.1em;
        line-height: 1.6;
    }
</style>

<div class="main-container">
    <div class="image-container">
        <img src="{{ asset('images/main/right.jpg') }}" alt="Левое изображение кондитерской">
    </div>
    <div class="text-container">
        <h1>Добро пожаловать в нашу кондитерскую!</h1>
        <p>Мы создаем вкусные сладости из качественных ингредиентов. 
        Наша команда делает праздники еще слаще!</p>
    </div>
</div>
@endsection