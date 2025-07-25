FROM php:8.2-fpm

<<<<<<< HEAD
# 必要なPHP拡張
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
=======
# PHP 設定ファイル
COPY php.ini /usr/local/etc/php/

# Node.js 18系と npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update && apt-get install -y nodejs

# PHP 拡張
RUN apt-get update \
    && apt-get install -y git zip unzip \
    && docker-php-ext-install pdo_mysql bcmath

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

WORKDIR /var/www
>>>>>>> 1f671e1 (初回コミット（再構築後）)
