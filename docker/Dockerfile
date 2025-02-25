# Usa a imagem oficial do PHP 8.3 com Apache
FROM php:8.3-apache

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define a pasta de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Symfony
RUN composer install --no-scripts --no-autoloader && composer dump-autoload --optimize

# Dá permissão à pasta var/
RUN chmod -R 777 var/

# Habilita mod_rewrite para Symfony
RUN a2enmod rewrite

# Expor a porta 8000 para desenvolvimento
EXPOSE 8000

# Comando para rodar o Apache
CMD ["apache2-foreground"]
