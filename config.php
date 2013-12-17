<?php
/**
 * Configuration for nginx-bakery.
 *
 * @author Kevin Papst
 * @see https://github.com/kevinpapst/nginx-bakery
 */
return array(
    // target directories for your generated nginx configs
    'target' => array(
        // directory where parsed includes will be stored
        'includes'      => __DIR__ . '/nginx/includes',
        // directory where generated server configs will be stored
        'sites'         => __DIR__ . '/nginx/sites-enabled'
    ),
    // full path to your certificates, change them to your needs and check certificates/README.md
    'certificates' => array(
        'default-crt'   => __DIR__ . '/certificates/server.crt',
        'default-key'   => __DIR__ . '/certificates/server.key'
    ),
    // a set of server definitions (one represents a site/domain)
    // cookbooks can be reused across several domains, which only vary in a couple of variables
    // this is a simple name-to-file mapping
    'cookbooks'         => array(
        'bigace-v2'     => 'cookbooks/bigace-v2.php',
        'bigace-v3'     => 'cookbooks/bigace-v3.php',
        'wordpress'     => 'cookbooks/wordpress.php',
        'php-fpm'       => 'cookbooks/php-fpm.php',
    ),
    // server recipes, each one represents a server entry in your nginx config
    // this is a simple name-to-file mapping
    'server'        => array(
        'http-default'            => 'recipes/80-default.conf',
        'https-default'           => 'recipes/443-default.conf',
        'http-redirect_server'    => 'recipes/80-redirect_server.conf',
        'https-redirect_server'   => 'recipes/443-redirect_server.conf',
    ),
    // nginx includes - re-usable includes which allow to access variables when being "baked"
    // note: they are generated once and afterwards all values are static
    // this is a simple name-to-file mapping
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
    ),
);