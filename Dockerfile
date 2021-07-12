FROM php:7.2-apache
RUN apt update
RUN mkdir -p /usr/share/man/man1
RUN apt install -y default-jre
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN sed -i -e 's/^\(upload_max_filesize\|post_max_size\) =.*/\1 = 150M/g' "$PHP_INI_DIR/php.ini"
WORKDIR /var/www/html
RUN rm -rf *
COPY ./ /var/www/html
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
