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
    .admin-page .form-container select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .admin-page .form-container button {
        background-color: #3490dc; /* Синий фон для кнопки */
        color: white; /* Белый текст для кнопки */
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .admin-page .form-container button:hover {
        background-color: #2779bd; /* Темно-синий фон при наведении */
    }
</style>

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Редактировать категорию</h1>
    <div class="form-container">
        <form action="{{ route('admin.categories.update', $category->id_category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name_category" class="block text-gray-700 text-sm font-bold mb-2">Название категории</label>
                <input type="text" name="name_category" id="name_category" value="{{ $category->name_category }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="available" class="block text-gray-700 text-sm font-bold mb-2">Доступность</label>
                <select name="available" id="available" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1" {{ $category->available ? 'selected' : '' }}>Да</option>
                    <option value="0" {{ !$category->available ? 'selected' : '' }}>Нет</option>
                </select>
            </div>
            <button type="submit" class="btn btn-blue">Обновить</button>
        </form>
    </div>
</div>
@endsection