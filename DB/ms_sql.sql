/*新增一个数据库 需要在mysql5.5下运行*/
DROP DATABASE IF EXIST `ms`;

CREATE DATABASE `ms`;

USE `ms`;

-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-04-08 20:59:47
-- 服务器版本: 5.5.47-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ms`
--

-- --------------------------------------------------------

--
-- 表的结构 `ms_admin`
--

CREATE TABLE IF NOT EXISTS `ms_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login_time` varchar(20) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `ms_admin`
--

INSERT INTO `ms_admin` (`id`, `username`, `password`, `is_effect`, `is_delete`, `role_id`, `login_time`, `login_ip`) VALUES
(1, 'admin', '7fef6171469e80d32c0559f88b377245', 1, 0, 0, '1460118974', '0.0.0.0'),
(2, 'lihang', '2a08109ac73764f1de067567ce909c40', 1, 0, 1, '1459307070', '0.0.0.0'),
(5, '111111111111', '111', 1, 0, 1, '2016-03-24 01:29:56', ''),
(6, 'sdsa', '6512bd43d9caa6e02c990b0a82652dca', 0, 0, 1, '2016-03-24 01:35:05', ''),
(7, '11111', '6512bd43d9caa6e02c990b0a82652dca', 0, 0, 0, '2016-03-24 01:35:15', ''),
(8, '11', '6512bd43d9caa6e02c990b0a82652dca', 0, 0, 2, '2016-03-24 01:35:23', ''),
(9, 'dsds', '11', 0, 0, 2, '2016-03-24 01:36:13', ''),
(10, '123456', '11', 1, 0, 1, '2016-03-24 01:37:19', ''),
(11, 'asda', '698d51a19d8a121ce581499d7b701668', 1, 0, 2, '2016-03-24 01:37:56', ''),
(12, 'sdsd', '4124bc0a9335c27f086f24ba207a4912', 1, 0, 0, '2016-03-24 01:38:27', ''),
(13, 'A', '4124bc0a9335c27f086f24ba207a4912', 1, 0, 0, '2016-03-24 01:41:24', ''),
(14, 'asadsad', '4124bc0a9335c27f086f24ba207a4912', 1, 0, 1, '2016-03-24 01:41:38', ''),
(15, 'adsdasd', '47bce5c74f589f4867dbd57e9ca9f808', 1, 0, 1, '2016-03-24 01:42:23', ''),
(16, 'lihang123', '6512bd43d9caa6e02c990b0a82652dca', 1, 0, 1, '2016-03-24 01:43:04', ''),
(17, 'lh', '8ecc6960abbf70f7a5a70d9bfaae585c', 0, 0, 2, '1458874790', '0.0.0.0'),
(18, 'li11', '6512bd43d9caa6e02c990b0a82652dca', 0, 0, 1, '2016-03-25 11:00:58', ''),
(19, '222', '03c7c0ace395d80182db07ae2c30f034', 1, 0, 7, '2016-03-30 11:04:05', '');

-- --------------------------------------------------------

--
-- 表的结构 `ms_category`
--

CREATE TABLE IF NOT EXISTS `ms_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '父分类ID',
  `name` varchar(20) DEFAULT NULL COMMENT '分类别名',
  `title` varchar(100) DEFAULT NULL COMMENT '分类标题',
  `link` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL COMMENT '分类关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '分类描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `ms_category`
--

