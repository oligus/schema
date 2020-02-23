FROM alpine:3.11

RUN set -xe && \
    apk update && \
    apk upgrade && \
    apk add --no-cache bash curl \
        php7 \
        php7-ast \
        php7-dom \
        php7-xml \
        php7-curl \
        php7-json \
        php7-phar \
        php7-iconv \
        php7-common \
        php7-opcache \
        php7-openssl \
        php7-simplexml \
        php7-tokenizer \
        php7-mbstring \
        php7-xmlwriter \
        php7-xdebug \
        --repository http://dl-cdn.alpinelinux.org/alpine/edge/main/ \
        --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ \
        --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing/ && \
    rm -rf /tmp/* /var/cache/apk/*

ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer && \
    composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

## Enable xdebug
# RUN /bin/sed -i "s|;zend_extension=xdebug.so|zend_extension=xdebug.so|g" /etc/php7/conf.d/xdebug.ini
