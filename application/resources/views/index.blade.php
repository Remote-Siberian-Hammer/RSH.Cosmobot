@extends('layouts.base')

@section('content')
    <section class="home-banner">
        <div class="container-fluid">
            <div class="d-flex align-items-center h-34">
                <div class="col-lg-7"></div>
                <div class="col-lg-5">
                    <h1>Мощный и удобный конструктор для <br> создания ботов</h1>
                    <div class="mt-1"></div>
                    <p>Создайте чат-бота без программирования <br>
                        и взаимодействуйте с клиентами в мессенджерах</p>
                    <p><b>Cosmo bot</b> это сервис, помогающий решать задачи месседж-маркетинга.</p>
                    <a href="#" class="btn btn-cb mt-2 w-50 text-center">Начать бесплатно</a>
                </div>
            </div>
        </div>
    </section>
    <section class="cb-green">
        <div class="p-5">
            <div class="col-lg-7 mx-auto">
                <div class="mt-4 mb-5">
                    <h3 class="text-center">Удобный и гибкий конструктор</h3>
                    <ul class="w-50 mx-auto">
                        <li class="mb-3 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                            </svg> Создавайте комплексные сценарии без строчки кода</li>
                        <li class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                            </svg> Используйте готовые интенты или создавайте собственные</li>
                        <li class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path>
                            </svg> Обрабатывайте данные во внешних системах через API</li>
                    </ul>
                </div>
                <img src="https://robochat.io/images/pages/main/sozdat-bota-vk-i-telegrama-besplatno.webp" class="img-fluid" alt="Пример">
            </div>
        </div>
    </section>
    <section>
        <div class="h-34 d-flex justify-content-center align-items-center">
            <div class="col-lg-6 card p-3 text-center">
                <div class="mt-4 mb-4">
                    <h3>Попробуйте <b>Cosmo bot</b> сейчас — платите потом!</h3>
                    <p class="mt-4 mb-4">Это быстро и бесплатно. Две вещи, которые все любят.</p>
                    <a href="#" class="d-block btn btn-cb mt-2 w-50 mx-auto">Начать бесплатно</a>
                </div>
            </div>
        </div>
    </section>
@endsection
