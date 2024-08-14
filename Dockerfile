FROM node:lts-alpine
WORKDIR /var/www/web
RUN apk update \
    && apk upgrade \
    && apk add --update --no-cache git nasm gcc g++ libtool make cmake pkgconfig autoconf build-base automake bash gettext \
    zlib zlib-dev libpng libpng-dev libwebp libwebp-dev libjpeg-turbo-dev giflib-dev tiff-dev lcms2-dev openssl \
    && npm install -g npm@8.10.0

# При созданном проекте это наверное не пригодится
COPY ./web .

ENTRYPOINT [ "npm",  "--ignore-platform-reqs" ]