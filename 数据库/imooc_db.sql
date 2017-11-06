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
use course;
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
DROP TABLE IF EXISTS `imooc_user`;
CREATE TABLE `imooc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'username',
  `password` char(32) DEFAULT NULL COMMENT '',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'username',

  -- `bookType` int(11) NOT NULL COMMENT '图书所在类别',
  -- `price` float NOT NULL COMMENT '图书价格',
  -- `count` int(11) NOT NULL COMMENT '库存',
  -- `publish` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '出版社',
  -- `publishDate` datetime DEFAULT NULL,
  -- `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '图书图片',
  PRIMARY KEY (`id`)
  -- KEY `bookType` (`bookType`),
  -- CONSTRAINT `t_book_ibfk_1` FOREIGN KEY (`bookType`) REFERENCES `t_bookclass` (`bookClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_book
-- ----------------------------
INSERT INTO `imooc_user` VALUES ('1', 'zhangxiaoyun', '789256', 'zxy_7981@qq.com');
-- INSERT INTO `t_book` VALUES ('112', 'php程序设计', '7', '36', '18', '电子科技大学出版社', '2008-01-16 00:00:00', '../upload/2013/07/01844900.jpg');
-- INSERT INTO `t_book` VALUES ('113', '安卓程序设计', '7', '13.5', '12', '理工大学出版社', '2009-05-20 00:00:00', '../upload/2013/07/37044500.jpg');
-- INSERT INTO `t_book` VALUES ('114', 'asp程序设计', '7', '35', '19', '理工大学', '2013-07-17 00:00:00', '../upload/2013/07/19957400.jpg');
-- INSERT INTO `t_book` VALUES ('115', '中国近代史', '5', '28', '25', '四川大学出版社', '2013-07-09 00:00:00', '../upload/2013/07/79494300.jpg');
-- INSERT INTO `t_book` VALUES ('116', '中国古代史', '5', '40', '18', '电子科技大学', '2013-07-02 00:00:00', '../upload/2013/07/15688400.jpg');
-- INSERT INTO `t_book` VALUES ('119', 'ceshi', '5', '12.5', '12', 'fafafa', '2013-07-01 00:00:00', '../upload/NoImage.jpg');

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
