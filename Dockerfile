FROM php:8.3-cli-alpine AS sio_test
RUN apk add --no-cache git zip bash

# Setup php extensions
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql

ENV COMPOSER_CACHE_DIR=/tmp/composer-cache
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy php.ini
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Setup php app user
ARG USER_ID=1000
RUN adduser -u ${USER_ID} -D -H app
USER app

COPY --chown=app ../.. /app
WORKDIR /app

# Change rights for cache folders
RUN mkdir -p var/cache var/log \
    && chown -R app:app var \
    && chmod -R 777 var

EXPOSE 8337

CMD ["php", "-S", "0.0.0.0:8337", "-t", "public"]
