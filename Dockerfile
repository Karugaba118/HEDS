FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Apache virtual host configuration
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Install Composer and PHP dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN cd /var/www/html/backend && composer install --no-dev --optimize-autoloader --no-interaction

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80
