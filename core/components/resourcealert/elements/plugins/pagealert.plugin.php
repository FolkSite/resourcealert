<?php
$res_array = $resource->toArray();
$modx->log(modX::LOG_LEVEL_ERROR, print_r($res_array));
if(!empty($res_array)) {
if ($mode == 'upd') {
     $activity = "Update";     
     if($res_array['tv110'] == 1) {
      
      $defaultCorePath = $modx->getOption('core_path').'components/resourcealert/';
      $myCorePath      = $modx->getOption('resourcealert.core_path',null,$defaultCorePath);
      $resourcealert   = $modx->getService('resourcealert', 'resourcealert', $myCorePath.'model/resourcealert/');

      // $saved = $resourcealert->saveAlert($id);
      // if(!$saved) {
        //  $modx->log(modX::LOG_LEVEL_ERROR, 'An error occurred while trying to save a page alert for ID: ' . $id);
        // return false;
      // }

      return true;
     }
  }
}