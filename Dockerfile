FROM php:8.2-apache

# Solo dependencias mínimas
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar todo
COPY . .

# Instalar dependencias
RUN composer install --no-dev --no-interaction 2>&1 | grep -E "(Installing|Package|Generating)" || true

# Configurar Apache para Laravel (public/)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
