# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

	config.vm.box = "bento/ubuntu-19.10"


	config.vm.provider "virtualbox" do |v|
		v.memory = 1024
	end

	config.ssh.forward_agent = true

	config.vm.hostname = "silkroad-laravel"
	config.vm.network "private_network", ip: "50.51.52.53"
	config.vm.network "forwarded_port", guest: 80, host: 8080
	config.vm.network "forwarded_port", guest: 443, host: 8080
	config.vm.network "public_network"

	config.vm.synced_folder "./", "/var/www", :nfs => !Vagrant::Util::Platform.windows?

	config.vm.provision :shell, path: "bootstrap.sh"
end
