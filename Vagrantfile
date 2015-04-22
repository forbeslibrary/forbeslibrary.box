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
		  # import databases
      mysql -u root < /var/www/omeka-2.2.2-data.sql;
      mysql -u root < /var/www/wordpress-data.sql;
			# set permissions required by php
      sudo chown -R nobody /var/lib/php/session;
      sudo chmod -R 770 /var/lib/php/session;
			# restart Appache with custom httpd.conf file
			sudo cp /var/www/httpd.conf /etc/httpd/conf/
			sudo apachectl -k graceful
    endOfScript
	end
end
