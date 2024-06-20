# Use o imagem oficial do PHP como base
FROM php:8.0-fpm

# Instale dependências de sistema
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
    curl

# Instale extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Remover cache da instalação 
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Sete o diretório de trabalho
WORKDIR /var/www

# Copie o arquivo composer.lock e composer.json
COPY composer.lock composer.json /var/www/

# Instale dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader

# Copie o restante do código do aplicativo
COPY . /var/www

# Ajuste permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Exponha a porta da aplicação
EXPOSE 9000

# Inicie o PHP-FPM
CMD ["php-fpm"]