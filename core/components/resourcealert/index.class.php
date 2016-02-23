<?php
/**
* Action file for resourcealert extra
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


abstract class resourcealertManagerController extends modExtraManagerController {
    /** @var resourcealert $resourcealert */
    public $resourcealert = NULL;

    /**
     * Initializes the main manager controller.
     */
    public function initialize() {
        /* Instantiate the resourcealert class in the controller */
        $path = $this->modx->getOption('resourcealert.core_path',
                NULL, $this->modx->getOption('core_path') .
                'components/resourcealert/') . 'model/resourcealert/';
        require_once $path . 'resourcealert.class.php';
        $this->resourcealert = new resourcealert($this->modx);

        /* Optional alternative  - install PHP class as a service */

        /* $this->resourcealert = $this->modx->getService('resourcealert',
             'resourcealert', $path);*/

        /* Add the main javascript class and our configuration */
        $this->addJavascript($this->resourcealert->config['jsUrl'] .
            'resourcealert.class.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            resourcealert.config = ' . $this->modx->toJSON($this->resourcealert->config) . ';
        });
        </script>');
    }

    /**
     * Defines the lexicon topics to load in our controller.
     *
     * @return array
     */
    public function getLanguageTopics() {
        return array('resourcealert:default');
    }

    /**
     * We can use this to check if the user has permission to see this
     * controller. We'll apply this in the admin section.
     *
     * @return bool
     */
    public function checkPermissions() {
        return true;
    }

    /**
     * The name for the template file to load.
     *
     * @return string
     */
    public function getTemplateFile() {
        return dirname(__FILE__) . '/templates/mgr.tpl';
        // return $this->resourcealert->config['templatesPath'] . 'mgr.tpl';
    }
}

/**
 * The Index Manager Controller is the default one that gets called when no
 * action is present.
 */
class IndexManagerController extends resourcealertManagerController {
    /**
     * Defines the name or path to the default controller to load.
     *
     * @return string
     */
    public static function getDefaultController() {
        return 'home';
    }
}
