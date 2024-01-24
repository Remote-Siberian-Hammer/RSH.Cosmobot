sudo docker-compose up --build
sudo cp .example.env .env
sudo docker ps
sudo docker exec -it <ID> bash
psql -U raptor
CREATE DATABASE cosmobot_db;
CREATE DATABASE cosmobot_db_test;
sudo docker inspect <ID> # Взять <HOST> бд и поместить в конфиг
Заполнить .env
sudo docker-compose run npm install
sudo docker-compose run npm run dev
sudo docker-compose run composer install
sudo docker-compose run artisan migrate
sudo docker-compose run webhook openssl genrsa -out webhook_pkey.pem 2048