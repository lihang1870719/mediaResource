/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils) {
  return {
    init: function() {
		var container = $('.post');	
		$(container).on('click', '.appr-success, .appr-fail', function(event){
			event.preventDefault();
			var data = {
					'id': $('#id').val(),
		    		'title': $('#post-title').val(),
					'cate_id': $('#post-cate').val(),
					'content': ue.getContent(),
					'type': $("input[name=type]:checked").val()
			};
			var status = $('#post-status').val();
			if ($(event.target).hasClass('appr-success')) {
				if (status == 0) {
					//审批通过，可以开始直播
					data.status = 1;
				} else {
					data.status = status;
				}
			} else {
				data.status = 2;
			}
			var url = $('#action-url').val();
			$.post(url, data, function(msg){
			    if(msg.info == 'ok') {
			    	alert(msg.info);
			    	window.location.href = msg.callback;
			    } else {
			    	alert(msg.info);
			    }
			  }, 'json').error(function(){
				   alert("网络错误");
			    });
		});
		$(container).on('click', '.submit', function(event){

		   	//阻止表单默认提交事件
			event.preventDefault();
			var data = {
		    		title: $('#post-title').val(),
		    		content: ue.getContent(),
		    		cate_id: $('#post-cate').val(),
		    		type: $("input[name=type]:checked").val()	
			};
			var id =$('#id').val();
			if(id != undefined) {
				data.id = id;
			}
		    var url = $('#action-url').val();
		    $.post(url, data, function(msg){
			    if(msg.info == 'ok') {
			    	alert(msg.info);
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
