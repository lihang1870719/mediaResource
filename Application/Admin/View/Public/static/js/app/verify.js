/**
 * 
 */

define(['jquery'], function($) {
  return {
    init: function() {
    	$(".verify").click(function(){
            var src = $('#verify-url').val();
            var random = Math.floor(Math.random()*(1000+1));
            $(this).attr("src",src+"&random="+random);
        });
    },
  	changeCode: function() {
        var src = $('#verify-url').val();
        var random = Math.floor(Math.random()*(1000+1));
        $(".verify").attr("src",src+"&random="+random);
  	}
  }
});