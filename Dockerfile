FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/server/

USER root

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libjpeg* \
    libfreetype6-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd\
    && docker-php-ext-install pdo pdo_mysql mysqli zip\
    && docker-php-ext-install bcmath\
    && pecl install xdebug\
    && docker-php-ext-enable xdebug\
    && rm -rf /tmp/pear

RUN #apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/www/server/vendor && chown -R www:www /var/www/server

COPY ./src /var/www/server

# change the owner and group of the current working directory to developer
#COPY --chown=1000:1000 . /var/www/server

# Set working directory
WORKDIR /var/www/server

RUN chown -R www:www /var/www/server

RUN chmod -R 755 storage/
RUN chmod -R ugo+rw storage



#USER 1000
USER www
RUN composer install --ignore-platform-reqs --prefer-dist --no-scripts --no-progress --no-interaction --no-dev --no-autoloader

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9000
CMD ["php-fpm"]