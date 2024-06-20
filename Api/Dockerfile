# Use imagem oficial do PHP com suporte ao FPM
FROM php:8.0-fpm

# Instale dependências necessárias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    nginx \
    supervisor  # Adicione o supervisor

# Instale extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Configuração do Nginx
COPY ./nginx/default.conf /etc/nginx/sites-available/default

# Copie o projeto
WORKDIR /var/www
COPY . .
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

# Exponha a porta 80 para Nginx
EXPOSE 80

# Start supervisord para gerenciar PHP-FPM e Nginx
COPY ./supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENTRYPOINT ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]