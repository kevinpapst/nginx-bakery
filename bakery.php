<?php
/**
 * An "old-school-style" php script to create nginx configuration from a bunch of includes and a master configuration.
 *
 * @author Kevin Papst
 * @see https://github.com/kevinpapst/nginx-bakery
 */
define('NXB_EOL', PHP_EOL);
define('NXB_TAB', "    ");
define('NXB_INC', __DIR__.'/includes/');

// sites.php will not be commited to the git repository, so you can safely keep your site configurations there
if (!file_exists(__DIR__ . '/sites.php')) {
    die('There is no "sites.php". Please rename "sites.php.dist" to "sites.php"');
}

$CONFIG = include_once(__DIR__ . '/config.php');
$SITES  = include_once(__DIR__ . '/sites.php');

if (!is_writable($CONFIG['target']['includes']) || !is_writable($CONFIG['target']['sites'])) {
    die('Make sure the target directories are writable.'.PHP_EOL.'Check "' . $CONFIG['target']['includes'] . '" and "'.$CONFIG['target']['sites'].'".');
}

// fetch all include files
$ritit = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(NXB_INC, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
$r = array();
foreach ($ritit as $splFileInfo) {
    $path = $splFileInfo->isDir() ? array($splFileInfo->getFilename() => array()) : array($splFileInfo->getFilename());
    for ($depth = $ritit->getDepth() - 1; $depth >= 0; $depth--) {
        $path = array($ritit->getSubIterator($depth)->current()->getFilename() => $path);
    }
    $r = array_merge_recursive($r, $path);
}

// now generate all of them and save them in the target directory
foreach($r as $incFolder => $includes)
{
    // README.md for example
    if (!is_array($includes)) continue;

    // target directory to store "includes"
    $includeTargetDir = $CONFIG['target']['includes'] . '/' . $incFolder;

    // make sure the target directory exosts
    if (!file_exists($includeTargetDir)) {
        if (!mkdir($includeTargetDir)) {
            die('Could not create target directory: ' . $includeTargetDir);
        }
    }

    // render includes
    foreach($includes as $incFilename)
    {
        $incTarget = $includeTargetDir . '/' . $incFilename;
        ob_start();
        nginx_bakery_render_include(NXB_INC . $incFolder . '/' .$incFilename);
        file_put_contents($incTarget, ob_get_clean());
        echo "\nRendered include: " . $incFolder . '/' .$incFilename;
    }
}

// generate server configs
foreach($SITES as $sitename => $siteServers)
{
    $tplTarget  = $CONFIG['target']['sites'] . '/' . $sitename;
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

/**
 * Renders an nginx "include".
 *
 * $CONFIG can be used in the included server-recipe.
 *
 * @param $filename
 * @param array $BAKERY
 */
function nginx_bakery_render_include($filename)
{
    // $CONFIG might be used within the included nginx-include
    global $CONFIG;

    if (!file_exists($filename)) {
        throw new Exception('Include does not exist: '.$filename);
    }

    echo NXB_EOL;
    include $filename;
    echo NXB_EOL;
}

/**
 * Renders a server part.
 *
 * Both $BAKERY and $CONFIG can be used in the included server-recipe.
 *
 * @param $type
 * @param array $BAKERY the configuration from the user "site"
 * @throws Exception
 */
function nginx_bakery_render_type($type, array $BAKERY)
{
    // $CONFIG might be used within the included "server recipe"
    global $CONFIG;

    if (!isset($CONFIG['server'][$type])) {
        throw new Exception('Server has no recipe: '. $type);
    }

    echo NXB_EOL;
    include $CONFIG['server'][$type];
    echo NXB_EOL;
}

/**
 * Renders the contents within a "server".
 *
 * @param array $siteConfig
 * @throws Exception
 */
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