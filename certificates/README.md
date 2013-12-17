Certificates
============

This directory could hold all your certificates.

To generate a certificate, please refer to http://wiki.nginx.org/HttpSslModule#Generate_Certificates
or follow these steps (one by one, as you might have to enter some information):

```
cd /opt/nginx-bakery/certificates
openssl genrsa -out server.key 2048
openssl req -new -key server.key -out server.csr
openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt
```

Attention
=========
Be warned, that the include `includes/general/ssl.conf` uses this exact name and location.
If you do not want the filename "server" or want to use another location (highly recommended),
change "config.php" accordingly and regenerate the files.

Warning!
========
Make sure that this directory and the files within have proper permissions,
you do not (really never!) want a script to be able to read or overwrite the certificates.

Or even worse: pointing a default domain to /var/www/ with activated "directory listings"...
