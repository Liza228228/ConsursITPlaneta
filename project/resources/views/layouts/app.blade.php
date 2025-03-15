<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
     <title>@yield('title', 'Fancy - кондитерская')</title><!--заголовок страницы -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Подключает библиотеку иконок Font Awesome для иконок -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link type="image/x-icon" href="{{ asset('favicon.ico') }}" rel="icon">
    <style>
        body {
            background-color: #FFEAE4;
        }

        header {
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            padding-bottom: 0px;
            background-color: #FFB6C1;
        }

        .header-content {
            border-radius: 0;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            flex-direction: column-reverse;
            flex-wrap: wrap;
            max-width: 100%;
            margin: 0 auto;
        }
        .content {
            margin-top: 150px; /* Отступ, чтобы контент находился ниже шапки */
        }
        .search-input {
            border-radius: 20px; /* Скругление */
            padding-right: 2.5rem; /* Отступ справа для иконки */
            padding-left: 2.5rem; /* Отступ слева для иконки */
            background-color: rgba(255, 255, 255, 0.8); /* Прозрачность фона */
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Плавные переходы */
        }
        /* Иконка поиска */
        .search-icon {
            position: absolute;
            left: 5px; /* Отступ для иконки */
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        /* Цвет текста плейсхолдера */
            .search-input::placeholder {
        }
        /* Эффект при наведении */
        .search-input:hover, .search-input:focus {
            background-color: rgba(255, 255, 255, 1); /* Убираем прозрачность при наведении */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Тень при наведении */
        }
        /*подвал */
        footer { 
            background-color: #FFB6C1 ;
            color: #333;
            display: flex;
            align-items: center;
        }
        footer .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: background-color 0.3s ease; /* Добавляем плавный переход для подсветки */
        }
        .dropdown-toggle {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 0;
            border: none;
        }
        .dropdown-toggle:focus {
            box-shadow: none; /* Убираем синее выделение */
        }
        .dropdown-toggle::after {
            display: none; /* Убираем стрелочку */
        }
        .dropdown:hover .dropdown-menu {
            display: block; /* Показываем меню при наведении */
        }
        .dropdown-menu {
            display: none; /* Скрываем меню по умолчанию */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <div class="container">
        <div class="header-content">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Логотип" class="me-2" style="max-width: 100px;">
                </a>

                <a href="/" class="btn btn-light btn btn-outline-danger me-2">Главная</a>
               
                <a href="/catalog" class="btn btn-light btn btn-outline-danger me-3">Каталог</a>
                <!-- проверка на администратора  -->
                @auth
                    @if(auth()->user()->isAdmin())
                     <a href="{{ route('admin.index') }}" class="btn btn-light btn btn-outline-danger me-2">Админ панель</a>
                     @endif
                @endauth

                <div class="position-relative w-50">
                    <form action="{{ route('shop.search') }}" method="GET">
                        <input type="text" class="form-control search-input" name="query" placeholder="Поиск..." aria-label="Search">
                        <button type="submit" class="btn btn-link search-icon"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                @if(auth()->check() && auth()->user()->role != 1)
                    <div style="position: relative; display: inline-block;">
                        <a href="/cart" class="btn btn-outline-secondary btn btn-outline-danger rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;" id="cart-icon">
                            <i class="fa fa-cart-arrow-down"></i>
                        </a>
                        <span id="cart-count" class="badge bg-danger" style="position: absolute; top: -10px; right: -10px; display: {{ Session::get('cart', []) ? 'inline-block' : 'none' }};">{{ Session::get('cart', []) ? array_sum(array_column(Session::get('cart', []), 'quantity')) : 0 }}</span>
                    </div>
                @elseif(!auth()->check())
                    <div style="position: relative; display: inline-block;">
                        <a href="/cart" class="btn btn-outline-secondary btn btn-outline-danger rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;" id="cart-icon">
                            <i class="fa fa-cart-arrow-down"></i>
                        </a>
                        <span id="cart-count" class="badge bg-danger" style="position: absolute; top: -10px; right: -10px; display: {{ Session::get('cart', []) ? 'inline-block' : 'none' }};">{{ Session::get('cart', []) ? array_sum(array_column(Session::get('cart', []), 'quantity')) : 0 }}</span>
                    </div>
                @endif
        
                <div class="dropdown">
                 @if(Auth::check())
                    <a href="/lk/profile" class="btn btn-outline-primary btn-outline-danger" id="profileDropdown">
                       <div class="profile-icon">
                      <i class="fas fa-user"></i>
                  </div>
                 </a>
                 @else
                     <button class="btn btn-outline-primary dropdown-toggle btn-outline-danger" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="profile-icon">
                     <i class="fas fa-user"></i>
                  </div>
                 </button>
                  <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                  <li><a class="dropdown-item" href="/lk/login">Вход</a></li>
                 <li><a class="dropdown-item" href="/lk/register">Регистрация</a></li>
                  </ul>
                  @endif
                </div>
            </div>
        </div>
    </div>
</header>

<main class="container my-4">
    @yield('content')
</main>

 <footer class="py-3 mt-auto">  <!--элементы подвала -->
    <div class="container">
        <!-- Левый блок - Контакты -->
        <div class="col-md-3 d-flex flex-column justify-content-center">
            <ul class="list-unstyled">
                <li><i class="fas fa-phone me-2"></i> <a href="tel: +7 (999)-222-33-44" class="text-dark">+7 (999)-422-33-44</a></li>
                <li><i class="fas fa-envelope me-2"></i> <a href="mailto: fancy@fancy.ry" class="text-dark">fancy@fancy.ry</a></li>
                <li><i class="fas fa-map-marker-alt me-2"></i> Иркутск, ул. Ленина, д. 5А</li>
            </ul>
        </div>

        <!-- Второй блок - Навигация -->
        <div class="col-md-3 d-flex flex-column justify-content-center">
            <ul class="list-unstyled">
                <li><a href="/" class="text-dark">Главная</a></li>
                <li><a href="/catalog" class="text-dark">Каталог</a></li>
                <li><a href="/help" class="text-dark">Руководство пользователя</a></li>
            </ul>
        </div>

        <!-- Третий блок - Текст  -->
        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center text-center">
            <p class="text-dark mb-1">© КОНДИТЕРСКАЯ «Fancy». Все права защищены.</p>
            <p class="text-dark">
            </p>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
