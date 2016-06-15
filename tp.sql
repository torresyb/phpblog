/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-06-14 09:54:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET gb2312 NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET gb2312 NOT NULL DEFAULT '',
  `lastloginip` varchar(15) CHARACTER SET gb2312 NOT NULL DEFAULT '',
  `lastlogintime` int(10) unsigned zerofill DEFAULT NULL,
  `email` varchar(40) CHARACTER SET gb2312 DEFAULT '',
  `realname` varchar(50) CHARACTER SET gb2312 NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned zerofill NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('6', 'admin', '0f442da608ef0a9f1515d8f47d0bf990', '', null, '', '', '1');

-- ----------------------------
-- Table structure for tp_form
-- ----------------------------
DROP TABLE IF EXISTS `tp_form`;
CREATE TABLE `tp_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `createtime` int(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of tp_form
-- ----------------------------
INSERT INTO `tp_form` VALUES ('1', '3223', 'dsfddd', '00000000000');
INSERT INTO `tp_form` VALUES ('2', '', 'sddd', '00000000000');
INSERT INTO `tp_form` VALUES ('3', '', '54454554', '00000000000');
INSERT INTO `tp_form` VALUES ('4', '2332233', '好好的人啊啊啊啊ssssss', '01464953577');

-- ----------------------------
-- Table structure for tp_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_menu`;
CREATE TABLE `tp_menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) unsigned zerofill NOT NULL,
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` tinyint(1) unsigned zerofill NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`f`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_menu
-- ----------------------------
INSERT INTO `tp_menu` VALUES ('1', '显示菜单', '000000', 'admin', 'menu', 'showmenu', '0', '-1', '1');
INSERT INTO `tp_menu` VALUES ('2', '这是一个菜单', '000000', 'admin', 'menu', 'showtest', '0', '-1', '0');
INSERT INTO `tp_menu` VALUES ('3', '测试数据1', '000000', 'admin', 'page', 'index', '0', '-1', '1');
INSERT INTO `tp_menu` VALUES ('4', '测试数据2', '000000', 'admin', 'page', 'index', '0', '-1', '0');
INSERT INTO `tp_menu` VALUES ('5', '测试数据3', '000000', 'admin', 'page', 'index', '1', '-1', '0');
INSERT INTO `tp_menu` VALUES ('6', '测试数据4', '000000', 'admin', 'page', 'index', '2', '-1', '1');
INSERT INTO `tp_menu` VALUES ('7', '测试数据5', '000000', 'admin', 'page', 'index', '3', '-1', '1');
INSERT INTO `tp_menu` VALUES ('8', '这是一个菜单new', '000000', 'admin', 'menu', 'showtest', '2', '-1', '0');
INSERT INTO `tp_menu` VALUES ('9', '编辑菜单', '000000', 'admin', 'menus', 'index', '11', '-1', '0');
INSERT INTO `tp_menu` VALUES ('10', '编辑菜单new11', '000000', 'admin', 'menus', 'index', '10', '-1', '1');
INSERT INTO `tp_menu` VALUES ('16', '添加菜单16new', '000000', 'index', 'menu', 'add', '0', '-1', '0');
INSERT INTO `tp_menu` VALUES ('17', '删除菜单', '000000', 'admin', 'index', 'deleted', '0', '-1', '1');
INSERT INTO `tp_menu` VALUES ('18', '文章管理', '000000', 'admin', 'content', 'index', '2', '1', '1');
INSERT INTO `tp_menu` VALUES ('19', '菜单管理', '000000', 'admin', 'menu', 'index', '1', '1', '1');
INSERT INTO `tp_menu` VALUES ('20', '用户管理', '000000', 'admin', 'admin', 'index', '3', '1', '1');

-- ----------------------------
-- Table structure for tp_news
-- ----------------------------
DROP TABLE IF EXISTS `tp_news`;
CREATE TABLE `tp_news` (
  `news_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned zerofill NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(30) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) NOT NULL COMMENT '标题颜色',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL COMMENT '文章描述',
  `listorder` tinyint(3) unsigned zerofill NOT NULL,
  `status` tinyint(1) unsigned zerofill NOT NULL,
  `copyfrom` varchar(250) NOT NULL COMMENT '来源',
  `username` varchar(20) NOT NULL,
  `create_time` int(10) unsigned zerofill NOT NULL,
  `update_time` int(10) unsigned zerofill NOT NULL,
  `count` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `listorder` (`listorder`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_news
-- ----------------------------

-- ----------------------------
-- Table structure for tp_news_content
-- ----------------------------
DROP TABLE IF EXISTS `tp_news_content`;
CREATE TABLE `tp_news_content` (
  `id` int(11) unsigned NOT NULL,
  `news_id` mediumint(8) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) unsigned zerofill NOT NULL,
  `update_time` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_news_content
-- ----------------------------

-- ----------------------------
-- Table structure for tp_position
-- ----------------------------
DROP TABLE IF EXISTS `tp_position`;
CREATE TABLE `tp_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned zerofill NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_time` int(10) unsigned zerofill NOT NULL,
  `update_time` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_position
-- ----------------------------

-- ----------------------------
-- Table structure for tp_position_content
-- ----------------------------
DROP TABLE IF EXISTS `tp_position_content`;
CREATE TABLE `tp_position_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(5) unsigned NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `news_id` int(8) unsigned NOT NULL,
  `listorder` tinyint(3) unsigned zerofill NOT NULL,
  `status` tinyint(1) unsigned zerofill NOT NULL,
  `create_time` int(10) unsigned zerofill NOT NULL,
  `update_time` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_position_content
-- ----------------------------
