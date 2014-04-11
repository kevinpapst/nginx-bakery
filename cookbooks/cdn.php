<?php
/**
 * Cookbook for a simple content-delivery-network.
 *
 * @param server_name
 * @param root
 * @param include
 */
return array(
    array(
        'recipe'    => array('http-default', 'https-default'),
        'config'    => array(
            'server_name'       => '%server_name%',
            'root'              => '%root%',
            'index'             => 'index.php index.html',
            'includes'          => array(
                '%include%', 'favicon', 'robots', 'htaccess', 'cache-assets'
            )
        ),
    ),
);