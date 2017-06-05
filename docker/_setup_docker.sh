#! /bin/bash

# server configuration ====================================================
# stop daemons
/etc/init.d/postgresql stop
/etc/init.d/apache2 stop

# add website
mkdir -p /var/www/localhost && rm -rf /var/www/localhost/public_html
mv /tmp/php  /var/www/localhost/public_html

sed -i "s/ServerName localhost/ServerName $IP/g" /tmp/conf/localhost.conf
mv /tmp/conf/localhost.conf  /etc/apache2/sites-available/000-default.conf
#  mv /tmp/conf/localhost.conf  /etc/apache2/sites-available/localhost.conf
#  a2ensite localhost.conf

# PHP - make Apache look for an index.php file first
sed -i "s/index.php//g" /etc/apache2/mods-enabled/dir.conf
sed -i "s/DirectoryIndex /DirectoryIndex index.php/g" /etc/apache2/mods-enabled/dir.conf

# SSL
a2enmod ssl
cp /tmp/some.crt /etc/ssl/certs/some.crt
cp /tmp/some.key /etc/ssl/private/some.key

# validate config =========================================================
apache2ctl configtest


