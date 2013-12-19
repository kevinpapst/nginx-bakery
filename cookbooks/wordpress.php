<?php
/**
 * Cookbook for a wordpress site.
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
        'recipe'    => array('http-default'),
        'config'    => array(
            'server_name'       => '%server_name%',
            'root'              => '%root%',
            'index'             => 'index.php',
            'includes'          => array(
                // optional use wordpress-301-ssl instead of wordpress-hide
                '%include%', 'favicon', 'wordpress', 'wordpress-hide', 'cache-assets', 'htaccess', 'hide-headers'
            )
        ),
    ),
    array(
        'recipe'    => array('https-default'),
        'config'    => array(
            'server_name'       => '%server_name%',
            'root'              => '%root%',
            'index'             => 'index.php',
            'includes'          => array(
                '%include%', 'favicon', 'wordpress', 'wordpress-admin', 'cache-assets', 'htaccess', 'hide-headers'
            )
        ),
    ),
);