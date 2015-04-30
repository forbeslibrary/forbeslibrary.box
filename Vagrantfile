# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "smallhadroncollider/centos-6.5-lamp"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder "./", "/var/www"

	# Provision box
	config.vm.provision "shell" do |s|
		s.inline = <<-endOfScript
      shopt -s dotglob

      echo "creating databases..."
      mysql -u root < /var/www/config/mysql/omeka-2.2.2-data.sql;
      mysql -u root < /var/www/config/mysql/wordpress-data.sql;

      echo "setting permissions required by php..."
      sudo chown -R nobody /var/lib/php/session;
      sudo chmod -R 770 /var/lib/php/session;

      echo "installing software via yum..."
      yum -y --quiet install git
      yum -y --quiet install unzip

      if ! [ -e /var/www/public/omeka-2.2.2/ ]
        then
          echo "downloading Omeka..."
          wget --no-clobber --no-verbose http://omeka.org/files/omeka-2.2.2.zip
          echo "installing Omeka..."
          unzip -nq omeka-2.2.2.zip -d /var/www/public/
          echo "configuring Omeka..."
          cp -f /var/www/config/omeka/* /var/www/public/omeka-2.2.2/
      fi

      echo "installing Omeka plugins and themes..."
      if ! [ -e /var/www/public/omeka-2.2.2/themes/forbes-library ]
        then
          git clone --quiet https://github.com/forbeslibrary/omeka.theme.forbes-library.git /var/www/public/omeka-2.2.2/themes/forbes-library
      fi
      if ! [ -e /var/www/public/omeka-2.2.2/plugins/concise-search ]
        then
          git clone --quiet https://github.com/forbeslibrary/omeka.plugin.concise-search.git /var/www/public/omeka-2.2.2/plugins/concise-search
      fi

      if ! [ -e /var/www/public/wordpress/ ]
        then
          echo "downloading Wordpress..."
          wget --no-clobber --no-verbose --no-check-certificate https://wordpress.org/wordpress-4.1.1.zip
          echo installing Wordpress...""
          unzip -nq wordpress-4.1.1.zip -d /var/www/public/
          echo "configuring Wordpress..."
          cp -f /var/www/config/wordpress/* /var/www/public/wordpress/
      fi

      echo "installing Wordpress plugins and themes"
      if ! [ -e /var/www/public/wordpress/wp-content/themes/weaver-ii ]
        then
          wget --no-clobber --no-verbose http://weavertheme.com/wp-content/uploads/downloads/2014/05/weaver-ii-2-1-12.zip
          unzip -nq weaver-ii-2-1-12.zip -d /var/www/public/wordpress/wp-content/themes/
      fi

      if ! [ -e /var/www/public/wordpress/wp-content/themes/weaver-ii-forbes ]
        then
          git clone --quiet https://github.com/forbeslibrary/wordpress.theme.weaver-ii-forbes.git /var/www/public/wordpress/wp-content/themes/weaver-ii-forbes
      fi
      if ! [ -e /var/www/public/wordpress/wp-content/plugins/weaver-ii-theme-extras ]
        then
          wget --no-clobber --no-verbose https://downloads.wordpress.org/plugin/weaver-ii-theme-extras.2.2.10.zip
          unzip -nq weaver-ii-theme-extras.2.2.10.zip -d /var/www/public/wordpress/wp-content/plugins/
      fi
      if ! [ -e /var/www/public/wordpress/wp-content/plugins/staff-picks ]
        then
          git clone --quiet https://github.com/forbeslibrary/wordpress.plugin.staff-picks.git /var/www/public/wordpress/wp-content/plugins/staff-picks
      fi
      if ! [ -e /var/www/public/wordpress/wp-content/plugins/library-databases ]
        then
          git clone --quiet https://github.com/forbeslibrary/wordpress.plugin.library-databases.git /var/www/public/wordpress/wp-content/plugins/library-databases
      fi

      echo "restarting Appache with httpd.conf..."
			sudo cp /var/www/config/appache/httpd.conf /etc/httpd/conf/
			sudo apachectl -k graceful
    endOfScript
	end
end
