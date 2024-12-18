#!/bin/bash

# Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos esté lista..."
until php artisan migrate --force; do
  echo "Migraciones fallidas. Reintentando en 5 segundos..."
  sleep 5
done

# Ejecutar seeders
echo "Ejecutando seeders..."
php artisan db:seed --force

# Iniciar PHP-FPM
php-fpm
