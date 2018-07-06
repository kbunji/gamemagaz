<!DOCTYPE html>
<html lang="ru">
<head>
    <title>ГеймсМаркет</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/libs.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/media.css">
</head>
<body>
@yield('register')
@yield('order-form')
<div class="main-wrapper">
    <header class="main-header">
        <div class="logotype-container"><a href="/" class="logotype-link"><img src="/img/logo.png" alt="Логотип"></a>
        </div>
        <nav class="main-navigation">
            <ul class="nav-list">
                <li class="nav-list__item"><a href="/" class="nav-list__item__link">Главная</a></li>
                <li class="nav-list__item"><a href="{{ route('order.my') }}" class="nav-list__item__link">Мой заказ</a>
                </li>
                <li class="nav-list__item"><a href="{{ route('post.all') }}" class="nav-list__item__link">Новости</a>
                </li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">О компании</a></li>
            </ul>
        </nav>
        <div class="header-contact">
            <div class="header-contact__phone"><a href="#" class="header-contact__phone-link">Телефон: 33-333-33</a>
            </div>
        </div>
        <div class="header-container">
            <div class="payment-container">
                <div class="payment-basket__status">
                    <div class="payment-basket__status__icon-block"><a class="payment-basket__status__icon-block__link"><i
                                    class="fa fa-shopping-basket"></i></a></div>
                    <div class="payment-basket__status__basket"><span
                                class="payment-basket__status__basket-value">{{ $orderProducts }}</span><span
                                class="payment-basket__status__basket-value-descr">товаров</span></div>
                </div>
            </div>
            <div class="authorization-block">
                @guest
                    <a href="{{ route('register') }}" class="authorization-block__link">Регистрация</a>
                    <a href="{{ route('login') }}" class="authorization-block__link">Войти</a>
                @else
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle authorization-block__link" href="#"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == 'admin')
                                    <a class="dropdown-item" href="{{ route('admin') }}">
                                        Админ панель
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </header>
    <div class="middle">
        <div class="sidebar">
            <div class="sidebar-item">
                <div class="sidebar-item__title">Категории</div>
                <div class="sidebar-item__content">
                    <ul class="sidebar-category">
                        @foreach($categories as $category)
                            <li class="sidebar-category__item">
                                <a href="{{route('category.get', ['$categoryId' => $category->id])}}"
                                   class="sidebar-category__item__link">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item__title">Последние новости</div>
                <div class="sidebar-item__content">
                    <div class="sidebar-news">
                        @foreach($postsLast as $post)
                            <div class="sidebar-news__item">
                                <div class="sidebar-news__item__preview-news">
                                    <img src="/img/news/{{ $post->photo }}" alt="image-new"
                                         class="sidebar-new__item__preview-new__image">
                                </div>
                                <div class="sidebar-news__item__title-news">
                                    <a href="{{route('post.get', ['postId' => $post->id])}}"
                                       class="sidebar-news__item__title-news__link">
                                        {{ $post->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="content-top">
                <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск,
                    скачать Steam игры после оплаты
                </div>
                <div class="slider"><img src="/img/slider.png" alt="Image" class="image-main"></div>
            </div>
            <div class="content-middle">
                <div class="content-head__container">
                    <div class="content-head__title-wrap">
                        <div class="content-head__title-wrap__title bcg-title">
                            @if($title == 1)
                                Последние товары
                            @elseif($title == 2)
                                {{ $product->name }}
                            @elseif($title == 3)
                                Новости
                            @elseif($title == 4)
                                Товары категории {{ $cat->name }}
                            @elseif($title == 5)
                                Мой заказ
                            @endif
                        </div>
                    </div>
                    <div class="content-head__search-block">
                        <div class="search-container">
                            <form class="search-container__form">
                                <input type="text" class="search-container__form__input">
                                <button class="search-container__form__btn">search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end heeeader-->
                @yield('main-content')
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="footer__footer-content">
        <div class="random-product-container">
            <div class="random-product-container__head">Случайный товар</div>
            <div class="random-product-container__content">
                <div class="item-product">
                    <div class="item-product__title-product"><a href="#" class="item-product__title-product__link">The
                            Witcher 3: Wild Hunt</a></div>
                    <div class="item-product__thumbnail"><a href="#" class="item-product__thumbnail__link"><img
                                    src="/img/cover/game-1.jpg" alt="Preview-image"
                                    class="item-product__thumbnail__link__img"></a></div>
                    <div class="item-product__description">
                        <div class="item-product__description__products-price"><span
                                    class="products-price">400 руб</span></div>
                        <div class="item-product__description__btn-block"><a href="#" class="btn btn-blue">Купить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__footer-content__main-content">
            <p>
                Интернет-магазин компьютерных игр ГЕЙМСМАРКЕТ - это
                онлайн-магазин игр для геймеров, существующий на рынке уже 5 лет.
                У нас широкий спектр лицензионных игр на компьютер, ключей для игр - для активации
                и авторизации, а также карты оплаты (game-card, time-card, игровые валюты и т.д.),
                коды продления и многое друго. Также здесь всегда можно узнать последние новости
                из области онлайн-игр для PC. На сайте предоставлены самые востребованные и
                актуальные товары MMORPG, приобретение которых здесь максимально удобно и,
                что немаловажно, выгодно!
            </p>
        </div>
    </div>
    <div class="footer__social-block">
        <ul class="social-block__list bcg-social">
            <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                            class="fa fa-facebook"></i></a></li>
            <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                            class="fa fa-twitter"></i></a></li>
            <li class="social-block__list__item"><a href="#" class="social-block__list__item__link"><i
                            class="fa fa-instagram"></i></a></li>
        </ul>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="/js/main.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>