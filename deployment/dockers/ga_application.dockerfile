FROM php:8.1.0-fpm

RUN apt update && apt install -y libicu-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install mysqli pdo pdo_mysql sockets intl
RUN docker-php-ext-enable pdo_mysql sockets intl

# Set working directory
WORKDIR /var/www/application

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www application /var/www/application

COPY --chown=www:www deployment/configs/ga_application_php.ini /usr/local/etc/php/php.ini

# NPM installation
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash
RUN apt-get install nodejs

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]