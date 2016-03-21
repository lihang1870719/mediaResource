/**
 * 
 */

define(['jquery'], function($) {
  return {
    jump: function(count, url) {
    	window.setTimeout(function(){    
            count--;    
            if(count == 1) {       
		    	window.location.href = url;
            }    
        }, 500);  
    }
  }
});