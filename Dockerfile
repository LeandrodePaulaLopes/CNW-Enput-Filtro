# Imagem PHP-FPM
FROM php:8.2-fpm

# Instalar extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Pasta de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Expor porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
