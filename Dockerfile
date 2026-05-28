FROM php:8.2-apache

# Instalar solo lo esencial
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite (si no está ya)
RUN if ! grep -q "rewrite" /etc/apache2/mods-enabled/*.load; then a2enmod rewrite; fi || true

WORKDIR /var/www/html

# Instalar Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto completo
COPY . .

# Instalar dependencias sin ejecutar scripts
RUN composer install --no-dev --no-interaction --no-scripts 2>&1 | tail -20

# Copiar configuración de Apache (apuntar a public/)
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
