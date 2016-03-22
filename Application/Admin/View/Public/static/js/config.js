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
    	post:'app/post'
    }
});

/*require(['domReady','verify'],function(dm,v){
    dm(function(){
    	v.init();
    });
});*/
require(['app', 'verify', 'login', 'category', 'post', 'jquery', 'bootstrap'],function(a, v, l, c, p){
	a.init();	
	v.init();
    l.init();
    c.init();
    p.init();
});