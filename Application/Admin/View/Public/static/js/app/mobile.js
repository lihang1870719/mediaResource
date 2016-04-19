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
						swal({
						  title: "Error!",
						  text: "请选择课程!",
						  type: "error",
						  confirmButtonText: "OK"
						});
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