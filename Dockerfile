FROM php:8.3-cli-alpine AS sio_test

# Setup php extensions
RUN apk add --no-cache \
    git \
    zip \
    bash \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql

# Setup composer
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy php.ini
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Setup php app user
ARG USER_ID=1000
RUN adduser -u ${USER_ID} -D -H app

# Change rights for cache folders
RUN mkdir -p /app/var/cache /app/var/log \
    && chown -R app:app /app/var \
    && chmod -R 777 /app/var

# Copy code
WORKDIR /app
COPY --chown=app:app . .

USER app


CMD ["sh", "-c", "rm -rf var/cache/* && php -S 0.0.0.0:8337 -t public"]