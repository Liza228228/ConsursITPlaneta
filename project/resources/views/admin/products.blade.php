@extends('layouts.app')

@section('content')
<style>
    .admin-page {
        background-color: rgb(212, 250, 250); /* Голубой фон */
    }

    .admin-page .container {
        width: 100%;
        max-width: 100%;
        padding: 0;
        margin: 0;
    }

    .admin-page .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .admin-page table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        color: black; /* Черный текст в таблице */
    }

    .admin-page th, .admin-page td {
        padding: 12px 15px;
        text-align: left;
    }

    .admin-page th {
        background-color: #e0ffff; /* голубой фон для заголовка таблицы */
        color: dark;
    }

    .admin-page .btn {
        display: inline-block;
        padding: 8px 12px;
        margin: 5px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .admin-page .btn-outline-danger {
        background-color: #e3342f; /* Красный фон */
        color: black; /* Черный текст */
        border: 1px solid #e3342f; /* Красная рамка */
    }

    .admin-page .btn-outline-danger:hover {
        background-color: #cc1f1a; /* Темно-красный фон при наведении */
    }

    .admin-page .btn-outline-success {
        background-color: #FF1493; 
        color: black; /* Черный текст */
        border: 1px solid #FF1493; 
    }

    .admin-page .btn-outline-success:hover {
        background-color: #C71585; 
    }

    .admin-page .btn-outline-purple {
        background-color: #9c27b0; /* Фиолетовый фон */
        color: white; /* Белый текст */
        border: 1px solid #9c27b0; /* Фиолетовая рамка */
    }

    .admin-page .btn-outline-purple:hover {
        background-color: #7b1fa2; /* Темно-фиолетовый фон при наведении */
        color: white; /* Белый текст при наведении */
    }

    .admin-page .filter-section {
        background-color: white;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .admin-page .filter-form {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .admin-page .filter-form select, 
    .admin-page .filter-form button {
        padding: 8px 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .admin-page .filter-form button {
        background-color: #3490dc;
        color: white;
        border: none;
        cursor: pointer;
    }

    .admin-page .filter-form button:hover {
        background-color: #2779bd;
    }

</style>

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Управление продуктами</h1>
    <a href="{{ route('admin.index') }}" class="btn btn-outline-purple">Назад</a>
    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-success">Добавить продукт</a>
    
    <!-- Секция фильтрации -->
    <div class="filter-section">
        <form action="{{ route('admin.products') }}" method="GET" class="filter-form">
            <select name="category_id" class="form-select">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}" {{ request('category_id') == $category->id_category ? 'selected' : '' }}>
                        {{ $category->name_category }}
                    </option>
                @endforeach
            </select>
            
            
            <button type="submit" class="btn btn-blue">Применить фильтр</button>
            <a href="{{ route('admin.products') }}" class="btn btn-outline-purple">Сбросить</a>
        </form>
    </div>

    <div class="table-container">
        <table class="w-full shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Название</th>
                    <th class="py-3 px-6 text-left">Категория</th>
                    <th class="py-3 px-6 text-left">Цена</th>
                    <th class="py-3 px-6 text-left">Количество</th>
                    <th class="py-3 px-6 text-left">Вес</th>
                    <th class="py-3 px-6 text-left">Доступность</th>
                    <th class="py-3 px-6 text-center">Операция</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $product->name_product }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->category->name_category ?? 'Без категории' }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->price }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->weight }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->available ? 'Да' : 'Нет' }}</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('admin.products.edit', $product->id_product) }}" class="btn btn-outline-success">Редактировать</a>
                        <form action="{{ route('admin.products.delete', $product->id_product) }}" method="POST" class="inline" onsubmit="return confirm('Вы уверены?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection