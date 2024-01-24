FROM composer:latest

WORKDIR /var/www/application

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
