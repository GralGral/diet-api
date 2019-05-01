FROM php:7.3-fpm

ARG TIMEZONE
ARG XDEBUG_REMOTE_ENABLE
ARG XDEBUG_REMOTE_AUTOSTART
ARG XDEBUG_REMOTE_CONNECT_BACK
ARG XDEBUG_REMOTE_PORT
ARG XDEBUG_REMOTE_HOST
ARG XDEBUG_PROFILER_ENABLE
ARG XDEBUG_IDEKEY
ARG XDEBUG_PROFILER_ENABLE_TRIGGER

ENV APPLICATION_USER=application \
    APPLICATION_GROUP=application \
    APPLICATION_PATH=/app

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y install \
        zip \
        unzip \
        git  \
        wget \
        apt-utils \
        locales \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN docker-php-ext-install pdo pdo_mysql

# Install mongodb ext
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install xdebug ext
RUN pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable = ${XDEBUG_REMOTE_ENABLE}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart = ${XDEBUG_REMOTE_AUTOSTART}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back = ${XDEBUG_REMOTE_CONNECT_BACK}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_port = ${XDEBUG_REMOTE_PORT}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_host = ${XDEBUG_REMOTE_HOST}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable = ${XDEBUG_PROFILER_ENABLE}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey = ${XDEBUG_IDEKEY}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable_trigger = ${XDEBUG_PROFILER_ENABLE_TRIGGER}" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"

# Add group, user and assign user to group
RUN groupadd $APPLICATION_GROUP \
    && useradd -g $APPLICATION_GROUP --no-user-group $APPLICATION_USER

# Set entrypoint script
COPY entrypoints/init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh
ENTRYPOINT ["/usr/local/bin/init.sh"]

EXPOSE 9000

CMD ["php-fpm"]
