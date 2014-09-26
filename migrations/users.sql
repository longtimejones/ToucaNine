/*
Navicat MySQL Data Transfer

Source Server         : htpc
Source Server Version : 50619
Source Host           : localhost:3306
Source Database       : dummy

Target Server Type    : MYSQL
Target Server Version : 50619
File Encoding         : 65001

Date: 2014-09-26 12:58:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'ToucaNine');
