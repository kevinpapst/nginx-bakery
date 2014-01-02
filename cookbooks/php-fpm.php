<?php
/**
 * Cookbook for a phph fastcgi site.
 *
 * @param redirect
 * @param server_name
 * @param root
 * @param include
 */
return array(
    array(
        'recipe'    => 'http-redirect_server',
        'config'    => array(
            'server_name'   => '%redirect%',
            'target'        => '%server_name%'
        ),
    ),
    array(
        'recipe'    => 'https-redirect_server',
        'config'    => array(
            'server_name'   => '%redirect%',
            'target'        => '%server_name%'
        ),
    ),
    array(
        'recipe'    => array('http-default', 'https-default'),
        'config'    => array(
            'server_name'       => '%server_name%',
            'root'              => '%root%',
            'index'             => 'index.php',
            'includes'          => array(
                '%include%', 'favicon', 'php-fpm', 'robots', 'cache-assets', 'htaccess'
            )
        ),
    ),
);