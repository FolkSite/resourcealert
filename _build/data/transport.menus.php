<?php
/**
 * menus transport file for resourcealert extra
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
/* @var xPDOObject[] $menus */

$action = $modx->newObject('modAction');
$action->fromArray( array (
  'namespace' => 'resourcealert',
  'controller' => 'index',
  'haslayout' => 1,
  'lang_topics' => 'resourcealert:default',
  'assets' => '',
  'help_url' => '',
  'id' => 1,
), '', true, true);

$menus[1] = $modx->newObject('modMenu');
$menus[1]->fromArray( array (
  'text' => 'Resource Alert',
  'parent' => 'components',
  'description' => 'Resource Alert Management',
  'icon' => '',
  'menuindex' => 0,
  'params' => '',
  'handler' => '',
  'permissions' => '',
  'namespace' => 'resourcealert',
  'id' => 1,
), '', true, true);
$menus[1]->addOne($action);

return $menus;
