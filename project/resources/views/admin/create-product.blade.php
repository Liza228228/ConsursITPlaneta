@extends('layouts.app')

@section('content')
<style>
    .admin-page {
        background-color: #e0ffff; /* Голубой фон */
        color: black; /* Черный текст */
        padding: 20px 0; /* Добавлен отступ сверху и снизу */
    }

    .admin-page .container {
        width: 100%;
        max-width: 1200px; /* Увеличена максимальная ширина контейнера */
        padding: 0;
        margin: 0 auto;
    }

    .admin-page .form-container {
        width: 100%;
        max-width: 1000px; /* Увеличена ширина формы */
        margin: 0 auto;
        background-color: #e0ffff; /* Голубой фон для контейнера */
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Добавить новый продукт</h1>
    <div class="form-container">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name_product">
                    Название
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name_product') border-red-500 @enderror" id="name_product" type="text" name="name_product" value="{{ old('name_product') }}" required>
                
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Описание
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" id="description" name="description">{{ old('description') }}</textarea>
                
            </div>
            <div class="mb-4">
                <label for="weight" class="block text-gray-700 text-sm font-bold mb-2">
                    Вес (В килограммах)
                </label>
                <input type="number" name="weight" id="weight" step="0.01" min="0.00" max="999.99" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('weight') border-red-500 @enderror" value="{{ old('weight') }}" required>
              
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Цена
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror" id="price" type="number" step="0.01" min="0.00" max="99999999.99" name="price" value="{{ old('price') }}" required>
                
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                    Количество
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('quantity') border-red-500 @enderror" id="quantity" type="number" min="0" max="2147483647" name="quantity" value="{{ old('quantity') }}" required>
                
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="available">
                    Доступность
                </label> 
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('available') border-red-500 @enderror" id="available" name="available">
                    <option value="1" {{ old('available') == 1 ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ old('available') == 0 ? 'selected' : '' }}>Нет</option>
                </select>
                
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="id_category">
                    Категория
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('id_category') border-red-500 @enderror" id="id_category" name="id_category" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_category }}" {{ old('id_category') == $category->id_category ? 'selected' : '' }}>
                            {{ $category->name_category }}
                        </option>
                    @endforeach
                </select>
               
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="picture">
                    Изображение
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('picture') border-red-500 @enderror" id="picture" type="file" name="picture">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Добавить
                </button>
            </div>
        </form>
    </div>
</div>
@endsection