FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx git curl unzip
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install --no-dev --no-interaction 2>&1 | tail -5

# Nginx config
RUN mkdir -p /run/nginx && echo 'server {
    listen 8080;
    root /var/www/html/public;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }
}' > /etc/nginx/conf.d/default.conf

RUN chown -R nobody:nobody /var/www/html

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
