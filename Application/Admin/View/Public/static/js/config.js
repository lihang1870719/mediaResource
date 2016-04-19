/**
 *  require main entrance
 */

require.config({
    //baseUrl: "lib",
    //packages: ['carousel'],
    paths: {jquery: 'lib/jquery-1.10.2',
    	bootstrap:'lib/bootstrap',
    	app:'app/app',
    	verify:'app/verify',
    	login:'app/login',
    	utils:'app/utils',
    	category:'app/category',
    	post:'app/post',
    	course:'app/course',
    	admin:'app/admin',
    	role:'app/role',
    	mobile:'app/mobile',
    	comments:'app/comments',
    	mail:'app/mail',
    	message:'app/message',
    	salert:'lib/sweetalert.min'
    }
});
require(['app', 'verify', 'login', 'category', 
         'post','course', 'admin', 'role', 'mobile',
         'comments','mail','message' , 'jquery', 'bootstrap','salert'],
         function(a, v, l, c, p, cs, ad, role,mobile,comments, mail, message){
	a.init();	
	v.init();
    l.init();
    c.init();
    p.init();
    cs.init();
    ad.init();
    role.init();
    mobile.init();
    comments.init();
    mail.init();
    message.init();
});