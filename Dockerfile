FROM webdevops/php-nginx:8.1-alpine
# Install Laravel framework system requirements (https://laravel.com/docs/8.x/deployment#optimizing-configuration-loading)
RUN docker-php-ext-install \
    bcmath \
    pdo_mysql

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
RUN printf "[program:cache]\ncommand=/bin/sh -c \"touch /app/storage/logs/laravel.log && chmod 777 /app/storage/logs/laravel.log && cd /app && php artisan route:cache && php artisan view:cache && php artisan config:cache\"\nautostart=true" > /opt/docker/etc/supervisor.d/artisan-cache.conf

# switch to the application user
USER application
# Copy Laravel project files
COPY --chown=application:application . .

#update and optimize packages
RUN composer install --no-interaction --optimize-autoloader --no-dev
