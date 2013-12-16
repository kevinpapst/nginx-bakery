nginx-bakery
============

PHP scripts to create nginx config files from templates

**_ATTENTION_: This repository (by now) is meant for demonstration purposes only. Unless the includes were not pimped by an experienced nginx admin, I do not recommend using generated configs in production environments.**

This library can possibly help you, if you are managing a lot of virtual hosts.
It has some basic logic for dynamic inclusion and using variables and mixins, stuff that is often refered as to "templating".

If you start with nginx, you might stumble upon some basic problems, like the wish to use variables within your server definitions.
All discussions point out, that nginx does not support this, because of runtime performance impacts.
The recommended solution is to use a template system to generate your configs. As so often, I could not find anything ready-to-use, so I wrote this small library.

The configurations are far away from being good, as I started to learn nginx just a couple of days ago.
I can manage my own sites using these scripts, so I thought I share it with the community.

Directories
===========
For the sake of out-of-the-box usage, all scripts rely on two paths:

- /etc/nginx/             - as base configuration directory for nginx
- /var/www/nginx-bakery/  - as installation directory of this library

Installation
============

```
cd /var/www/
git clone https://github.com/kevinpapst/nginx-bakery
```
 
Initial setup
=============

- Create "sites-php" with `cp sites.php.dist sites.php`
- Adjust "sites.php" to your needs (or use the example from sites.php.dist for a demo)
- Run "php bakery.php"
- Enable sites from the "nginx/sites-enabled" directory (some options are named below)

Enable sites
============
There are several ways on how to activate the generated configs ... use your imagination if you do not like the ones mentioned below :)

1. This is the most easy one and will work, if you manage all sites with this library:
```
mv /etc/nginx/sites-enabled /etc/nginx/backup_sites-enabled
ln -s /var/www/nginx-bakery/nginx/sites-enabled /etc/nginx/sites-enabled
ln -s /var/www/nginx-bakery/nginx/includes /etc/nginx/includes
```

2. Or you could copy the files over to their new location:
```
cp -r /var/www/nginx-bakery/nginx/includes /etc/nginx/
cp /var/www/nginx-bakery/nginx/sites-enabled/* /etc/nginx/sites-enabled/
```

HOW-TO
======
Lets start with a wording definition.

nginx-bakery knows three different stages of configuration files:
1) cookbooks (a full set of several server definitions)
2) recipes (single server definitions)
3) ingredients (nginx includes)
where each stage supports the usage of variables during the generation process.

A set of server configurations and includes are "baked" - namely the process of parsing your configuration
and creating static nginx config files and includes from your definitions.

All your sites are defined in the file "sites.php". If you want to add cookbooks, recipes or ingredients, you need to adjust "config.php" by now.
This might change in the future, but for now keeping them in a config file makes it easier to handle.

