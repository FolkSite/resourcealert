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
 
(function($) {
  $(function() { 
  	var toggler= $('#btn_pagealert');
  	var toggler_message = $('#btn_pagealert_message');
    toggler.change(function(e) {
      
      var ischecked = $(this).prop('checked');
      var state = 0;
      if(ischecked) { state = 1; }
      
      toggler_message.text('Saving');
      
  		$.ajax({
  			type: 'POST',
  			url: resourcealert_url_assets + 'connectors/connector.php?action=web/rasubscribe',
  			cache: false,
  			dataType: 'json',
  			timeout: 15000,
    			data: {
  				ctx: resourcealert_ctx,
  				rid: rid,
  				uid: uid,
  				state: state
  			},
  			// Parameter textStatus examples: "error", "parseerror", "timeout".
  			error: function(XMLHttpRequest, textStatus) {
  				toggler_message.text(textStatus);
  				console.log(textStatus);
  			},
  			// Called if the request succeeds
  			success: function(data) {
            console.log(data);
            toggler_message.text('Saved');
  					return;
  			},
  			// Called when the request finishes, after the error or success callback
  			complete: function(data) {
    			// console.log('complete');
  			}
  		});
    })
  });
})(jQuery);
