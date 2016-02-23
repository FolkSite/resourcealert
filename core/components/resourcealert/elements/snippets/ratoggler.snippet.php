<?php
/**
 * RAToggler snippet for resourcealert extra
 *
 * Copyright 2016 by DANNY HARDING <danny@stuntrocket.co>
 * Created on 02-21-2016
 *
 * resourcealert is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * resourcealert is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * resourcealert; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package resourcealert
 */

/**
 * Description
 * -----------
 * Description for Snippet ResourceAlertToggler
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package resourcealert
 **/
$defaultCorePath = $modx->getOption('core_path').'components/resourcealert/';
$myCorePath = $modx->getOption('resourcealert.core_path',null,$defaultCorePath);
$resourcealert = $modx->getService('resourcealert', 'resourcealert', $myCorePath.'model/resourcealert/', $scriptProperties);

$defaultAssetsPath = $modx->getOption('assets_url').'mycomponents/resourcealert/assets';
$myAssetsPath = $modx->getOption('resourcealert.assets_fronturl', null, $defaultAssetsPath);

if (empty($resourcealert)) return 'Class Not Found';
if (!($resourcealert instanceof resourcealert)) return 'Wrong Class';
 
/* setup default properties */
$tpl  = $modx->getOption('tpl', $scriptProperties, 'ResourceAlertTogglerButton');

$user = $modx->getUser();    
$uid  = $user->get('id');
$rid  = $modx->resource->get('id');

$modx->regClientHTMLBlock('<script type="text/javascript">var uid = "'.$uid.'"; var rid = "'.$rid.'"; var resourcealert_url_assets = "'.$myAssetsPath.'"; var resourcealert_ctx = "'.$modx->context->get('key').'";</script>');
$modx->regClientScript($myAssetsPath . 'js/resourcealerttoggle.js');

$output = "";
$data = array();
$data['state'] = $resourcealert->getUserPageStatus();

$output .= $resourcealert->getChunk($tpl, $data);
return $output;