<?php
/**
 * Processor file for resourcealert extra
 *
 * Copyright 2016 by DANNY HARDING <danny@stuntrocket.co>
 * Created on 02-22-2016
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
 * @subpackage processors
 */

/* @var $modx modX */


class resourcealertResourceRasubscribeProcessor extends modProcessor {
    public $classKey = 'modResource';
    public $languageTopics = array('resourcealert:default');
    public $defaultSortField = 'pagetitle';
    public $defaultSortDirection = 'ASC';
    public $ids;

    function initialize() {
        return true;
    }

    public function process() {

        $defaultCorePath = $this->modx->getOption('core_path').'components/resourcealert/';
        $myCorePath = $this->modx->getOption('resourcealert.core_path',null,$defaultCorePath);
        $resourcealert = $this->modx->getService('resourcealert', 'resourcealert', $myCorePath.'model/resourcealert/');
        if (!($resourcealert instanceof ResourceAlert)) {
          return $this->modx->error->failure($this->modx->lexicon('Unable to load ResourceAlert class'));
        }
        
        $sanitizedPosts = $this->modx->sanitize($_POST);
        $uid = (isset($sanitizedPosts['uid']) && !empty($sanitizedPosts['uid'])) ? $sanitizedPosts['uid'] : false;
        $rid = (isset($sanitizedPosts['rid']) && !empty($sanitizedPosts['rid'])) ? $sanitizedPosts['rid'] : false;
        $state = (isset($sanitizedPosts['state']) && !empty($sanitizedPosts['state'])) ? 1 : 0;

        if(!$uid) {
          return $this->modx->error->failure("No User ID");
        }
        
        if(!$rid) {
          return $this->modx->error->failure("No Resource ID");
        }
        
        $saved = $resourcealert->saveSubscription($sanitizedPosts);
        if(!$saved) {
          return $this->modx->error->failure("Unable To Save");
        }
                
        return $this->success();

    }
}

return 'resourcealertResourceRasubscribeProcessor';
