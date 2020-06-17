/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : comp_manage

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2020-06-11 14:24:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_comp_in
-- ----------------------------
DROP TABLE IF EXISTS `tb_comp_in`;
CREATE TABLE `tb_comp_in` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) DEFAULT NULL,
  `innum` int(11) DEFAULT NULL,
  `remain` int(11) DEFAULT NULL,
  `user` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `manageer` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_comp_in
-- ----------------------------
INSERT INTO `tb_comp_in` VALUES ('16', '10', '6', '11', 'xmd', 'xmd', '2020-04-30 11:28:25', '');

-- ----------------------------
-- Table structure for tb_comp_out
-- ----------------------------
DROP TABLE IF EXISTS `tb_comp_out`;
CREATE TABLE `tb_comp_out` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) DEFAULT NULL,
  `outnum` int(11) DEFAULT NULL,
  `remain` int(11) DEFAULT NULL,
  `user` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `manageer` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_comp_out
-- ----------------------------
INSERT INTO `tb_comp_out` VALUES ('35', '10', '2', '9', '', 'xmd', '2020-05-08 13:54:49', '');

-- ----------------------------
-- Table structure for tb_comp_reserve
-- ----------------------------
DROP TABLE IF EXISTS `tb_comp_reserve`;
CREATE TABLE `tb_comp_reserve` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(64) COLLATE utf8_bin NOT NULL COMMENT '元器件类型',
  `name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '元器件名称',
  `standard` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `store_num` int(11) DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `producer` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `producer_linkman` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `project_pact` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comp_pact` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comp_price` double(10,2) DEFAULT NULL,
  `bargain_num` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `certification_num` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_comp_reserve
-- ----------------------------
INSERT INTO `tb_comp_reserve` VALUES ('10', '10', '钽电容', 'CAK45A-H-50V-10UF-K', '9', 'GJB（M）/K', '1', null, '02批', 'G20200405', '35.00', 'CK2019-HT20', 'YZX241491', 'test1');
INSERT INTO `tb_comp_reserve` VALUES ('11', '8', '线缆', 'CAK45A-H-50V-10UF-K', '3', 'GJB(M)/K', '4', null, '02批', 'G20200405', '35.00', 'CK2019-HT2020', 'YZX241491', '123');

-- ----------------------------
-- Table structure for tb_dic_dic
-- ----------------------------
DROP TABLE IF EXISTS `tb_dic_dic`;
CREATE TABLE `tb_dic_dic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_dic_dic
-- ----------------------------
INSERT INTO `tb_dic_dic` VALUES ('1', '生产厂家', '生产厂家名称字典');
INSERT INTO `tb_dic_dic` VALUES ('3', '连接器类型', '');

-- ----------------------------
-- Table structure for tb_dic_manage
-- ----------------------------
DROP TABLE IF EXISTS `tb_dic_manage`;
CREATE TABLE `tb_dic_manage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `value` int(10) DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_dic_manage
-- ----------------------------
INSERT INTO `tb_dic_manage` VALUES ('1', '1', 'ERNI', null, '小明 13071176696');
INSERT INTO `tb_dic_manage` VALUES ('2', '1', '中航光电', null, 'wx 13301010101010');
INSERT INTO `tb_dic_manage` VALUES ('4', '1', '贵州航天', null, '');
INSERT INTO `tb_dic_manage` VALUES ('5', '1', '深圳国徽电子', null, '');
INSERT INTO `tb_dic_manage` VALUES ('6', '1', '772所', null, '');
INSERT INTO `tb_dic_manage` VALUES ('7', '3', '连接器', null, '');
INSERT INTO `tb_dic_manage` VALUES ('8', '3', '线缆', null, '');
INSERT INTO `tb_dic_manage` VALUES ('9', '3', '集成电路', null, '');
INSERT INTO `tb_dic_manage` VALUES ('10', '3', '电容', null, '');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `access` tinyint(3) unsigned DEFAULT NULL COMMENT '管理权限 1超级管理员 2普通管理员',
  `date` datetime DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'wx', '202cb962ac59075b964b07152d234b70', '1', null, null);
INSERT INTO `tb_user` VALUES ('2', 'xmd', '202cb962ac59075b964b07152d234b70', '2', '2020-04-29 12:30:34', '');
