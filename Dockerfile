FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Kopyahon ang Nginx config
COPY default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --no-interaction --optimize-autoloader --no-dev

# Paghimo ug temporary .env file
RUN cp .env.example .env
RUN php artisan key:generate

# Install npm dependencies ug build
RUN npm install
RUN npm run build

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# I-expose ang port nga gamiton sa Render
EXPOSE 8080

# I-start ang PHP-FPM ug Nginx
CMD service nginx start && php-fpm
