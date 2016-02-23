<?php
/**
 * Processor file for resourcealert extra
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
 * @subpackage processors
 */

/* @var $modx modX */

// comment out the next line to make processor functional
class ResourceChangeCategoryProcessor extends modProcessor {
    public $classKey = 'modResource';
    public $languageTopics = array('resourcealert:default');
    
    public function process() {

/* !!! Remove this line to make processor functional */
return $this->modx->error->success();

        if (!$this->modx->hasPermission('save_resource')) {
            return $this->modx->error->failure($this->modx->lexicon('access_denied'));
        }

        if (empty($scriptProperties['resources'])) {
            return $this->failure($this->modx->lexicon('resourcealert.resources_err_ns'));
        }
        /* get parent */
        if (!empty($scriptProperties['category'])) {
            $category = $this->modx->getObject('modCategory',$scriptProperties['category']);
            if (empty($category)) {
                return $this->failure($this->modx->lexicon('resource.category_err_nf'));
            }
        }

        /* iterate over resources */
        /** @var $resource modElement */
        $resourceIds = explode(',',$scriptProperties['resources']);
        foreach ($resourceIds as $resourceId) {
            $resource = $this->modx->getObject($this->classKey,$resourceId);
            if ($resource == null) continue;
        
            $resource->set('category',$scriptProperties['category']);
            $resource->save(3600);
        }
        return $this->success();
    }



}

return 'ResourceChangeCategoryProcessor';