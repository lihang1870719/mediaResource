/**
 * author:lh
 */

define(['jquery','verify', 'utils'], function($, v, utils) {
  return {
    init: function() {
		$('.submit').click(function(event){
		   	//阻止表单默认提交事件
			var container = $('.login-form');
			event.preventDefault();
			var username = $('#login-username').val();
			var password = $('#login-password').val();
			var verify = $('#login-verify').val();
			var tips = $('.tips');
			tips.addClass('tips-error');
			if(username==""){
			    tips.text('登录名不能为空').removeClass('tips-success');
			    $('#login-username').focus();
			    return false;
			}else if(password==""){
			    tips.text('密码不能为空').removeClass('tips-success');
			    $('#login-password').focus();
			    return false;
			}else if(verify==""){
			    tips.text('验证码不能为空').removeClass('tips-success');
			    $('#login-verify').focus();
			    return false;
			}else {
			    var url = $('#action-url').val();
			    $.post(url, { 
			    	username : username,
			    	password : password,
			    	verify : verify
			    	}, function(msg){
				    if(msg.info == 'ok') {
				    	tips.text('登录成功, 2秒后跳转').removeClass('tips-error').addClass('tips-success');
				    	utils.jump(2, msg.callback);
				    } else {
				    	tips.text(msg.info).removeClass('tips-success');
				    	v.changeCode();
				    }
				  }, 'json').error(function(){
				    	tips.text('网络错误，请稍后再试！').removeClass('tips-success');
				    });
			}
		}); 
    }
  }
});
