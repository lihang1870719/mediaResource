/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils) {
  return {
    init: function() {
		$('.submit').click(function(event){
			var container = $('.category');	
		   	//阻止表单默认提交事件
			event.preventDefault();
			var title = $('#title').val();
			var pid = $('#pid').val();
			var name = $('#name').val();
			var keywords = $('#keywords').val();
			var description = $('#description').val();
		    var url = $('#action-url').val();
		    $.post(url, { 
		    		title: title,
		    		pid: pid,
		    		name: name,
		    		keywords: keywords,
		    		description: description
		    	}, function(msg){
			    if(msg.info == 'ok') {
			    	alert(msg.info);
			    	window.location.href = msg.callback;
			    } else {
			    	alert(msg.info);
			    }
			  }, 'json').error(function(){
				   alert("网络错误")
			    });
		}); 
    }
  }
});
