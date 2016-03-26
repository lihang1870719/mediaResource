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

/*var sql = "INSERT INTO `ms_category` (`pid`, `name`, `title`, `keywords`, `description`) VALUES"
	+ "(0, 'fe', '前端开发', '', ''),"
	+ "(0, 'be', '后端开发', '', ''),"
	+ "(0, 'mobile', '移动开发', '', ''),"
	+ "(0, 'data', '数据处理', '', ''),"
	+ "(0, 'photo', '图像处理', '', '')";
query(sql, function(err,vals,fields){  
	console.log(err);
	console.log(vals);
});*/

/*query('select * from ms_category', function(err,vals,fields){  
	console.log(err);
	console.log(vals);
});*/

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
		parseDataTmp(body, name);
	});
}

function parseDataCourse(body, name) {
	console.log(11);
}

/*category_temp*/
function parseDataTmp(body, name){
	  console.log('============================================================================================');
	  console.log('======================================MOOC==================================================');
	  console.log('============================================================================================');		  
	  var sql = 'select id from ms_category where `title` = ?';
	  var params = name;
	  console.log(sql);
	  query(sql, name , function(err,vals,fields){  
			if (err) {
				console.error('[ERROR]Select' + err);		
				return;
			}
			var pid = vals[0].id;
			var $ = cheerio.load(body);
			var cate = $('.course-nav-item a');
			var pid_title = name;
			console.log( pid_title + '=======pid==========');
			var insert_sql;
			for(var i = 0; i < cate.length; i++) {
				if ($(cate[i]).attr('data-id')){
					var link = $(cate[i]).attr('href');
					var title = $(cate[i]).text();
					var temp = [pid, title, title, '', ''];
					if (i == 7) {
						insert_sql = "INSERT INTO `ms_category` (`pid`, `name`, `title`, `link`) VALUES ('" + pid + "', '" + title + "','" + title+ "','" + link +"')";
					} else {
						insert_sql +=",('" + pid + "', '" + title + "','" + title+ "','" + link +"')";
					}

					console.log(i + title + "  " + link); 
				}
			}
			console.log(insert_sql); 
			query(insert_sql,function(err,vals,fields){  
				console.log(err);
				console.log(vals);
			});

		});
}

/*category*/
function parseData(body, name){
	  console.log('============================================================================================');
	  console.log('======================================MOOC==================================================');
	  console.log('============================================================================================');		  
	  var sql = 'select id from ms_category where `title` = ?';
	  var params = name;
	  console.log(sql);
	  query(sql, name , function(err,vals,fields){  
			if (err) {
				console.error('[ERROR]Select' + err);		
				return;
			}
			var pid = vals[0].id;
			var $ = cheerio.load(body);
			var cate = $('.course-nav-item a');
			var pid_title = name;
			console.log( pid_title + '=======pid==========');
			var insert_sql;
			for(var i = 0; i < cate.length; i++) {
				if ($(cate[i]).attr('data-id')){
					var link = $(cate[i]).attr('href');
					var title = $(cate[i]).text();
					var temp = [pid, title, title, '', ''];
					if (i == 7) {
						insert_sql = "INSERT INTO `ms_category` (`pid`, `name`, `title`) VALUES ('" + pid + "', '" + title + "','" + title+ "')";
					} else {
						insert_sql +=",('" + pid + "', '" + title + "','" + title+ "')";
					}

					console.log(i + title + "  " + link); 
				}
			}
			console.log(insert_sql);
			query(insert_sql,function(err,vals,fields){  
				console.log(err);
				console.log(vals);
			});
		});
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