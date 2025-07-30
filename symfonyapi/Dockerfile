FROM php:8.2-cli

WORKDIR /app

COPY composer.json composer.lock ./
RUN apt-get update && apt-get install -y git zip unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --no-scripts --prefer-dist

COPY . .

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
