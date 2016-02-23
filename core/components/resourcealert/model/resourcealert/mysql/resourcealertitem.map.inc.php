<?php
$xpdo_meta_map['resourcealertItem']= array (
  'package' => 'resourcealert',
  'version' => NULL,
  'table' => 'resourcesalert_subscriptions',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'user' => 0,
    'resource' => 0,
  ),
  'fieldMeta' => 
  array (
    'user' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
  ),
);
