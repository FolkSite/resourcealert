<?php
/**
 * Resolver for resourcealert extra
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
 * @package resourcealert
 * @subpackage build
 */

/* @var $object xPDOObject */
/* @var $modx modX */

/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:

            $modx =& $object->xpdo;
                        
            $modelPath = $modx->getOption('resourcealert.core_path', null, 
              $modx->getOption('core_path') . 'components/resourcealert/') . 'model/';
                        
            $modx->addPackage('resourcealert', $modelPath);
            $manager = $modx->getManager();
            // $modx->setOption(xPDO::OPT_AUTO_CREATE_TABLES, true);
            $manager->createObjectContainer('resourcealertItem');
            $manager->createObjectContainer('resourcealertAlert'); // created the database table

            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;