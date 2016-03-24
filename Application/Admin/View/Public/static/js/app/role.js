/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils){
	return {
		init: function() {
			var container = $('.role');			
			$(container).on('click', '.submit', function(event){
				event.preventDefault();
				var data = {
						'name': $('#role-name').val(),
						'is_effect': $("input[name='is_effect']:checked").val(),
				};
				var role_access = [];
				$("input[name='role_access']:checked").each(function(){
					role_access.push($(this).val());
				})
				data.role_access = role_access;
				if (data.name == "") {
					alert("管理员组名称不能为空");
					$('#role-name').focus();
					return;
				}
				var id = $('#id').val();
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