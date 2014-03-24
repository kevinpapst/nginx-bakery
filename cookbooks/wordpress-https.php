<?php
/**
 * Cookbook for a wordpress site:
 *
 * - which is running on https only
 *
 * @param redirect
 * @param server_name
 * @param root
 * @param include_ssl
 */
return array(
    array(
        'recipe'    => 'https-redirect_server',
        'config'    => array(
            'server_name'   => '%redirect%',
            'target'        => '%server_name%'
        ),
    ),
    array(
        'recipe'    => array('https-default'),
        'config'    => array(
            'server_name'       => '%server_name%',
            'root'              => '%root%',
            'index'             => 'index.php',
            'includes'          => array(
                '%include_ssl%', 'favicon', 'wordpress', 'wordpress-phpfpm', 'wordpress-admin', 'cache-assets', 'htaccess', 'hide-headers'
            )
        ),
    ),
);