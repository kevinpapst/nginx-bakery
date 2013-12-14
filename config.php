<?php
/**
 * Configuration for nginx-bakery.
 *
 * @author Kevin Papst
 * @see https://github.com/kevinpapst/nginx-bakery
 */
return array(
    'target'        => __DIR__ . '/server/',
    'server'        => array(
        '80-default'            => 'recipes/80-default.conf',
        '443-default'           => 'recipes/443-default.conf',
        '80-redirect_server'    => 'recipes/80-redirect_server.conf',
        '443-redirect_server'   => 'recipes/443-redirect_server.conf',
    ),
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