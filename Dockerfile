# Usa la imagen de PHP con Apache
FROM php:apache

# Copia los archivos HTML y PHP al directorio de trabajo de Apache
COPY . /var/www/html/

# Expone el puerto 80 para que pueda ser accedido desde fuera del contenedor
EXPOSE 80

RUN docker-php-ext-enable mysqli