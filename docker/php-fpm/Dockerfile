FROM php:7.3-fpm

ARG TZ=Europe/Moscow
RUN echo "Define variable TZ. New value: ${TZ}";
ARG APP_CODE_PATH_CONTAINER=/var/www/html
RUN echo "Define variable APP_CODE_PATH_CONTAINER. New value: ${APP_CODE_PATH_CONTAINER}";

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

#####################################
#  Clean up APT:
#####################################
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update

RUN apt-get install -y \
            apt-utils \
            curl \
            git

# Install the PHP zip extention
RUN apt-get install -y libzip-dev zip unzip && \
    docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install zip

# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql

# Install the PHP bcmath extension
RUN docker-php-ext-install bcmath

# Install the PHP redis extension
RUN pecl install redis
RUN docker-php-ext-enable redis

#####################################
# PHP Memcached:
#####################################

# Install the php memcached extension
RUN apt-get install -y libmemcached-dev && \
    pecl install memcached && \
    docker-php-ext-enable memcached

#####################################
# PHP opcache:
#####################################
RUN docker-php-ext-enable opcache

# Install the PHP sockets extension
RUN docker-php-ext-install sockets

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#
COPY ./conf/php/php.ini /usr/local/etc/php/php.ini
COPY ./conf/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./conf/php-fpm/php-fpm.d /usr/local/etc/php-fpm.d

#####################################
#  Clean up APT:
#####################################
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR ${APP_CODE_PATH_CONTAINER}

CMD ["php-fpm"]
