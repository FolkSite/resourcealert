<?php
/**
 * systemSettings transport file for resourcealert extra
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
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'resourcealert_enabled',
  'value' => true,
  'xtype' => 'combo-boolean',
  'namespace' => 'resourcealert',
  'area' => 'area2',
  'name' => 'Resource Alert enabled setting',
  'description' => 'Enable or disable resource alert component',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'resourcealert.core_path',
  'value' => '/var/www/vhosts/cap/assets/mycomponents/resourcealert/core/components/resourcealert/',
  'xtype' => 'textfield',
  'namespace' => 'resourcealert',
  'area' => '',
  'name' => 'resourcealert.core_path',
  'description' => 'setting_resourcealert.core_path_desc',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
  'key' => 'resourcealert.assets_url',
  'value' => '/var/www/vhosts/cap/assets/mycomponents/resourcealert/assets/components/resourcealert/',
  'xtype' => 'textfield',
  'namespace' => 'resourcealert',
  'area' => '',
  'name' => 'resourcealert.assets_url',
  'description' => 'setting_resourcealert.assets_url_desc',
), '', true, true);
$systemSettings[4] = $modx->newObject('modSystemSetting');
$systemSettings[4]->fromArray(array (
  'key' => 'resourcealert.assets_fronturl',
  'value' => '/assets/mycomponents/resourcealert/assets/components/resourcealert/',
  'xtype' => 'textfield',
  'namespace' => 'resourcealert',
  'area' => '',
  'name' => 'resourcealert.assets_fronturl',
  'description' => 'setting_resourcealert.assets_fronturl_desc',
), '', true, true);
return $systemSettings;
