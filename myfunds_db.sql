/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50129
Source Host           : localhost:3306
Source Database       : phpsystem_db

Target Server Type    : MYSQL
Target Server Version : 50129
File Encoding         : 65001

Date: 2016-10-24 20:59
*/
use myfunds;
SET FOREIGN_KEY_CHECKS=0;

-- -- ----------------------------
-- -- Table structure for `t_admin`
-- -- ----------------------------
-- DROP TABLE IF EXISTS `t_admin`;
-- CREATE TABLE `t_admin` (
--   `username` varchar(20) NOT NULL DEFAULT '',
--   `password` varchar(32) DEFAULT NULL,
--   PRIMARY KEY (`username`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_admin
-- -- ----------------------------
-- INSERT INTO `t_admin` VALUES ('admin2', '123');


-- ----------------------------
-- Table structure for `t_book`
-- ----------------------------
DROP TABLE IF EXISTS `myfunds_expense`;
CREATE TABLE `myfunds_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
   `transactionType` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '交易类型',
  `date` datetime DEFAULT NULL COMMENT '交易时期',
  `category` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '分类',
  `subCategory` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '子分类',
  `accountOut` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '账户1',

  `accountIn` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '账户2',
  `project` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '项目',
  `member` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '成员',
  `merchant` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '商户',
  `sum` float NOT NULL COMMENT '金额',
  `notes` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '附注',

  -- `bookType` int(11) NOT NULL COMMENT '图书所在类别',
  -- `count` int(11) NOT NULL COMMENT '库存',
  -- `publish` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '出版社',
  -- `publishDate` datetime DEFAULT NULL,
  -- `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '图书图片',
  PRIMARY KEY (`id`)
  -- KEY `bookType` (`bookType`),
  -- CONSTRAINT `t_book_ibfk_1` FOREIGN KEY (`bookType`) REFERENCES `t_bookclass` (`bookClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_book
-- -- ----------------------------
-- INSERT INTO `myfunds_expense` VALUES ('1', '支出', '2017-10-30 23:22:14', '金融保险', '基金/股票历史亏损', '财通可持续组合', '', '基金股票浮动/历史亏损', '', '', '12.91', '我是附注');



-- ----------------------------
-- Table structure for `t_book`
-- ----------------------------
DROP TABLE IF EXISTS `myfunds_income`;
CREATE TABLE `myfunds_income` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
   `transactionType` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '交易类型',
  `date` datetime DEFAULT NULL COMMENT '交易时期',
  `category` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '分类',
  `subCategory` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '子分类',
  `accountOut` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '账户1',

  `accountIn` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '账户2',
  `project` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '项目',
  `member` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '成员',
  `merchant` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '商户',
  `sum` float NOT NULL COMMENT '金额',
  `notes` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '附注',

  -- `bookType` int(11) NOT NULL COMMENT '图书所在类别',
  -- `count` int(11) NOT NULL COMMENT '库存',
  -- `publish` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '出版社',
  -- `publishDate` datetime DEFAULT NULL,
  -- `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '图书图片',
  PRIMARY KEY (`id`)
  -- KEY `bookType` (`bookType`),
  -- CONSTRAINT `t_book_ibfk_1` FOREIGN KEY (`bookType`) REFERENCES `t_bookclass` (`bookClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_book
-- -- ----------------------------
-- INSERT INTO `myfunds_income` VALUES ('1', '收入', '2017-10-30 23:22:14', '金融保险', '基金/股票历史亏损', '财通可持续组合', '', '基金股票浮动/历史亏损', '', '', '12.91', '我是附注');


-- ----------------------------
-- Table structure for `t_book`
-- ----------------------------
DROP TABLE IF EXISTS `myfunds_transfer`;
CREATE TABLE `myfunds_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
   `transactionType` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '交易类型',
  `date` datetime DEFAULT NULL COMMENT '交易时期',
  `category` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '分类',
  `subCategory` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '子分类',
  `accountOut` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '账户1',

  `accountIn` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '账户2',
  `project` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '项目',
  `member` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '成员',
  `merchant` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '商户',
  `sum` float NOT NULL COMMENT '金额',
  `notes` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '附注',

  -- `bookType` int(11) NOT NULL COMMENT '图书所在类别',
  -- `count` int(11) NOT NULL COMMENT '库存',
  -- `publish` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '出版社',
  -- `publishDate` datetime DEFAULT NULL,
  -- `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '图书图片',
  PRIMARY KEY (`id`)
  -- KEY `bookType` (`bookType`),
  -- CONSTRAINT `t_book_ibfk_1` FOREIGN KEY (`bookType`) REFERENCES `t_bookclass` (`bookClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_book
-- -- ----------------------------
-- INSERT INTO `myfunds_income` VALUES ('1', '收入', '2017-10-30 23:22:14', '金融保险', '基金/股票历史亏损', '财通可持续组合', '', '基金股票浮动/历史亏损', '', '', '12.91', '我是附注');




-- -- ----------------------------
-- -- Table structure for `t_bookclass`
-- -- ----------------------------
-- DROP TABLE IF EXISTS `t_bookclass`;
-- CREATE TABLE `t_bookclass` (
--   `bookClassId` int(11) NOT NULL AUTO_INCREMENT,
--   -- `bookClassName` varchar(50) DEFAULT NULL,
--   `bookClassName` varchar(100) DEFAULT NULL,
--   PRIMARY KEY (`bookClassId`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- -- ----------------------------
-- -- Records of t_bookclass
-- -- ----------------------------
-- INSERT INTO `t_bookclass` VALUES ('5', '历史类');
-- INSERT INTO `t_bookclass` VALUES ('7', '计算机');
-- INSERT INTO `t_bookclass` VALUES ('25', '地理类');
