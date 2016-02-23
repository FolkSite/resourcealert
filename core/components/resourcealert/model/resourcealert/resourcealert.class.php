<?php
/**
 * CMP class file for resourcealert extra
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
 * @package ResourceAlert
 */

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

 class ResourceAlert {
    /** @var $modx modX */
    public $modx;
    /** @var $props array */
    public $config;

    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;  
        $basePath = $this->modx->getOption('resourcealert.core_path',$config,$this->modx->getOption('core_path').'components/resourcealert/');
        $assetsUrl = $this->modx->getOption('resourcealert.assets_url',$config,$this->modx->getOption('assets_url').'components/resourcealert/');
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'templatesPath' => $basePath.'templates/',
            'chunksPath' => $basePath.'elements/chunks/',
            'snippetsPath' => $basePath.'elements/snippets/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
        ),$config);
        
        $this->modx->addPackage('resourcealert',$this->config['modelPath']);
        
        if ($this->modx->lexicon) {
            $this->modx->lexicon->load('resourcealert:default');
        }
    }

    /**
      
      /var/www/vhosts/cap/assets/mycomponents/resourcealert/assets/components/resourcealert/
      /var/www/vhosts/cap/assets/mycomponents/resourcealert/assets/components/resourcealert/js/
      
     * Initializes resourcealert based on a specific context.
     *
     * @access public
     * @param string $ctx The context to initialize in.
     * @return string The processed content.
     */
     
    public function initialize($ctx = 'mgr') {
        $output = '';
        switch ($ctx) {
            case 'mgr':
                if (!$this->modx->loadClass('resourcealert.request.resourcealertControllerRequest',
                    $this->config['modelPath'],true,true)) {
                        return 'Could not load controller request handler.';
                }
                $this->request = new resourcealertControllerRequest($this);
                $output = $this->request->handleRequest();
                break;
        }
        return $output;
    }
    
 
    
  public function getUserPageStatus() {
    $user = $this->modx->getUser();
    if (!$user) { return 0; }
    
    $user_id       = $user->get('id');
    $resource_id   = $this->modx->resource->get('id');
        
    if(empty($user_id) || empty($resource_id)) { return 0; }
    
    $subscription = $this->modx->getObject('resourcealertItem', array('user' => $user_id, 'resource' => $resource_id));
    if(!empty($subscription)) {
      return 1;
    }
    return 0;
  }
  
  
  public function sendAlerts() {
    // check which pages have alert set
    //   
  }
  
  
  public function getUserSubscriptions() {
    // 
    //   
  }
  
  public function saveAlert($resource_id) {
    if(empty($resource_id)) { return false; }
    
    $alert = $this->modx->getObject('resourcealertAlert', array('resource' => $resource_id, 'state' => 0));
    if(empty($alert)) {
      $alert = $this->modx->newObject('resourcealertAlert');
      $alert->set('resource',$resource_id);
      $alert->set('date',time());
      $alert->save();
      return true;
    }    
    return true;
  }
  
  public function saveSubscription($input) {
    if(empty($input)) { return false; }
    
    $user_id = (isset($input['uid']) && !empty($input['uid'])) ? $input['uid'] : false;
    $resource_id = (isset($input['rid']) && !empty($input['rid'])) ? $input['rid'] : false;
    $state = (isset($input['state']) && !empty($input['state'])) ? 1 : 0;

    $subscription = $this->modx->getObject('resourcealertItem', array('user' => $user_id, 'resource' => $resource_id));
    
    // Create
    if($state == 1) {
      
      if(empty($subscription)) {
        
        $subscription = $this->modx->newObject('resourcealertItem');
        $subscription->set('user',$user_id);
        $subscription->set('resource',$resource_id);
                      
      }
      return $subscription->save();
    }
    
    // Delete request but it didn't exist anyway.
    if(!$subscription) {
      return true; 
    }
    
    // We couldn't delete, operation failed.
    if ($subscription->remove() == false) {
       return false;
    }
    
    return true;
  }
  
 
  public function getChunk($name,$properties = array()) {
      $chunk = null;
      if (!isset($this->chunks[$name])) {
          $chunk = $this->modx->getObject('modChunk',array('name' => $name));
          if (empty($chunk) || !is_object($chunk)) {
              $chunk = $this->_getTplChunk($name);
              if ($chunk == false) return false;
          }
          $this->chunks[$name] = $chunk->getContent();
      } else {
          $o = $this->chunks[$name];
          $chunk = $this->modx->newObject('modChunk');
          $chunk->setContent($o);
      }
      $chunk->setCacheable(false);
      return $chunk->process($properties);
  }
   
  private function _getTplChunk($name,$postfix = '.chunk.tpl') {
      $chunk = false;
      $f = $this->config['chunksPath'].strtolower($name).$postfix;
            
      if (file_exists($f)) {
          $o = file_get_contents($f);
          $chunk = $this->modx->newObject('modChunk');
          $chunk->set('name',$name);
          $chunk->setContent($o);
      }
      return $chunk;
  } 
    
    
}