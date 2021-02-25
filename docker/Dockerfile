FROM php:7.4-fpm as app
WORKDIR /app

RUN apt-get clean && apt-get update && apt-get install -y --fix-missing --no-install-recommends \
    zlib1g-dev \
    libmemcached-dev \
    libssl-dev \
    librabbitmq-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    make \
    curl \
    git \
    bash \
    apt-file \
    libxml2-dev \
    libpq-dev

RUN docker-php-ext-install \
    zip \
    mysqli \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    soap \
    gettext \
    mbstring \
    bcmath

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/* && rm -rf /var/lib/apt/lists/*

RUN pecl install memcached \
    && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/ext-memcached.ini

RUN pecl install amqp \
    && echo "extension=amqp.so" > /usr/local/etc/php/conf.d/ext-amqp.ini

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

RUN pecl install xdebug-2.9.6 && composer self-update

FROM app as app-development
RUN docker-php-ext-enable xdebug

FROM nginx:1.19 AS nginx-development
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf.template
CMD /bin/bash -c "envsubst '\$CONTAINER_APP_NAME' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'"
