FROM php:8.2-apache

# Copy all project files into Apache root
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional but useful)
RUN a2enmod rewrite

EXPOSE 80