<?php
/**
 * An "old-school-style" php script to create nginx configuration from a bunch of includes and a master configuration.
 *
 * @author Kevin Papst
 * @see https://github.com/kevinpapst/nginx-bakery
 */
define('NXB_EOL', PHP_EOL);
define('NXB_TAB', "    ");

// sites.php will not be commited to the git repository, so you can safely keep your site configurations there
if (!file_exists(__DIR__ . '/sites.php')) {
    die("There is no sites.php. Please rename sites.php.dist to sites.php");
}

$CONFIG = include_once(__DIR__ . '/config.php');
$SITES  = include_once(__DIR__ . '/sites.php');

foreach($SITES as $sitename => $siteServers)
{
    $tplTarget  = $CONFIG['target'] . $sitename;
    ob_start();

    foreach($siteServers as $server)
    {

        if (!is_array($server['type'])) {
            $server['type'] = array($server['type']);
        }

        foreach($server['type'] as $serverType)
        {
            nginx_bakery_render_type($serverType, $server['config']);
        }
    }
    file_put_contents($tplTarget, ob_get_clean());
    echo "\nRendered config [$sitename] to: " . $tplTarget;
}

function nginx_bakery_render_type($type, array $BAKERY)
{
    global $CONFIG;

    if (isset($CONFIG['server'][$type])) {
        echo "\n";
        include $CONFIG['server'][$type];
        echo "\n";
        return;
    }

    throw new Exception('Server-Type "'.$type.'" has no recipe');
}

function nginx_bakery_render_server(array $siteConfig)
{
    global $CONFIG;

    foreach($siteConfig as $configKey => $configValue)
    {
        switch ($configKey) {
            case 'listen':
            case 'server_name':
            case 'index':
            case 'root':
                echo NXB_EOL . NXB_TAB . $configKey . ' ' . $configValue . ';';
                break;
            case 'nginx':
                echo NXB_EOL;
                foreach($configValue as $nginxKey => $nginxValue) {
                    echo NXB_EOL . NXB_TAB . $nginxKey . ' ' . $nginxValue . ';';
                }
                break;
            case 'includes':
                echo NXB_EOL;
                foreach($configValue as $incName) {
                    $inc = $incName;
                    if (isset($CONFIG['includes'][$incName])) {
                        $inc = $CONFIG['includes'][$incName];
                    }
                    echo NXB_EOL . NXB_TAB . 'include' . ' ' . $inc . ';';
                }
                break;
            default:
                throw new Exception('Unsupported configuration key: ' . $configKey);
                break;
        }
    }
    echo NXB_EOL;
}