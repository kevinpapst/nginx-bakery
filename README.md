nginx-bakery
============

PHP scripts to create nginx config files from templates

ATTENTION: This is a demo for generating nginx configs.

This library can possibly help you, if you are managing a lot of virtual hosts.
It has logic for dynmic inclusion and using variables and mixins, stuff that is often refered as to "templating".

If you start with nginx, you mightstumble upon some basic problems, like the wish to use variables within your server definitions.
All discussions point out, that nginx does not support this, because of the runtime performance impacts.
They all tell you (and I double that) to use a templating system. As so often, I could not find a ready to use solution,
so I have written this small library.

The configurations are far away from being good, as I started to learn nginx just a couple of days ago.
I can manage my own sites with this scripts, so I thought I share it with the community.

Directories
===========
For the sake of out-of-the-box usage, all scripts rely on two paths:
/etc/nginx/             - as base configuration directory for nginx
/var/www/nginx-bakery/  - as base for this library

Installation
============

cd /var/www/
git clone https://github.com/kevinpapst/nginx-bakery
ln -s /var/www/nginx-bakery/includes /etc/nginx/includes

Usage
=====

- Edit "sites.php" to your needs
- Call "php bakery.php"
- Enable sites from the "server" directory (some options are named below)

Enable sites
============
There are several choices on how to activate the generated "server" configs, just to name a few:

1. Copy the generated configs from the "server" directory to the nginx sites-enabled directory:
cp /var/www/nginx-bakery/server/* /etc/nginx/sites-enabled/

2. Link singled configs to /etc/nginx/sites-enabled/ like this:
ln -s /var/www/nginx-bakery/server/default /etc/nginx/sites-enabled/default

Other options (not recommended!) include:

1. [NOT RECOMMENDED] Change the target location of the script from
'target'        => __DIR__ . '/server/',
to
'target'        => '/etc/nginx/sites-enabled/',
and execute the "bakery.php" script with sufficient permissions... argh, no we don't want that...

2. Link the complete directory to nginx:
ln -s /var/www/nginx-bakery/server /etc/nginx/sites-enabled
