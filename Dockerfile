FROM php:8.2-fpm

ARG ENV

# install nginx web server
RUN apt update
RUN apt install -y nginx
RUN apt install -y ufw
RUN ufw allow 'Nginx HTTP'
RUN apt install -y systemctl


# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libxml2-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    nano \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath
RUN docker-php-ext-install opcache sockets exif

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www/app

RUN chown -R www-data:www-data /var/www/app

# copy app.conf for webserver config
COPY ./app.conf /etc/nginx/conf.d

# delete default sites-available
RUN rm /etc/nginx/sites-available/default
RUN rm /etc/nginx/sites-enabled/default

WORKDIR /var/www/app


# make permission storage for write logs
RUN chown -R $USER:www-data storage
RUN chmod -R 775 storage

# install package laravel
RUN composer install

CMD php artisan storage:link && systemctl start nginx && php-fpm
