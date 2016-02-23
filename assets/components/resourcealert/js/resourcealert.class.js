/**
* JS file for resourcealert extra
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
*/
        
/* These are for LexiconHelper:
   $modx->lexicon->load('resourcealert:default');
   include 'resourcealert.class.php'
 */
var resourcealert = function (config) {
    config = config || {};
    resourcealert.superclass.constructor.call(this, config);
};
Ext.extend(resourcealert, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}
});
Ext.reg('resourcealert', resourcealert);

var resourcealert = new resourcealert();