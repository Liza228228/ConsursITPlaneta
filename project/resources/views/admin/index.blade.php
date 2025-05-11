@extends('layouts.app')

@section('content')
<style>
.admin-page .btn {
    display: flex;
    padding: 10px 20px;
    margin: 20px;
    font-size: 25px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.admin-page .btn-blue {
    background-color:rgb(255, 107, 186);
    color: dark;
}
 
.admin-page .btn-blue:hover {
    background-color:rgb(248, 58, 178);
}
</style>

<div class="container mx-auto px-4 py-8 admin-page">
    <h1 class="text-3xl font-bold mb-6">Панель администратора</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.users') }}" class="btn btn-blue">Пользователи</a>
        <a href="{{ route('admin.products') }}" class="btn btn-blue">Продукты</a>
        <a href="{{ route('admin.orders') }}" class="btn btn-blue">Заказы</a>
        <a href="{{ route('admin.categories') }}" class="btn btn-blue">Категории</a>
    </div>
</div>
@endsection