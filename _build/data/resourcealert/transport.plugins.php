<?php
/**
 * plugins transport file for resourcealert extra
 *
 * Copyright 2016 by DANNY HARDING <danny@stuntrocket.co>
 * Created on 02-21-2016
 *
 * @package resourcealert
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $plugins */


$plugins = array();

$plugins[1] = $modx->newObject('modPlugin');
$plugins[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'PageAlert',
  'description' => '',
  'properties' => 
  array (
  ),
  'disabled' => false,
), '', true, true);
$plugins[1]->setContent(file_get_contents($sources['source_core'] . '/elements/plugins/pagealert.plugin.php'));

$plugins[2] = $modx->newObject('modPlugin');
$plugins[2]->fromArray(array (
  'id' => 2,
  'property_preprocess' => false,
  'name' => 'ResourceAlertPlugin',
  'description' => 'Description for ResourceAlertPlugin',
  'properties' => NULL,
  'disabled' => false,
), '', true, true);
$plugins[2]->setContent(file_get_contents($sources['source_core'] . '/elements/plugins/resourcealertplugin.plugin.php'));

return $plugins;
