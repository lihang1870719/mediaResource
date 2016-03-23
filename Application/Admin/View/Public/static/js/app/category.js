/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils) {
  return {
    init: function() {
		var container = $('.category');	
		
		$(container).on('click', '.model-btn', function(){
			$('#myModal').modal('toggle')
		});
		
		$(container).on('click', '.submit', function(event){

		   	//阻止表单默认提交事件
			event.preventDefault();
			var data = {
		    		title: $('#title').val(),
		    		pid: $('#pid').val(),
		    		name: $('#name').val(),
		    		keywords: $('#keywords').val(),
		    		description: $('#description').val()	
			};
			var id =$('#id').val();
			if(id != undefined) {
				data.id = id;
			}
		    var url = $('#action-url').val();
		    $.post(url, data, function(msg){
			    if(msg.info == 'ok') {
			    	//alert(msg.info);
			    	window.location.href = msg.callback;
			    } else {
			    	alert(msg.info);
			    }
			  }, 'json').error(function(){
				   alert("网络错误");
			    });
		}); 
		
		$(container).on('click', '.delete-item', function(event){
        	var msg = "您真的确定要删除吗？\n\n删除后将不能恢复!请确认！"; 
            if (confirm(msg)==true){ 
            	var url = $(event.target).parent().find('.delete-url').val();
    		    $.get(url, function(msg){
    			    if(msg.info == 'ok') {
    			    	//alert(msg.info);
    			    	window.location.href = msg.callback;
    			    } else {
    			    	alert(msg.info);
    			    }
    			  }, 'json').error(function(){
    				   alert("网络错误");
    			    });
                }else{ 
                    return false; 
            } 
		});
    }
  }
});
