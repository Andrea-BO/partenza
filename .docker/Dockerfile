FROM php:7.4-apache

# vim
RUN apt-get update \
   && apt-get install -y \
            apt-utils \
            git \
            libaio1 \
            libfreetype6-dev \
            libicu-dev \
            libjpeg62-turbo-dev \
            libpng-dev \
            nano \
            unzip \
            vim \
            wget \
   && apt-get clean autoclean && apt-get autoremove --yes &&  rm -rf /var/lib/{apt,dpkg,cache,log}/

#composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# xdebug
#RUN pecl install xdebug-2.9.0 \
#    && docker-php-ext-enable xdebug

# ORACLE oci
RUN mkdir /opt/oracle \
    && cd /opt/oracle

ADD ./.docker/instantclient-basic-linux.x64-12.1.0.2.0.zip /opt/oracle
ADD ./.docker/instantclient-sdk-linux.x64-12.1.0.2.0.zip /opt/oracle

# Install Oracle Instantclient
RUN  unzip /opt/oracle/instantclient-basic-linux.x64-12.1.0.2.0.zip -d /opt/oracle \
    && unzip /opt/oracle/instantclient-sdk-linux.x64-12.1.0.2.0.zip -d /opt/oracle \
    && ln -s /opt/oracle/instantclient_12_1/libclntsh.so.12.1 /opt/oracle/instantclient_12_1/libclntsh.so \
    && ln -s /opt/oracle/instantclient_12_1/libclntshcore.so.12.1 /opt/oracle/instantclient_12_1/libclntshcore.so \
    && ln -s /opt/oracle/instantclient_12_1/libocci.so.12.1 /opt/oracle/instantclient_12_1/libocci.so \
    && rm -rf /opt/oracle/*.zip

ENV LD_LIBRARY_PATH  /opt/oracle/instantclient_12_1:${LD_LIBRARY_PATH}

# Install Oracle extensions
RUN echo 'instantclient,/opt/oracle/instantclient_12_1/' | pecl install oci8-2.2.0 \
      && docker-php-ext-enable \
               oci8 \
       && docker-php-ext-configure pdo_oci --with-pdo-oci=instantclient,/opt/oracle/instantclient_12_1,12.1 \
       && docker-php-ext-install \
               pdo_oci


# Install php extension
RUN docker-php-ext-configure intl \
 && docker-php-ext-install gd intl pdo_mysql

# Use the default production configuration
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Copy timezone configration
COPY .docker/timezone.ini /usr/local/etc/php/conf.d/timezone.ini
ENV TIMEZONE Europe/Rome
# Set timezone
RUN rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && "date"


# Alias
#RUN alias ll="ls -al"
RUN a2enmod rewrite
