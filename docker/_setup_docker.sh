#! /bin/bash

# install needed packages =================================================
apt-get update
apt-get install -y apache2 \
		libapache2-mod-php5 \
		php5 \
		php5-pgsql \
		postgresql-9.4 \
		postgresql-contrib-9.4

# server configuration ====================================================
# stop daemons
/etc/init.d/postgresql stop
/etc/init.d/apache2 stop

# add website
mkdir -p /var/www/example.com && rm -rf /var/www/example.com/public_html
mv /tmp/php  /var/www/example.com/public_html
mv /tmp/conf/example.com.conf  /etc/apache2/sites-available/example.com.conf

a2ensite example.com.conf

# PHP - make Apache look for an index.php file first
sed -i "s/index.php//g" /etc/apache2/mods-enabled/dir.conf
sed -i "s/DirectoryIndex /DirectoryIndex index.php/g" /etc/apache2/mods-enabled/dir.conf

# SSL
a2enmod ssl
cp /tmp/ssl/certs/server.crt /etc/ssl/certs/server.crt
cp /tmp/ssl/private/server.key /etc/ssl/private/server.key
# cp /tmp/ssl/certs/dhparam.pem /etc/ssl/certs/dhparam.pem
# TODO: Other files needed by ssl

# validate config =========================================================
apache2ctl configtest


