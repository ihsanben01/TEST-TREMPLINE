FROM lavoweb/php-8.3

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
