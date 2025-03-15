@extends('layouts.app')

@section('content')
<style>
    .admin-page {
        background-color: #A9CDF0; /* Голубой фон */
        padding: 20px 0; /* Добавлен отступ сверху и снизу */
    }

    .admin-page .container {
        width: 100%;
        max-width: 1200px; /* Увеличена максимальная ширина контейнера */
        padding: 0;
        margin: 0 auto;
    }

    .admin-page .table-container {
        width: 100%;
        overflow-x: auto;
        background-color: #A9CDF0; /* Голубой фон для контейнера таблицы */
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .admin-page table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        color: black; /* Черный текст в таблице */
        border-radius: 5px;
        overflow: hidden; /* Скрывает границы внутри таблицы */
    }

    .admin-page th, .admin-page td {
        padding: 12px 15px;
        text-align: left;
    }

    .admin-page th {
        background-color: #C4E4FE; /* Голубой фон для заголовка таблицы */
        color: black;
    }

    .admin-page tr {
        transition: background-color 0.3s ease; /* Плавный переход для строк */
    }

    .admin-page tr:hover {
        background-color: #F0F8FF; /* Светло-голубой фон при наведении на строку */
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
        color: white; /* Белый текст */
        border: 1px solid #e3342f; /* Красная рамка */
    }

    .admin-page .btn-outline-danger:hover {
        background-color: #cc1f1a; /* Темно-красный фон при наведении */
    }

    .admin-page .btn-outline-success {
        background-color: #38c172; /* Светло-зеленый фон */
        color: white; /* Белый текст */
        border: 1px solid #38c172; /* Светло-зеленая рамка */
    }

    .admin-page .btn-outline-success:hover {
        background-color: #1f9d55; /* Темно-зеленый фон при наведении */
    }

    .admin-page .btn-outline-purple {
        background-color: #9c27b0; /* Фиолетовый фон */
        color: white; /* Белый текст */
        border: 1px solid #9c27b0; /* Фиолетовая рамка */
    }

    .admin-page .btn-outline-purple:hover {
        background-color: #7b1fa2; /* Темно-фиолетовый фон при наведении */
    }
</style>

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Категории</h1>
    <a href="{{ route('admin.index') }}" class="btn btn-outline-purple">Назад</a>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-success">Добавить категорию</a>
    <div class="table-container mt-6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Название</th>
                    <th class="px-4 py-2">Доступность</th>
                    <th class="px-4 py-2">Операция</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="px-4 py-2">{{ $category->name_category }}</td>
                    <td class="px-4 py-2">{{ $category->available ? 'Да' : 'Нет' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.categories.edit', $category->id_category) }}" class="btn btn-outline-success">Редактировать</a>
                        <form action="{{ route('admin.categories.delete', $category->id_category) }}" method="POST" class="inline">
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