# Используем официальный образ PHP с поддержкой FPM
FROM php:8.1-fpm

# Устанавливаем необходимые расширения
RUN docker-php-ext-install mysqli

# Копируем исходный код в контейнер
COPY src/ /var/www/html/

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html/
