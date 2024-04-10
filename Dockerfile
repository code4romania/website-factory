FROM node:20-alpine AS assets

WORKDIR /build

COPY app app
COPY help help
COPY lang lang
COPY resources resources
COPY \
    .babelrc \
    artisan \
    package.json \
    package-lock.json \
    postcss.config.js \
    tailwind.config.js \
    vite.config.js \
    ./

RUN npm ci --no-audit --ignore-scripts
RUN npm run build

FROM php:8.2-fpm-alpine

ARG S6_OVERLAY_VERSION=3.1.6.2

ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-noarch.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-noarch.tar.xz
ADD https://github.com/just-containers/s6-overlay/releases/download/v${S6_OVERLAY_VERSION}/s6-overlay-x86_64.tar.xz /tmp
RUN tar -C / -Jxpf /tmp/s6-overlay-x86_64.tar.xz

COPY docker/openssl/openssl.cnf /etc/ssl/openssl.cnf
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY --chmod=755 docker/s6-rc.d /etc/s6-overlay/s6-rc.d

RUN apk update && \
    # build dependencies
    apk add --no-cache --virtual .build-deps \
    bzip2-dev \
    curl-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev \
    libzip-dev \
    postgresql-dev \
    zlib-dev \
    zip && \
    #
    # production dependencies
    apk add --no-cache \
    icu-libs \
    fcgi \
    libjpeg-turbo \
    libpng \
    libwebp \
    libzip \
    nginx \
    php-pgsql && \
    #
    # configure extensions
    docker-php-ext-configure gd --enable-gd --with-jpeg --with-webp && \
    #
    # install redis
    pecl install redis && \
    docker-php-ext-enable redis && \
    #
    # install extensions
    docker-php-ext-install \
    bcmath \
    curl \
    dom \
    fileinfo \
    gd \
    intl \
    opcache \
    pdo_pgsql \
    simplexml \
    zip && \
    #
    # cleanup
    apk del -f .build-deps

RUN curl -o /usr/local/bin/php-fpm-healthcheck https://raw.githubusercontent.com/renatomefi/php-fpm-healthcheck/master/php-fpm-healthcheck && chmod +x /usr/local/bin/php-fpm-healthcheck

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
ENV COMPOSER_CACHE_DIR /dev/null

WORKDIR /var/www

COPY --chown=www-data:www-data . /var/www
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY --from=assets --chown=www-data:www-data /build/public/build /var/www/public/build

ARG VERSION
ARG REVISION

RUN echo "$VERSION (${REVISION:0:7})" > /var/www/.version

RUN composer install \
    --optimize-autoloader \
    --no-interaction \
    --no-plugins \
    --no-dev \
    --prefer-dist

ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

ENV WEBSITE_FACTORY_EDITION ong

EXPOSE 80

ENTRYPOINT ["/init"]
