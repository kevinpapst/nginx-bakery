<?php
/**
 * Configuration for nginx-bakery.
 *
 * @author Kevin Papst
 * @see https://github.com/kevinpapst/nginx-bakery
 */
return array(
    'target' => array(
        // directory where parsed incldues will be stored
        'includes'      => __DIR__ . '/nginx/includes',
        // directory where generated server configs will be stored
        'sites'         => __DIR__ . '/nginx/sites-enabled'
    ),
    // full path to your certificates, change them to your needs and check certificates/README.md
    'certificates' => array(
        'default-crt'   => '/var/www/nginx-bakery/certificates/server.crt',
        'default-key'   => '/var/www/nginx-bakery/certificates/server.key'
    ),
    // server recipes, mapping a name to a file
    'server'        => array(
        'http-default'            => 'recipes/80-default.conf',
        'https-default'           => 'recipes/443-default.conf',
        'http-redirect_server'    => 'recipes/80-redirect_server.conf',
        'https-redirect_server'   => 'recipes/443-redirect_server.conf',
    ),
    // nginx includes, mapping a name to a file
    'includes'      => array(
        '404'               => 'includes/error/404.conf',
        '50x'               => 'includes/error/50x.conf',
        'cache-assets'      => 'includes/general/cache-assets.conf',
        'htaccess'          => 'includes/general/deny-htaccess.conf',
        'favicon'           => 'includes/general/favicon.conf',
        'php-fpm'           => 'includes/general/php-fpm.conf',
        'robots'            => 'includes/general/robots.conf',
        'ssl'               => 'includes/general/ssl-site.conf',
        'bigace-v2'         => 'includes/software/bigace-v2.conf',
        'bigace-v3'         => 'includes/software/bigace-v3.conf',
        'dokuwiki'          => 'includes/software/dokuwiki.conf',
        'piwik-tracking'    => 'includes/software/piwik-tracking.conf',
        'smf-v1'            => 'includes/software/smf-v1.conf',
        'smf-v2-prettyurls' => 'includes/software/smf-v2-prettyurls.conf',
        'wordpress'         => 'includes/software/wordpress.conf',
        'yourls'            => 'includes/software/yourls.conf'
    )
);