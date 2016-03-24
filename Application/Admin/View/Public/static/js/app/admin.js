/**
 * author:lh
 */

define(['jquery', 'utils'], function($, utils){
	return {
		init: function() {
			var container = $('.admin');			
			$(container).on('click', '.submit', function(event){
				event.preventDefault();
				var data = {
						'username': $('#admin-username').val(),
						'password': $('#admin-password').val(),
						'role_id': $('#admin-role').val(),
						'is_effect': $("input[name=is_effect]:checked").val()
				};
				var r_password = $('#admin-cf-pasword').val();

				if (data.username == "") {
					alert("管理员名称不能为空");
					$('#admin-username').focus();
					return;
				} else if (!data.password || !r_password) {
					alert("密码不能为空");
				    $('#admin-password').focus();
					return;					
				} else if (r_password != data.password) {
					alert("两次密码一致，请重新填写");
				    $('#admin-password').focus();
				    $('#admin-password').val("");
				    $('#admin-cf-pasword').val("");
					return;
				} else if (data.role_id == "") {
					alert("请选择管理员分类");
					$('#admin-role').focus();
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