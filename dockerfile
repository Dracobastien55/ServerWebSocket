# Utilisation de l'image officielle d'Apache avec prise en charge de PHP
FROM php:8.2-cli

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR app
COPY . /app

EXPOSE 3001

ENTRYPOINT ["php", "src/server.php"]