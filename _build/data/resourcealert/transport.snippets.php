<?php
/**
 * snippets transport file for resourcealert extra
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
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'ResourceAlertSnippet',
  'description' => 'Description for Snippet ResourceAlertSnippet',
  'properties' => NULL,
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/resourcealertsnippet.snippet.php'));

$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->fromArray(array (
  'id' => 2,
  'property_preprocess' => false,
  'name' => 'RAToggler',
  'description' => 'Description for Snippet ResourceAlertToggler',
  'properties' => 
  array (
  ),
), '', true, true);
$snippets[2]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/ratoggler.snippet.php'));

return $snippets;
