# Imagen base
FROM php:8.2-fpm

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar dependencias PHP con Composer
RUN composer install --optimize-autoloader --no-dev

# Asignar permisos a los directorios necesarios
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Configurar el puerto de escucha
EXPOSE 9000

# Comando para iniciar el contenedor
CMD ["php-fpm"]
