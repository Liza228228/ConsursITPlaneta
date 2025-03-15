<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Регистрация</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
            background: #ffc0cb ;
           
        }
        .form-container {
            width: 100%;
            max-width: 400px; 
            padding: 20px;
            background: #e0ffff; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .input-group-text {
            cursor: pointer; 
        }
        .error-message {
            color: red;
            font-size: 0.875em;
        }
        .btn-primary {
            background-color: #ff69b4;
            border-color: #ff69b4;
        }
        .btn-primary:hover {
            background-color: #ff1493;
            border-color: #ff1493;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center" style="color: #ff69b4;">Регистрация</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="last_name" class="form-label">Фамилия</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Имя</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" name="login" value="{{ old('login') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text" id="togglePassword">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                <span class="input-group-text" id="togglePasswordConfirmation">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <span id="password-match-error" class="error-message d-none">Пароли не совпадают</span>
        </div>
        <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
    </form>

    <div class="mt-3 text-center">
        <span>Уже есть аккаунт? <a href="{{ route('login') }}" style="color: #ff69b4;">Войти</a></span>
    </div>
</div>

<script>
            document.addEventListener('DOMContentLoaded', function() {
            // Маска для телефона
            document.getElementById('phone').addEventListener('input', function() {
                let input = this.value.replace(/\D/g, ''); 
                let formatted = '+7 ('; 

                if (input.length > 1) {
                    formatted += input.slice(1, 4); 
                }
                if (input.length >= 4) {
                    formatted += ') ' + input.slice(4, 7); 
                }
                if (input.length >= 7) {
                    formatted += '-' + input.slice(7, 9); 
                }
                if (input.length >= 9) {
                    formatted += '-' + input.slice(9, 11); 
                }

                this.value = formatted; 
            });

            // Скрипт для переключения видимости пароля
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordField = document.getElementById('password'); // поле пароля
                const passwordFieldType = passwordField.type; // тип поля 
                if (passwordFieldType === 'password') {
                    passwordField.type = 'text'; // пароль
                    this.querySelector('i').classList.remove('fa-eye-slash'); // иконка глаз
                    this.querySelector('i').classList.add('fa-eye');
                } else {
                    passwordField.type = 'password'; // пароль скрытый
                    this.querySelector('i').classList.remove('fa-eye'); // иконка закрытый глаз
                    this.querySelector('i').classList.add('fa-eye-slash');
                }
            });

            // Скрипт для переключения видимости подтверждения пароля
            document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
                const passwordConfirmationField = document.getElementById('password_confirmation'); 
                const passwordConfirmationFieldType = passwordConfirmationField.type; // тип поля
                if (passwordConfirmationFieldType === 'password') {
                    passwordConfirmationField.type = 'text'; //  пароль
                    this.querySelector('i').classList.remove('fa-eye-slash'); // Меняем иконку 
                    this.querySelector('i').classList.add('fa-eye');
                } else {
                    passwordConfirmationField.type = 'password'; // скрываем пароль
                    this.querySelector('i').classList.remove('fa-eye'); // иконка закрытый глаз
                    this.querySelector('i').classList.add('fa-eye-slash');
                }
            });

            // Проверка совпадения паролей в реальном времени
            document.getElementById('password').addEventListener('input', checkPasswordMatch); // обработчик на поле пароля
            document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch); // обработчик на поле подтверждения пароля

            function checkPasswordMatch() {
                const password = document.getElementById('password').value; 
                const passwordConfirmation = document.getElementById('password_confirmation').value; 
                const errorSpan = document.getElementById('password-match-error'); // элемент отображения ошибки

                if (password && passwordConfirmation && password !== passwordConfirmation) {
                    errorSpan.classList.remove('d-none'); // ошибка если пароли не совпадают
                } else {
                    errorSpan.classList.add('d-none'); 
                }
            }
        });
</script>
</body>
</html>