INSERT INTO `ms_category` (`id`, `pid`, `name`, `title`, `link`, `keywords`, `description`) VALUES
(1, 0, 'default', '默认分类', NULL, '默认分类', '默认分类描述'),
(2, 0, 'fe', '前端开发', NULL, '', ''),
(3, 0, 'be', '后端开发', NULL, '', ''),
(4, 0, 'mobile', '移动开发', NULL, '', ''),
(5, 0, 'data', '数据处理', NULL, '', ''),
(6, 0, 'photo', '图像处理', NULL, '', ''),
(7, 6, 'Photoshop', 'Photoshop', '/course/list?c=photoshop', NULL, NULL),
(8, 6, 'Maya', 'Maya', '/course/list?c=maya', NULL, NULL),
(9, 6, 'Premiere', 'Premiere', '/course/list?c=premiere', NULL, NULL),
(10, 6, 'ZBrush', 'ZBrush', '/course/list?c=ZBrush', NULL, NULL),
(11, 5, 'MySQL', 'MySQL', '/course/list?c=mysql', NULL, NULL),
(12, 5, 'MongoDB', 'MongoDB', '/course/list?c=mongodb', NULL, NULL),
(13, 5, '云计算', '云计算', '/course/list?c=cloudcomputing', NULL, NULL),
(14, 5, 'Oracle', 'Oracle', '/course/list?c=Oracle', NULL, NULL),
(15, 5, '大数据', '大数据', '/course/list?c=%E5%A4%A7%E6%95%B0%E6%8D%AE', NULL, NULL),
(16, 5, 'SQL Server', 'SQL Server', '/course/list?c=SQL+Server', NULL, NULL),
(17, 4, 'Android', 'Android', '/course/list?c=android', NULL, NULL),
(18, 4, 'iOS', 'iOS', '/course/list?c=ios', NULL, NULL),
(19, 4, 'Unity 3D', 'Unity 3D', '/course/list?c=Unity+3D', NULL, NULL),
(20, 4, 'Cocos2d-x', 'Cocos2d-x', '/course/list?c=Cocos2d-x', NULL, NULL),
(21, 2, 'HTML/CSS', 'HTML/CSS', '/course/list?c=html', NULL, NULL),
(22, 2, 'JavaScript', 'JavaScript', '/course/list?c=javascript', NULL, NULL),
(23, 2, 'CSS3', 'CSS3', '/course/list?c=CSS3', NULL, NULL),
(24, 2, 'Html5', 'Html5', '/course/list?c=html5', NULL, NULL),
(25, 2, 'jQuery', 'jQuery', '/course/list?c=jquery', NULL, NULL),
(26, 2, 'AngularJS', 'AngularJS', '/course/list?c=angularjs', NULL, NULL),
(27, 2, 'Node.js', 'Node.js', '/course/list?c=nodejs', NULL, NULL),
(28, 2, 'Bootstrap', 'Bootstrap', '/course/list?c=bootstrap', NULL, NULL),
(29, 2, 'WebApp', 'WebApp', '/course/list?c=webapp', NULL, NULL),
(30, 2, '前端工具', '前端工具', '/course/list?c=fetool', NULL, NULL),
(31, 3, 'PHP', 'PHP', '/course/list?c=php', NULL, NULL),
(32, 3, 'JAVA', 'JAVA', '/course/list?c=java', NULL, NULL),
(33, 3, 'Linux', 'Linux', '/course/list?c=linux', NULL, NULL),
(34, 3, 'Python', 'Python', '/course/list?c=python', NULL, NULL),
(35, 3, 'C', 'C', '/course/list?c=C', NULL, NULL),
(36, 3, 'C++', 'C++', '/course/list?c=C+puls+puls', NULL, NULL),
(37, 3, 'Go', 'Go', '/course/list?c=Go', NULL, NULL),
(38, 3, 'C#', 'C#', '/course/list?c=C%23', NULL, NULL),
(39, 3, '数据结构', '数据结构', '/course/list?c=data+structure', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ms_comments`
--

CREATE TABLE IF NOT EXISTS `ms_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` text,
  `comments_links` varchar(255) DEFAULT NULL,
  `time` varchar(20) DEFAULT '0',
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1:文本,2:语音',
  `style` tinyint(1) DEFAULT '0' COMMENT '0 评论:,1:笔记',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `ms_comments`
--

INSERT INTO `ms_comments` (`id`, `comments`, `comments_links`, `time`, `course_id`, `user_id`, `type`, `style`) VALUES
(1, '是地方撒发', NULL, '0', 2, 1, 1, 0),
(2, '是地方撒发', NULL, '0', 2, 1, 1, 0),
(3, '撒地方撒啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊的说法啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊是否的撒发撒地方撒地方撒范德萨艾弗森大幅撒', NULL, '0', 2, 1, 1, 1),
(4, '撒地方撒啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊的说法啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊是否的撒发撒地方撒地方撒范德萨艾弗森大幅撒', NULL, '0', 2, 1, 1, 1),
(5, '&lt;p&gt;sadfsadfsadf&lt;/p&gt;', NULL, '1459066843', NULL, 1, 1, 0),
(6, '&lt;p&gt;rtyrytrytry&lt;br/&gt;&lt;/p&gt;', NULL, '1459067008', NULL, 1, 1, 0),
(7, '&lt;p&gt;fhgfhfgdhfdh&lt;/p&gt;', NULL, '1459067038', 1, 1, 1, 0),
(9, '&lt;p&gt;什么时候&lt;/p&gt;', NULL, '1459067071', 1, 1, 1, 0),
(13, '复合肥电话\n', NULL, '1459067521', 1, 1, 2, 1),
(14, 'dsfdsafsdaf\n', NULL, '1459151815', 76, 1, 1, 0),
(15, 'safdsafdsafsdaf', NULL, '0', 1, 1, 1, 1),
(16, '1111111111111', NULL, '0', 1, 1, 1, 1),
(17, 'etewrt\n', NULL, '1459501018', 1, 1, 1, 0),
(19, '滚滚滚古古怪怪', NULL, '0', 76, 1, 1, 1),
(20, '', NULL, '0', 76, 1, 1, 1),
(21, '呃呃呃', NULL, '0', 76, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ms_course`
--

CREATE TABLE IF NOT EXISTS `ms_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '父级课程 0:顶级',
  `title` varchar(255) DEFAULT NULL COMMENT '课程标题',
  `link` varchar(255) DEFAULT NULL COMMENT '课程直播或者点播分配地址',
  `time` varchar(11) DEFAULT '0' COMMENT '课程总时长',
  `create_at` varchar(11) DEFAULT '0',
  `update_at` varchar(11) DEFAULT '0',
  `content` text COMMENT '课程或者章节简介',
  `cate_id` int(11) DEFAULT NULL COMMENT '分类',
  `user_id` int(11) DEFAULT NULL COMMENT '对应的编辑者',
  `status` tinyint(1) DEFAULT '0' COMMENT '课程状态 0：审批中，1：审批通过，可以直播，2：直播中，3：直播完成，审批中，4：直播完成，审批通过，可以点播；5：审核未通过',
  `type` tinyint(1) DEFAULT '1' COMMENT '课程类型 1:普通,2:置顶,3:热门,4:推荐',
  `image` varchar(255) DEFAULT NULL COMMENT '课程图片',
  `image_status` tinyint(1) DEFAULT '0' COMMENT '是否在轮播列表中 0：否 1:是',
  `image_sort` tinyint(1) DEFAULT '0' COMMENT '权重，权重越大越在前面',
  `crt` int(11) DEFAULT '0' COMMENT '点击率',
  `update_course` varchar(20) DEFAULT '' COMMENT 'course的pid为0才会显示update_course, 如果更新完成则显示更新完成',
  `start_at` varchar(20) DEFAULT '0' COMMENT '视频已经播放到多少秒',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- 转存表中的数据 `ms_course`
--

INSERT INTO `ms_course` (`id`, `pid`, `title`, `link`, `time`, `create_at`, `update_at`, `content`, `cate_id`, `user_id`, `status`, `type`, `image`, `image_status`, `image_sort`, `crt`, `update_course`, `start_at`) VALUES
(1, 0, 'HTML+CSS基础课程', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '9小时17分钟 ', '0', '0', '&lt;p&gt;本课程从最基本的概念开始讲起，步步深入，带领大家学习HTML、CSS样式基础知识，了解各种常用标签的意义以及基本用法，后半部分讲解CSS样式代码添加，为后面的案例课程打下基础。&lt;/p&gt;', 21, 1, 1, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(2, 0, '网页布局基础', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时30分钟 ', '0', '0', NULL, 21, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '16000'),
(3, 0, 'HTML5之元素与标签结构', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时 ', '0', '0', NULL, 24, 1, 0, 1, 'uploads/20160327143636_888.jpg', 1, 1, 232, '更新到1-1', '0'),
(4, 0, 'H5+JS+CSS3实现七夕言情', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '2小时24分钟 ', '0', '0', NULL, 24, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(5, 0, 'jQuery基础课程', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '9小时57分钟 ', '0', '0', NULL, 25, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(7, 0, '十天精通CSS3', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时 ', '0', '0', NULL, 23, 1, 0, 1, 'uploads/20160327143636_888.jpg', 1, 2, 232, '更新到1-1', '0'),
(9, 0, 'JavaScript入门篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时35分钟 ', '0', '0', NULL, 22, 1, 0, 1, 'uploads/20160327143636_888.jpg', 1, 3, 232, '更新到1-1', '0'),
(10, 0, 'JavaScript进阶篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '8小时55分钟 ', '0', '0', NULL, 22, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(11, 0, 'AngularJS实战', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '7小时12分钟 ', '0', '0', NULL, 26, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(12, 0, '使用AngularJS开发下一代Web应用', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '54分钟 ', '0', '0', NULL, 26, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(13, 0, '进击Node.js基础（一）', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '3小时27分钟 ', '0', '0', NULL, 27, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(14, 0, 'node+mongodb 建站攻略（一期）', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '2小时 ', '0', '0', NULL, 27, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(15, 0, '玩转Bootstrap（基础）', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '10小时 ', '0', '0', NULL, 28, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(16, 0, '基于bootstrap的网页开发', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时14分钟 ', '0', '0', NULL, 28, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(17, 0, '移动端开发框架Zepto.js入门', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时 ', '0', '0', NULL, 29, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(18, 0, '慕课网2048私人订制', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '2小时27分钟 ', '0', '0', NULL, 29, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(19, 0, ' Linux达人养成计划 I', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '6小时 ', '0', '0', NULL, 33, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(20, 0, 'Linux 达人养成计划 II', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '2小时30分钟 ', '0', '0', NULL, 33, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(21, 0, 'C语言入门', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '4小时50分钟 ', '0', '0', NULL, 35, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(22, 0, 'Linux C语言编程基本原理与实践', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '2小时 ', '0', '0', NULL, 35, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(23, 0, 'Python入门', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时 ', '0', '0', NULL, 34, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(24, 0, 'python进阶', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '3小时33分钟 ', '0', '0', NULL, 34, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(25, 0, 'Java入门第一季', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时 ', '0', '0', NULL, 32, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(26, 0, 'Java入门第二季', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '4小时 ', '0', '0', NULL, 32, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(27, 0, 'C++远征之起航篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时5分钟 ', '0', '0', NULL, 36, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(28, 0, 'C++远征之离港篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时27分钟 ', '0', '0', NULL, 36, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(29, 0, 'Go语言第一课', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '3小时9分钟 ', '0', '0', NULL, 37, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(30, 0, 'Gopher China 2015 上海大会', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '10小时58分钟 ', '0', '0', NULL, 37, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(31, 0, 'C#开发轻松入门', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '4小时42分钟 ', '0', '0', NULL, 38, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(32, 0, '用C#实现封装', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '2小时24分钟 ', '0', '0', NULL, 38, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(33, 0, 'PHP入门篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时56分钟 ', '0', '0', NULL, 31, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(34, 0, 'PHP进阶篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '9小时27分钟 ', '0', '0', NULL, 31, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(35, 0, '数据结构探险—队列篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时14分钟 ', '0', '0', NULL, 39, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(36, 0, '使用Swift开发iOS8 App实战', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '7小时48分钟 ', '0', '0', NULL, 18, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(37, 0, '玩儿转Swift', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '6小时36分钟 ', '0', '0', NULL, 18, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(38, 0, 'Cocos2d-x游戏开发初体验-C++篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '52分钟 ', '0', '0', NULL, 20, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(39, 0, 'Cocos2d-x游戏之七夕女神抓捕计划', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '4小时32分钟 ', '0', '0', NULL, 20, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(40, 0, 'Unity3D快速入门', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '3小时18分钟 ', '0', '0', NULL, 19, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(41, 0, 'Unity3D-万圣前夜之惊声尖笑', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '50分钟 ', '0', '0', NULL, 19, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(42, 0, 'Android攻城狮的第一门课（入门篇）', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时 ', '0', '0', NULL, 17, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(43, 0, 'Android攻城狮的第二门课（第1季）', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时 ', '0', '0', NULL, 17, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(44, 0, '与MySQL的零距离接触', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '8小时29分钟 ', '0', '0', NULL, 11, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(45, 0, '数据库设计那些事', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时50分钟 ', '0', '0', NULL, 11, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(46, 0, 'Oracle数据库开发必备利器之SQL基础', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '4小时13分钟 ', '0', '0', NULL, 14, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(47, 0, 'Oracle数据库开发必备利器之PL/SQL基础', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '3小时21分钟 ', '0', '0', NULL, 14, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(48, 0, 'SQL Server基础--T-SQL语句', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时36分钟 ', '0', '0', NULL, 16, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(49, 0, 'mongoDB入门篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时20分钟 ', '0', '0', NULL, 12, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(50, 0, 'MongoDB 2014北京大会', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '3小时2分钟 ', '0', '0', NULL, 12, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(51, 0, '在线分布式数据库原理与实践', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时53分钟 ', '0', '0', NULL, 13, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(52, 0, '云安全的架构设计与实践之旅', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时18分钟 ', '0', '0', NULL, 13, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(53, 0, 'Hadoop大数据平台架构与实践--基础篇', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时22分钟 ', '0', '0', NULL, 15, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(54, 0, 'R语言入门', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1小时 ', '0', '0', NULL, 15, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(56, 0, '拍摄与剪辑“怀孕日记”', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '30分钟 ', '0', '0', NULL, 9, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(57, 0, 'Premiere魔术——图片变电影', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '23分钟 ', '0', '0', NULL, 9, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(58, 0, ' Maya3D建模攻略——葵花宝典     ', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '5小时40分钟 ', '0', '0', NULL, 8, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(59, 0, 'Zbrush生物角色高级雕刻', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '6小时34分钟 ', '0', '0', '', 10, 1, 1, 2, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(60, 0, 'PS入门教程——新手过招', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '9小时44分钟 ', '0', '0', NULL, 7, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(61, 0, 'PS大神通关教程', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '8小时11分钟 ', '0', '0', '', 7, 1, 1, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '更新到1-1', '0'),
(74, 1, '第1章 Html介绍', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '0', '0', '0', NULL, 21, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '', '0'),
(75, 1, '第2章 认识标签(第一部分)', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '0', '0', '0', NULL, 21, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '', '0'),
(76, 74, '1-1 代码初体验，制作我的第一个网页', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1458997739', '0', '0', '', 21, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '', '0'),
(77, 74, '1-2 Html和CSS的关系', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1458997767', '0', '0', '&lt;p&gt;sa&lt;/p&gt;', 21, 1, 0, 1, 'uploads/20160327143636_888.jpg', 0, 0, 232, '', '16000'),
(78, 74, '1-3 认识html标签', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1459060598', '0', '0', '', 21, 1, 5, 1, 'uploads/20160327143636_888.jpg', 1, 0, 232, '', '0'),
(79, 75, '2-1 认识html标签', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1459149839', '0', '0', '', 21, 1, 0, 1, 'uploads/20160328152357_358.jpg', 0, 0, 0, '', '0'),
(80, 10, '第一章', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1459237097', '0', '0', NULL, 1, 1, 0, 1, NULL, 0, 0, 0, '', '0'),
(81, 2, '第1章 课程简介', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1459244228', '0', '0', '', 21, 1, 0, 1, 'uploads/20160329173659_856.jpg', 0, 0, 0, '', '0'),
(82, 2, '第2章 自动居中一列布局', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1459244257', '0', '0', '', 21, 1, 0, 1, 'uploads/20160329173735_467.jpg', 0, 0, 0, '', '0'),
(83, 81, '1-1第一节', 'http://192.168.11.41/mediaResource/uploads/video/111.mp4', '1459244622', '0', '0', '', 21, 1, 0, 1, 'uploads/20160329174341_643.jpg', 0, 0, 0, '', '0'),
(84, 4, '第一章', NULL, '1459307374', '0', '0', '', 21, 2, 0, 1, 'uploads/20160330110933_879.jpg', 0, 0, 0, '', '0');

-- --------------------------------------------------------

--
-- 表的结构 `ms_live`
--

CREATE TABLE IF NOT EXISTS `ms_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '直播名字',
  `user_id` int(11) DEFAULT NULL COMMENT '直播用户名',
  `cate_id` int(11) DEFAULT NULL COMMENT '分类',
  `status` tinyint(1) DEFAULT '0' COMMENT '直播状态 0：审批中，1：直播中，2：直播完成，并需要将完成的流媒体存入课程列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ms_log`
--

CREATE TABLE IF NOT EXISTS `ms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_info` text NOT NULL,
  `log_time` int(11) NOT NULL,
  `log_admin` int(11) NOT NULL,
  `log_ip` varchar(255) NOT NULL,
  `log_status` tinyint(1) NOT NULL,
  `module` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='//记录' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ms_log`
--

INSERT INTO `ms_log` (`id`, `log_info`, `log_time`, `log_admin`, `log_ip`, `log_status`, `module`, `action`) VALUES
(1, '管理员更新成功', 1459383233, 1, '0.0.0.0', 1, 'Admin', 'update'),
(2, '管理员更新成功', 1459383361, 1, '::1', 1, 'Admin', 'update'),
(3, 'Admin成功登录', 1459408571, 1, '0.0.0.0', 1, 'Admin', 'login'),
(4, 'Admin成功登录', 1459472187, 1, '0.0.0.0', 1, 'Admin', 'login'),
(5, 'Admin成功登录', 1459552565, 1, '0.0.0.0', 1, 'Admin', 'login'),
(6, 'Admin成功登录', 1460090174, 1, '0.0.0.0', 1, 'Admin', 'login');

-- --------------------------------------------------------

--
-- 表的结构 `ms_mail`
--

CREATE TABLE IF NOT EXISTS `ms_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail_server` varchar(255) DEFAULT NULL COMMENT '邮件服务器地址/短信接口名称',
  `is_effect` tinyint(1) NOT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '类型 0：email,1:phone',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ms_mail`
--

INSERT INTO `ms_mail` (`id`, `username`, `password`, `mail_server`, `is_effect`, `type`) VALUES
(1, 'server-ll', 'server--', 'http://sdfdsfsd', 1, 0),
(3, 'gdfsgdsfsssssss', 'gfsdgdsfg', 'dgdfsgdfsqqqqqqqqqqqqqq', 1, 0),
(4, 'sdgfdsgfdss', 'gdfsgfsdgss', 'gffdshdfsg', 1, 0),
(5, 'wwww的撒发撒发', '爱上方式的', '是否撒ffffffffffffffffffffffffffasdsadasfdsafasdf', 1, 1),
(6, 'sdafsdaf', 'sdafsadf', 'asfssdafdsaf', 1, 0),
(7, 'dafsadfasdf', 'asdfasdf', 'sadfdsafdsaf', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ms_post`
--

CREATE TABLE IF NOT EXISTS `ms_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `time` varchar(20) DEFAULT '0',
  `cate_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1:普通,2:置顶,3:热门,4:推荐',
  `status` tinyint(1) DEFAULT '0' COMMENT '0:待审批,1:审批通过,2:审批不通过',
  `crt` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cate_id` (`cate_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `ms_post`
--

INSERT INTO `ms_post` (`id`, `title`, `content`, `time`, `cate_id`, `user_id`, `type`, `status`, `crt`) VALUES
(1, 'werewqrwqrewr', '&lt;p&gt;11111111111&lt;br/&gt;&lt;/p&gt;', '1458632719', 1, 1, 1, 0, 100),
(3, '11111111111', '&lt;p&gt;sdfdsafsad&lt;/p&gt;', '1458634137', 1, 1, 1, 0, 100),
(4, '我而且服务', '&lt;p&gt;&amp;lt;gjhgj&amp;gt;&lt;/p&gt;', '1458634292', 1, 1, 1, 0, 100),
(5, '撒发地方', '&lt;p&gt;是的发达是否&lt;br/&gt;&lt;/p&gt;', '1458634411', 1, 1, 2, 0, 100),
(6, 'wqeqwe', '', '1458634487', 1, 1, 1, 0, 100),
(7, '的玩儿的完全', '', '1458634718', 1, 1, 1, 0, 100),
(8, 'wqfwefweqf', '', '1458635285', 1, 1, 1, 0, 100),
(9, 'CSS 第二届', '&lt;p&gt;wdqwedwqd&lt;br/&gt;&lt;/p&gt;', '1458635503', 1, 1, 2, 0, 100),
(10, '11', '&lt;p&gt;111112222222222222&lt;/p&gt;', '1458635520', 1, 1, 1, 0, 100),
(12, 'sfadsafsda', '&lt;p&gt;fsdafsdafasdf&lt;/p&gt;', '1458723336', 1, 1, 1, 2, 100),
(22, 'sdfdsf', '&lt;p&gt;dsfsdfdsf&lt;/p&gt;', '1459156317', 1, 1, 1, 0, 100),
(23, 'assssssssssss', '&lt;p&gt;sssfffffffffffff&lt;/p&gt;', '1459156321', 1, 1, 1, 0, 100),
(24, '1111111111111111111111', '&lt;p&gt;&lt;img src=&quot;/Public/upload/image/201603/1459157155816736.jpg&quot; title=&quot;1459157155816736.jpg&quot; alt=&quot;2936a547cd8df8538d9cb2bddcbf470b.jpg&quot;/&gt;11111111111111&lt;/p&gt;', '1459156326', 1, 1, 1, 0, 100),
(25, '33333333333333333', '&lt;p&gt;33323333333333333&lt;/p&gt;', '1459156332', 1, 1, 1, 0, 100),
(28, 'qwreeeeeeeeeeeeeeeeeeeeeqq', '&lt;p&gt;eeerweqqqqqqqqqqqqqqqqqq&lt;/p&gt;', '1459164144', 1, 1, 1, 0, 100),
(29, 'qwerwqrweqr', '&lt;p&gt;weqrewqrqwer&lt;/p&gt;', '1459164149', 1, 1, 1, 0, 100),
(30, 'wqerweqr', '&lt;p&gt;werqwerwer&lt;/p&gt;', '1459164153', 1, 1, 1, 0, 100),
(31, '222222222222222', '&lt;p&gt;2222222222222222222222222222222222&lt;/p&gt;', '1459164158', 1, 1, 1, 0, 100),
(32, '33333333333333', '&lt;p&gt;3333333333333333&lt;/p&gt;', '1459164164', 1, 1, 1, 0, 100),
(33, '23242', '&lt;p&gt;4324324&lt;/p&gt;', '1459164169', 1, 1, 1, 0, 100),
(34, 'sfdsafsda', '&lt;p&gt;fsdafdsafdsaf&lt;/p&gt;', '1459165400', 1, 1, 1, 0, 100),
(35, 'asfsadf', '&lt;p&gt;safsdaf&lt;/p&gt;', '1459165404', 1, 1, 1, 0, 100),
(36, 'asfsadf', '&lt;p&gt;safsdaf&lt;/p&gt;', '1459165408', 1, 1, 1, 0, 100),
(37, 'asfsadf', '&lt;p&gt;sdafsdaf&lt;/p&gt;', '1459165412', 1, 1, 1, 0, 100),
(38, 'fasfdsafsdaf', '&lt;p&gt;safsafsdaf&lt;/p&gt;', '1459165417', 1, 1, 1, 0, 100),
(39, 'fsdafsdfsdfsadf', '&lt;p&gt;safsadf&lt;/p&gt;', '1459166166', 2, 1, 1, 0, 0),
(40, 'asdfdsafsaaaaaaaaaaaaaaff', '&lt;p&gt;sdfsadfsdaf&lt;/p&gt;', '1459166173', 3, 1, 1, 0, 0),
(41, 'safsdafdsafsdafdsafd', '&lt;p&gt;asfsafsadfsdaf&lt;/p&gt;', '1459166180', 5, 1, 1, 0, 0),
(42, 'sadfsdafsdafs', '&lt;p&gt;&lt;img src=&quot;/Public/upload/image/201603/1459168777818774.jpg&quot; title=&quot;1459168777818774.jpg&quot; alt=&quot;2936a547cd8df8538d9cb2bddcbf470b.jpg&quot;/&gt;sfsadfsafsadf&lt;/p&gt;', '1459166189', 6, 1, 1, 0, 0),
(43, 'dsdafdsf', '&lt;p&gt;&lt;img src=&quot;/Public/upload/image/201603/1459169148995264.jpg&quot; title=&quot;1459169148995264.jpg&quot; alt=&quot;2936a547cd8df8538d9cb2bddcbf470b.jpg&quot;/&gt;dsafsdafdsaf&lt;/p&gt;', '1459169141', 1, 1, 1, 0, 0),
(44, 'ffdgfdsgfdsgdsg', '&lt;p&gt;sdfgfsdg&lt;/p&gt;', '1459237275', 4, 1, 1, 0, 0),
(45, 'js技巧专题篇：表单常用的密码强度检验', '&lt;p&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; background-color: rgb(255, 255, 255);&quot;&gt;近日工作繁忙，更新速度稍慢，敬请谅解。闲话不说，就上一弹的CSS选择器话题，先供上一张总结图片供参考。&lt;/span&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;img src=&quot;/Public/upload/image/201603/1459239764694271.png&quot; alt=&quot;图片描述&quot; style=&quot;border: 0px; display: block; margin: 0.6em auto; max-width: 100%; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; position: static !important; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; background-color: rgb(255, 255, 255);&quot;&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;下面主要谈谈在CSS中的基本盒子模型。盒子，是页面中元素呈现的基本样式模型。是每一个元素标签在页面上的呈现。对应HTML中的块级元素和行内元素，那么有两类盒子，一类是块级元素的块级盒子：默认占据一行，可以指定显式的宽度和高度，每个盒子单独占一行后自动换行；另一类是行内元素的行内盒子，它不可指定宽度，自动包裹住内容宽度，并且在一行内并排显示，只有排列不下的情况下才会被“挤”到下一行，并不自动换行。大部分的标签元素的显示，都是块级盒子，少量如span、img是行内盒子。&lt;/span&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;img src=&quot;/Public/upload/image/201603/1459239764205697.png&quot; alt=&quot;图片描述&quot; style=&quot;border: 0px; display: block; margin: 0.6em auto; max-width: 100%; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; position: static !important; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; background-color: rgb(255, 255, 255);&quot;&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;那么，每个盒子具体是什么样子的，又有哪些基本CSS属性呢？下面是一个基本盒子的图样，以及对应的属性总结：&lt;/span&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;img src=&quot;/Public/upload/image/201603/1459239765194257.png&quot; alt=&quot;图片描述&quot; style=&quot;border: 0px; display: block; margin: 0.6em auto; max-width: 100%; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; position: static !important; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;img src=&quot;/Public/upload/image/201603/1459239766849382.png&quot; alt=&quot;图片描述&quot; style=&quot;border: 0px; display: block; margin: 0.6em auto; max-width: 100%; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; position: static !important; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; background-color: rgb(255, 255, 255);&quot;&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;当涉及到外边距、边框、outline、内边距的属性书写的时候，会有简写的情况，这时候记住：&lt;/span&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;strong style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;em style=&quot;font-weight: inherit;&quot;&gt;1、数值一次性书写，其顺序是从top开始，顺时针表示 top、right、bottom、left。&lt;br/&gt;2、因为这些都是矩形，所以，如果对应的数值如果缺失，缺失的那一边就采用对面边的数值。如果只有一个数值，那就表示四个边都是同一个数值。&lt;/em&gt;&lt;/strong&gt;&lt;br style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;/&gt;&lt;span style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; background-color: rgb(255, 255, 255);&quot;&gt;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 了解了页面元素的呈现都是一些盒子的排列，和具体盒子的属性设置，我们可以简单的看看一个页面是怎么布局的了。我们来看个实际的页面：&lt;/span&gt;&lt;/p&gt;', '1459239774', 2, 1, 1, 0, 0),
(46, '移动端H5各种各样的列表的制作方法(六)', '&lt;blockquote style=&quot;margin: 0.8em 0px; padding: 10.5px 21px; quotes: none; border-left-width: 4px; border-left-style: solid; border-left-color: rgb(204, 204, 204); color: rgb(85, 85, 85); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(245, 245, 245);&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px;&quot;&gt;如果你是先看到的这篇文章,建议您先去上面的链接,把对应的内容给看一下,这样上下文连贯,更容易理解本文的内容.&lt;/p&gt;&lt;/blockquote&gt;&lt;p style=&quot;margin-top: 0.8em; margin-bottom: 0.8em; padding: 0px; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;在前面两章中,讲的都是两列布局的图文列表.而事实上,两列布局的图文列表还是比较简单的.这一章,我们将要更进一步来挑战难度.实现一个相对来说,非常复杂的布局方式.&lt;/p&gt;&lt;p style=&quot;margin-top: 0.8em; margin-bottom: 0.8em; padding: 0px; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;并且,为兼容安卓4.4以下,以及部分傻逼国产移动端浏览器.我们将在实践中,放弃&lt;code style=&quot;margin: 0px; padding: 0px; font-size: 0.92857em; font-family: Menlo, Monaco, Consolas, &amp;#39;Courier New&amp;#39;, monospace; color: rgb(199, 37, 78); border-radius: 3px; background-color: rgb(243, 243, 243);&quot;&gt;calc\\vh\\vw&lt;/code&gt;等&lt;code style=&quot;margin: 0px; padding: 0px; font-size: 0.92857em; font-family: Menlo, Monaco, Consolas, &amp;#39;Courier New&amp;#39;, monospace; color: rgb(199, 37, 78); border-radius: 3px; background-color: rgb(243, 243, 243);&quot;&gt;css3&lt;/code&gt;最新属性.只使用比较简单的参数,来实现这个布局.&lt;/p&gt;&lt;p&gt;&lt;strong style=&quot;color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; white-space: normal; display: block; font-size: 22px; margin: 22px 0px 10px; background-color: rgb(255, 255, 255);&quot;&gt;复杂图文混排列表&lt;/strong&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0.8em; margin-bottom: 0.8em; padding: 0px; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;这部分是比较复杂的,但是,特别特别的常见.我们先来看一下最终效果图.&lt;/p&gt;&lt;p style=&quot;margin-top: 0.8em; margin-bottom: 0.8em; padding: 0px; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;&lt;img src=&quot;http://ww2.sinaimg.cn/large/459e195ajw1f1yio2trh0j209o0cvq4y.jpg&quot; alt=&quot;复杂图文混排列表&quot; style=&quot;border: 0px; display: block; margin: 0.6em auto; max-width: 100%; position: static !important;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0.8em; margin-bottom: 0.8em; padding: 0px; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;如上图所示,这应该算是一个比较复杂的图文列表了.不知道你看到这个布局,你会构建怎么样的DOM框架.&lt;/p&gt;&lt;p style=&quot;margin-top: 0.8em; margin-bottom: 0.8em; padding: 0px; color: rgb(51, 51, 51); font-family: &amp;#39;Open Sans&amp;#39;, &amp;#39;Helvetica Neue&amp;#39;, Helvetica, Arial, STHeiti, &amp;#39;Microsoft Yahei&amp;#39;, sans-serif; line-height: 28.8px; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;我是这样考虑的.为了后端能够方便的输出,这六个产品,必须格式统一.因此,我的HTML代码如下:&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1459239879', 2, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ms_role`
--

CREATE TABLE IF NOT EXISTS `ms_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ms_role`
--

INSERT INTO `ms_role` (`id`, `name`, `is_effect`, `is_delete`) VALUES
(1, 'lihang', 1, 0),
(2, '课程直播管理员组', 1, 0),
(6, 'qwqewqe', 0, 0),
(7, 'admin2', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ms_role_access`
--

CREATE TABLE IF NOT EXISTS `ms_role_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `ms_role_access`
--

INSERT INTO `ms_role_access` (`id`, `role_id`, `node_id`, `module_id`) VALUES
(2, 2, 0, 4),
(3, 2, 0, 8),
(5, 3, 0, 8),
(6, 3, 0, 9),
(7, 1, 0, 4),
(8, 1, 0, 8),
(9, 1, 0, 9),
(12, 4, 0, 7),
(13, 4, 0, 9),
(14, 7, 0, 2),
(15, 7, 0, 4);

-- --------------------------------------------------------

--
-- 表的结构 `ms_role_module`
--

CREATE TABLE IF NOT EXISTS `ms_role_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `ms_role_module`
--

INSERT INTO `ms_role_module` (`id`, `module`, `name`, `is_effect`, `is_delete`) VALUES
(1, 'Role', '权限管理', 1, 0),
(2, 'Admin', '管理员管理', 1, 0),
(3, 'Category', '分类管理', 1, 0),
(4, 'Course', '课程管理', 1, 0),
(5, 'Post', '文章管理', 1, 0),
(7, 'Comments', '留言评论管理', 1, 0),
(8, 'Live', '直播管理', 1, 0),
(9, 'Mobile', '移动平台管理', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ms_role_nav`
--

CREATE TABLE IF NOT EXISTS `ms_role_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `module` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `ms_role_nav`
--

INSERT INTO `ms_role_nav` (`id`, `pid`, `module`, `name`, `icon`, `is_effect`, `is_delete`, `sort`) VALUES
(1, 0, 'Index', '系统首页', 'fa-dashboard', 1, 0, 1),
(2, 0, 'Category', '分类管理', 'fa-reorder', 1, 0, 2),
(3, 0, 'Course', '课程管理', 'fa-files-o', 1, 0, 3),
(4, 0, 'Live', '直播管理', 'fa-desktop', 1, 0, 4),
(5, 0, 'Post', '文章管理', 'fa-edit', 1, 0, 5),
(6, 0, 'Comments', '留言笔记管理', 'fa-comments', 1, 0, 6),
(7, 0, '', '系统设置', 'fa-cog', 1, 0, 7),
(8, 7, 'Role', '管理员组管理', '', 1, 0, 8),
(9, 7, 'Admin', '管理员管理', '', 1, 0, 9),
(10, 0, 'Mobile', '移动平台管理', 'fa-tablet', 1, 0, 6),
(11, 0, '', '短信邮件管理', 'fa-envelope-o', 1, 0, 6),
(12, 11, 'Message', '短信管理', '', 1, 0, 0),
(13, 11, 'Mail', '邮件服务器管理', '', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ms_role_node`
--

CREATE TABLE IF NOT EXISTS `ms_role_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `nav_id` int(11) NOT NULL COMMENT '后台分组菜单分组ID',
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `ms_role_node`
--

INSERT INTO `ms_role_node` (`id`, `action`, `name`, `is_effect`, `is_delete`, `nav_id`, `module_id`) VALUES
(1, 'index', '管理员分组列表', 1, 0, 8, 1),
(2, 'index', '管理员列表', 1, 0, 9, 2),
(3, 'index', '分类列表', 1, 0, 2, 3),
(4, 'index', '课程列表', 1, 0, 3, 4),
(5, 'index', '文章列表', 1, 0, 5, 5),
(6, 'index', '直播列表', 1, 0, 4, 8),
(7, 'index', '留言笔记列表', 1, 0, 6, 7),
(8, 'index', '移动平台列表', 1, 0, 10, 9),
(9, 'add', '新增管理员分组', 1, 0, 0, 1),
(10, 'add', '新增管理员', 1, 0, 0, 2),
(11, 'add', '新增分类', 1, 0, 0, 3),
(12, 'add', '新增课程', 1, 0, 0, 4),
(13, 'add', '新增文章', 1, 0, 0, 5),
(14, 'add', '新增直播', 1, 0, 0, 8),
(15, 'add', '新增留言笔记', 1, 0, 0, 7),
(16, 'add', '新增移动平台', 1, 0, 0, 9),
(17, 'delete', '删除管理员分组', 1, 0, 0, 1),
(18, 'delete', '删除管理员', 1, 0, 0, 2),
(19, 'delete', '删除分类', 1, 0, 0, 3),
(20, 'delete', '删除课程', 1, 0, 0, 4),
(21, 'delete', '删除文章', 1, 0, 0, 5),
(22, 'delete', '删除直播', 1, 0, 0, 8),
(23, 'delete', '删除留言笔记', 1, 0, 0, 7),
(24, 'delete', '删除移动平台', 1, 0, 0, 9),
(25, 'update', '编辑管理员分组', 1, 0, 0, 1),
(26, 'update', '编辑管理员', 1, 0, 0, 2),
(27, 'update', '编辑分类', 1, 0, 0, 3),
(28, 'update', '编辑课程', 1, 0, 0, 4),
(29, 'update', '编辑文章', 1, 0, 0, 5),
(30, 'update', '编辑直播', 1, 0, 0, 8),
(31, 'update', '编辑留言笔记', 1, 0, 0, 7),
(32, 'upadte', '编辑移动平台', 1, 0, 0, 9),
(33, 'approve', '审批课程', 1, 0, 0, 4),
(34, 'approve', '审批文章', 1, 0, 0, 5),
(35, 'approve', '审批直播', 1, 0, 0, 8);

-- --------------------------------------------------------

--
-- 表的结构 `ms_user`
--

CREATE TABLE IF NOT EXISTS `ms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `email` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `create_at` varchar(20) DEFAULT '0',
  `update_at` varchar(20) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0' COMMENT '0:正常 1:删除',
  `is_effect` tinyint(1) DEFAULT '1' COMMENT '0:禁止登陆 1:正常',
  `type` tinyint(1) DEFAULT '0' COMMENT '0: 普通会员，1： 可以上传，直播的用户',
  `description` text COMMENT '个人简介',
  `open_id` tinyint(1) DEFAULT '0' COMMENT '0:正常 1: 来自微信 2: 来自QQ 3:来自其他',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ms_user`
--

INSERT INTO `ms_user` (`id`, `username`, `password`, `avatar`, `email`, `nickname`, `login_ip`, `create_at`, `update_at`, `is_delete`, `is_effect`, `type`, `description`, `open_id`) VALUES
(1, 'hello', 'hello', NULL, NULL, NULL, NULL, '0', '0', 0, 1, 0, 'sadfff', 0),
(3, '15002752798', '15002752798', NULL, NULL, NULL, NULL, '0', '0', 0, 1, 0, NULL, 0),
(6, '1157995231@qq.com', '698d51a19d8a121ce581499d7b701668', NULL, NULL, '111', NULL, '0', '0', 0, 1, 0, NULL, 0),
(7, '18707199735', '698d51a19d8a121ce581499d7b701668', NULL, NULL, '111', NULL, '0', '0', 0, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ms_user_course`
--

CREATE TABLE IF NOT EXISTS `ms_user_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `course_history` int(11) DEFAULT '0' COMMENT '用户学习记录对应的course表中的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ms_user_course`
--

INSERT INTO `ms_user_course` (`id`, `user_id`, `course_history`) VALUES
(1, 1, 2),
(4, 1, 3),
(7, 1, 4);

-- --------------------------------------------------------

--
-- 表的结构 `ms_verifycode`
--

CREATE TABLE IF NOT EXISTS `ms_verifycode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `verifycode` varchar(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(2) DEFAULT NULL COMMENT '1代表短信验证码，2代表邮箱验证码',
  `state` varchar(30) DEFAULT '0' COMMENT '发送状态 0代表未成功 1代表成功',
  `content` text COMMENT '发送过的验证信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `ms_verifycode`
--

INSERT INTO `ms_verifycode` (`id`, `username`, `verifycode`, `create_at`, `type`, `state`, `content`) VALUES
(12, '18707199735', '7652', '2016-04-08 12:30:54', '1', '1', '您的验证码是：【7652】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！'),
(11, '1157995231@qq.com', '179921', '2016-04-08 12:24:25', '2', '1', '亲爱的用户,您好,您在媒资管理平台上注册的验证码是179921'),
(10, '1157995231@qq.com', '171169', '2016-04-08 12:22:07', '2', '1', '亲爱的用户,您好,您在媒资管理平台上注册的验证码是171169'),
(9, '', '2230', '2016-04-08 12:12:46', NULL, '0', '您的验证码是：【2230】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！'),
(8, '', '4822', '2016-04-08 12:01:59', NULL, '0', '您的验证码是：【4822】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！'),
(7, '', '2750', '2016-04-08 12:01:38', NULL, '0', '您的验证码是：【2750】。请不要把验证码泄露给其他人。如非本人操作，可不用理会！');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;