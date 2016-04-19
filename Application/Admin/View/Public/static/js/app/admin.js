/**
 * author:lh
 */

define(['jquery', 'utils', 'salert'], function($, utils, sa){
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
					swal({
					  title: "Error!",
					  text: "管理员名称不能为空!",
					  type: "error",
					  confirmButtonText: "OK"
					});
					$('#admin-username').focus();
					return;
				} else if (!data.password || !r_password) {
					swal({
					  title: "Error!",
					  text: "密码不能为空!",
					  type: "error",
					  confirmButtonText: "OK"
					});
				    $('#admin-password').focus();
					return;					
				} else if (r_password != data.password) {
					swal({
					  title: "Error!",
					  text: "两次密码一致，请重新填写!",
					  type: "error",
					  confirmButtonText: "OK"
					});
				    $('#admin-password').focus();
				    $('#admin-password').val("");
				    $('#admin-cf-pasword').val("");
					return;
				} else if (data.role_id == "") {
					swal({
					  title: "Error!",
					  text: "请选择管理员分类!",
					  type: "error",
					  confirmButtonText: "OK"
					});
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
				    	window.location.href = msg.callback;
				    } else {
						swal({
						  title: "Warning!",
						  text: msg.info,
						  type: "warning",
						  confirmButtonText: "OK"
						});
				    }
				  }, 'json').error(function(){
						swal({
						  title: "Error!",
						  text: "网络错误",
						  type: "error",
						  confirmButtonText: "OK"
						});
				    });
			});
			
			$(container).on('click', '.delete-item', function(event){
				swal({
				  title: "您真的要删除吗?",
				  text: "删除后将不能恢复!",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes",
				  cancelButtonText: "No",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
				function(isConfirm){
				  if (isConfirm) {
				    var url = $(event.target).parent().find('.delete-url').val();
				    $.get(url, function(msg){
					    if(msg.info == 'ok') {
					    	//alert(msg.info);
					    	window.location.href = msg.callback;
					    } else {
							swal({
							  title: "Warning!",
							  text: msg.info,
							  type: "warning",
							  confirmButtonText: "OK"
							});
					    }
					  }, 'json').error(function(){
							swal({
							  title: "Error!",
							  text: "网络错误",
							  type: "error",
							  confirmButtonText: "OK"
							});
					    });
				  } else {
					  swal("Cancelled", "admin is safe :)", "error");
					  return false;
				  }
				});
			});
		}
	}
});