/*新增一个数据库 需要在mysql5.5下运行*/
DROP DATABASE IF EXIST `ms`;

CREATE DATABASE `ms`;

USE `ms`;

/*admin*/
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ms_admin` (`id`, `username`, `password`, `is_effect`, `is_delete`, `role_id`, `login_time`, `login_ip`) VALUES
(1, 'admin', '7fef6171469e80d32c0559f88b377245', 1, 0, 4, 1458012224, '::1'),
(4, '123456789', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 5, 0, ''),
(5, 'admin12', '1844156d4166d94387f1a4ad031ca5fa', 1, 0, 5, 1457980913, '::1');

/*role 管理员权限*/
CREATE TABLE IF NOT EXISTS `ms_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ms_role` (`id`, `name`, `is_effect`, `is_delete`) VALUES
(4, '测试管理员', 1, 0),
(5, 'admin123', 1, 0),
(6, 'dasadsa', 1, 0);

/*role_access*/
CREATE TABLE IF NOT EXISTS `ms_role_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*role_module*/
CREATE TABLE IF NOT EXISTS `ms_role_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ms_role_module` (`id`, `module`, `name`, `is_effect`, `is_delete`) VALUES
(1, 'Role', '权限管理', 1, 0),
(2, 'Admin', '管理员', 1, 0),
(3, 'Category', '分类管理', 1, 0),
(4, 'Media', '元数据管理', 1, 0),
(5, 'Post', '文章管理', 1, 0),
(6, 'Page', '单页管理', 1, 0),
(7, 'Comment', '留言管理' , 1, 0),
(8, 'Link', '链接管理', 1, 0);


/*role_node*/
CREATE TABLE IF NOT EXISTS `ms_role_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `nav_id` int(11) NOT NULL COMMENT '后台分组菜单分组ID',
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ms_role_node` (`id`, `action`, `name`, `is_effect`, `is_delete`, `nav_id`, `module_id`) VALUES
(1, 'index', '管理员分组列表', 1, 0, 6, 1),
(2, 'index', '管理员列表', 1, 0, 6, 2),
(3, 'index', '分类列表', 1, 0, 2, 3),
(4, 'index', '元数据列表', 1, 0, 3, 4),
(5, 'index', '文章列表', 1, 0, 4, 5),
(6, 'index', '单页列表', 1, 0, 5, 6),
(7, 'index', '留言列表', 1, 0, 7, 7),
(8, 'index', '链接列表', 1, 0, 8, 8),
(9, 'add', '新增管理员分组', 1, 0, 0, 1),
(10, 'add', '新增管理员', 1, 0, 0, 2),
(11, 'add', '新增分类', 1, 0, 0, 3),
(12, 'add', '新增元数据', 1, 0, 0, 4),
(13, 'add', '新增文章', 1, 0, 0, 5),
(14, 'add', '新增单页', 1, 0, 0, 6),
(15, 'add', '新增留言', 1, 0, 0, 7),
(16, 'add', '新增链接', 1, 0, 0, 8),
(17, 'update', '更新管理员分组', 1, 0, 0, 1),
(18, 'update', '更新管理员', 1, 0, 0, 2),
(19, 'update', '更新分类', 1, 0, 0, 3),
(20, 'update', '更新元数据', 1, 0, 0, 4),
(21, 'update', '更新文章', 1, 0, 0, 5),
(22, 'update', '更新单页', 1, 0, 0, 6),
(23, 'update', '更新留言', 1, 0, 0, 7),
(24, 'update', '更新链接', 1, 0, 0, 8),
(25, 'delete', '删除管理员分组', 1, 0, 0, 1),
(26, 'delete', '删除管理员', 1, 0, 0, 2),
(27, 'delete', '删除分类', 1, 0, 0, 3),
(28, 'delete', '删除元数据', 1, 0, 0, 4),
(29, 'delete', '删除文章', 1, 0, 0, 5),
(30, 'delete', '删除单页', 1, 0, 0, 6),
(31, 'delete', '删除留言', 1, 0, 0, 7),
(32, 'delete', '删除链接', 1, 0, 0, 8);


