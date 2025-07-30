FROM php:8.2-cli

WORKDIR /app


# Instala herramientas de sistema y extensiones PDO para PostgreSQL y MySQL
RUN apt-get update \
    && apt-get install -y \
        git zip unzip \
        libpq-dev \
        default-libmysqlclient-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Copia toda la aplicación primero (incluyendo bin/console)
COPY composer.json composer.lock ./
COPY . .

# Instala Composer y dependencias de PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install

CMD ["php", "-S", "0.0.0.0:5050", "-t", "public"]
