/**
 * 公共方法库
 */

/**
 * 生成随机验证码
 */
function createCode(){ 
code = new Array();
var codeLength = 6;//验证码的长度

var selectChar = new Array(1,2,3,4,5,6,7,8,9);

for(var i=0;i<codeLength;i++) {
   var charIndex = Math.floor(Math.random()*32);
   code +=selectChar[charIndex];
}
if(code.length != codeLength){
   createCode();
}
return code;
}

//手机号正则表达式
var reg = /^1[3|4|5|8][0-9]\d{8}$/;
//邮箱正则表达式
var reg2 = /[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/;

/**
 * 倒计时
 */
var countdown=60; 
function settime($obj) { 
if (countdown == 0) { 
$("#getCode").addClass("button-primary");    
countdown =60; 
$("#getCode").text("免费获取验证码"); 
} else { 
$("#getCode").text("("+ countdown + "秒)后重新发送"); 
countdown--; 
t= setTimeout(function() { settime($obj) },1000); 
} 
} 
