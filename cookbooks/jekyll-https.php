<?php
/**
 * Cookbook for a Jekyll site running exclusively on HTTPS
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
        'recipe'    => 'http-redirect_server',
        'config'    => array(
            'server_name'   => array('%redirect%', '%server_name%'),
            'target'        => 'https://%server_name%'
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
        'recipe'    => array('https-default'),
        'config'    => array(
            'server_name'       => '%server_name%',
            'root'              => '%root%',
            'includes'          => array(
                '%include_ssl%', 'htaccess', 'jekyll', 'favicon', 'cache-assets', 'hide-headers'
            )
        ),
    ),
);