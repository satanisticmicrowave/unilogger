FROM php:8.4-fpm-alpine AS builder

RUN apk add --no-cache \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.* ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress

COPY . .
RUN composer dump-autoload --no-dev
RUN php bin/console cache:clear --env=prod

FROM php:8.4-fpm-alpine AS unilogger

RUN apk add --no-cache \
    caddy  \
    supervisor \
    libpq \
    && apk add --no-cache --virtual .build-deps libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql opcache \
    && apk del .build-deps

COPY --from=builder /app /app
COPY Caddyfile /etc/caddy/Caddyfile
COPY docker-entrypoint.sh /usr/local/bin
COPY supervisord.conf /etc/supervisord.conf

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /app
EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
