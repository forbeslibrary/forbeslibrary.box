#!/bin/bash

shopt -s dotglob
shopt -s expand_aliases
alias wget='wget --no-clobber --no-verbose --append-output=/var/www/wget.log'
SHARED="/var/www"
CONFIG="$SHARED/config"
PUBLIC="$SHARED/public"

echo "creating databases..."
mysql -u root < $CONFIG/mysql/omeka-data.sql;
mysql -u root < $CONFIG/mysql/wordpress-data.sql;

echo "setting permissions required by php..."
sudo chown -R nobody /var/lib/php/session;
sudo chmod -R 770 /var/lib/php/session;

echo "installing software via yum..."
yum -y --quiet install git
yum -y --quiet install unzip

if ! [ -e $PUBLIC/omeka-2.4.1/ ]
  then
    echo "downloading Omeka..."
    wget http://omeka.org/files/omeka-2.4.1.zip
    echo "installing Omeka..."
    unzip -nq omeka-2.4.1.zip -d $PUBLIC/
    echo "configuring Omeka..."
    cp -f $CONFIG/omeka/* $PUBLIC/omeka-2.4.1/
fi

echo "installing Omeka plugins and themes..."
if ! [ -e $PUBLIC/omeka-2.4.1/themes/forbes-library ]
  then
    git clone --quiet https://github.com/forbeslibrary/omeka.theme.forbes-library.git $PUBLIC/omeka-2.4.1/themes/forbes-library
fi
if ! [ -e $PUBLIC/omeka-2.4.1/plugins/concise-search ]
  then
    git clone --quiet https://github.com/forbeslibrary/omeka.plugin.concise-search.git $PUBLIC/omeka-2.4.1/plugins/concise-search
fi

if ! [ -e $PUBLIC/wordpress/ ]
  then
    echo "downloading Wordpress..."
    wget --no-check-certificate https://downloads.wordpress.org/release/wordpress-4.5.zip
    echo installing Wordpress...""
    unzip -nq wordpress-4.5.zip -d $PUBLIC/
    echo "configuring Wordpress..."
    cp -f $CONFIG/wordpress/* $PUBLIC/wordpress/
fi

echo "installing Wordpress plugins and themes"
if ! [ -e $PUBLIC/wordpress/wp-content/themes/weaver-ii ]
  then
    wget http://weavertheme.com/wp-content/uploads/downloads/2016/01/weaver-ii-2-2-3.zip
    unzip -nq weaver-ii-2-2-3.zip -d $PUBLIC/wordpress/wp-content/themes/
fi

if ! [ -e $PUBLIC/wordpress/wp-content/themes/weaver-ii-forbes ]
  then
    git clone --quiet https://github.com/forbeslibrary/wordpress.theme.weaver-ii-forbes.git $PUBLIC/wordpress/wp-content/themes/weaver-ii-forbes
fi
if ! [ -e $PUBLIC/wordpress/wp-content/plugins/weaver-ii-theme-extras ]
  then
    wget  https://downloads.wordpress.org/plugin/weaver-ii-theme-extras.2.3.1.zip
    unzip -nq weaver-ii-theme-extras.2.3.1.zip -d $PUBLIC/wordpress/wp-content/plugins/
fi
if ! [ -e $PUBLIC/wordpress/wp-content/plugins/staff-picks ]
  then
    git clone --quiet https://github.com/forbeslibrary/wordpress.plugin.staff-picks.git $PUBLIC/wordpress/wp-content/plugins/staff-picks
fi
if ! [ -e $PUBLIC/wordpress/wp-content/plugins/library-databases ]
  then
    git clone --quiet https://github.com/forbeslibrary/wordpress.plugin.library-databases.git $PUBLIC/wordpress/wp-content/plugins/library-databases
fi
if ! [ -e $PUBLIC/wordpress/wp-content/plugins/wowbrary ]
  then
    git clone --quiet https://github.com/forbeslibrary/wordpress.plugin.wowbrary.git $PUBLIC/wordpress/wp-content/plugins/wowbrary
fi

echo "restarting Appache with httpd.conf..."
sudo cp $CONFIG/appache/httpd.conf /etc/httpd/conf/
sudo apachectl -k graceful
