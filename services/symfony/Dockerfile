FROM php:8-fpm-alpine


RUN apt-get update -y
RUN apt-get install -y software-properties-common
RUN apt-get install -y apache2


# Get composer from offcial composer image
# Install Composer
RUN curl -sS https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer


# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2dissite *default
COPY ./services/symfony/conf/symfony-vh.conf /etc/apache2/sites-available/symfony-vh.conf
COPY ./services/symfony/conf/apache.conf /etc/apache2/conf-available/z-app.conf
RUN a2enmod rewrite remoteip \
    && a2enconf z-app \
    && a2ensite symfony-vh.conf


# Install Symfony dependencies
WORKDIR /app
COPY ./app/composer.* ./
RUN composer install --prefer-dist --optimize-autoloader && composer clear-cache


# Download and launch waiter script to wait after the database
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.9.0/wait /usr/bin/wait
RUN chmod +x /wait


# Environment variable
ENV GLOBAL_ENV=dev 


# Clean image
RUN apt-get clean \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./services/symfony/docker-entrypoint.sh ./
RUN chmod 755 /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]

CMD apachectl -D FOREGROUND
EXPOSE 80