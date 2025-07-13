FROM php:8.4-alpine

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies needed for building Xdebug
RUN apk add --no-cache $PHPIZE_DEPS linux-headers

# Install XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Copy XDebug conf
COPY php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Expose server on port 80
EXPOSE 80

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
