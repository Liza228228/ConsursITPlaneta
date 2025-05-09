@extends('layouts.app')

@section('content')
<style>
    .admin-page {
        background-color:rgb(212, 250, 250); /* Голубой фон */
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
        color: white; /* Белый текст при наведении */
    }

    .admin-page .admin-row {
        background-color: #90EE90; /* Салатовый фон для строки администратора */
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
</style>

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Данные пользователей</h1>
    <a href="{{ route('admin.index') }}" class="btn btn-outline-purple">Назад</a>
    <div class="table-container">
        <table class="w-full shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Имя</th>
                    <th class="py-3 px-6 text-left">Фамилия</th>
                    <th class="py-3 px-6 text-left">Логин</th>
                    <th class="py-3 px-6 text-left">Телефон</th>
                    <th class="py-3 px-6 text-left">Роль</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-100 {{ $user->role == 1 ? 'admin-row' : '' }}">
                    <td class="py-3 px-6 text-left">{{ $user->first_name }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->last_name }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->login }}</td>
                    <td class="py-3 px-6 text-left">{{ $user->phone }}</td>
                    <td class="py-3 px-6 text-left">
                        {{ $user->role == 0 ? 'Пользователь' : 'Администратор' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection