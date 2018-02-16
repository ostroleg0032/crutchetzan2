FROM php:7.1.2-apache 
RUN a2enmod rewrite && service apache2 restart