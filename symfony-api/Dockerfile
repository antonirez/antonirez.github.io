FROM php:8.2-cli
WORKDIR /app
COPY composer.json /app/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --prefer-dist --no-progress --no-interaction
COPY . /app
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
