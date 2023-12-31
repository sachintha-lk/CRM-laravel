FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Copy the .env file
COPY .env .env

RUN composer install

#ref : https://medium.com/@eloufirhatim/add-docker-to-an-existing-laravel-10-project-1e6c383fc7a8


# prob better? check later https://adambailey.io/blog/dockerize-a-laravel-application/
# to build run
# docker-compose build
