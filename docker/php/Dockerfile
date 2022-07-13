FROM php:7.4 as main

RUN apt update
RUN apt install zip unzip

RUN docker-php-ext-install calendar

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT ["tail", "-f", "/dev/null"]