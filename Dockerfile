FROM php:8.2-apache

WORKDIR /var/www/html

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar archivos del proyecto
COPY . /var/www/html

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configurar Apache para apuntar a public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|g' /etc/apache2/sites-available/000-default.conf

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de PHP
RUN composer install --no-dev --no-interaction

# Permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage

EXPOSE 80

CMD ["apache2-foreground"]
