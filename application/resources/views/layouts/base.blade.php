<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cosmobot</title>
        <!-- TODO: Написать условие для страниц создания и редакта ботов -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jointjs/3.7.7/joint.css" />
        <!-- Scripts -->
        @vite(['resources/css/bootstrap-5-3-2/bootstrap.min.css', 'resources/css/app.css', 'resources/css/app.effects.css'])
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <strong>C O S M O</strong>
                        <small>bot</small>
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @guest
                            <ul class="navbar-nav mx-auto w-50 mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">О сервисе</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Конструктор</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Кейсы</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Заказать разработку</a>
                                </li>
                            </ul>
                            <a href="{{ route('auth') }}" class="btn btn-cb">Начать бесплатно</a>
                        @endguest
                        @auth
                            <div class="d-flex w-100 justify-content-end">
                                <button class="btn btn-cb br-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;">
                                        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                                    </svg>
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>
        @auth
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="row mt-5">
                        <div class="col-3">
                            <img src="https://workspace.ru/upload/resize_cache/main/f43/njubago7lntpw9zr9pe2dr0kpzbpvco3/200_200_2619711fa078991f0a23d032687646b21/pY1j6FZQz6M.jpg" alt="Миронов Вячеслав" class="img-fluid">
                        </div>
                        <div class="col-9">
                            <h4 class="mb-2">Миронов Вячеслав</h4>
                            <div class="mb-2">
                                <div>
                                    <p>Ваш баланс: <b>22033</b> руб</p>
                                </div>
                                <a href="#" class="btn btn-cb w-100">Пополнить</a>
                            </div>
                        </div>
                    </div>
                    <ul class="mx-auto mt-5 w-70">
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="#">📖 Руководство</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="#">🌀 О сервисе</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="#">🤖 Мои боты</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="{{ route('bot.constructor.control') }}">⚙️ Создать бота</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="#">📬 Рассылки</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="#">🧩 Магазин плагинов</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="btn w-100" aria-current="page" href="#">⚙️ Настройки</a>
                        </li>
                        <li class="nav-item mt-5">
                            <a href="#" class="btn w-100" style="color: #f93636;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #f93636;">
                                    <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                    <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path>
                                </svg> Выйти
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
        <main id="app" class="wrapper">
            @yield('content')
        </main>
        <footer>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <a class="navbar-brand" href="#">
                            <strong>
                                C O S M O
                            </strong>
                            <small>bot</small>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <h4>Продукт:</h4>
                        <div>
                            <a href="#">О сервисе</a>
                        </div>
                        <div>
                            <a href="#">Цены</a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h4>Ресурсы:</h4>
                        <div>
                            <a href="#">С чего начать</a>
                        </div>
                        <div>
                            <a href="#">Часто задаваемые вопросы</a>
                        </div>
                        <div>
                            <a href="#">Руководство</a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <h4>Помощь:</h4>
                        <div>
                            <a href="#">Контакты</a>
                        </div>
                        <div>
                            <a href="#">Конфиденциальность</a>
                        </div>
                        <div>
                            <a href="#">Возврат средств</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </footer>
        @vite(['resources/js/bootstrap-5-3-2/bootstrap.bundle.min.js', 'resources/js/app.js'])
    </body>
</html>
