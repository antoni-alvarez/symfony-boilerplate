FROM php:8.4-alpine

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies needed for Xdebug, Intl and PostgreSQL
RUN apk add --no-cache $PHPIZE_DEPS linux-headers icu-dev postgresql-dev

# Install Intl PHP extension
RUN docker-php-ext-install intl

# Install Composer
RUN apk --no-cache add curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Install Redis
RUN pecl install redis && docker-php-ext-enable redis

# Install Supervisor
RUN apk add --no-cache supervisor

# Copy XDebug conf
COPY php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Increase PHP memory limit
RUN echo "memory_limit=1G" > /usr/local/etc/php/conf.d/zz-memory-limit.ini

# Copy supervisor config for workers
COPY supervisor/supervisord.conf /etc/supervisord.conf
COPY supervisor/crond.conf /etc/supervisor/conf.d/crond.conf
COPY supervisor/php_server.conf /etc/supervisor/conf.d/php_server.conf

# Crontab
COPY cron/root /etc/crontabs/root

# Expose server on port 80
EXPOSE 80

# Start Supervisor with PHP built-in server
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
