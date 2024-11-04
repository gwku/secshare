FROM php:8.2.0-fpm AS base

ENV SESSION_DRIVER=cookie
ENV APP_NAME=SecShare
ENV APP_ENV=production

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Create a non-root user and set permissions
RUN useradd -G www-data,root -u 1000 -d /home/user user && \
    mkdir -p /home/user && \
    chown -R user:www-data /var/www

# Copy Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy source code
COPY . .

# Install dependencies
RUN composer install --no-scripts --no-autoloader --no-dev && \
    composer dump-autoload --optimize

# Set ownership for the application files
RUN chown -R user:www-data /var/www

# Switch to the non-root user
USER user

# Setup default nginx config
COPY ./docker-compose/nginx/default.conf /etc/nginx/conf.d/default.conf
