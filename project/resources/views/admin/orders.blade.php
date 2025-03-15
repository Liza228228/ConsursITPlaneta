@extends('layouts.app')

@section('content')
<style>
     .admin-page {
        background-color: #A9CDF0; /* Голубой фон */
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
        background-color: #C4E4FE; /* голубой фон для заголовка таблицы */
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

    .admin-page .btn-outline-success {
        background-color: #38c172; /* Светло-зеленый фон */
        color: black; /* Черный текст */
        border: 1px solid #38c172; /* Светло-зеленая рамка */
    }

    .admin-page .btn-outline-success:hover {
        background-color: #1f9d55; /* Темно-зеленый фон при наведении */
        color: white; /* Белый текст при наведении */
    }

    .admin-page .btn-blue {
        background-color: #3490dc; /* Синий фон */
        color: white; /* Белый текст */
        border: 1px solid #3490dc; /* Синяя рамка */
    }

    .admin-page .btn-blue:hover {
        background-color: #2779bd; /* Темно-синий фон при наведении */
        color: white; /* Белый текст при наведении */
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
    <h1 class="text-3xl font-bold mb-6">Управление заказами</h1>
    <a href="{{ route('admin.index') }}" class="btn btn-outline-purple">Назад</a>
    <div class="table-container">
        <table class="w-full shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Пользователь</th>
                    <th class="py-3 px-6 text-left">Дата</th>
                    <th class="py-3 px-6 text-left">Сумма</th>
                    <th class="py-3 px-6 text-left">Статус</th>
                    <th class="py-3 px-6 text-center">Операция</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($orders as $order)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                    <td class="py-3 px-6 text-left">{{ $order->order_date }}</td>
                    <td class="py-3 px-6 text-left">{{ $order->total_amount }}</td>
                    <td class="py-3 px-6 text-left">{{ $order->status }}</td>
                    <td class="py-3 px-6 text-center">
                        <form action="{{ route('admin.orders.update', $order->id_order) }}" method="POST" class="inline">
                            @csrf 
                            @method('PUT')
                            <select name="status" class="mr-2 p-2 border rounded">
                                <option value="Создан" {{ $order->status == 'Создан' ? 'selected' : '' }}>Создан</option>
                                <option value="Принят" {{ $order->status == 'Принят' ? 'selected' : '' }}>Принят</option>
                                <option value="В процессе" {{ $order->status == 'В процессе' ? 'selected' : '' }}>В процессе</option>
                                <option value="Готов к выдаче" {{ $order->status == 'Готов к выдаче' ? 'selected' : '' }}>Готов к выдаче</option>
                                <option value="Отменён" {{ $order->status == 'Отменён' ? 'selected' : '' }}>Отменён</option>
                            </select>
                            <button type="submit" class="btn btn-blue">Обновить статус</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection