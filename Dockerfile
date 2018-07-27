# usage
# docker run -d -v /you/laravel/folder:/var/www/laravel -p 80:80 -p 443:443 rafaelsantin/apache-laravel
FROM ubuntu:18.04
MAINTAINER Rafael <rafael-sg@live.com>
ENV TZ=America/Los_Angeles

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \ 
&& apt-get update \
&& apt-get -y install git curl apache2 php php-soap php-mysql php-json php-curl php-xml php-mbstring php-gd php-odbc php-pgsql php-sybase php-sqlite3 php-zip tdsodbc \
&& apt-get -y autoremove \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* \
&& /usr/sbin/a2enmod mpm_prefork \
&& /usr/sbin/a2enmod rewrite \
&& /usr/sbin/a2enmod mime \
&& /usr/sbin/a2dissite '*' \
&& /usr/sbin/a2disconf other-vhosts-access-log

ADD 000-laravel.conf /etc/apache2/sites-available/
ADD 001-laravel-ssl.conf /etc/apache2/sites-available/
COPY freetds.conf /etc/freetds/freetds.conf

RUN /usr/sbin/a2ensite 000-laravel 001-laravel-ssl \
&& /usr/bin/curl -sS https://getcomposer.org/installer |/usr/bin/php \
&& /bin/mv composer.phar /usr/local/bin/composer

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

EXPOSE 80
EXPOSE 443

WORKDIR /var/www/laravel

copy . .

RUN cp .env.example .env \
&& composer install \
&& php artisan key:generate \
&& chown www-data:www-data -R storage \
&& chown www-data:www-data -R bootstrap



CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

#docker-compose exec laravel php artisan migrate --force
