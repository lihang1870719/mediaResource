/**
 * data crawler
 * author: lh
 */
var request = require('request'),
	cheerio = require('cheerio'),
	query=require("./lib/db.js"),
	async = require('async'),
	URL_PREFIX = 'http://www.imooc.com',
	URL_LIST,
	URL_MOOCS = 'http://www.imooc.com/course/list';

function startUp(){
	console.log("get url");
	query('select * from ms_category where pid = 6', function(err,vals,fields){  
		if (err) {
			console.error('[ERROR]Select' + err);		
			return;
		}
		for(var i = 0; i < vals.length; i++){
		    console.log(vals[i].id + ':' + vals[i].link);
			requestData(URL_PREFIX + vals[i].link, vals[i].id);
		}
	});

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
		parseDataCourse(body, name);
	});
}

function parseDataCourse(body, name) {
	  console.log('============================================================================================');
	  console.log('======================================MOOC==================================================');
	  console.log('============================================================================================');		  
	  var $ = cheerio.load(body);
	  var course = $('.course-list .course-one');
	  console.log( '============insert=======course==========');
	  var insert_sql;	
	  var pid = 0;
	  var userId = 1;
	  var cateId = name;
	  var c_l = course.length>2?2:course.length;
	  for(var i = 0; i < c_l; i++) {
		  var img = $(course[i]).find('.course-list-img img'),
		  tips = $(course[i]).find('.tips p').text(),
		  link = $(course[i]).find('a').attr('href'),
		  timeLabel = $(course[i]).find('.time-label').text().trim(),
		  index = timeLabel.indexOf('|'),
		  time = timeLabel.substring(0, index),
		  imgSrc = img.attr('src'),
		  title = img.attr('alt');
		  console.log('link: ' + link);
		  console.log('tips: ' + tips);
		  console.log('title: ' + title);
		  console.log('imageUrl: ' + imgSrc);
		  console.log('time: ' + time);
		  if (i == 0) {
			  insert_sql = "INSERT INTO `ms_course` (`pid`, `title`, `link`, `cate_id` , `user_id`,`time`,`image`) VALUES ('" 
				  + pid + "','" 
				  + title + "','"
				  + link + "','"
				  + cateId + "','"
				  + userId + "','"
				  + time + "','"				  
				  + imgSrc+ "')";
		  } else {
			  insert_sql +=",('" 
				  + pid + "','" 
				  + title + "','"
				  + link + "','"
				  + cateId + "','"
				  + userId + "','"
				  + time + "','"				  
				  + imgSrc+ "')";
		  }
	  }
	  console.log(insert_sql);
	  query(insert_sql,function(err,vals,fields){  
		  console.log(err);
		  console.log(vals);
	  });
	  
	/*  var sql = 'select id from ms_category where `title` = ?';
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
		});*/
}

startUp();