# Imagen base
FROM php:8.2-fpm

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto
COPY . .

# Ejecutar Composer para instalar las dependencias
RUN composer install --optimize-autoloader --no-dev

# Dar permisos correctos a las carpetas necesarias
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Copiar el script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Configurar el script de entrada
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Exponer el puerto 9000
EXPOSE 9000
