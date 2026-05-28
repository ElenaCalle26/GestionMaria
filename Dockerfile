FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# RESOLVER CONFLICTO MPM: Deshabilitar todos, habilitar solo uno
RUN a2dismod mpm_prefork mpm_worker mpm_event 2>/dev/null || true
RUN a2enmod mpm_prefork

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install --no-dev --no-interaction 2>&1 | grep -E "(Installing|Generating)" || true

# Configurar para Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
