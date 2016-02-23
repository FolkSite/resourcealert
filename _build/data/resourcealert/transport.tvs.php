<?php
/**
 * templateVars transport file for resourcealert extra
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
/* @var xPDOObject[] $templateVars */


$templateVars = array();

$templateVars[1] = $modx->newObject('modTemplateVar');
$templateVars[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'type' => 'listbox',
  'name' => 'Alertable',
  'caption' => 'Alertable',
  'description' => 'Does this page allow page alert subscriptions.',
  'elements' => 'On==1||Off==0',
  'rank' => 0,
  'display' => 'default',
  'default_text' => '0',
  'properties' => 
  array (
  ),
  'input_properties' => 
  array (
    'allowBlank' => 'true',
    'listWidth' => '',
    'title' => '',
    'typeAhead' => 'false',
    'typeAheadDelay' => '250',
    'forceSelection' => 'false',
    'listEmptyText' => '',
  ),
  'output_properties' => 
  array (
  ),
), '', true, true);
$templateVars[2] = $modx->newObject('modTemplateVar');
$templateVars[2]->fromArray(array (
  'id' => 2,
  'property_preprocess' => false,
  'type' => 'text',
  'name' => 'AlertSummary',
  'caption' => 'Alert Summary',
  'description' => 'Summary sent to subscribers',
  'elements' => '',
  'rank' => 0,
  'display' => 'default',
  'default_text' => 'Page updated on CAP website.',
  'properties' => 
  array (
  ),
  'input_properties' => 
  array (
  ),
  'output_properties' => 
  array (
  ),
), '', true, true);
return $templateVars;
