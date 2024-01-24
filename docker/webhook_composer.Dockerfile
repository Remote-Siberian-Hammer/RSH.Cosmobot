FROM composer:latest

WORKDIR /var/www/webhook

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
