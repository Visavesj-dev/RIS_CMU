FROM php:7.3.1-fpm

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
    mysql-client \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    libzip-dev \
    curl \
    unzip \
    zip \
    git \
    apt-transport-https \
    gnupg2 \
    cron && pecl channel-update pecl.php.net

# Install Nodejs via nvm 
# https://gist.github.com/remarkablemark/aacf14c29b3f01d6900d13137b21db3a

# replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

ENV NVM_DIR /usr/local/nvm
RUN mkdir -p $NVM_DIR

RUN curl --silent -o- https://raw.githubusercontent.com/creationix/nvm/v0.34.0/install.sh | bash

RUN source $NVM_DIR/nvm.sh \
    && nvm install --lts \
    && nvm alias default lts/* \
    && nvm use default

# Install yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y --no-install-recommends yarn 

# Install extensions
RUN docker-php-ext-install mysqli pdo_mysql exif pcntl bcmath zip

RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# SOAP extension
RUN rm /etc/apt/preferences.d/no-debian-php && \
    apt-get -y install libxml2-dev php-soap && \
    docker-php-ext-install soap

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Memory Limit
RUN echo "memory_limit=2048M" > $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "max_execution_time=900" >> $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "post_max_size=20M" >> $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "upload_max_filesize=20M" >> $PHP_INI_DIR/conf.d/memory-limit.ini

# Time Zone
RUN echo "date.timezone=${PHP_TIMEZONE:-Asia/Bangkok}" > $PHP_INI_DIR/conf.d/date_timezone.ini

# Display errors in stderr
RUN echo "display_errors=stderr" > $PHP_INI_DIR/conf.d/display-errors.ini

# Disable PathInfo
RUN echo "cgi.fix_pathinfo=0" > $PHP_INI_DIR/conf.d/path-info.ini

# Disable expose PHP
RUN echo "expose_php=0" > $PHP_INI_DIR/conf.d/path-info.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Setup nvm
RUN echo "source /usr/local/nvm/nvm.sh" >> /home/www/.bashrc

COPY ./docker/php/start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

WORKDIR /var/www

ADD . /var/www

RUN chown www:www -R .

# Reset permission
RUN find . -type f -exec chmod 664 {} \;   
RUN find . -type d -exec chmod 775 {} \;

RUN chmod -R ug+rwx storage bootstrap/cache

USER www

RUN composer install

CMD ["/usr/local/bin/start"]