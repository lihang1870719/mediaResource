/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils){
	return {
		init: function() {
			var container = $('.mobile');			
			$(container).on('click', '.submit', function(event){
				event.preventDefault();
				var data = {
						'image_status': $("input[name=image_status]:checked").val(),
						'image_sort': $("input[name=image_sort]:checked").val(),
				};
				var id = $("#id").val();
				if(id != undefined) {
					// update
					data.id = id;
				} else {
					//add
					var title = $("#course-title option:selected").text();
					if (title == "请选择课程") {
						alert("请选择课程");
						return;
					}
					id = $("#course-title option:selected").val();
					if(id != undefined) {
						data.id = id;
					}
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