@extends('layouts.app')

@section('content')
<style>
    .admin-page {
        background-color: #e0ffff; /* Голубой фон */
        color: black; /* Черный текст */
    }

    .admin-page .container {
     width: 100%;
        max-width: 100%;
        padding: 0;
        margin: 0;
    }

    .admin-page .form-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .admin-page .form-container form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .admin-page .form-container label {
        color: black; /* Черный текст для лейблов */
    }

    .admin-page .form-container input,
    .admin-page .form-container textarea,
    .admin-page .form-container select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .admin-page .form-container button {
        background-color: #38c172; /* Светло-зеленый фон для кнопки */
        color: white; /* Белый текст для кнопки */
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .admin-page .form-container button:hover {
        background-color: #1f9d55; /* Темно-зеленый фон при наведении */
    }
</style>

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Редактировать продукт</h1>
    <div class="form-container">
        <form action="{{ route('admin.products.update', $product->id_product) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name_product">
                    Название
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name_product" type="text" name="name_product" value="{{ $product->name_product }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Описание
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="mb-4">
            <label for="weight" class="block text-gray-700 text-sm font-bold mb-2">
                Вес (В килограммах)
            </label>
            <input type="text" name="weight" id="weight" value="{{ $product->weight }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Цена
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" type="number" step="0.01" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                    Количество
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" type="number" name="quantity" value="{{ $product->quantity }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="available">
                    Доступность
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="available" name="available">
                    <option value="1" {{ $product->available ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ !$product->available ? 'selected' : '' }}>Нет</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="id_category">
                    Категория
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="id_category" name="id_category" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_category }}" {{ $product->id_category == $category->id_category ? 'selected' : '' }}>
                            {{ $category->name_category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="picture">
                    Изображение
                </label>
                @if($product->picture)
                    <div class="mb-4">
                        <img src="{{ asset($product->picture) }}" alt="{{ $product->name_product }}" class="w-32 h-32 object-cover">
                    </div>
                @endif
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="picture" type="file" name="picture">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Обновить
                </button>
            </div>
        </form>
    </div>
</div>
@endsection