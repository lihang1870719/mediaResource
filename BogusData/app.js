/**
 * data crawler
 * author: lh
 */
var request = require('request'),
	cheerio = require('cheerio'),
	query=require("./lib/db.js"),
	URL_LIST = {
		'前端开发': 'http://www.imooc.com/course/list?c=fe',
		'后端开发': 'http://www.imooc.com/course/list?c=be',
		'移动开发': 'http://www.imooc.com/course/list?c=mobile',
		'数据处理': 'http://www.imooc.com/course/list?c=data',
		'图像处理': 'http://www.imooc.com/course/list?c=photo'
	};
	URL_MOOCS = 'http://www.imooc.com/course/list';

function startUp(){
	console.log(111);
	for(var name in URL_LIST){
	    console.log(name + ':' + URL_LIST[name]);
		requestData(URL_LIST[name], name);
	}
	//requestData(URL_MOOCS);
}


query("select * from ms_category",function(err,vals,fields){  
	console.log(vals);
	console.log(fields)
}); 

function requestData(url, name){
	request({
		url: url,
		method: 'GET'
	}, function(err, res, body) {
		if(err) {
			console.log(url);
			console.error('[ERROR]Collection' + err);		
			return;
		}
		parseData(body, name);
	});
}

function parseData(body, name){
	  console.log('============================================================================================');
	  console.log('======================================MOOC==================================================');
	  console.log('============================================================================================');	
	  var $ = cheerio.load(body);
	  var cate = $('.course-nav-item a');
	  var pid = name;
	  console.log( pid + '=======pid==========');
	  for(var i = 0; i < cate.length; i++) {
		  if ($(cate[i]).attr('data-id')){
			  var link = $(cate[i]).attr('href');
			  var title = $(cate[i]).text();
			  console.log(title + "  " + link); 
		  }
	  }
/*	  var course = $('.course-list .course-one');
	  for(var i = 0; i < course.length; i++) {
		  var img = $(course[i]).find('.course-list-img img');
		  var tips = $(course[i]).find('.tips p').text();
		  var imgSrc = img.attr('src');
		  var title = img.attr('alt');
		  console.log('tips: ' + tips);
		  console.log('title: ' + title);
		  console.log('imageUrl: ' + imgSrc);
	  }*/
}

startUp();