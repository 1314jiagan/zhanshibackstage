/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50529
Source Host           : localhost:3306
Source Database       : kangcunshi

Target Server Type    : MYSQL
Target Server Version : 50529
File Encoding         : 65001

Date: 2020-06-30 15:33:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sortclass`
-- ----------------------------
DROP TABLE IF EXISTS `sortclass`;
CREATE TABLE `sortclass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sortname` varchar(25) NOT NULL COMMENT '类别名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID: 第一级的话为0',
  `sortpath` varchar(50) DEFAULT NULL COMMENT '类别路径, 从顶级到当前级, 方便类别模糊查询',
  `level` tinyint(4) DEFAULT '0' COMMENT '级别:　第一级为０',
  `orders` smallint(6) DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sortclass
-- ----------------------------
INSERT INTO `sortclass` VALUES ('1', '信息分类', '0', '0,1,', '0', '1');
INSERT INTO `sortclass` VALUES ('2', '新闻分类', '1', '0,1,2,', '1', '4');
INSERT INTO `sortclass` VALUES ('3', '关于我们', '1', '0,1,3,', '1', '3');
INSERT INTO `sortclass` VALUES ('4', '产品类别', '1', '0,1,4,', '1', '2');
INSERT INTO `sortclass` VALUES ('5', '葡萄', '4', '0,1,4,5,', '2', '2');
INSERT INTO `sortclass` VALUES ('6', '苹果', '4', '0,1,4,6,', '2', '1');
INSERT INTO `sortclass` VALUES ('7', '联系我们', '3', '0,1,3,7,', '2', '3');
INSERT INTO `sortclass` VALUES ('8', '公司荣誉', '3', '0,1,3,8,', '2', '2');
INSERT INTO `sortclass` VALUES ('9', '企业文化', '3', '0,1,3,9,', '2', '1');
INSERT INTO `sortclass` VALUES ('10', '行业动态', '2', '0,1,2,10,', '2', '2');
INSERT INTO `sortclass` VALUES ('11', '企业新闻', '2', '0,1,2,11,', '2', '1');
INSERT INTO `sortclass` VALUES ('12', '地区分类', '1', '0,1,12,', '1', '1');
INSERT INTO `sortclass` VALUES ('13', '江西省', '12', '0,1,12,13,', '2', '2');
INSERT INTO `sortclass` VALUES ('14', '江苏省', '12', '0,1,12,14,', '2', '1');
INSERT INTO `sortclass` VALUES ('15', '南昌', '13', '0,1,12,13,15,', '3', '2');
INSERT INTO `sortclass` VALUES ('16', '赣州', '13', '0,1,12,13,16,', '3', '1');
INSERT INTO `sortclass` VALUES ('17', '青山湖区', '15', '0,1,12,13,15,17,', '4', '2');
INSERT INTO `sortclass` VALUES ('18', '高新区', '15', '0,1,12,13,15,18,', '4', '1');
