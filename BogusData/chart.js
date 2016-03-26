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
	query('select * from ms_course where id = 1', function(err,vals,fields){  
		if (err) {
			console.error('[ERROR]Select' + err);		
			return;
		}
		for(var i = 0; i < vals.length; i++){
		    console.log(vals[i].id + ':' + vals[i].link);
			requestData(URL_PREFIX + vals[i].link, vals[i].id, vals[i].cate_id);
		}
	});

	//requestData(URL_MOOCS);
}

function requestData(url, name, cateId){
	request({
		url: url,
		method: 'GET'
	}, function(err, res, body) {
		if(err) {
			console.log(url);
			console.error('[ERROR]Collection' + err);		
			return;
		}
		parseDataCourse(body, name, cateId);
	});
}

function requestDetail(url, name, cateId){
	request({
		url: url,
		method: 'GET'
	}, function(err, res, body) {
		if(err) {
			console.log(url);
			console.error('[ERROR]Collection' + err);		
			return;
		}
		parseChart(body, name, cateId);
	});
}

function parseChart(body, name, cateId) {
	  console.log('============================================================================================');
	  console.log('======================================MOOC==================================================');
	  console.log('============================================================================================');		  
	  var $ = cheerio.load(body);
	  var modChapters = $('.mod-chapters'),
	  chapter = $(modChapters).find('.chapter'),
	  pid = name,
	  userId = 1,
	  insert_sql;
	  for(var i = 0; i < 2; i++) {
		  var title = $(chapter[i]).find('strong').text();
		  if (i == 0) {
			  insert_sql = "INSERT INTO `ms_course` (`pid`, `title`, `cate_id` , `user_id`) VALUES ('" 
				  + pid + "','" 
				  + title + "','"
				  + cateId + "','"
				  + userId + "')";			  
		  } else {
			  insert_sql +=",('" 
				  + pid + "','" 
				  + title + "','"
				  + cateId + "','"
				  + userId + "')";			  
		  }
	  }
	  console.log(insert_sql);
	  query(insert_sql,function(err,vals,fields){  
		  console.log(err);
		  console.log(vals);
		 /* var smChaper = $(chapter).find('.video li a');
		  for(var i = 0; i < 2; i++) {
			  var title = $(smChaper[i]).text();
			  var link = $(smChaper[i]).attr('href');
			  if (i == 0) {
				  insert_sql = "INSERT INTO `ms_course` (`pid`, `title`, `cate_id` , `user_id`) VALUES ('" 
					  + pid + "','" 
					  + title + "','"
					  + cateId + "','"
					  + userId + "')";			  
			  } else {
				  insert_sql +=",('" 
					  + pid + "','" 
					  + title + "','"
					  + cateId + "','"
					  + userId + "')";			  
			  }
		  }*/
		  
	  });
}

function parseDataCourse(body, name, cateId) {		  
	  var $ = cheerio.load(body);
	  var infoLink = $('.info-bar-box a').attr('href');
	  var courseInfo = $('.course-brief').find('.auto-wrap').text();
	  console.log(courseInfo + "::::::::  " + infoLink);
	  query('update ms_course set `content` = ? where `id` = ?', [courseInfo, name], function(err,vals,fields){  
		  if (err) {
			  console.error('[ERROR]Update' + err);		
			  return;
		  }

		  requestDetail(URL_PREFIX + infoLink, name, cateId);

	  });
/*	  console.log( '============insert=======course==========');
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
	  });*/
	  
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