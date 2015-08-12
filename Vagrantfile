# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

$script = <<SCRIPT
apt-get update
apt-get install libapache2-mod-xsendfile
apt-get install libcurl3 php5-curl
SCRIPT







$ip = <<IP
ifconfig
IP

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "avenuefactory/lamp"
  config.vm.provision "shell", inline: $script
  config.vm.provision "shell", inline: $ip, run: "always"
  config.vm.network "private_network", ip: "172.1.1.6"
#  config.vm.network "public_network"
  config.vm.synced_folder "./", "/var/www/html", nfs: true
  # Use NFS for shared folders for better performance
  config.vm.synced_folder '.', '/vagrant', nfs: true
#  config.vm.provider "virtualbox" do |v|
#    v.gui = true
#    v.customize ["modifyvm", :id, "--clipboard", "bidirectional"]
#  end
config.vm.provider "virtualbox" do |v|
  host = RbConfig::CONFIG['host_os']

  # Give VM 1/4 system memory & access to all cpu cores on the host
  if host =~ /darwin/
    cpus = `sysctl -n hw.ncpu`.to_i
    # sysctl returns Bytes and we need to convert to MB
    mem = `sysctl -n hw.memsize`.to_i / 1024 / 1024 / 4
  elsif host =~ /linux/
    cpus = `nproc`.to_i
    # meminfo shows KB and we need to convert to MB
    mem = `grep 'MemTotal' /proc/meminfo | sed -e 's/MemTotal://' -e 's/ kB//'`.to_i / 1024 / 4
  else # sorry Windows folks, I can't help you
    cpus = 2
    mem = 1024
  end

  v.customize ["modifyvm", :id, "--memory", mem]
  v.customize ["modifyvm", :id, "--cpus", cpus]
end
end
