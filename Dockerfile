FROM dmstr/php-yii2:latest-nginx
MAINTAINER Joe Skilton (joe@catalystglobal.com)

ARG DB_DSN
ARG DB_USER
ARG DB_PASS
ARG DB_GAME_DSN

ENV DB_GAME_DSN=$DB_GAME_DSN
ENV DB_DSN=$DB_DSN
ENV DB_USER=$DB_USER
ENV DB_PASS=$DB_PASS

ARG ENABLE_DEBUG
ENV QUICKFIRE_DEBUG=$ENABLE_DEBUG

ARG QUICKFIRE_ENV
ENV QUICKFIRE_ENV=$QUICKFIRE_ENV

# Add GMP support to php
RUN apt-get update && apt-get install libgmp-dev -y --no-install-recommends && apt-get install unzip -y --no-install-recommends && apt-get install stunnel -y --no-install-recommends
RUN docker-php-ext-install gmp

# Add Redis support to php
#ENV PHPREDIS_VERSION 5.0.2
##RUN mkdir -p /usr/src/php/ext/redis \
#    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
#    && echo 'redis' >> /usr/src/php-available-exts \
#    && docker-php-ext-install redis

# Remove apt cache
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copy app source into container
WORKDIR /app
ADD ./php/src /app/

# Copy nginx config
COPY ./nginx/ /

# Copy PHP config
COPY ./php/config/ /usr/local/etc/php/conf.d/

# Copy image files
COPY ./image-files/root/ /root/

# Run composer update
RUN composer global remove fxp/composer-asset-plugin
RUN composer config -g github-oauth.github.com 00c7d9ff3adb44c03a9c448f57017623a726c60f && \
composer install --prefer-dist --optimize-autoloader && \
composer clear-cache

# Make runtime directories and chown them
RUN mkdir -p runtime web/assets && \
    chmod -R 775 runtime web/assets && \
chown -R www-data:www-data runtime web/assets
