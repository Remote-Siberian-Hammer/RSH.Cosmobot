FROM composer:latest

WORKDIR /var/www/src

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
