/**
 * 
 */
define(['jquery'], function($) {
  return {
    init: function() {
        var myNav = $(".side-nav a");
        for (var i = 0; i < myNav.length; i++) {
            var links = myNav.eq(i).attr("href");
            var myURL = document.URL;
            var durl=/http:\/\/([^\/]+)\//i;
            domain = myURL.match(durl);
            var result = myURL.replace("http://"+domain[1],"");
            if (links == result) {
                myNav.eq(i).parents(".dropdown").addClass("open");
            }
        }
        
    	$('.check-module').click(function(){
        	if($(this)[0].checked)
        	{
        		$(this).parent().parent().find(".check_all").attr("disabled",true);
        		$(this).parent().parent().find(".node_item").attr("disabled",true);
        	}
        	else
        	{
        		$(this).parent().parent().find(".check_all").attr("disabled",false);
        		$(this).parent().parent().find(".node_item").attr("disabled",false);	
        	}
    	});
    	
    	$('.node_item').click(function(){
        	if($(this.parentNode.parentNode.parentNode).find(".node_item:checked").length!=$(obj.parentNode.parentNode.parentNode).find(".node_item").length)
        	{
        		$(this.parentNode.parentNode.parentNode).find(".check_all").attr("checked",false);
        	}
        	else
        		$(this.parentNode.parentNode.parentNode).find(".check_all").attr("checked",true);
    	});
    	
    }
  }
});