CREATE TABLE IF NOT EXISTS `ms_role_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ms_role_nav` (`id`, `name`, `is_delete`, `is_effect`, `sort`) VALUES
(1, '首页', 0, 1, 1),
(2, '分类管理', 0, 1, 2),
(3, '元数据管理', 0, 1, 3),
(4, '文章管理', 0, 1, 4),
(5, '单页管理', 0, 1, 5),
(6, '用户管理', 0, 1, 6),
(7, '留言管理', 0, 1, 7),
(8, '链接管理', 0, 1, 8),
(9, '系统设置', 0, 1, 9);

/*user 会员*/
CREATE TABLE IF NOT EXISTS `ms_user` (
  	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`avatar` varchar(255) DEFAULT NULL COMMENT '头像',
	`email` varchar(100) DEFAULT NULL,	
	`login_ip` varchar(20) DEFAULT NULL,
	`create_at` varchar(20) DEFAULT '0',
	`update_at` varchar(20) DEFAULT '0',
	`is_delete` tinyint(1) DEFAULT '0' COMMENT '0:正常 1:删除',
	`is_effect` tinyint(1) DEFAULT '1' COMMENT '0:禁止登陆 1:正常',
	`type` tinyint(1) DEFAULT '0' COMMENT '0: 普通会员，1： 可以上传，直播的用户',
	`description` text COMMENT '个人简介',
	`open_id` tinyint(1) DEFAULT '0' COMMENT '0:正常 1: 来自微信 2: 来自QQ 3:来自其他',
	 PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*course 课程*/
CREATE TABLE IF NOT EXISTS `ms_course` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`pid` int(11) DEFAULT NULL COMMENT '父级课程 0:顶级',
	`title` varchar(255) DEFAULT NULL COMMENT '课程标题',
	`link` varchar(255) DEFAULT NULL COMMENT '课程直播或者点播分配地址',
	`time` varchar(11) DEFAULT '0' COMMENT '课程总时长',
	`create_at` varchar(11) DEFAULT '0',
	`update_at` varchar(11) DEFAULT '0',
	`content` text COMMENT '课程或者章节简介',
	`cate_id` int(11) DEFAULT NULL COMMENT'分类',
	`user_id` int(11) DEFAULT NULL COMMENT '对应的编辑者',
	`status` tinyint(1) DEFAULT '0' COMMENT '课程状态 0：审批中，1：直播中，2：可点播',
	`type` tinyint(1) DEFAULT '1' COMMENT '课程类型 1:普通,2:置顶,3:热门,4:推荐',
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*category 分类，包括了课程，文章等*/
CREATE TABLE IF NOT EXISTS `ms_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '父分类ID',
  `name` varchar(20) DEFAULT NULL COMMENT '分类别名',
  `title` varchar(100) DEFAULT NULL COMMENT '分类标题',
  `keywords` varchar(255) DEFAULT NULL COMMENT '分类关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '分类描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*live 直播*/
CREATE TABLE IF NOT EXISTS `ms_live` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(50) DEFAULT NULL COMMENT '直播名字',
	`user_id` int(11) DEFAULT NULL COMMENT '直播用户名',
	`cate_id` int(11) DEFAULT NULL COMMENT '分类',
	`status` tinyint(1) DEFAULT '0' COMMENT '直播状态 0：审批中，1：直播中，2：直播完成，并需要将完成的流媒体存入课程列表',
	 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*文章列表*/	
CREATE TABLE `ms_post` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) DEFAULT NULL,
	`content` text,
	`time` varchar(20) DEFAULT '0',
	`cate_id` int(11) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`type` tinyint(1) DEFAULT '1' COMMENT '1:普通,2:置顶,3:热门,4:推荐',
	PRIMARY KEY (`id`),
	KEY `cate_id` (`cate_id`),
	KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*留言列表*/	
CREATE TABLE `ms_comments` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`comments` text,
	`comments_links` varchar(255) DEFAULT NULL,
	`time` varchar(20) DEFAULT '0',
	`course_id` int(11) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`type` tinyint(1) DEFAULT '1' COMMENT '1:文本,2:语音',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
