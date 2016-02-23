<?php
/**
 * Build Schema script
 *
 * @package resourcealert
 * @subpackage build
 */
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

require_once dirname(__FILE__) . '/build.config.php';
include_once MODX_CORE_PATH . 'model/modx/modx.class.php';

$modx= new modX();
$modx->initialize('mgr');
$modx->loadClass('transport.modPackageBuilder','',false, true);
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
$root = dirname(dirname(__FILE__)).'/';
$sources = array(
    'root' => $root,
    'core' => $root.'core/components/resourcealert/',
    'model' => $root.'core/components/resourcealert/model/',
    'assets' => $root.'assets/components/resourcealert/',
    'schema' => $root.'_build/schema/',
);

$manager= $modx->getManager();
$generator= $manager->getGenerator();

if (!is_dir($sources['model'])) { $modx->log(modX::LOG_LEVEL_ERROR,'Model directory not found!'); die(); }

$generator->parseSchema($sources['schema'].'resourcealert.mysql.schema.xml', $sources['model']);

$modx->setOption(xPDO::OPT_AUTO_CREATE_TABLES, true);
$modx->addPackage('resourcealert', $sources['model']); // add package to make all models available
$manager->createObjectContainer('resourcealertItem');
$manager->createObjectContainer('resourcealertAlert'); // created the database table
$modx->log(modX::LOG_LEVEL_INFO, 'Done!');

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);
echo "\nExecution time: {$totalTime}\n";
exit ();