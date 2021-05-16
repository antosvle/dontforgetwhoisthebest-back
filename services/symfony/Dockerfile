FROM php:8-apache


# Add some tools to image
RUN apt-get update \
    && apt-get install -y --no-install-recommends locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;


# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY ./services/symfony/conf/symfony-vh.conf /etc/apache2/sites-available/symfony-vh.conf
RUN a2enmod rewrite remoteip \
    && a2dissite 000-default.conf \
    && a2ensite symfony-vh.conf


# Install composer
RUN curl -sS https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer


# Install some PHP plugins
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring zip gd xsl


# Install project dependencies
WORKDIR /var/www/symfony
COPY ./apps/symfony/composer.* .
RUN composer install --prefer-dist --optimize-autoloader && composer clear-cache


# Download and configure waiter script to wait after the database
WORKDIR /
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.9.0/wait /wait
RUN chmod +x /wait


# Clean image
RUN apt-get clean \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


# Configure entry point
COPY ./services/symfony/docker-entrypoint.sh ./
RUN chmod 755 /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]


CMD apachectl -D FOREGROUND
EXPOSE 80