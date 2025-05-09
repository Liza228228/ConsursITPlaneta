@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            <!-- Левая колонка: Карточка профиля -->
            <div class="col-md-6 {{ auth()->user()->role == 1 ? 'offset-md-3' : '' }}">
    <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
        @csrf
        <div class="card profile-card">
            <div class="card-header">
                <h3>Ваши данные</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" disabled>
                    <div class="invalid-feedback" id="phoneError"></div>
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" disabled readonly
                           data-bs-toggle="tooltip" data-bs-placement="top" title="Логин изменить нельзя">
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="editButton">Изменить данные</button>
                <button type="button" class="btn btn-secondary d-none" id="cancelButton">Отмена</button>
                <button type="submit" class="btn btn-success d-none" id="saveButton">Сохранить</button>
                <!-- Форма выхода -->
                
            </div>
        </div>
    </form>
    <form action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger text-dark">Выйти</button>
    </form>
</div>

            <!-- Правая колонка: История заказов -->
            <div class="col-md-6">
    @if(auth()->user()->role != 1)
        <div class="card shadow-sm">
            <div class="card-header bg-purple text-white">
                <h3 class="mb-0">История заказов</h3>
            </div>
            <div class="card-body">
                @forelse($orders as $order)
                    <div class="mb-4 border-bottom pb-2">
                        <h5 class="mb-2">Заказ #{{ $order->id_order }}</h5>
                        <p class="mb-1"><strong>Дата заказа:</strong> {{ $order->order_date->format('d.m.Y H:i') }}</p>
                        <p class="mb-1"><strong>Статус:</strong> <span class="badge bg-light-pink">{{ $order->status }}</span></p>
                        <p class="mb-1"><strong>Итоговая сумма:</strong> {{ number_format($order->total_amount, 2) }} ₽</p>
                        <p class="mb-2">Оплата при получении!</p>
                        <h6 class="mb-2">Товары:</h6>
                        <ul class="list-group list-group-flush">
                            @foreach($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $loop->iteration }}. {{ $item->product->name_product ?? 'Неизвестный товар' }}
                                    <span>{{ $item->quantity }} шт × {{ number_format($item->price, 2) }} ₽ = {{ number_format($item->quantity * $item->price, 2) }} ₽</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="text-muted">У вас нет заказов.</p>
                @endforelse
            </div>
        </div>
    @endif
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Инициализация подсказок
            var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Сохранение оригинальных значений
            const originalValues = {
                lastName: document.getElementById('last_name').value,
                firstName: document.getElementById('first_name').value,
                phone: document.getElementById('phone').value,
            };

            // Форматирование номера телефона
            document.getElementById('phone').addEventListener('input', function() {
                let input = this.value.replace(/\D/g, '').substring(0, 11);
                let formatted = '+7';

                if (input.length > 1) {
                    formatted += ' (' + input.substring(1, 4);
                }
                if (input.length >= 4) {
                    formatted += ') ' + input.substring(4, 7);
                }
                if (input.length >= 7) {
                    formatted += '-' + input.substring(7, 9);
                }
                if (input.length >= 9) {
                    formatted += '-' + input.substring(9, 11);
                }

                this.value = formatted;
            });

            // Обработка кнопки "Редактировать"
            document.getElementById('editButton').addEventListener('click', function () {
                const inputs = document.querySelectorAll('#profileForm input:not([readonly])');
                inputs.forEach(input => input.disabled = false);
                document.getElementById('saveButton').classList.remove('d-none');
                document.getElementById('cancelButton').classList.remove('d-none');
                this.classList.add('d-none');
            });

            // Обработка кнопки "Отмена"
            document.getElementById('cancelButton').addEventListener('click', function () {
                document.getElementById('last_name').value = originalValues.lastName;
                document.getElementById('first_name').value = originalValues.firstName;
                document.getElementById('phone').value = originalValues.phone;

                const inputs = document.querySelectorAll('#profileForm input:not([readonly])');
                inputs.forEach(input => input.disabled = true);
                document.getElementById('saveButton').classList.add('d-none');
                this.classList.add('d-none');
                document.getElementById('editButton').classList.remove('d-none');
            });

          // Валидация формы
            document.getElementById('profileForm').addEventListener('submit', function(event) {
                // Получаем значение поля телефона
                const phone = document.getElementById('phone').value;
                const phonePattern = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
                //очищаем сообщение об ошибке 
                document.getElementById('phone').classList.remove('is-invalid');
                document.getElementById('phoneError').textContent = '';

                // Проверяем, соответствует ли номер телефона заданному формату
                if (!phonePattern.test(phone)) {
                    event.preventDefault();
                    
                    // для отображения ошибки
                    document.getElementById('phone').classList.add('is-invalid');
                    document.getElementById('phoneError').textContent = 'Введите корректный номер телефона';
                }
            });
        });
    </script>

    <style>
        .profile-card {
            background: #EAB0FF;/* Нежно фиолетовый цвет */
            opacity: 0.85; 
            transition: opacity 0.3s ease;
            color: white;
        }
        .profile-card:hover {
            opacity: 1;
        }
        .card {
            border: none; /* Убираем чёрную обводку */
            box-shadow: none; /* Убирает тень, если была */
        }
        #editButton {
        background-color: #FF1493; /* Цвет кнопки */
        border-color: #FF1493; /* Цвет границы */
        color: #000000; /* Цвет текста */
    }

        #editButton:hover {
            background-color: #C71585; /* Цвет при наведении */
            border-color: #C71585; /* Цвет границы при наведении */
        }

        .bg-purple {
            background-color: #EAB0FF; /* Нежно фиолетовый цвет */
        }

        .bg-light-pink {
    background-color: #ff69b4; /* Светло малиновый цвет */
}
    </style>
@endsection
