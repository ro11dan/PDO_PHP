FROM php:8.2-apache

# Habilitar la extensión de PHP para PDO con MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Remplazar la configuracion que viene por defecto en apache2.conf por la que se encuentra en el proyecto apuntando a /public
COPY docker/app/000-default.conf /etc/apache2/sites-available/000-default.conf

# Activar el módulo de reescritura de Apache
RUN a2enmod rewrite

#Directorio de trabajo base para la aplicación
WORKDIR /var/www/html