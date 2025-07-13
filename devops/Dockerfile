FROM php:8.4-alpine

# Set the working directory inside the container
WORKDIR /var/www

# Expose server on port 80
EXPOSE 80

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
