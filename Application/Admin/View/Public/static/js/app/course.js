/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils){
	return {
		init: function() {
			var container = $('.course');
			$(container).on('click', '.appr-success, .appr-fail', function(event){
				event.preventDefault();
				var data = {
						'id': $('#id').val(),
						'title': $('#course-title').val(),
						'cate_id': $('#course-cate').val(),
						'pid': $('#course-pid').val(),
						'link' : $('#course-link').val(),
						'content': $('#course-content').val(),
						'type': $('#type').val()
				};
				var status = $('#course-status').val();
				if ($(event.target).hasClass('appr-success')) {
					if (status == 0) {
						//审批通过，可以开始直播
						data.status = 1;
					} else if (status == 3) {
						//审批通过，可以开始点播
						data.status = 4;
					}
				} else {
					data.status = 5;
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
				event.preventDefault();
				var data = {
						'title': $('#course-title').val(),
						'cate_id': $('#course-cate').val(),
						'pid': $('#course-pid').val(),
						'content': $('#course-content').val()
				};
				var id = $('#id').val();
				if(id != undefined) {
					data.id = id;
				}
				var link = $('#course-link').val();
				if(link != undefined) {
					data.link = link;
				}
				var url = $('#aciton-url').val();
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