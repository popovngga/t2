FROM php:8.4-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libxml2-dev \
    libonig-dev \
    gettext-base \
    && docker-php-ext-install pdo_mysql zip mbstring xml bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

COPY composer.json composer.lock artisan bootstrap/ package.json package-lock.json vite.config.js ./

RUN composer install --no-dev --no-autoloader
RUN npm ci

COPY . .

RUN usermod -u 1001 www-data && groupmod -g 1001 www-data

RUN composer dump-autoload --optimize
RUN chown -R www-data:www-data storage bootstrap/cache

COPY ./docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

USER www-data

ENTRYPOINT ["docker-entrypoint.sh"]
