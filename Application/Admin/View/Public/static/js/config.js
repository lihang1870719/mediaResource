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
    	utils:'app/utils'
    }
});

/*require(['domReady','verify'],function(dm,v){
    dm(function(){
    	v.init();
    });
});*/
require(['app','verify', 'login','jquery','bootstrap'],function(a, v, l){
    a.init();	
    a.del();
	v.init();
    l.init();
});