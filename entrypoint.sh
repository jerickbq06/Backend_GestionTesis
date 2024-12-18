#!/bin/bash

# Esperar a que la base de datos esté lista (esto es opcional pero puede ser útil)
echo "Esperando a que la base de datos esté lista..."
until pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
  echo "Esperando conexión a la base de datos..."
  sleep 2
done

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar los seeders si es necesario
echo "Ejecutando seeders..."
php artisan db:seed --force

# Ejecutar el servidor
echo "Iniciando el servidor..."
php-fpm
