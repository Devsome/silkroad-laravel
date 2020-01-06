#!/usr/bin/env bash

# update / upgrade
sudo apt-get update
sudo apt-get -y upgrade

# create public folder
sudo mkdir "/var/www/public"

# Install nginx
sudo apt-get install -y nginx

# Install mysql
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"
sudo apt-get install -y mysql-server

sudo wget http://repo.mysql.com/mysql-apt-config_0.8.9-1_all.deb
sudo dpkg -i mysql-apt-config_0.8.9-1_all.deb -y
sudo apt-get update
sudo apt-get install -y mysql-server

# Install php-fpm 7.3
sudo add-apt-repository -y ppa:ondrej/php && sudo apt-get update
sudo apt-get install -y php7.3-cli php7.3-fpm php7.3-mysql php7.3-curl php-memcached php7.3-dev php7.3-sqlite3 php7.3-mbstring php7.3-xml freetds-common freetds-bin unixodbc php7.3-sybase
sudo apt install php7.3-bcmath
sudo apt install -y zip unzip php7.3-zip
sudo apt-cache search php7.3
sudo apt install php7.3-zip

sudo apt-get install acl
sudo apt install -y npm

# Sendmail
sudo apt-get install -y sendmail
sudo hostnamectl set-hostname silkroad-laravel.de
sudo sendmailconfig

# Setup database
#echo "DROP DATABASE IF EXISTS DB_SHISHA" | mysql -uroot -proot
echo mysql_upgrade -u root -proot --force
echo "CREATE DATABASE DB_SILKROAD" | mysql -uroot -proot
echo "FLUSH PRIVILEGES" | mysql -uroot -proot
echo "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';"

# php.ini
sudo sed -i.bak 's/^;cgi.fix_pathinfo.*$/cgi.fix_pathinfo = 1/g' /etc/php/7.3/fpm/php.ini

sudo service php7.3-fpm restart

# Configure host
cat << 'EOF' > /etc/nginx/sites-available/default
server {
    listen 80;
    server_name localhost;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;

    server_name localhost;

    ssl_certificate     /var/www/ssl-script/silkroad-laravel.crt;
    ssl_certificate_key /var/www/ssl-script/device.key;

	# Useful logs for debug.
	access_log /var/log/nginx/localhost_access.log;
	error_log /var/log/nginx/localhost_error.log;
	rewrite_log on;

	# The location of our projects public directory.
	root  /var/www/public;

	# Point index to the Laravel front controller.
	index index.php index.html;

	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	# Remove trailing slash to please routing system.
	if (!-d $request_filename) {
		rewrite ^/(.+)/$ /$1 permanent;
	}

	# PHP FPM configuration.
	location ~* \.php$ {
		fastcgi_pass unix:/run/php/php7.3-fpm.sock;
		fastcgi_index index.php;
		fastcgi_split_path_info ^(.+\.php)(.*)$;
		include /etc/nginx/fastcgi_params;
		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	}

	# We don't need .ht files with nginx.
	location ~ /\.ht {
		deny all;
	}

	# Set header expirations on per-project basis
	location ~* \.(?:ico|css|js|jpe?g|JPG|png|svg|woff)$ {
		expires 365d;
	}
}
EOF

# install git
sudo apt-get -y install git

# install Composer
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Restart servers
sudo service nginx restart
sudo service php7.3-fpm restart
sudo service mysql restart
