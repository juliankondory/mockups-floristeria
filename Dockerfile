FROM php:8.0-apache

# Habilitar mod_rewrite de Apache (requerido por el .htaccess del proyecto)
RUN a2enmod rewrite

# Instalar extensiones PHP necesarias para MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Configurar el DocumentRoot y permitir .htaccess en el directorio del proyecto
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copiar el proyecto al directorio de Apache
COPY . /var/www/html/

# Asegurar permisos correctos para Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
