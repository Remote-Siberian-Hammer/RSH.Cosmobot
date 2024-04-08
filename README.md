<img src="https://avatars.githubusercontent.com/u/153977186?s=400&u=7268ad55ed694cec25c1467486710abb82bc9ad8&v=4" style="width: 10%">
<h2>Remote-Siberian-Hammer</h2>
<br>
<h3>Используемые технологии:</h3>
<ul>
    <li>
        <a href="#">PHP 8.2</a>
    </li>
    <li>
        <a href="#">PostgreSQL 13</a>
    </li>
    <li>
        <a href="#">MongoDB 4</a>
    </li>
    <li>
        <a href="#">Python 3</a>
    </li>
    <li>
        <a href="#">JavaScript</a>
    </li>
</ul>
<hr>
<h3>Настройка окружения.</h3>
<ul>
    <li>
        <p>
            <span>Поднять docker:</span><br>
            <code><b>sudo docker-compose up --build</b></code>
        </p>
    </li>
    <li>
        <p>
            <span>Создать базу данных в контейнере:</span><br>
            <code><b>sudo docker ps</b><br>
            <b>sudo docker exec -it <ID> bash</b><br>
            <b>psql -U raptor</b><br>
            <b>CREATE DATABASE cosmobot_db;</b><br>
            <b>CREATE DATABASE cosmobot_db_test;</b></code>
        </p>    
    </li>
    <li>
        <p>
            <span>Создать/настроить конфиг, как минимум надо настроить подключение к БД:</span><br>
            <code><b>sudo cp .example.env .env</b></code>
        </p>
    </li>
    <li>
        <p>
            <span>Установить зависимости:</span><br>
            <code><b>sudo docker-compose run composer install</b><br>
            <b>sudo docker-compose run npm install</b></code>
        </p>
    </li>
    <li>
        <p>
            <span>Запуск сборщика фронтенда:</span><br>
            <code><b>sudo docker-compose run npm run dev</b></code>
        </p>
    </li>
    <li>
        <span>Создать миграции:</span><br>
        <code><b>sudo docker-compose run app ./vendor/bin/doctrine-migrations migrations:migrate</b></code>
    </li>
    <li>
        <p>
            <span>Настройка прослушивателя, если нет https:</span><br>
            <code>
                <b><a href="#">https://api.telegram.org/bot6742010369:AAEDGXt3ctqOSdtWFOlG6SH_00WUrNkwlS4/setWebhook?url=<СЮДА ПИХАЕМ URL ИЗ КОМАНДНОЙ СТРОКИ, ВОЗВРАЩАЕМЫЙ СЕРВИСОМ "localxpose"></a></b><br>
                <b>(не обязательно) sudo docker-compose run webhook openssl genrsa -out webhook_pkey.pem 2048</b>
            </code>
        </p>
    </li>
</ul>
