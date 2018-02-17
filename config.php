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
        'sites'         => __DIR__ . '/nginx/sites-enabled',
        // external files being included while parsing can be defined by a key-value mapping of source => target directory
        'externals'     => array()
    ),
    // full path to your certificates, change them to your needs and check certificates/README.md
    'certificates' => array(
        // we look for "default" only if no side specific certificate can be found
        'default'       => array(
            'crt'   => __DIR__ . '/certificates/server.crt',
            'key'   => __DIR__ . '/certificates/server.key'
        ),
        /*
        // e.g. the site 'example.org' would look like:
        'example.org'       => array(
            'crt'   => __DIR__ . '/certificates/example_org.crt',
            'key'   => __DIR__ . '/certificates/example_org.key'
        ),
        */
    ),
    // a set of server definitions (one represents a site/domain)
    // cookbooks can be reused across several domains, which only vary in a couple of variables
    // this is a simple name-to-file mapping, to allow placing cookbooks outside the default directory "cookbooks/"
    'cookbooks'         => array(
        'bigace-v2'     => 'cookbooks/bigace-v2.php',
        'bigace-v3'     => 'cookbooks/bigace-v3.php',
        'wordpress'     => 'cookbooks/wordpress.php',
        'php-fpm'       => 'cookbooks/php-fpm.php',
        'cdn'           => 'cookbooks/cdn.php',
    ),
    // server recipes, each one represents a server entry in your nginx config
    // this is a simple name-to-file mapping
    'server'        => array(
        'http-default'            => 'recipes/80-default.conf',
        'https-default'           => 'recipes/443-default.conf',
        'http-redirect_server'    => 'recipes/80-redirect_server.conf',
        'https-redirect_server'   => 'recipes/443-redirect_server.conf',
        'http-redirect_static'    => 'recipes/80-redirect_static.conf',
        'https-redirect_static'   => 'recipes/443-redirect_static.conf',
        'plaintext'               => 'recipes/plaintext.conf'
    ),
    // nginx includes - re-usable includes which allow to access variables when being "baked"
    // note: they are generated once and afterwards all values are static
    // this is a simple name-to-file mapping to be used in
    'includes'      => array(
        '404'               => 'includes/error/404.conf',
        '50x'               => 'includes/error/50x.conf',
        'cache-assets'      => 'includes/general/cache-assets.conf',
        'htaccess'          => 'includes/general/deny-htaccess.conf',
        'favicon'           => 'includes/general/favicon.conf',
        'php-fpm'           => 'includes/general/php-fpm.conf',
        'robots'            => 'includes/general/robots.conf',
        'ssl'               => 'includes/general/ssl-site.conf',
        'empty'             => 'includes/general/empty.conf',
        'hide-headers'      => 'includes/general/hide-headers.conf',
        'bigace-v2'         => 'includes/software/bigace-v2.conf',
        'bigace-v3'         => 'includes/software/bigace-v3.conf',
        'dokuwiki'          => 'includes/software/dokuwiki.conf',
        'piwik-tracking'    => 'includes/software/piwik-tracking.conf',
        'smf-v1'            => 'includes/software/smf-v1.conf',
        'smf-v2-prettyurls' => 'includes/software/smf-v2-prettyurls.conf',
        'wordpress'         => 'includes/wordpress/common.conf',
        'wordpress-phpfpm'  => 'includes/wordpress/php-fpm.conf',
        'wordpress-hide'    => 'includes/wordpress/hide-login.conf',
        'wordpress-301-ssl' => 'includes/wordpress/redirect-ssl.conf',
        'wordpress-admin'   => 'includes/wordpress/administration.conf',
        'kimai'             => 'includes/software/kimai.conf',
        'yourls'            => 'includes/software/yourls.conf',
        'jekyll'            => 'includes/software/jekyll.conf',
    ),
);