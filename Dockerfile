FROM php:7.0.33-apache
WORKDIR /var/www/html/
RUN apt-get update
# 1. development packages
RUN apt-get update && apt-get install zlib1g-dev -y && apt-get install -y \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      zip \
      libcurl4-openssl-dev \
      pkg-config libssl-dev \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install \
      intl \
      mbstring \
      mcrypt \
      pcntl \
      pdo_mysql \
      zip \
      opcache

# 2. apache configs + document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers
# 4. MongoDB dependencies
RUN pecl install mongodb-1.8.0 && docker-php-ext-enable mongodb

# 5. start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

ARG WITH_XDEBUG

RUN if [ $WITH_XDEBUG = "true" ] ; then \
            pecl install xdebug-2.9.0; \
            docker-php-ext-enable xdebug; \
        fi ;

# 5. composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#COPY Files
COPY . .
RUN chmod -R 777 /var/www/html/
RUN composer install