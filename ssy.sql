/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : ssy

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-12-07 13:02:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yb_admin
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin`;
CREATE TABLE `yb_admin` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `roleid` int(11) NOT NULL,
  `realname` varchar(25) DEFAULT NULL,
  `lastloginip` varchar(25) DEFAULT NULL,
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `encrypt` varchar(10) NOT NULL COMMENT '加密字符串',
  `email` varchar(50) DEFAULT NULL,
  `siteid` int(5) DEFAULT '1' COMMENT '默认的站点ID',
  PRIMARY KEY (`userid`),
  KEY `roleid` (`roleid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='utf8_general_ci';

-- ----------------------------
-- Records of yb_admin
-- ----------------------------
INSERT INTO `yb_admin` VALUES ('1', 'admin', '93834f3e74dfc42b65694ac83184a018', '1', '高峰', '192.168.1.100', '1449450344', 'GP1KnL', '592472116@qq.com', '1');
INSERT INTO `yb_admin` VALUES ('9', 'pan', 'd141a43ddebf2cc926f70f92b579e65d', '11', '小号', '192.168.1.100', '1447913819', '13kypi', '592472116@qq.com', '1');

-- ----------------------------
-- Table structure for yb_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_menu`;
CREATE TABLE `yb_admin_menu` (
  `menuid` int(5) NOT NULL AUTO_INCREMENT,
  `action` varchar(125) DEFAULT NULL COMMENT '行为',
  `parentmenuid` int(5) DEFAULT '0' COMMENT '上级菜单ID',
  `menuname` varchar(20) NOT NULL COMMENT '菜单名称',
  `markname` varchar(25) NOT NULL COMMENT '标识',
  `is_index` tinyint(1) DEFAULT '0' COMMENT '默认显示的homepage',
  `listorder` int(5) DEFAULT '0',
  `getArray` varchar(512) DEFAULT NULL,
  `icoClass` varchar(52) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`menuid`),
  KEY `parentmenuid` (`parentmenuid`)
) ENGINE=MyISAM AUTO_INCREMENT=1013 DEFAULT CHARSET=utf8 COMMENT='后台菜单';

-- ----------------------------
-- Records of yb_admin_menu
-- ----------------------------
INSERT INTO `yb_admin_menu` VALUES ('1', '', '0', '我的面板', 'index', '0', '0', null, 'fa fa-home', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('2', '', '0', '内容管理', 'content', '0', '0', null, 'fa fa-list-alt', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('3', null, '0', '管理员设置', 'index', '0', '0', null, 'fa fa-user-secret', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('4', null, '0', '更新缓存', 'index', '0', '0', null, 'fa fa-hdd-o', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('22', 'Content/page/chose_model', '2', '添加单网页', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('6', 'Index/station', '1', '站点详情', 'index', '1', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('7', 'Index/role', '3', '角色管理', 'index', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('8', 'Index/admin_manage', '3', '管理员管理', 'index', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('9', null, '0', '数据模型管理', 'content', '0', '0', null, 'fa fa-object-group', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('10', 'Index/website_setting', '1', '站点设置', 'index', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('11', 'Index/flush_cache/view_c', '4', '更新模板缓存', 'index', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('12', 'Index/flush_cache/db', '4', '更新数据库缓存', 'index', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('13', 'Index/flush_cache/all', '4', '更新全站缓存', 'index', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('14', 'Module/manage', '9', '模型管理', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('18', 'Content/category/manage', '2', '栏目管理', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('17', 'Content/category/add', '2', '添加栏目', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('15', 'Content/content/manage', '2', '管理内容', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('19', '', '0', '用户管理', 'member', '0', '0', null, 'fa fa-users', null, '1');
INSERT INTO `yb_admin_menu` VALUES ('20', 'Member/group', '19', '用户组管理', 'member', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('21', 'Member/manage', '19', '用户管理', 'member', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('23', null, '0', '拓展管理', 'package', '0', '0', null, 'fa fa-plug', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('24', 'Package/install', '23', '安装拓展', 'package', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('16', 'Content/content/add', '2', '添加内容', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('101', null, '0', '表单管理', 'content', '0', '0', null, 'fa fa-table', null, '0');
INSERT INTO `yb_admin_menu` VALUES ('102', 'Form/setting/add', '101', '添加自定义表单', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('114', 'Form/manage', '101', '申请音浪加盟代理', 'content', '0', '0', 'a:1:{s:6:\"formid\";s:2:\"10\";}', null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('107', 'Form/setting', '101', '自定义表单管理', 'content', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('112', 'Package/run/editor', '23', '模板管理', 'package', '0', '0', null, null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('113', 'Form/manage', '101', '申请全国联采', 'content', '0', '0', 'a:1:{s:6:\"formid\";s:1:\"9\";}', null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('115', 'Form/manage', '101', '申请音浪金牌网吧', 'content', '0', '0', 'a:1:{s:6:\"formid\";s:2:\"11\";}', null, 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('119', null, '0', '系统设置', 'website', '0', '0', null, 'fa fa-gears', null, '1');
INSERT INTO `yb_admin_menu` VALUES ('118', 'Content/attach', '2', '附件管理', 'content', '0', '0', null, 'fa fa-file', 'second', '0');
INSERT INTO `yb_admin_menu` VALUES ('121', 'Index/website_manage', '119', '站点管理', 'website', '0', '0', null, 'fa fa-sitemap', 'second', '1');
INSERT INTO `yb_admin_menu` VALUES ('1012', 'Content/tags', '2', '标签管理', 'content', '0', '0', null, 'fa fa-tags', 'second', '1');

-- ----------------------------
-- Table structure for yb_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_role`;
CREATE TABLE `yb_admin_role` (
  `roleid` int(10) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `disabled` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';

-- ----------------------------
-- Records of yb_admin_role
-- ----------------------------
INSERT INTO `yb_admin_role` VALUES ('11', '管理员', '啊啊啊啊啊啊啊啊啊啊', '0');
INSERT INTO `yb_admin_role` VALUES ('1', '超级管理员', '超级管理员，不可以删除，不可以更改权限。', '0');

-- ----------------------------
-- Table structure for yb_admin_role_priv
-- ----------------------------
DROP TABLE IF EXISTS `yb_admin_role_priv`;
CREATE TABLE `yb_admin_role_priv` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `roleid` int(5) NOT NULL,
  `menuid` int(5) NOT NULL,
  `get` longtext,
  `siteid` int(5) DEFAULT '1' COMMENT '站点ID',
  PRIMARY KEY (`id`),
  KEY `roleid` (`roleid`)
) ENGINE=MyISAM AUTO_INCREMENT=718 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';

-- ----------------------------
-- Records of yb_admin_role_priv
-- ----------------------------
INSERT INTO `yb_admin_role_priv` VALUES ('534', '8', '106', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('533', '8', '105', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('532', '8', '104', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('531', '8', '103', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('530', '8', '13', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('529', '8', '12', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('528', '8', '11', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('527', '8', '4', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('526', '8', '16', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('525', '8', '15', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('524', '8', '17', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('523', '8', '18', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('522', '8', '22', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('521', '8', '2', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('520', '8', '10', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('519', '8', '6', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('518', '8', '1', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('716', '11', '119', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('715', '11', '115', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('714', '11', '113', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('713', '11', '107', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('712', '11', '114', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('711', '11', '102', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('710', '11', '101', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('709', '11', '112', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('708', '11', '24', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('707', '11', '23', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('706', '11', '1011', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('705', '11', '21', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('704', '11', '20', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('703', '11', '19', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('702', '11', '14', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('701', '11', '9', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('700', '11', '13', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('699', '11', '12', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('698', '11', '11', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('697', '11', '4', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('696', '11', '8', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('695', '11', '7', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('694', '11', '3', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('693', '11', '118', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('692', '11', '16', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('691', '11', '15', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('690', '11', '17', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('689', '11', '18', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('688', '11', '22', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('687', '11', '2', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('686', '11', '10', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('685', '11', '6', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('684', '11', '1', null, '1');
INSERT INTO `yb_admin_role_priv` VALUES ('717', '11', '121', null, '1');

-- ----------------------------
-- Table structure for yb_area_city
-- ----------------------------
DROP TABLE IF EXISTS `yb_area_city`;
CREATE TABLE `yb_area_city` (
  `cityid` int(3) NOT NULL COMMENT '城市id',
  `cityname` varchar(15) NOT NULL COMMENT '城市名称',
  `provinceid` int(2) NOT NULL COMMENT '省份id',
  `districtid` int(4) NOT NULL COMMENT '地区id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_area_city
-- ----------------------------
INSERT INTO `yb_area_city` VALUES ('1', '北京市', '1', '1');
INSERT INTO `yb_area_city` VALUES ('2', '天津市', '2', '2');
INSERT INTO `yb_area_city` VALUES ('3', '上海市', '9', '3');
INSERT INTO `yb_area_city` VALUES ('4', '重庆市', '27', '4');
INSERT INTO `yb_area_city` VALUES ('5', '邯郸市', '3', '5');
INSERT INTO `yb_area_city` VALUES ('6', '石家庄市', '3', '6');
INSERT INTO `yb_area_city` VALUES ('7', '保定市', '3', '7');
INSERT INTO `yb_area_city` VALUES ('8', '张家口市', '3', '8');
INSERT INTO `yb_area_city` VALUES ('9', '承德市', '3', '9');
INSERT INTO `yb_area_city` VALUES ('10', '唐山市', '3', '10');
INSERT INTO `yb_area_city` VALUES ('11', '廊坊市', '3', '11');
INSERT INTO `yb_area_city` VALUES ('12', '沧州市', '3', '12');
INSERT INTO `yb_area_city` VALUES ('13', '衡水市', '3', '13');
INSERT INTO `yb_area_city` VALUES ('14', '邢台市', '3', '14');
INSERT INTO `yb_area_city` VALUES ('15', '秦皇岛市', '3', '15');
INSERT INTO `yb_area_city` VALUES ('16', '朔州市', '4', '16');
INSERT INTO `yb_area_city` VALUES ('17', '忻州市', '4', '17');
INSERT INTO `yb_area_city` VALUES ('18', '太原市', '4', '18');
INSERT INTO `yb_area_city` VALUES ('19', '大同市', '4', '19');
INSERT INTO `yb_area_city` VALUES ('20', '阳泉市', '4', '20');
INSERT INTO `yb_area_city` VALUES ('21', '晋中市', '4', '21');
INSERT INTO `yb_area_city` VALUES ('22', '长治市', '4', '22');
INSERT INTO `yb_area_city` VALUES ('23', '晋城市', '4', '23');
INSERT INTO `yb_area_city` VALUES ('24', '临汾市', '4', '24');
INSERT INTO `yb_area_city` VALUES ('25', '吕梁市', '4', '25');
INSERT INTO `yb_area_city` VALUES ('26', '运城市', '4', '26');
INSERT INTO `yb_area_city` VALUES ('27', '沈阳市', '6', '27');
INSERT INTO `yb_area_city` VALUES ('28', '铁岭市', '6', '28');
INSERT INTO `yb_area_city` VALUES ('29', '大连市', '6', '29');
INSERT INTO `yb_area_city` VALUES ('30', '鞍山市', '6', '30');
INSERT INTO `yb_area_city` VALUES ('31', '抚顺市', '6', '31');
INSERT INTO `yb_area_city` VALUES ('32', '本溪市', '6', '32');
INSERT INTO `yb_area_city` VALUES ('33', '丹东市', '6', '33');
INSERT INTO `yb_area_city` VALUES ('34', '锦州市', '6', '34');
INSERT INTO `yb_area_city` VALUES ('35', '营口市', '6', '35');
INSERT INTO `yb_area_city` VALUES ('36', '阜新市', '6', '36');
INSERT INTO `yb_area_city` VALUES ('37', '辽阳市', '6', '37');
INSERT INTO `yb_area_city` VALUES ('38', '朝阳市', '6', '38');
INSERT INTO `yb_area_city` VALUES ('39', '盘锦市', '6', '39');
INSERT INTO `yb_area_city` VALUES ('40', '葫芦岛市', '6', '40');
INSERT INTO `yb_area_city` VALUES ('41', '长春市', '7', '41');
INSERT INTO `yb_area_city` VALUES ('42', '吉林市', '7', '42');
INSERT INTO `yb_area_city` VALUES ('43', '延边朝鲜族自治州', '7', '43');
INSERT INTO `yb_area_city` VALUES ('44', '四平市', '7', '44');
INSERT INTO `yb_area_city` VALUES ('45', '通化市', '7', '45');
INSERT INTO `yb_area_city` VALUES ('46', '白城市', '7', '46');
INSERT INTO `yb_area_city` VALUES ('47', '辽源市', '7', '47');
INSERT INTO `yb_area_city` VALUES ('48', '松原市', '7', '48');
INSERT INTO `yb_area_city` VALUES ('49', '白山市', '7', '49');
INSERT INTO `yb_area_city` VALUES ('50', '哈尔滨市', '8', '50');
INSERT INTO `yb_area_city` VALUES ('51', '齐齐哈尔市', '8', '51');
INSERT INTO `yb_area_city` VALUES ('52', '鸡西市', '8', '52');
INSERT INTO `yb_area_city` VALUES ('53', '牡丹江市', '8', '53');
INSERT INTO `yb_area_city` VALUES ('54', '七台河市', '8', '54');
INSERT INTO `yb_area_city` VALUES ('55', '佳木斯市', '8', '55');
INSERT INTO `yb_area_city` VALUES ('56', '鹤岗市', '8', '56');
INSERT INTO `yb_area_city` VALUES ('57', '双鸭山市', '8', '57');
INSERT INTO `yb_area_city` VALUES ('58', '绥化市', '8', '58');
INSERT INTO `yb_area_city` VALUES ('59', '黑河市', '8', '59');
INSERT INTO `yb_area_city` VALUES ('60', '大兴安岭地区', '8', '60');
INSERT INTO `yb_area_city` VALUES ('61', '伊春市', '8', '61');
INSERT INTO `yb_area_city` VALUES ('62', '大庆市', '8', '62');
INSERT INTO `yb_area_city` VALUES ('63', '南京市', '10', '63');
INSERT INTO `yb_area_city` VALUES ('64', '无锡市', '10', '64');
INSERT INTO `yb_area_city` VALUES ('65', '镇江市', '10', '65');
INSERT INTO `yb_area_city` VALUES ('66', '苏州市', '10', '66');
INSERT INTO `yb_area_city` VALUES ('67', '南通市', '10', '67');
INSERT INTO `yb_area_city` VALUES ('68', '扬州市', '10', '68');
INSERT INTO `yb_area_city` VALUES ('69', '盐城市', '10', '69');
INSERT INTO `yb_area_city` VALUES ('70', '徐州市', '10', '70');
INSERT INTO `yb_area_city` VALUES ('71', '淮安市', '10', '71');
INSERT INTO `yb_area_city` VALUES ('72', '连云港市', '10', '72');
INSERT INTO `yb_area_city` VALUES ('73', '常州市', '10', '73');
INSERT INTO `yb_area_city` VALUES ('74', '泰州市', '10', '74');
INSERT INTO `yb_area_city` VALUES ('75', '宿迁市', '10', '75');
INSERT INTO `yb_area_city` VALUES ('76', '舟山市', '11', '76');
INSERT INTO `yb_area_city` VALUES ('77', '衢州市', '11', '77');
INSERT INTO `yb_area_city` VALUES ('78', '杭州市', '11', '78');
INSERT INTO `yb_area_city` VALUES ('79', '湖州市', '11', '79');
INSERT INTO `yb_area_city` VALUES ('80', '嘉兴市', '11', '80');
INSERT INTO `yb_area_city` VALUES ('81', '宁波市', '11', '81');
INSERT INTO `yb_area_city` VALUES ('82', '绍兴市', '11', '82');
INSERT INTO `yb_area_city` VALUES ('83', '温州市', '11', '83');
INSERT INTO `yb_area_city` VALUES ('84', '丽水市', '11', '84');
INSERT INTO `yb_area_city` VALUES ('85', '金华市', '11', '85');
INSERT INTO `yb_area_city` VALUES ('86', '台州市', '11', '86');
INSERT INTO `yb_area_city` VALUES ('87', '合肥市', '12', '87');
INSERT INTO `yb_area_city` VALUES ('88', '芜湖市', '12', '88');
INSERT INTO `yb_area_city` VALUES ('89', '蚌埠市', '12', '89');
INSERT INTO `yb_area_city` VALUES ('90', '淮南市', '12', '90');
INSERT INTO `yb_area_city` VALUES ('91', '马鞍山市', '12', '91');
INSERT INTO `yb_area_city` VALUES ('92', '淮北市', '12', '92');
INSERT INTO `yb_area_city` VALUES ('93', '铜陵市', '12', '93');
INSERT INTO `yb_area_city` VALUES ('94', '安庆市', '12', '94');
INSERT INTO `yb_area_city` VALUES ('95', '黄山市', '12', '95');
INSERT INTO `yb_area_city` VALUES ('96', '滁州市', '12', '96');
INSERT INTO `yb_area_city` VALUES ('97', '阜阳市', '12', '97');
INSERT INTO `yb_area_city` VALUES ('98', '宿州市', '12', '98');
INSERT INTO `yb_area_city` VALUES ('99', '巢湖市', '12', '99');
INSERT INTO `yb_area_city` VALUES ('100', '六安市', '12', '100');
INSERT INTO `yb_area_city` VALUES ('101', '亳州市', '12', '101');
INSERT INTO `yb_area_city` VALUES ('102', '池州市', '12', '102');
INSERT INTO `yb_area_city` VALUES ('103', '宣城市', '12', '103');
INSERT INTO `yb_area_city` VALUES ('104', '福州市', '13', '104');
INSERT INTO `yb_area_city` VALUES ('105', '厦门市', '13', '105');
INSERT INTO `yb_area_city` VALUES ('106', '宁德市', '13', '106');
INSERT INTO `yb_area_city` VALUES ('107', '莆田市', '13', '107');
INSERT INTO `yb_area_city` VALUES ('108', '泉州市', '13', '108');
INSERT INTO `yb_area_city` VALUES ('109', '漳州市', '13', '109');
INSERT INTO `yb_area_city` VALUES ('110', '龙岩市', '13', '110');
INSERT INTO `yb_area_city` VALUES ('111', '三明市', '13', '111');
INSERT INTO `yb_area_city` VALUES ('112', '南平市', '13', '112');
INSERT INTO `yb_area_city` VALUES ('113', '鹰潭市', '14', '113');
INSERT INTO `yb_area_city` VALUES ('114', '新余市', '14', '114');
INSERT INTO `yb_area_city` VALUES ('115', '南昌市', '14', '115');
INSERT INTO `yb_area_city` VALUES ('116', '九江市', '14', '116');
INSERT INTO `yb_area_city` VALUES ('117', '上饶市', '14', '117');
INSERT INTO `yb_area_city` VALUES ('118', '抚州市', '14', '118');
INSERT INTO `yb_area_city` VALUES ('119', '宜春市', '14', '119');
INSERT INTO `yb_area_city` VALUES ('120', '吉安市', '14', '120');
INSERT INTO `yb_area_city` VALUES ('121', '赣州市', '14', '121');
INSERT INTO `yb_area_city` VALUES ('122', '景德镇市', '14', '122');
INSERT INTO `yb_area_city` VALUES ('123', '萍乡市', '14', '123');
INSERT INTO `yb_area_city` VALUES ('124', '菏泽市', '15', '124');
INSERT INTO `yb_area_city` VALUES ('125', '济南市', '15', '125');
INSERT INTO `yb_area_city` VALUES ('126', '青岛市', '15', '126');
INSERT INTO `yb_area_city` VALUES ('127', '淄博市', '15', '127');
INSERT INTO `yb_area_city` VALUES ('128', '德州市', '15', '128');
INSERT INTO `yb_area_city` VALUES ('129', '烟台市', '15', '129');
INSERT INTO `yb_area_city` VALUES ('130', '潍坊市', '15', '130');
INSERT INTO `yb_area_city` VALUES ('131', '济宁市', '15', '131');
INSERT INTO `yb_area_city` VALUES ('132', '泰安市', '15', '132');
INSERT INTO `yb_area_city` VALUES ('133', '临沂市', '15', '133');
INSERT INTO `yb_area_city` VALUES ('134', '滨州市', '15', '134');
INSERT INTO `yb_area_city` VALUES ('135', '东营市', '15', '135');
INSERT INTO `yb_area_city` VALUES ('136', '威海市', '15', '136');
INSERT INTO `yb_area_city` VALUES ('137', '枣庄市', '15', '137');
INSERT INTO `yb_area_city` VALUES ('138', '日照市', '15', '138');
INSERT INTO `yb_area_city` VALUES ('139', '莱芜市', '15', '139');
INSERT INTO `yb_area_city` VALUES ('140', '聊城市', '15', '140');
INSERT INTO `yb_area_city` VALUES ('141', '商丘市', '16', '141');
INSERT INTO `yb_area_city` VALUES ('142', '郑州市', '16', '142');
INSERT INTO `yb_area_city` VALUES ('143', '安阳市', '16', '143');
INSERT INTO `yb_area_city` VALUES ('144', '新乡市', '16', '144');
INSERT INTO `yb_area_city` VALUES ('145', '许昌市', '16', '145');
INSERT INTO `yb_area_city` VALUES ('146', '平顶山市', '16', '146');
INSERT INTO `yb_area_city` VALUES ('147', '信阳市', '16', '147');
INSERT INTO `yb_area_city` VALUES ('148', '南阳市', '16', '148');
INSERT INTO `yb_area_city` VALUES ('149', '开封市', '16', '149');
INSERT INTO `yb_area_city` VALUES ('150', '洛阳市', '16', '150');
INSERT INTO `yb_area_city` VALUES ('151', '济源市', '16', '151');
INSERT INTO `yb_area_city` VALUES ('152', '焦作市', '16', '152');
INSERT INTO `yb_area_city` VALUES ('153', '鹤壁市', '16', '153');
INSERT INTO `yb_area_city` VALUES ('154', '濮阳市', '16', '154');
INSERT INTO `yb_area_city` VALUES ('155', '周口市', '16', '155');
INSERT INTO `yb_area_city` VALUES ('156', '漯河市', '16', '156');
INSERT INTO `yb_area_city` VALUES ('157', '驻马店市', '16', '157');
INSERT INTO `yb_area_city` VALUES ('158', '三门峡市', '16', '158');
INSERT INTO `yb_area_city` VALUES ('159', '武汉市', '17', '159');
INSERT INTO `yb_area_city` VALUES ('160', '襄樊市', '17', '160');
INSERT INTO `yb_area_city` VALUES ('161', '鄂州市', '17', '161');
INSERT INTO `yb_area_city` VALUES ('162', '孝感市', '17', '162');
INSERT INTO `yb_area_city` VALUES ('163', '黄冈市', '17', '163');
INSERT INTO `yb_area_city` VALUES ('164', '黄石市', '17', '164');
INSERT INTO `yb_area_city` VALUES ('165', '咸宁市', '17', '165');
INSERT INTO `yb_area_city` VALUES ('166', '荆州市', '17', '166');
INSERT INTO `yb_area_city` VALUES ('167', '宜昌市', '17', '167');
INSERT INTO `yb_area_city` VALUES ('168', '恩施土家族苗族自治州', '17', '168');
INSERT INTO `yb_area_city` VALUES ('169', '神农架林区', '17', '169');
INSERT INTO `yb_area_city` VALUES ('170', '十堰市', '17', '170');
INSERT INTO `yb_area_city` VALUES ('171', '随州市', '17', '171');
INSERT INTO `yb_area_city` VALUES ('172', '荆门市', '17', '172');
INSERT INTO `yb_area_city` VALUES ('173', '仙桃市', '17', '173');
INSERT INTO `yb_area_city` VALUES ('174', '天门市', '17', '174');
INSERT INTO `yb_area_city` VALUES ('175', '潜江市', '17', '175');
INSERT INTO `yb_area_city` VALUES ('176', '岳阳市', '18', '176');
INSERT INTO `yb_area_city` VALUES ('177', '长沙市', '18', '177');
INSERT INTO `yb_area_city` VALUES ('178', '湘潭市', '18', '178');
INSERT INTO `yb_area_city` VALUES ('179', '株洲市', '18', '179');
INSERT INTO `yb_area_city` VALUES ('180', '衡阳市', '18', '180');
INSERT INTO `yb_area_city` VALUES ('181', '郴州市', '18', '181');
INSERT INTO `yb_area_city` VALUES ('182', '常德市', '18', '182');
INSERT INTO `yb_area_city` VALUES ('183', '益阳市', '18', '183');
INSERT INTO `yb_area_city` VALUES ('184', '娄底市', '18', '184');
INSERT INTO `yb_area_city` VALUES ('185', '邵阳市', '18', '185');
INSERT INTO `yb_area_city` VALUES ('186', '湘西土家族苗族自治州', '18', '186');
INSERT INTO `yb_area_city` VALUES ('187', '张家界市', '18', '187');
INSERT INTO `yb_area_city` VALUES ('188', '怀化市', '18', '188');
INSERT INTO `yb_area_city` VALUES ('189', '永州市', '18', '189');
INSERT INTO `yb_area_city` VALUES ('190', '广州市', '19', '190');
INSERT INTO `yb_area_city` VALUES ('191', '汕尾市', '19', '191');
INSERT INTO `yb_area_city` VALUES ('192', '阳江市', '19', '192');
INSERT INTO `yb_area_city` VALUES ('193', '揭阳市', '19', '193');
INSERT INTO `yb_area_city` VALUES ('194', '茂名市', '19', '194');
INSERT INTO `yb_area_city` VALUES ('195', '惠州市', '19', '195');
INSERT INTO `yb_area_city` VALUES ('196', '江门市', '19', '196');
INSERT INTO `yb_area_city` VALUES ('197', '韶关市', '19', '197');
INSERT INTO `yb_area_city` VALUES ('198', '梅州市', '19', '198');
INSERT INTO `yb_area_city` VALUES ('199', '汕头市', '19', '199');
INSERT INTO `yb_area_city` VALUES ('200', '深圳市', '19', '200');
INSERT INTO `yb_area_city` VALUES ('201', '珠海市', '19', '201');
INSERT INTO `yb_area_city` VALUES ('202', '佛山市', '19', '202');
INSERT INTO `yb_area_city` VALUES ('203', '肇庆市', '19', '203');
INSERT INTO `yb_area_city` VALUES ('204', '湛江市', '19', '204');
INSERT INTO `yb_area_city` VALUES ('205', '中山市', '19', '205');
INSERT INTO `yb_area_city` VALUES ('206', '河源市', '19', '206');
INSERT INTO `yb_area_city` VALUES ('207', '清远市', '19', '207');
INSERT INTO `yb_area_city` VALUES ('208', '云浮市', '19', '208');
INSERT INTO `yb_area_city` VALUES ('209', '潮州市', '19', '209');
INSERT INTO `yb_area_city` VALUES ('210', '东莞市', '19', '210');
INSERT INTO `yb_area_city` VALUES ('211', '兰州市', '22', '211');
INSERT INTO `yb_area_city` VALUES ('212', '金昌市', '22', '212');
INSERT INTO `yb_area_city` VALUES ('213', '白银市', '22', '213');
INSERT INTO `yb_area_city` VALUES ('214', '天水市', '22', '214');
INSERT INTO `yb_area_city` VALUES ('215', '嘉峪关市', '22', '215');
INSERT INTO `yb_area_city` VALUES ('216', '武威市', '22', '216');
INSERT INTO `yb_area_city` VALUES ('217', '张掖市', '22', '217');
INSERT INTO `yb_area_city` VALUES ('218', '平凉市', '22', '218');
INSERT INTO `yb_area_city` VALUES ('219', '酒泉市', '22', '219');
INSERT INTO `yb_area_city` VALUES ('220', '庆阳市', '22', '220');
INSERT INTO `yb_area_city` VALUES ('221', '定西市', '22', '221');
INSERT INTO `yb_area_city` VALUES ('222', '陇南市', '22', '222');
INSERT INTO `yb_area_city` VALUES ('223', '临夏回族自治州', '22', '223');
INSERT INTO `yb_area_city` VALUES ('224', '甘南藏族自治州', '22', '224');
INSERT INTO `yb_area_city` VALUES ('225', '成都市', '28', '225');
INSERT INTO `yb_area_city` VALUES ('226', '攀枝花市', '28', '226');
INSERT INTO `yb_area_city` VALUES ('227', '自贡市', '28', '227');
INSERT INTO `yb_area_city` VALUES ('228', '绵阳市', '28', '228');
INSERT INTO `yb_area_city` VALUES ('229', '南充市', '28', '229');
INSERT INTO `yb_area_city` VALUES ('230', '达州市', '28', '230');
INSERT INTO `yb_area_city` VALUES ('231', '遂宁市', '28', '231');
INSERT INTO `yb_area_city` VALUES ('232', '广安市', '28', '232');
INSERT INTO `yb_area_city` VALUES ('233', '巴中市', '28', '233');
INSERT INTO `yb_area_city` VALUES ('234', '泸州市', '28', '234');
INSERT INTO `yb_area_city` VALUES ('235', '宜宾市', '28', '235');
INSERT INTO `yb_area_city` VALUES ('236', '资阳市', '28', '236');
INSERT INTO `yb_area_city` VALUES ('237', '内江市', '28', '237');
INSERT INTO `yb_area_city` VALUES ('238', '乐山市', '28', '238');
INSERT INTO `yb_area_city` VALUES ('239', '眉山市', '28', '239');
INSERT INTO `yb_area_city` VALUES ('240', '凉山彝族自治州', '28', '240');
INSERT INTO `yb_area_city` VALUES ('241', '雅安市', '28', '241');
INSERT INTO `yb_area_city` VALUES ('242', '甘孜藏族自治州', '28', '242');
INSERT INTO `yb_area_city` VALUES ('243', '阿坝藏族羌族自治州', '28', '243');
INSERT INTO `yb_area_city` VALUES ('244', '德阳市', '28', '244');
INSERT INTO `yb_area_city` VALUES ('245', '广元市', '28', '245');
INSERT INTO `yb_area_city` VALUES ('246', '贵阳市', '29', '246');
INSERT INTO `yb_area_city` VALUES ('247', '遵义市', '29', '247');
INSERT INTO `yb_area_city` VALUES ('248', '安顺市', '29', '248');
INSERT INTO `yb_area_city` VALUES ('249', '黔南布依族苗族自治州', '29', '249');
INSERT INTO `yb_area_city` VALUES ('250', '黔东南苗族侗族自治州', '29', '250');
INSERT INTO `yb_area_city` VALUES ('251', '铜仁地区', '29', '251');
INSERT INTO `yb_area_city` VALUES ('252', '毕节地区', '29', '252');
INSERT INTO `yb_area_city` VALUES ('253', '六盘水市', '29', '253');
INSERT INTO `yb_area_city` VALUES ('254', '黔西南布依族苗族自治州', '29', '254');
INSERT INTO `yb_area_city` VALUES ('255', '海口市', '20', '255');
INSERT INTO `yb_area_city` VALUES ('256', '三亚市', '20', '256');
INSERT INTO `yb_area_city` VALUES ('257', '五指山市', '20', '257');
INSERT INTO `yb_area_city` VALUES ('258', '琼海市', '20', '258');
INSERT INTO `yb_area_city` VALUES ('259', '儋州市', '20', '259');
INSERT INTO `yb_area_city` VALUES ('260', '文昌市', '20', '260');
INSERT INTO `yb_area_city` VALUES ('261', '万宁市', '20', '261');
INSERT INTO `yb_area_city` VALUES ('262', '东方市', '20', '262');
INSERT INTO `yb_area_city` VALUES ('263', '澄迈县', '20', '263');
INSERT INTO `yb_area_city` VALUES ('264', '定安县', '20', '264');
INSERT INTO `yb_area_city` VALUES ('265', '屯昌县', '20', '265');
INSERT INTO `yb_area_city` VALUES ('266', '临高县', '20', '266');
INSERT INTO `yb_area_city` VALUES ('267', '白沙黎族自治县', '20', '267');
INSERT INTO `yb_area_city` VALUES ('268', '昌江黎族自治县', '20', '268');
INSERT INTO `yb_area_city` VALUES ('269', '乐东黎族自治县', '20', '269');
INSERT INTO `yb_area_city` VALUES ('270', '陵水黎族自治县', '20', '270');
INSERT INTO `yb_area_city` VALUES ('271', '保亭黎族苗族自治县', '20', '271');
INSERT INTO `yb_area_city` VALUES ('272', '琼中黎族苗族自治县', '20', '272');
INSERT INTO `yb_area_city` VALUES ('273', '西双版纳傣族自治州', '30', '273');
INSERT INTO `yb_area_city` VALUES ('274', '德宏傣族景颇族自治州', '30', '274');
INSERT INTO `yb_area_city` VALUES ('275', '昭通市', '30', '275');
INSERT INTO `yb_area_city` VALUES ('276', '昆明市', '30', '276');
INSERT INTO `yb_area_city` VALUES ('277', '大理白族自治州', '30', '277');
INSERT INTO `yb_area_city` VALUES ('278', '红河哈尼族彝族自治州', '30', '278');
INSERT INTO `yb_area_city` VALUES ('279', '曲靖市', '30', '279');
INSERT INTO `yb_area_city` VALUES ('280', '保山市', '30', '280');
INSERT INTO `yb_area_city` VALUES ('281', '文山壮族苗族自治州', '30', '281');
INSERT INTO `yb_area_city` VALUES ('282', '玉溪市', '30', '282');
INSERT INTO `yb_area_city` VALUES ('283', '楚雄彝族自治州', '30', '283');
INSERT INTO `yb_area_city` VALUES ('284', '普洱市', '30', '284');
INSERT INTO `yb_area_city` VALUES ('285', '临沧市', '30', '285');
INSERT INTO `yb_area_city` VALUES ('286', '怒江傈傈族自治州', '30', '286');
INSERT INTO `yb_area_city` VALUES ('287', '迪庆藏族自治州', '30', '287');
INSERT INTO `yb_area_city` VALUES ('288', '丽江市', '30', '288');
INSERT INTO `yb_area_city` VALUES ('289', '海北藏族自治州', '25', '289');
INSERT INTO `yb_area_city` VALUES ('290', '西宁市', '25', '290');
INSERT INTO `yb_area_city` VALUES ('291', '海东地区', '25', '291');
INSERT INTO `yb_area_city` VALUES ('292', '黄南藏族自治州', '25', '292');
INSERT INTO `yb_area_city` VALUES ('293', '海南藏族自治州', '25', '293');
INSERT INTO `yb_area_city` VALUES ('294', '果洛藏族自治州', '25', '294');
INSERT INTO `yb_area_city` VALUES ('295', '玉树藏族自治州', '25', '295');
INSERT INTO `yb_area_city` VALUES ('296', '海西蒙古族藏族自治州', '25', '296');
INSERT INTO `yb_area_city` VALUES ('297', '西安市', '23', '297');
INSERT INTO `yb_area_city` VALUES ('298', '咸阳市', '23', '298');
INSERT INTO `yb_area_city` VALUES ('299', '延安市', '23', '299');
INSERT INTO `yb_area_city` VALUES ('300', '榆林市', '23', '300');
INSERT INTO `yb_area_city` VALUES ('301', '渭南市', '23', '301');
INSERT INTO `yb_area_city` VALUES ('302', '商洛市', '23', '302');
INSERT INTO `yb_area_city` VALUES ('303', '安康市', '23', '303');
INSERT INTO `yb_area_city` VALUES ('304', '汉中市', '23', '304');
INSERT INTO `yb_area_city` VALUES ('305', '宝鸡市', '23', '305');
INSERT INTO `yb_area_city` VALUES ('306', '铜川市', '23', '306');
INSERT INTO `yb_area_city` VALUES ('307', '防城港市', '21', '307');
INSERT INTO `yb_area_city` VALUES ('308', '南宁市', '21', '308');
INSERT INTO `yb_area_city` VALUES ('309', '崇左市', '21', '309');
INSERT INTO `yb_area_city` VALUES ('310', '来宾市', '21', '310');
INSERT INTO `yb_area_city` VALUES ('311', '柳州市', '21', '311');
INSERT INTO `yb_area_city` VALUES ('312', '桂林市', '21', '312');
INSERT INTO `yb_area_city` VALUES ('313', '梧州市', '21', '313');
INSERT INTO `yb_area_city` VALUES ('314', '贺州市', '21', '314');
INSERT INTO `yb_area_city` VALUES ('315', '贵港市', '21', '315');
INSERT INTO `yb_area_city` VALUES ('316', '玉林市', '21', '316');
INSERT INTO `yb_area_city` VALUES ('317', '百色市', '21', '317');
INSERT INTO `yb_area_city` VALUES ('318', '钦州市', '21', '318');
INSERT INTO `yb_area_city` VALUES ('319', '河池市', '21', '319');
INSERT INTO `yb_area_city` VALUES ('320', '北海市', '21', '320');
INSERT INTO `yb_area_city` VALUES ('321', '拉萨市', '31', '321');
INSERT INTO `yb_area_city` VALUES ('322', '日喀则地区', '31', '322');
INSERT INTO `yb_area_city` VALUES ('323', '山南地区', '31', '323');
INSERT INTO `yb_area_city` VALUES ('324', '林芝地区', '31', '324');
INSERT INTO `yb_area_city` VALUES ('325', '昌都地区', '31', '325');
INSERT INTO `yb_area_city` VALUES ('326', '那曲地区', '31', '326');
INSERT INTO `yb_area_city` VALUES ('327', '阿里地区', '31', '327');
INSERT INTO `yb_area_city` VALUES ('328', '银川市', '26', '328');
INSERT INTO `yb_area_city` VALUES ('329', '石嘴山市', '26', '329');
INSERT INTO `yb_area_city` VALUES ('330', '吴忠市', '26', '330');
INSERT INTO `yb_area_city` VALUES ('331', '固原市', '26', '331');
INSERT INTO `yb_area_city` VALUES ('332', '中卫市', '26', '332');
INSERT INTO `yb_area_city` VALUES ('333', '塔城地区', '24', '333');
INSERT INTO `yb_area_city` VALUES ('334', '哈密地区', '24', '334');
INSERT INTO `yb_area_city` VALUES ('335', '和田地区', '24', '335');
INSERT INTO `yb_area_city` VALUES ('336', '阿勒泰地区', '24', '336');
INSERT INTO `yb_area_city` VALUES ('337', '克孜勒苏柯尔克孜自治州', '24', '337');
INSERT INTO `yb_area_city` VALUES ('338', '博尔塔拉蒙古自治州', '24', '338');
INSERT INTO `yb_area_city` VALUES ('339', '克拉玛依市', '24', '339');
INSERT INTO `yb_area_city` VALUES ('340', '乌鲁木齐市', '24', '340');
INSERT INTO `yb_area_city` VALUES ('341', '石河子市', '24', '341');
INSERT INTO `yb_area_city` VALUES ('342', '昌吉回族自治州', '24', '342');
INSERT INTO `yb_area_city` VALUES ('343', '五家渠市', '24', '343');
INSERT INTO `yb_area_city` VALUES ('344', '吐鲁番地区', '24', '344');
INSERT INTO `yb_area_city` VALUES ('345', '巴音郭楞蒙古自治州', '24', '345');
INSERT INTO `yb_area_city` VALUES ('346', '阿克苏地区', '24', '346');
INSERT INTO `yb_area_city` VALUES ('347', '阿拉尔市', '24', '347');
INSERT INTO `yb_area_city` VALUES ('348', '喀什地区', '24', '348');
INSERT INTO `yb_area_city` VALUES ('349', '图木舒克市', '24', '349');
INSERT INTO `yb_area_city` VALUES ('350', '伊犁哈萨克自治州', '24', '350');
INSERT INTO `yb_area_city` VALUES ('351', '呼伦贝尔市', '5', '351');
INSERT INTO `yb_area_city` VALUES ('352', '呼和浩特市', '5', '352');
INSERT INTO `yb_area_city` VALUES ('353', '包头市', '5', '353');
INSERT INTO `yb_area_city` VALUES ('354', '乌海市', '5', '354');
INSERT INTO `yb_area_city` VALUES ('355', '乌兰察布市', '5', '355');
INSERT INTO `yb_area_city` VALUES ('356', '通辽市', '5', '356');
INSERT INTO `yb_area_city` VALUES ('357', '赤峰市', '5', '357');
INSERT INTO `yb_area_city` VALUES ('358', '鄂尔多斯市', '5', '358');
INSERT INTO `yb_area_city` VALUES ('359', '巴彦淖尔市', '5', '359');
INSERT INTO `yb_area_city` VALUES ('360', '锡林郭勒盟', '5', '360');
INSERT INTO `yb_area_city` VALUES ('361', '兴安盟', '5', '361');
INSERT INTO `yb_area_city` VALUES ('362', '阿拉善盟', '5', '362');
INSERT INTO `yb_area_city` VALUES ('363', '澳门特别行政区', '33', '370');
INSERT INTO `yb_area_city` VALUES ('364', '台北市', '32', '372');
INSERT INTO `yb_area_city` VALUES ('365', '高雄市', '32', '373');
INSERT INTO `yb_area_city` VALUES ('366', '台南市', '32', '374');
INSERT INTO `yb_area_city` VALUES ('367', '台中市', '32', '375');
INSERT INTO `yb_area_city` VALUES ('368', '金门县', '32', '376');
INSERT INTO `yb_area_city` VALUES ('369', '南投县', '32', '377');
INSERT INTO `yb_area_city` VALUES ('370', '基隆市', '32', '378');
INSERT INTO `yb_area_city` VALUES ('371', '新竹市', '32', '379');
INSERT INTO `yb_area_city` VALUES ('372', '嘉义县', '32', '380');
INSERT INTO `yb_area_city` VALUES ('373', '新北市', '32', '381');
INSERT INTO `yb_area_city` VALUES ('374', '宜兰县', '32', '382');
INSERT INTO `yb_area_city` VALUES ('375', '新竹县', '32', '383');
INSERT INTO `yb_area_city` VALUES ('376', '桃园县', '32', '384');
INSERT INTO `yb_area_city` VALUES ('377', '苗栗县', '32', '385');
INSERT INTO `yb_area_city` VALUES ('378', '彰化县', '32', '386');
INSERT INTO `yb_area_city` VALUES ('379', '嘉义县', '32', '387');
INSERT INTO `yb_area_city` VALUES ('380', '云林县', '32', '388');
INSERT INTO `yb_area_city` VALUES ('381', '屏东县', '32', '389');
INSERT INTO `yb_area_city` VALUES ('382', '台东县', '32', '390');
INSERT INTO `yb_area_city` VALUES ('383', '花莲县', '32', '391');
INSERT INTO `yb_area_city` VALUES ('384', '澎湖县', '32', '392');
INSERT INTO `yb_area_city` VALUES ('385', '连江县', '32', '393');
INSERT INTO `yb_area_city` VALUES ('386', '香港岛', '34', '394');
INSERT INTO `yb_area_city` VALUES ('387', '九龙', '34', '395');
INSERT INTO `yb_area_city` VALUES ('388', '新界', '34', '396');

-- ----------------------------
-- Table structure for yb_area_district
-- ----------------------------
DROP TABLE IF EXISTS `yb_area_district`;
CREATE TABLE `yb_area_district` (
  `districtid` int(4) NOT NULL COMMENT '地区id',
  `districtname` varchar(15) NOT NULL COMMENT '地区名称',
  `cityid` int(3) NOT NULL COMMENT '城市id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_area_district
-- ----------------------------
INSERT INTO `yb_area_district` VALUES ('1', '东城区', '1');
INSERT INTO `yb_area_district` VALUES ('2', '西城区', '1');
INSERT INTO `yb_area_district` VALUES ('3', '崇文区', '1');
INSERT INTO `yb_area_district` VALUES ('4', '宣武区', '1');
INSERT INTO `yb_area_district` VALUES ('5', '朝阳区', '1');
INSERT INTO `yb_area_district` VALUES ('6', '丰台区', '1');
INSERT INTO `yb_area_district` VALUES ('7', '石景山区', '1');
INSERT INTO `yb_area_district` VALUES ('8', '海淀区', '1');
INSERT INTO `yb_area_district` VALUES ('9', '门头沟区', '1');
INSERT INTO `yb_area_district` VALUES ('10', '房山区', '1');
INSERT INTO `yb_area_district` VALUES ('11', '通州区', '1');
INSERT INTO `yb_area_district` VALUES ('12', '顺义区', '1');
INSERT INTO `yb_area_district` VALUES ('13', '昌平区', '1');
INSERT INTO `yb_area_district` VALUES ('14', '大兴区', '1');
INSERT INTO `yb_area_district` VALUES ('15', '怀柔区', '1');
INSERT INTO `yb_area_district` VALUES ('16', '平谷区', '1');
INSERT INTO `yb_area_district` VALUES ('17', '密云县', '1');
INSERT INTO `yb_area_district` VALUES ('18', '延庆县', '1');
INSERT INTO `yb_area_district` VALUES ('19', '和平区', '2');
INSERT INTO `yb_area_district` VALUES ('20', '河东区', '2');
INSERT INTO `yb_area_district` VALUES ('21', '河西区', '2');
INSERT INTO `yb_area_district` VALUES ('22', '南开区', '2');
INSERT INTO `yb_area_district` VALUES ('23', '河北区', '2');
INSERT INTO `yb_area_district` VALUES ('24', '红桥区', '2');
INSERT INTO `yb_area_district` VALUES ('25', '塘沽区', '2');
INSERT INTO `yb_area_district` VALUES ('26', '汉沽区', '2');
INSERT INTO `yb_area_district` VALUES ('27', '大港区', '2');
INSERT INTO `yb_area_district` VALUES ('28', '东丽区', '2');
INSERT INTO `yb_area_district` VALUES ('29', '西青区', '2');
INSERT INTO `yb_area_district` VALUES ('30', '津南区', '2');
INSERT INTO `yb_area_district` VALUES ('31', '北辰区', '2');
INSERT INTO `yb_area_district` VALUES ('32', '武清区', '2');
INSERT INTO `yb_area_district` VALUES ('33', '宝坻区', '2');
INSERT INTO `yb_area_district` VALUES ('34', '宁河县', '2');
INSERT INTO `yb_area_district` VALUES ('35', '静海县', '2');
INSERT INTO `yb_area_district` VALUES ('36', '蓟县', '2');
INSERT INTO `yb_area_district` VALUES ('37', '黄浦区', '3');
INSERT INTO `yb_area_district` VALUES ('38', '卢湾区', '3');
INSERT INTO `yb_area_district` VALUES ('39', '徐汇区', '3');
INSERT INTO `yb_area_district` VALUES ('40', '长宁区', '3');
INSERT INTO `yb_area_district` VALUES ('41', '静安区', '3');
INSERT INTO `yb_area_district` VALUES ('42', '普陀区', '3');
INSERT INTO `yb_area_district` VALUES ('43', '闸北区', '3');
INSERT INTO `yb_area_district` VALUES ('44', '虹口区', '3');
INSERT INTO `yb_area_district` VALUES ('45', '杨浦区', '3');
INSERT INTO `yb_area_district` VALUES ('46', '闵行区', '3');
INSERT INTO `yb_area_district` VALUES ('47', '宝山区', '3');
INSERT INTO `yb_area_district` VALUES ('48', '嘉定区', '3');
INSERT INTO `yb_area_district` VALUES ('49', '浦东新区', '3');
INSERT INTO `yb_area_district` VALUES ('50', '金山区', '3');
INSERT INTO `yb_area_district` VALUES ('51', '松江区', '3');
INSERT INTO `yb_area_district` VALUES ('52', '青浦区', '3');
INSERT INTO `yb_area_district` VALUES ('53', '南汇区', '3');
INSERT INTO `yb_area_district` VALUES ('54', '奉贤区', '3');
INSERT INTO `yb_area_district` VALUES ('55', '崇明县', '3');
INSERT INTO `yb_area_district` VALUES ('56', '万州区', '4');
INSERT INTO `yb_area_district` VALUES ('57', '涪陵区', '4');
INSERT INTO `yb_area_district` VALUES ('58', '渝中区', '4');
INSERT INTO `yb_area_district` VALUES ('59', '大渡口区', '4');
INSERT INTO `yb_area_district` VALUES ('60', '江北区', '4');
INSERT INTO `yb_area_district` VALUES ('61', '沙坪坝区', '4');
INSERT INTO `yb_area_district` VALUES ('62', '九龙坡区', '4');
INSERT INTO `yb_area_district` VALUES ('63', '南岸区', '4');
INSERT INTO `yb_area_district` VALUES ('64', '北碚区', '4');
INSERT INTO `yb_area_district` VALUES ('65', '万盛区', '4');
INSERT INTO `yb_area_district` VALUES ('66', '双桥区', '4');
INSERT INTO `yb_area_district` VALUES ('67', '渝北区', '4');
INSERT INTO `yb_area_district` VALUES ('68', '巴南区', '4');
INSERT INTO `yb_area_district` VALUES ('69', '黔江区', '4');
INSERT INTO `yb_area_district` VALUES ('70', '长寿区', '4');
INSERT INTO `yb_area_district` VALUES ('71', '江津区', '4');
INSERT INTO `yb_area_district` VALUES ('72', '合川区', '4');
INSERT INTO `yb_area_district` VALUES ('73', '永川区', '4');
INSERT INTO `yb_area_district` VALUES ('74', '南川区', '4');
INSERT INTO `yb_area_district` VALUES ('75', '綦江县', '4');
INSERT INTO `yb_area_district` VALUES ('76', '潼南县', '4');
INSERT INTO `yb_area_district` VALUES ('77', '铜梁县', '4');
INSERT INTO `yb_area_district` VALUES ('78', '大足县', '4');
INSERT INTO `yb_area_district` VALUES ('79', '荣昌县', '4');
INSERT INTO `yb_area_district` VALUES ('80', '璧山县', '4');
INSERT INTO `yb_area_district` VALUES ('81', '梁平县', '4');
INSERT INTO `yb_area_district` VALUES ('82', '城口县', '4');
INSERT INTO `yb_area_district` VALUES ('83', '丰都县', '4');
INSERT INTO `yb_area_district` VALUES ('84', '垫江县', '4');
INSERT INTO `yb_area_district` VALUES ('85', '武隆县', '4');
INSERT INTO `yb_area_district` VALUES ('86', '忠县', '4');
INSERT INTO `yb_area_district` VALUES ('87', '开县', '4');
INSERT INTO `yb_area_district` VALUES ('88', '云阳县', '4');
INSERT INTO `yb_area_district` VALUES ('89', '奉节县', '4');
INSERT INTO `yb_area_district` VALUES ('90', '巫山县', '4');
INSERT INTO `yb_area_district` VALUES ('91', '巫溪县', '4');
INSERT INTO `yb_area_district` VALUES ('92', '石柱土家族自治县', '4');
INSERT INTO `yb_area_district` VALUES ('93', '秀山土家族苗族自治县', '4');
INSERT INTO `yb_area_district` VALUES ('94', '酉阳土家族苗族自治县', '4');
INSERT INTO `yb_area_district` VALUES ('95', '彭水苗族土家族自治县', '4');
INSERT INTO `yb_area_district` VALUES ('96', '邯山区', '5');
INSERT INTO `yb_area_district` VALUES ('97', '丛台区', '5');
INSERT INTO `yb_area_district` VALUES ('98', '复兴区', '5');
INSERT INTO `yb_area_district` VALUES ('99', '峰峰矿区', '5');
INSERT INTO `yb_area_district` VALUES ('100', '邯郸县', '5');
INSERT INTO `yb_area_district` VALUES ('101', '临漳县', '5');
INSERT INTO `yb_area_district` VALUES ('102', '成安县', '5');
INSERT INTO `yb_area_district` VALUES ('103', '大名县', '5');
INSERT INTO `yb_area_district` VALUES ('104', '涉县', '5');
INSERT INTO `yb_area_district` VALUES ('105', '磁县', '5');
INSERT INTO `yb_area_district` VALUES ('106', '肥乡县', '5');
INSERT INTO `yb_area_district` VALUES ('107', '永年县', '5');
INSERT INTO `yb_area_district` VALUES ('108', '邱县', '5');
INSERT INTO `yb_area_district` VALUES ('109', '鸡泽县', '5');
INSERT INTO `yb_area_district` VALUES ('110', '广平县', '5');
INSERT INTO `yb_area_district` VALUES ('111', '馆陶县', '5');
INSERT INTO `yb_area_district` VALUES ('112', '魏县', '5');
INSERT INTO `yb_area_district` VALUES ('113', '曲周县', '5');
INSERT INTO `yb_area_district` VALUES ('114', '武安市', '5');
INSERT INTO `yb_area_district` VALUES ('115', '长安区', '6');
INSERT INTO `yb_area_district` VALUES ('116', '桥东区', '6');
INSERT INTO `yb_area_district` VALUES ('117', '桥西区', '6');
INSERT INTO `yb_area_district` VALUES ('118', '新华区', '6');
INSERT INTO `yb_area_district` VALUES ('119', '井陉矿区', '6');
INSERT INTO `yb_area_district` VALUES ('120', '裕华区', '6');
INSERT INTO `yb_area_district` VALUES ('121', '井陉县', '6');
INSERT INTO `yb_area_district` VALUES ('122', '正定县', '6');
INSERT INTO `yb_area_district` VALUES ('123', '栾城县', '6');
INSERT INTO `yb_area_district` VALUES ('124', '行唐县', '6');
INSERT INTO `yb_area_district` VALUES ('125', '灵寿县', '6');
INSERT INTO `yb_area_district` VALUES ('126', '高邑县', '6');
INSERT INTO `yb_area_district` VALUES ('127', '深泽县', '6');
INSERT INTO `yb_area_district` VALUES ('128', '赞皇县', '6');
INSERT INTO `yb_area_district` VALUES ('129', '无极县', '6');
INSERT INTO `yb_area_district` VALUES ('130', '平山县', '6');
INSERT INTO `yb_area_district` VALUES ('131', '元氏县', '6');
INSERT INTO `yb_area_district` VALUES ('132', '赵县', '6');
INSERT INTO `yb_area_district` VALUES ('133', '辛集市', '6');
INSERT INTO `yb_area_district` VALUES ('134', '藁城市', '6');
INSERT INTO `yb_area_district` VALUES ('135', '晋州市', '6');
INSERT INTO `yb_area_district` VALUES ('136', '新乐市', '6');
INSERT INTO `yb_area_district` VALUES ('137', '鹿泉市', '6');
INSERT INTO `yb_area_district` VALUES ('138', '新市区', '7');
INSERT INTO `yb_area_district` VALUES ('139', '北市区', '7');
INSERT INTO `yb_area_district` VALUES ('140', '南市区', '7');
INSERT INTO `yb_area_district` VALUES ('141', '满城县', '7');
INSERT INTO `yb_area_district` VALUES ('142', '清苑县', '7');
INSERT INTO `yb_area_district` VALUES ('143', '涞水县', '7');
INSERT INTO `yb_area_district` VALUES ('144', '阜平县', '7');
INSERT INTO `yb_area_district` VALUES ('145', '徐水县', '7');
INSERT INTO `yb_area_district` VALUES ('146', '定兴县', '7');
INSERT INTO `yb_area_district` VALUES ('147', '唐县', '7');
INSERT INTO `yb_area_district` VALUES ('148', '高阳县', '7');
INSERT INTO `yb_area_district` VALUES ('149', '容城县', '7');
INSERT INTO `yb_area_district` VALUES ('150', '涞源县', '7');
INSERT INTO `yb_area_district` VALUES ('151', '望都县', '7');
INSERT INTO `yb_area_district` VALUES ('152', '安新县', '7');
INSERT INTO `yb_area_district` VALUES ('153', '易县', '7');
INSERT INTO `yb_area_district` VALUES ('154', '曲阳县', '7');
INSERT INTO `yb_area_district` VALUES ('155', '蠡县', '7');
INSERT INTO `yb_area_district` VALUES ('156', '顺平县', '7');
INSERT INTO `yb_area_district` VALUES ('157', '博野县', '7');
INSERT INTO `yb_area_district` VALUES ('158', '雄县', '7');
INSERT INTO `yb_area_district` VALUES ('159', '涿州市', '7');
INSERT INTO `yb_area_district` VALUES ('160', '定州市', '7');
INSERT INTO `yb_area_district` VALUES ('161', '安国市', '7');
INSERT INTO `yb_area_district` VALUES ('162', '高碑店市', '7');
INSERT INTO `yb_area_district` VALUES ('163', '桥东区', '8');
INSERT INTO `yb_area_district` VALUES ('164', '桥西区', '8');
INSERT INTO `yb_area_district` VALUES ('165', '宣化区', '8');
INSERT INTO `yb_area_district` VALUES ('166', '下花园区', '8');
INSERT INTO `yb_area_district` VALUES ('167', '宣化县', '8');
INSERT INTO `yb_area_district` VALUES ('168', '张北县', '8');
INSERT INTO `yb_area_district` VALUES ('169', '康保县', '8');
INSERT INTO `yb_area_district` VALUES ('170', '沽源县', '8');
INSERT INTO `yb_area_district` VALUES ('171', '尚义县', '8');
INSERT INTO `yb_area_district` VALUES ('172', '蔚县', '8');
INSERT INTO `yb_area_district` VALUES ('173', '阳原县', '8');
INSERT INTO `yb_area_district` VALUES ('174', '怀安县', '8');
INSERT INTO `yb_area_district` VALUES ('175', '万全县', '8');
INSERT INTO `yb_area_district` VALUES ('176', '怀来县', '8');
INSERT INTO `yb_area_district` VALUES ('177', '涿鹿县', '8');
INSERT INTO `yb_area_district` VALUES ('178', '赤城县', '8');
INSERT INTO `yb_area_district` VALUES ('179', '崇礼县', '8');
INSERT INTO `yb_area_district` VALUES ('180', '双桥区', '9');
INSERT INTO `yb_area_district` VALUES ('181', '双滦区', '9');
INSERT INTO `yb_area_district` VALUES ('182', '鹰手营子矿区', '9');
INSERT INTO `yb_area_district` VALUES ('183', '承德县', '9');
INSERT INTO `yb_area_district` VALUES ('184', '兴隆县', '9');
INSERT INTO `yb_area_district` VALUES ('185', '平泉县', '9');
INSERT INTO `yb_area_district` VALUES ('186', '滦平县', '9');
INSERT INTO `yb_area_district` VALUES ('187', '隆化县', '9');
INSERT INTO `yb_area_district` VALUES ('188', '丰宁满族自治县', '9');
INSERT INTO `yb_area_district` VALUES ('189', '宽城满族自治县', '9');
INSERT INTO `yb_area_district` VALUES ('190', '围场满族蒙古族自治县', '9');
INSERT INTO `yb_area_district` VALUES ('191', '路南区', '10');
INSERT INTO `yb_area_district` VALUES ('192', '路北区', '10');
INSERT INTO `yb_area_district` VALUES ('193', '古冶区', '10');
INSERT INTO `yb_area_district` VALUES ('194', '开平区', '10');
INSERT INTO `yb_area_district` VALUES ('195', '丰南区', '10');
INSERT INTO `yb_area_district` VALUES ('196', '丰润区', '10');
INSERT INTO `yb_area_district` VALUES ('197', '滦县', '10');
INSERT INTO `yb_area_district` VALUES ('198', '滦南县', '10');
INSERT INTO `yb_area_district` VALUES ('199', '乐亭县', '10');
INSERT INTO `yb_area_district` VALUES ('200', '迁西县', '10');
INSERT INTO `yb_area_district` VALUES ('201', '玉田县', '10');
INSERT INTO `yb_area_district` VALUES ('202', '唐海县', '10');
INSERT INTO `yb_area_district` VALUES ('203', '遵化市', '10');
INSERT INTO `yb_area_district` VALUES ('204', '迁安市', '10');
INSERT INTO `yb_area_district` VALUES ('205', '安次区', '11');
INSERT INTO `yb_area_district` VALUES ('206', '广阳区', '11');
INSERT INTO `yb_area_district` VALUES ('207', '固安县', '11');
INSERT INTO `yb_area_district` VALUES ('208', '永清县', '11');
INSERT INTO `yb_area_district` VALUES ('209', '香河县', '11');
INSERT INTO `yb_area_district` VALUES ('210', '大城县', '11');
INSERT INTO `yb_area_district` VALUES ('211', '文安县', '11');
INSERT INTO `yb_area_district` VALUES ('212', '大厂回族自治县', '11');
INSERT INTO `yb_area_district` VALUES ('213', '霸州市', '11');
INSERT INTO `yb_area_district` VALUES ('214', '三河市', '11');
INSERT INTO `yb_area_district` VALUES ('215', '新华区', '12');
INSERT INTO `yb_area_district` VALUES ('216', '运河区', '12');
INSERT INTO `yb_area_district` VALUES ('217', '沧县', '12');
INSERT INTO `yb_area_district` VALUES ('218', '青县', '12');
INSERT INTO `yb_area_district` VALUES ('219', '东光县', '12');
INSERT INTO `yb_area_district` VALUES ('220', '海兴县', '12');
INSERT INTO `yb_area_district` VALUES ('221', '盐山县', '12');
INSERT INTO `yb_area_district` VALUES ('222', '肃宁县', '12');
INSERT INTO `yb_area_district` VALUES ('223', '南皮县', '12');
INSERT INTO `yb_area_district` VALUES ('224', '吴桥县', '12');
INSERT INTO `yb_area_district` VALUES ('225', '献县', '12');
INSERT INTO `yb_area_district` VALUES ('226', '孟村回族自治县', '12');
INSERT INTO `yb_area_district` VALUES ('227', '泊头市', '12');
INSERT INTO `yb_area_district` VALUES ('228', '任丘市', '12');
INSERT INTO `yb_area_district` VALUES ('229', '黄骅市', '12');
INSERT INTO `yb_area_district` VALUES ('230', '河间市', '12');
INSERT INTO `yb_area_district` VALUES ('231', '桃城区', '13');
INSERT INTO `yb_area_district` VALUES ('232', '枣强县', '13');
INSERT INTO `yb_area_district` VALUES ('233', '武邑县', '13');
INSERT INTO `yb_area_district` VALUES ('234', '武强县', '13');
INSERT INTO `yb_area_district` VALUES ('235', '饶阳县', '13');
INSERT INTO `yb_area_district` VALUES ('236', '安平县', '13');
INSERT INTO `yb_area_district` VALUES ('237', '故城县', '13');
INSERT INTO `yb_area_district` VALUES ('238', '景县', '13');
INSERT INTO `yb_area_district` VALUES ('239', '阜城县', '13');
INSERT INTO `yb_area_district` VALUES ('240', '冀州市', '13');
INSERT INTO `yb_area_district` VALUES ('241', '深州市', '13');
INSERT INTO `yb_area_district` VALUES ('242', '桥东区', '14');
INSERT INTO `yb_area_district` VALUES ('243', '桥西区', '14');
INSERT INTO `yb_area_district` VALUES ('244', '邢台县', '14');
INSERT INTO `yb_area_district` VALUES ('245', '临城县', '14');
INSERT INTO `yb_area_district` VALUES ('246', '内丘县', '14');
INSERT INTO `yb_area_district` VALUES ('247', '柏乡县', '14');
INSERT INTO `yb_area_district` VALUES ('248', '隆尧县', '14');
INSERT INTO `yb_area_district` VALUES ('249', '任县', '14');
INSERT INTO `yb_area_district` VALUES ('250', '南和县', '14');
INSERT INTO `yb_area_district` VALUES ('251', '宁晋县', '14');
INSERT INTO `yb_area_district` VALUES ('252', '巨鹿县', '14');
INSERT INTO `yb_area_district` VALUES ('253', '新河县', '14');
INSERT INTO `yb_area_district` VALUES ('254', '广宗县', '14');
INSERT INTO `yb_area_district` VALUES ('255', '平乡县', '14');
INSERT INTO `yb_area_district` VALUES ('256', '威县', '14');
INSERT INTO `yb_area_district` VALUES ('257', '清河县', '14');
INSERT INTO `yb_area_district` VALUES ('258', '临西县', '14');
INSERT INTO `yb_area_district` VALUES ('259', '南宫市', '14');
INSERT INTO `yb_area_district` VALUES ('260', '沙河市', '14');
INSERT INTO `yb_area_district` VALUES ('261', '海港区', '15');
INSERT INTO `yb_area_district` VALUES ('262', '山海关区', '15');
INSERT INTO `yb_area_district` VALUES ('263', '北戴河区', '15');
INSERT INTO `yb_area_district` VALUES ('264', '青龙满族自治县', '15');
INSERT INTO `yb_area_district` VALUES ('265', '昌黎县', '15');
INSERT INTO `yb_area_district` VALUES ('266', '抚宁县', '15');
INSERT INTO `yb_area_district` VALUES ('267', '卢龙县', '15');
INSERT INTO `yb_area_district` VALUES ('268', '朔城区', '16');
INSERT INTO `yb_area_district` VALUES ('269', '平鲁区', '16');
INSERT INTO `yb_area_district` VALUES ('270', '山阴县', '16');
INSERT INTO `yb_area_district` VALUES ('271', '应县', '16');
INSERT INTO `yb_area_district` VALUES ('272', '右玉县', '16');
INSERT INTO `yb_area_district` VALUES ('273', '怀仁县', '16');
INSERT INTO `yb_area_district` VALUES ('274', '忻府区', '17');
INSERT INTO `yb_area_district` VALUES ('275', '定襄县', '17');
INSERT INTO `yb_area_district` VALUES ('276', '五台县', '17');
INSERT INTO `yb_area_district` VALUES ('277', '代县', '17');
INSERT INTO `yb_area_district` VALUES ('278', '繁峙县', '17');
INSERT INTO `yb_area_district` VALUES ('279', '宁武县', '17');
INSERT INTO `yb_area_district` VALUES ('280', '静乐县', '17');
INSERT INTO `yb_area_district` VALUES ('281', '神池县', '17');
INSERT INTO `yb_area_district` VALUES ('282', '五寨县', '17');
INSERT INTO `yb_area_district` VALUES ('283', '岢岚县', '17');
INSERT INTO `yb_area_district` VALUES ('284', '河曲县', '17');
INSERT INTO `yb_area_district` VALUES ('285', '保德县', '17');
INSERT INTO `yb_area_district` VALUES ('286', '偏关县', '17');
INSERT INTO `yb_area_district` VALUES ('287', '原平市', '17');
INSERT INTO `yb_area_district` VALUES ('288', '小店区', '18');
INSERT INTO `yb_area_district` VALUES ('289', '迎泽区', '18');
INSERT INTO `yb_area_district` VALUES ('290', '杏花岭区', '18');
INSERT INTO `yb_area_district` VALUES ('291', '尖草坪区', '18');
INSERT INTO `yb_area_district` VALUES ('292', '万柏林区', '18');
INSERT INTO `yb_area_district` VALUES ('293', '晋源区', '18');
INSERT INTO `yb_area_district` VALUES ('294', '清徐县', '18');
INSERT INTO `yb_area_district` VALUES ('295', '阳曲县', '18');
INSERT INTO `yb_area_district` VALUES ('296', '娄烦县', '18');
INSERT INTO `yb_area_district` VALUES ('297', '古交市', '18');
INSERT INTO `yb_area_district` VALUES ('298', '矿区', '19');
INSERT INTO `yb_area_district` VALUES ('299', '南郊区', '19');
INSERT INTO `yb_area_district` VALUES ('300', '新荣区', '19');
INSERT INTO `yb_area_district` VALUES ('301', '阳高县', '19');
INSERT INTO `yb_area_district` VALUES ('302', '天镇县', '19');
INSERT INTO `yb_area_district` VALUES ('303', '广灵县', '19');
INSERT INTO `yb_area_district` VALUES ('304', '灵丘县', '19');
INSERT INTO `yb_area_district` VALUES ('305', '浑源县', '19');
INSERT INTO `yb_area_district` VALUES ('306', '左云县', '19');
INSERT INTO `yb_area_district` VALUES ('307', '大同县', '19');
INSERT INTO `yb_area_district` VALUES ('308', '矿区', '20');
INSERT INTO `yb_area_district` VALUES ('309', '平定县', '20');
INSERT INTO `yb_area_district` VALUES ('310', '盂县', '20');
INSERT INTO `yb_area_district` VALUES ('311', '榆次区', '21');
INSERT INTO `yb_area_district` VALUES ('312', '榆社县', '21');
INSERT INTO `yb_area_district` VALUES ('313', '左权县', '21');
INSERT INTO `yb_area_district` VALUES ('314', '和顺县', '21');
INSERT INTO `yb_area_district` VALUES ('315', '昔阳县', '21');
INSERT INTO `yb_area_district` VALUES ('316', '寿阳县', '21');
INSERT INTO `yb_area_district` VALUES ('317', '太谷县', '21');
INSERT INTO `yb_area_district` VALUES ('318', '祁县', '21');
INSERT INTO `yb_area_district` VALUES ('319', '平遥县', '21');
INSERT INTO `yb_area_district` VALUES ('320', '灵石县', '21');
INSERT INTO `yb_area_district` VALUES ('321', '介休市', '21');
INSERT INTO `yb_area_district` VALUES ('322', '长治县', '22');
INSERT INTO `yb_area_district` VALUES ('323', '襄垣县', '22');
INSERT INTO `yb_area_district` VALUES ('324', '屯留县', '22');
INSERT INTO `yb_area_district` VALUES ('325', '平顺县', '22');
INSERT INTO `yb_area_district` VALUES ('326', '黎城县', '22');
INSERT INTO `yb_area_district` VALUES ('327', '壶关县', '22');
INSERT INTO `yb_area_district` VALUES ('328', '长子县', '22');
INSERT INTO `yb_area_district` VALUES ('329', '武乡县', '22');
INSERT INTO `yb_area_district` VALUES ('330', '沁县', '22');
INSERT INTO `yb_area_district` VALUES ('331', '沁源县', '22');
INSERT INTO `yb_area_district` VALUES ('332', '潞城市', '22');
INSERT INTO `yb_area_district` VALUES ('333', '沁水县', '23');
INSERT INTO `yb_area_district` VALUES ('334', '阳城县', '23');
INSERT INTO `yb_area_district` VALUES ('335', '陵川县', '23');
INSERT INTO `yb_area_district` VALUES ('336', '泽州县', '23');
INSERT INTO `yb_area_district` VALUES ('337', '高平市', '23');
INSERT INTO `yb_area_district` VALUES ('338', '尧都区', '24');
INSERT INTO `yb_area_district` VALUES ('339', '曲沃县', '24');
INSERT INTO `yb_area_district` VALUES ('340', '翼城县', '24');
INSERT INTO `yb_area_district` VALUES ('341', '襄汾县', '24');
INSERT INTO `yb_area_district` VALUES ('342', '洪洞县', '24');
INSERT INTO `yb_area_district` VALUES ('343', '古县', '24');
INSERT INTO `yb_area_district` VALUES ('344', '安泽县', '24');
INSERT INTO `yb_area_district` VALUES ('345', '浮山县', '24');
INSERT INTO `yb_area_district` VALUES ('346', '吉县', '24');
INSERT INTO `yb_area_district` VALUES ('347', '乡宁县', '24');
INSERT INTO `yb_area_district` VALUES ('348', '大宁县', '24');
INSERT INTO `yb_area_district` VALUES ('349', '隰县', '24');
INSERT INTO `yb_area_district` VALUES ('350', '永和县', '24');
INSERT INTO `yb_area_district` VALUES ('351', '蒲县', '24');
INSERT INTO `yb_area_district` VALUES ('352', '汾西县', '24');
INSERT INTO `yb_area_district` VALUES ('353', '侯马市', '24');
INSERT INTO `yb_area_district` VALUES ('354', '霍州市', '24');
INSERT INTO `yb_area_district` VALUES ('355', '离石区', '25');
INSERT INTO `yb_area_district` VALUES ('356', '文水县', '25');
INSERT INTO `yb_area_district` VALUES ('357', '交城县', '25');
INSERT INTO `yb_area_district` VALUES ('358', '兴县', '25');
INSERT INTO `yb_area_district` VALUES ('359', '临县', '25');
INSERT INTO `yb_area_district` VALUES ('360', '柳林县', '25');
INSERT INTO `yb_area_district` VALUES ('361', '石楼县', '25');
INSERT INTO `yb_area_district` VALUES ('362', '岚县', '25');
INSERT INTO `yb_area_district` VALUES ('363', '方山县', '25');
INSERT INTO `yb_area_district` VALUES ('364', '中阳县', '25');
INSERT INTO `yb_area_district` VALUES ('365', '交口县', '25');
INSERT INTO `yb_area_district` VALUES ('366', '孝义市', '25');
INSERT INTO `yb_area_district` VALUES ('367', '汾阳市', '25');
INSERT INTO `yb_area_district` VALUES ('368', '盐湖区', '26');
INSERT INTO `yb_area_district` VALUES ('369', '临猗县', '26');
INSERT INTO `yb_area_district` VALUES ('370', '万荣县', '26');
INSERT INTO `yb_area_district` VALUES ('371', '闻喜县', '26');
INSERT INTO `yb_area_district` VALUES ('372', '稷山县', '26');
INSERT INTO `yb_area_district` VALUES ('373', '新绛县', '26');
INSERT INTO `yb_area_district` VALUES ('374', '绛县', '26');
INSERT INTO `yb_area_district` VALUES ('375', '垣曲县', '26');
INSERT INTO `yb_area_district` VALUES ('376', '夏县', '26');
INSERT INTO `yb_area_district` VALUES ('377', '平陆县', '26');
INSERT INTO `yb_area_district` VALUES ('378', '芮城县', '26');
INSERT INTO `yb_area_district` VALUES ('379', '永济市', '26');
INSERT INTO `yb_area_district` VALUES ('380', '河津市', '26');
INSERT INTO `yb_area_district` VALUES ('381', '和平区', '27');
INSERT INTO `yb_area_district` VALUES ('382', '沈河区', '27');
INSERT INTO `yb_area_district` VALUES ('383', '大东区', '27');
INSERT INTO `yb_area_district` VALUES ('384', '皇姑区', '27');
INSERT INTO `yb_area_district` VALUES ('385', '铁西区', '27');
INSERT INTO `yb_area_district` VALUES ('386', '苏家屯区', '27');
INSERT INTO `yb_area_district` VALUES ('387', '东陵区', '27');
INSERT INTO `yb_area_district` VALUES ('388', '沈北新区', '27');
INSERT INTO `yb_area_district` VALUES ('389', '于洪区', '27');
INSERT INTO `yb_area_district` VALUES ('390', '辽中县', '27');
INSERT INTO `yb_area_district` VALUES ('391', '康平县', '27');
INSERT INTO `yb_area_district` VALUES ('392', '法库县', '27');
INSERT INTO `yb_area_district` VALUES ('393', '新民市', '27');
INSERT INTO `yb_area_district` VALUES ('394', '银州区', '28');
INSERT INTO `yb_area_district` VALUES ('395', '清河区', '28');
INSERT INTO `yb_area_district` VALUES ('396', '铁岭县', '28');
INSERT INTO `yb_area_district` VALUES ('397', '西丰县', '28');
INSERT INTO `yb_area_district` VALUES ('398', '昌图县', '28');
INSERT INTO `yb_area_district` VALUES ('399', '调兵山市', '28');
INSERT INTO `yb_area_district` VALUES ('400', '开原市', '28');
INSERT INTO `yb_area_district` VALUES ('401', '长海县', '29');
INSERT INTO `yb_area_district` VALUES ('402', '旅顺口区', '29');
INSERT INTO `yb_area_district` VALUES ('403', '中山区', '29');
INSERT INTO `yb_area_district` VALUES ('404', '西岗区', '29');
INSERT INTO `yb_area_district` VALUES ('405', '沙河口区', '29');
INSERT INTO `yb_area_district` VALUES ('406', '甘井子区', '29');
INSERT INTO `yb_area_district` VALUES ('407', '金州区', '29');
INSERT INTO `yb_area_district` VALUES ('408', '普兰店市', '29');
INSERT INTO `yb_area_district` VALUES ('409', '瓦房店市', '29');
INSERT INTO `yb_area_district` VALUES ('410', '庄河市', '29');
INSERT INTO `yb_area_district` VALUES ('411', '铁东区', '30');
INSERT INTO `yb_area_district` VALUES ('412', '铁西区', '30');
INSERT INTO `yb_area_district` VALUES ('413', '立山区', '30');
INSERT INTO `yb_area_district` VALUES ('414', '千山区', '30');
INSERT INTO `yb_area_district` VALUES ('415', '台安县', '30');
INSERT INTO `yb_area_district` VALUES ('416', '岫岩满族自治县', '30');
INSERT INTO `yb_area_district` VALUES ('417', '海城市', '30');
INSERT INTO `yb_area_district` VALUES ('418', '新抚区', '31');
INSERT INTO `yb_area_district` VALUES ('419', '东洲区', '31');
INSERT INTO `yb_area_district` VALUES ('420', '望花区', '31');
INSERT INTO `yb_area_district` VALUES ('421', '顺城区', '31');
INSERT INTO `yb_area_district` VALUES ('422', '抚顺县', '31');
INSERT INTO `yb_area_district` VALUES ('423', '新宾满族自治县', '31');
INSERT INTO `yb_area_district` VALUES ('424', '清原满族自治县', '31');
INSERT INTO `yb_area_district` VALUES ('425', '平山区', '32');
INSERT INTO `yb_area_district` VALUES ('426', '溪湖区', '32');
INSERT INTO `yb_area_district` VALUES ('427', '明山区', '32');
INSERT INTO `yb_area_district` VALUES ('428', '南芬区', '32');
INSERT INTO `yb_area_district` VALUES ('429', '本溪满族自治县', '32');
INSERT INTO `yb_area_district` VALUES ('430', '桓仁满族自治县', '32');
INSERT INTO `yb_area_district` VALUES ('431', '元宝区', '33');
INSERT INTO `yb_area_district` VALUES ('432', '振兴区', '33');
INSERT INTO `yb_area_district` VALUES ('433', '振安区', '33');
INSERT INTO `yb_area_district` VALUES ('434', '宽甸满族自治县', '33');
INSERT INTO `yb_area_district` VALUES ('435', '东港市', '33');
INSERT INTO `yb_area_district` VALUES ('436', '凤城市', '33');
INSERT INTO `yb_area_district` VALUES ('437', '古塔区', '34');
INSERT INTO `yb_area_district` VALUES ('438', '凌河区', '34');
INSERT INTO `yb_area_district` VALUES ('439', '太和区', '34');
INSERT INTO `yb_area_district` VALUES ('440', '黑山县', '34');
INSERT INTO `yb_area_district` VALUES ('441', '义县', '34');
INSERT INTO `yb_area_district` VALUES ('442', '凌海市', '34');
INSERT INTO `yb_area_district` VALUES ('443', '北镇市', '34');
INSERT INTO `yb_area_district` VALUES ('444', '站前区', '35');
INSERT INTO `yb_area_district` VALUES ('445', '西市区', '35');
INSERT INTO `yb_area_district` VALUES ('446', '鮁鱼圈区', '35');
INSERT INTO `yb_area_district` VALUES ('447', '老边区', '35');
INSERT INTO `yb_area_district` VALUES ('448', '盖州市', '35');
INSERT INTO `yb_area_district` VALUES ('449', '大石桥市', '35');
INSERT INTO `yb_area_district` VALUES ('450', '海州区', '36');
INSERT INTO `yb_area_district` VALUES ('451', '新邱区', '36');
INSERT INTO `yb_area_district` VALUES ('452', '太平区', '36');
INSERT INTO `yb_area_district` VALUES ('453', '清河门区', '36');
INSERT INTO `yb_area_district` VALUES ('454', '细河区', '36');
INSERT INTO `yb_area_district` VALUES ('455', '阜新蒙古族自治县', '36');
INSERT INTO `yb_area_district` VALUES ('456', '彰武县', '36');
INSERT INTO `yb_area_district` VALUES ('457', '白塔区', '37');
INSERT INTO `yb_area_district` VALUES ('458', '文圣区', '37');
INSERT INTO `yb_area_district` VALUES ('459', '宏伟区', '37');
INSERT INTO `yb_area_district` VALUES ('460', '弓长岭区', '37');
INSERT INTO `yb_area_district` VALUES ('461', '太子河区', '37');
INSERT INTO `yb_area_district` VALUES ('462', '辽阳县', '37');
INSERT INTO `yb_area_district` VALUES ('463', '灯塔市', '37');
INSERT INTO `yb_area_district` VALUES ('464', '双塔区', '38');
INSERT INTO `yb_area_district` VALUES ('465', '龙城区', '38');
INSERT INTO `yb_area_district` VALUES ('466', '朝阳县', '38');
INSERT INTO `yb_area_district` VALUES ('467', '建平县', '38');
INSERT INTO `yb_area_district` VALUES ('468', '喀喇沁左翼蒙古族自治县', '38');
INSERT INTO `yb_area_district` VALUES ('469', '北票市', '38');
INSERT INTO `yb_area_district` VALUES ('470', '凌源市', '38');
INSERT INTO `yb_area_district` VALUES ('471', '双台子区', '39');
INSERT INTO `yb_area_district` VALUES ('472', '兴隆台区', '39');
INSERT INTO `yb_area_district` VALUES ('473', '大洼县', '39');
INSERT INTO `yb_area_district` VALUES ('474', '盘山县', '39');
INSERT INTO `yb_area_district` VALUES ('475', '连山区', '40');
INSERT INTO `yb_area_district` VALUES ('476', '龙港区', '40');
INSERT INTO `yb_area_district` VALUES ('477', '南票区', '40');
INSERT INTO `yb_area_district` VALUES ('478', '绥中县', '40');
INSERT INTO `yb_area_district` VALUES ('479', '建昌县', '40');
INSERT INTO `yb_area_district` VALUES ('480', '兴城市', '40');
INSERT INTO `yb_area_district` VALUES ('481', '南关区', '41');
INSERT INTO `yb_area_district` VALUES ('482', '宽城区', '41');
INSERT INTO `yb_area_district` VALUES ('483', '朝阳区', '41');
INSERT INTO `yb_area_district` VALUES ('484', '二道区', '41');
INSERT INTO `yb_area_district` VALUES ('485', '绿园区', '41');
INSERT INTO `yb_area_district` VALUES ('486', '双阳区', '41');
INSERT INTO `yb_area_district` VALUES ('487', '农安县', '41');
INSERT INTO `yb_area_district` VALUES ('488', '九台市', '41');
INSERT INTO `yb_area_district` VALUES ('489', '榆树市', '41');
INSERT INTO `yb_area_district` VALUES ('490', '德惠市', '41');
INSERT INTO `yb_area_district` VALUES ('491', '昌邑区', '42');
INSERT INTO `yb_area_district` VALUES ('492', '龙潭区', '42');
INSERT INTO `yb_area_district` VALUES ('493', '船营区', '42');
INSERT INTO `yb_area_district` VALUES ('494', '丰满区', '42');
INSERT INTO `yb_area_district` VALUES ('495', '永吉县', '42');
INSERT INTO `yb_area_district` VALUES ('496', '蛟河市', '42');
INSERT INTO `yb_area_district` VALUES ('497', '桦甸市', '42');
INSERT INTO `yb_area_district` VALUES ('498', '舒兰市', '42');
INSERT INTO `yb_area_district` VALUES ('499', '磐石市', '42');
INSERT INTO `yb_area_district` VALUES ('500', '延吉市', '43');
INSERT INTO `yb_area_district` VALUES ('501', '图们市', '43');
INSERT INTO `yb_area_district` VALUES ('502', '敦化市', '43');
INSERT INTO `yb_area_district` VALUES ('503', '珲春市', '43');
INSERT INTO `yb_area_district` VALUES ('504', '龙井市', '43');
INSERT INTO `yb_area_district` VALUES ('505', '和龙市', '43');
INSERT INTO `yb_area_district` VALUES ('506', '汪清县', '43');
INSERT INTO `yb_area_district` VALUES ('507', '安图县', '43');
INSERT INTO `yb_area_district` VALUES ('508', '铁西区', '44');
INSERT INTO `yb_area_district` VALUES ('509', '铁东区', '44');
INSERT INTO `yb_area_district` VALUES ('510', '梨树县', '44');
INSERT INTO `yb_area_district` VALUES ('511', '伊通满族自治县', '44');
INSERT INTO `yb_area_district` VALUES ('512', '公主岭市', '44');
INSERT INTO `yb_area_district` VALUES ('513', '双辽市', '44');
INSERT INTO `yb_area_district` VALUES ('514', '东昌区', '45');
INSERT INTO `yb_area_district` VALUES ('515', '二道江区', '45');
INSERT INTO `yb_area_district` VALUES ('516', '通化县', '45');
INSERT INTO `yb_area_district` VALUES ('517', '辉南县', '45');
INSERT INTO `yb_area_district` VALUES ('518', '柳河县', '45');
INSERT INTO `yb_area_district` VALUES ('519', '梅河口市', '45');
INSERT INTO `yb_area_district` VALUES ('520', '集安市', '45');
INSERT INTO `yb_area_district` VALUES ('521', '洮北区', '46');
INSERT INTO `yb_area_district` VALUES ('522', '镇赉县', '46');
INSERT INTO `yb_area_district` VALUES ('523', '通榆县', '46');
INSERT INTO `yb_area_district` VALUES ('524', '洮南市', '46');
INSERT INTO `yb_area_district` VALUES ('525', '大安市', '46');
INSERT INTO `yb_area_district` VALUES ('526', '龙山区', '47');
INSERT INTO `yb_area_district` VALUES ('527', '西安区', '47');
INSERT INTO `yb_area_district` VALUES ('528', '东丰县', '47');
INSERT INTO `yb_area_district` VALUES ('529', '东辽县', '47');
INSERT INTO `yb_area_district` VALUES ('530', '宁江区', '48');
INSERT INTO `yb_area_district` VALUES ('531', '前郭尔罗斯蒙古族自治县', '48');
INSERT INTO `yb_area_district` VALUES ('532', '长岭县', '48');
INSERT INTO `yb_area_district` VALUES ('533', '乾安县', '48');
INSERT INTO `yb_area_district` VALUES ('534', '扶余县', '48');
INSERT INTO `yb_area_district` VALUES ('535', '八道江区', '49');
INSERT INTO `yb_area_district` VALUES ('536', '江源区', '49');
INSERT INTO `yb_area_district` VALUES ('537', '抚松县', '49');
INSERT INTO `yb_area_district` VALUES ('538', '靖宇县', '49');
INSERT INTO `yb_area_district` VALUES ('539', '长白朝鲜族自治县', '49');
INSERT INTO `yb_area_district` VALUES ('540', '临江市', '49');
INSERT INTO `yb_area_district` VALUES ('541', '道里区', '50');
INSERT INTO `yb_area_district` VALUES ('542', '南岗区', '50');
INSERT INTO `yb_area_district` VALUES ('543', '道外区', '50');
INSERT INTO `yb_area_district` VALUES ('544', '平房区', '50');
INSERT INTO `yb_area_district` VALUES ('545', '松北区', '50');
INSERT INTO `yb_area_district` VALUES ('546', '香坊区', '50');
INSERT INTO `yb_area_district` VALUES ('547', '呼兰区', '50');
INSERT INTO `yb_area_district` VALUES ('548', '阿城区', '50');
INSERT INTO `yb_area_district` VALUES ('549', '依兰县', '50');
INSERT INTO `yb_area_district` VALUES ('550', '方正县', '50');
INSERT INTO `yb_area_district` VALUES ('551', '宾县', '50');
INSERT INTO `yb_area_district` VALUES ('552', '巴彦县', '50');
INSERT INTO `yb_area_district` VALUES ('553', '木兰县', '50');
INSERT INTO `yb_area_district` VALUES ('554', '通河县', '50');
INSERT INTO `yb_area_district` VALUES ('555', '延寿县', '50');
INSERT INTO `yb_area_district` VALUES ('556', '双城市', '50');
INSERT INTO `yb_area_district` VALUES ('557', '尚志市', '50');
INSERT INTO `yb_area_district` VALUES ('558', '五常市', '50');
INSERT INTO `yb_area_district` VALUES ('559', '龙沙区', '51');
INSERT INTO `yb_area_district` VALUES ('560', '建华区', '51');
INSERT INTO `yb_area_district` VALUES ('561', '铁锋区', '51');
INSERT INTO `yb_area_district` VALUES ('562', '昂昂溪区', '51');
INSERT INTO `yb_area_district` VALUES ('563', '富拉尔基区', '51');
INSERT INTO `yb_area_district` VALUES ('564', '碾子山区', '51');
INSERT INTO `yb_area_district` VALUES ('565', '梅里斯达翰尔族区', '51');
INSERT INTO `yb_area_district` VALUES ('566', '龙江县', '51');
INSERT INTO `yb_area_district` VALUES ('567', '依安县', '51');
INSERT INTO `yb_area_district` VALUES ('568', '泰来县', '51');
INSERT INTO `yb_area_district` VALUES ('569', '甘南县', '51');
INSERT INTO `yb_area_district` VALUES ('570', '富裕县', '51');
INSERT INTO `yb_area_district` VALUES ('571', '克山县', '51');
INSERT INTO `yb_area_district` VALUES ('572', '克东县', '51');
INSERT INTO `yb_area_district` VALUES ('573', '拜泉县', '51');
INSERT INTO `yb_area_district` VALUES ('574', '讷河市', '51');
INSERT INTO `yb_area_district` VALUES ('575', '鸡冠区', '52');
INSERT INTO `yb_area_district` VALUES ('576', '恒山区', '52');
INSERT INTO `yb_area_district` VALUES ('577', '滴道区', '52');
INSERT INTO `yb_area_district` VALUES ('578', '梨树区', '52');
INSERT INTO `yb_area_district` VALUES ('579', '城子河区', '52');
INSERT INTO `yb_area_district` VALUES ('580', '麻山区', '52');
INSERT INTO `yb_area_district` VALUES ('581', '鸡东县', '52');
INSERT INTO `yb_area_district` VALUES ('582', '虎林市', '52');
INSERT INTO `yb_area_district` VALUES ('583', '密山市', '52');
INSERT INTO `yb_area_district` VALUES ('584', '东安区', '53');
INSERT INTO `yb_area_district` VALUES ('585', '阳明区', '53');
INSERT INTO `yb_area_district` VALUES ('586', '爱民区', '53');
INSERT INTO `yb_area_district` VALUES ('587', '西安区', '53');
INSERT INTO `yb_area_district` VALUES ('588', '东宁县', '53');
INSERT INTO `yb_area_district` VALUES ('589', '林口县', '53');
INSERT INTO `yb_area_district` VALUES ('590', '绥芬河市', '53');
INSERT INTO `yb_area_district` VALUES ('591', '海林市', '53');
INSERT INTO `yb_area_district` VALUES ('592', '宁安市', '53');
INSERT INTO `yb_area_district` VALUES ('593', '穆棱市', '53');
INSERT INTO `yb_area_district` VALUES ('594', '新兴区', '54');
INSERT INTO `yb_area_district` VALUES ('595', '桃山区', '54');
INSERT INTO `yb_area_district` VALUES ('596', '茄子河区', '54');
INSERT INTO `yb_area_district` VALUES ('597', '勃利县', '54');
INSERT INTO `yb_area_district` VALUES ('598', '向阳区', '55');
INSERT INTO `yb_area_district` VALUES ('599', '前进区', '55');
INSERT INTO `yb_area_district` VALUES ('600', '东风区', '55');
INSERT INTO `yb_area_district` VALUES ('601', '桦南县', '55');
INSERT INTO `yb_area_district` VALUES ('602', '桦川县', '55');
INSERT INTO `yb_area_district` VALUES ('603', '汤原县', '55');
INSERT INTO `yb_area_district` VALUES ('604', '抚远县', '55');
INSERT INTO `yb_area_district` VALUES ('605', '同江市', '55');
INSERT INTO `yb_area_district` VALUES ('606', '富锦市', '55');
INSERT INTO `yb_area_district` VALUES ('607', '向阳区', '56');
INSERT INTO `yb_area_district` VALUES ('608', '工农区', '56');
INSERT INTO `yb_area_district` VALUES ('609', '南山区', '56');
INSERT INTO `yb_area_district` VALUES ('610', '兴安区', '56');
INSERT INTO `yb_area_district` VALUES ('611', '东山区', '56');
INSERT INTO `yb_area_district` VALUES ('612', '兴山区', '56');
INSERT INTO `yb_area_district` VALUES ('613', '萝北县', '56');
INSERT INTO `yb_area_district` VALUES ('614', '绥滨县', '56');
INSERT INTO `yb_area_district` VALUES ('615', '尖山区', '57');
INSERT INTO `yb_area_district` VALUES ('616', '岭东区', '57');
INSERT INTO `yb_area_district` VALUES ('617', '四方台区', '57');
INSERT INTO `yb_area_district` VALUES ('618', '宝山区', '57');
INSERT INTO `yb_area_district` VALUES ('619', '集贤县', '57');
INSERT INTO `yb_area_district` VALUES ('620', '友谊县', '57');
INSERT INTO `yb_area_district` VALUES ('621', '宝清县', '57');
INSERT INTO `yb_area_district` VALUES ('622', '饶河县', '57');
INSERT INTO `yb_area_district` VALUES ('623', '北林区', '58');
INSERT INTO `yb_area_district` VALUES ('624', '望奎县', '58');
INSERT INTO `yb_area_district` VALUES ('625', '兰西县', '58');
INSERT INTO `yb_area_district` VALUES ('626', '青冈县', '58');
INSERT INTO `yb_area_district` VALUES ('627', '庆安县', '58');
INSERT INTO `yb_area_district` VALUES ('628', '明水县', '58');
INSERT INTO `yb_area_district` VALUES ('629', '绥棱县', '58');
INSERT INTO `yb_area_district` VALUES ('630', '安达市', '58');
INSERT INTO `yb_area_district` VALUES ('631', '肇东市', '58');
INSERT INTO `yb_area_district` VALUES ('632', '海伦市', '58');
INSERT INTO `yb_area_district` VALUES ('633', '爱辉区', '59');
INSERT INTO `yb_area_district` VALUES ('634', '嫩江县', '59');
INSERT INTO `yb_area_district` VALUES ('635', '逊克县', '59');
INSERT INTO `yb_area_district` VALUES ('636', '孙吴县', '59');
INSERT INTO `yb_area_district` VALUES ('637', '北安市', '59');
INSERT INTO `yb_area_district` VALUES ('638', '五大连池市', '59');
INSERT INTO `yb_area_district` VALUES ('639', '呼玛县', '60');
INSERT INTO `yb_area_district` VALUES ('640', '塔河县', '60');
INSERT INTO `yb_area_district` VALUES ('641', '漠河县', '60');
INSERT INTO `yb_area_district` VALUES ('642', '伊春区', '61');
INSERT INTO `yb_area_district` VALUES ('643', '南岔区', '61');
INSERT INTO `yb_area_district` VALUES ('644', '友好区', '61');
INSERT INTO `yb_area_district` VALUES ('645', '西林区', '61');
INSERT INTO `yb_area_district` VALUES ('646', '翠峦区', '61');
INSERT INTO `yb_area_district` VALUES ('647', '新青区', '61');
INSERT INTO `yb_area_district` VALUES ('648', '美溪区', '61');
INSERT INTO `yb_area_district` VALUES ('649', '金山屯区', '61');
INSERT INTO `yb_area_district` VALUES ('650', '五营区', '61');
INSERT INTO `yb_area_district` VALUES ('651', '乌马河区', '61');
INSERT INTO `yb_area_district` VALUES ('652', '汤旺河区', '61');
INSERT INTO `yb_area_district` VALUES ('653', '带岭区', '61');
INSERT INTO `yb_area_district` VALUES ('654', '乌伊岭区', '61');
INSERT INTO `yb_area_district` VALUES ('655', '红星区', '61');
INSERT INTO `yb_area_district` VALUES ('656', '上甘岭区', '61');
INSERT INTO `yb_area_district` VALUES ('657', '嘉荫县', '61');
INSERT INTO `yb_area_district` VALUES ('658', '铁力市', '61');
INSERT INTO `yb_area_district` VALUES ('659', '萨尔图区', '62');
INSERT INTO `yb_area_district` VALUES ('660', '龙凤区', '62');
INSERT INTO `yb_area_district` VALUES ('661', '让胡路区', '62');
INSERT INTO `yb_area_district` VALUES ('662', '红岗区', '62');
INSERT INTO `yb_area_district` VALUES ('663', '大同区', '62');
INSERT INTO `yb_area_district` VALUES ('664', '肇州县', '62');
INSERT INTO `yb_area_district` VALUES ('665', '肇源县', '62');
INSERT INTO `yb_area_district` VALUES ('666', '林甸县', '62');
INSERT INTO `yb_area_district` VALUES ('667', '杜尔伯特蒙古族自治县', '62');
INSERT INTO `yb_area_district` VALUES ('668', '江宁区', '63');
INSERT INTO `yb_area_district` VALUES ('669', '浦口区', '63');
INSERT INTO `yb_area_district` VALUES ('670', '玄武区', '63');
INSERT INTO `yb_area_district` VALUES ('671', '白下区', '63');
INSERT INTO `yb_area_district` VALUES ('672', '秦淮区', '63');
INSERT INTO `yb_area_district` VALUES ('673', '建邺区', '63');
INSERT INTO `yb_area_district` VALUES ('674', '鼓楼区', '63');
INSERT INTO `yb_area_district` VALUES ('675', '下关区', '63');
INSERT INTO `yb_area_district` VALUES ('676', '栖霞区', '63');
INSERT INTO `yb_area_district` VALUES ('677', '雨花台区', '63');
INSERT INTO `yb_area_district` VALUES ('678', '六合区', '63');
INSERT INTO `yb_area_district` VALUES ('679', '溧水县', '63');
INSERT INTO `yb_area_district` VALUES ('680', '高淳县', '63');
INSERT INTO `yb_area_district` VALUES ('681', '崇安区', '64');
INSERT INTO `yb_area_district` VALUES ('682', '南长区', '64');
INSERT INTO `yb_area_district` VALUES ('683', '北塘区', '64');
INSERT INTO `yb_area_district` VALUES ('684', '锡山区', '64');
INSERT INTO `yb_area_district` VALUES ('685', '惠山区', '64');
INSERT INTO `yb_area_district` VALUES ('686', '滨湖区', '64');
INSERT INTO `yb_area_district` VALUES ('687', '江阴市', '64');
INSERT INTO `yb_area_district` VALUES ('688', '宜兴市', '64');
INSERT INTO `yb_area_district` VALUES ('689', '京口区', '65');
INSERT INTO `yb_area_district` VALUES ('690', '润州区', '65');
INSERT INTO `yb_area_district` VALUES ('691', '丹徒区', '65');
INSERT INTO `yb_area_district` VALUES ('692', '丹阳市', '65');
INSERT INTO `yb_area_district` VALUES ('693', '扬中市', '65');
INSERT INTO `yb_area_district` VALUES ('694', '句容市', '65');
INSERT INTO `yb_area_district` VALUES ('695', '沧浪区', '66');
INSERT INTO `yb_area_district` VALUES ('696', '常熟市', '66');
INSERT INTO `yb_area_district` VALUES ('697', '平江区', '66');
INSERT INTO `yb_area_district` VALUES ('698', '金阊区', '66');
INSERT INTO `yb_area_district` VALUES ('699', '虎丘区', '66');
INSERT INTO `yb_area_district` VALUES ('700', '昆山市', '66');
INSERT INTO `yb_area_district` VALUES ('701', '太仓市', '66');
INSERT INTO `yb_area_district` VALUES ('702', '吴江市', '66');
INSERT INTO `yb_area_district` VALUES ('703', '吴中区', '66');
INSERT INTO `yb_area_district` VALUES ('704', '相城区', '66');
INSERT INTO `yb_area_district` VALUES ('705', '张家港市', '66');
INSERT INTO `yb_area_district` VALUES ('706', '崇川区', '67');
INSERT INTO `yb_area_district` VALUES ('707', '港闸区', '67');
INSERT INTO `yb_area_district` VALUES ('708', '海安县', '67');
INSERT INTO `yb_area_district` VALUES ('709', '如东县', '67');
INSERT INTO `yb_area_district` VALUES ('710', '启东市', '67');
INSERT INTO `yb_area_district` VALUES ('711', '如皋市', '67');
INSERT INTO `yb_area_district` VALUES ('712', '通州市', '67');
INSERT INTO `yb_area_district` VALUES ('713', '海门市', '67');
INSERT INTO `yb_area_district` VALUES ('714', '高邮市', '68');
INSERT INTO `yb_area_district` VALUES ('715', '广陵区', '68');
INSERT INTO `yb_area_district` VALUES ('716', '邗江区', '68');
INSERT INTO `yb_area_district` VALUES ('717', '维扬区', '68');
INSERT INTO `yb_area_district` VALUES ('718', '宝应县', '68');
INSERT INTO `yb_area_district` VALUES ('719', '江都市', '68');
INSERT INTO `yb_area_district` VALUES ('720', '仪征市', '68');
INSERT INTO `yb_area_district` VALUES ('721', '亭湖区', '69');
INSERT INTO `yb_area_district` VALUES ('722', '盐都区', '69');
INSERT INTO `yb_area_district` VALUES ('723', '响水县', '69');
INSERT INTO `yb_area_district` VALUES ('724', '滨海县', '69');
INSERT INTO `yb_area_district` VALUES ('725', '阜宁县', '69');
INSERT INTO `yb_area_district` VALUES ('726', '射阳县', '69');
INSERT INTO `yb_area_district` VALUES ('727', '建湖县', '69');
INSERT INTO `yb_area_district` VALUES ('728', '东台市', '69');
INSERT INTO `yb_area_district` VALUES ('729', '大丰市', '69');
INSERT INTO `yb_area_district` VALUES ('730', '鼓楼区', '70');
INSERT INTO `yb_area_district` VALUES ('731', '云龙区', '70');
INSERT INTO `yb_area_district` VALUES ('732', '九里区', '70');
INSERT INTO `yb_area_district` VALUES ('733', '贾汪区', '70');
INSERT INTO `yb_area_district` VALUES ('734', '泉山区', '70');
INSERT INTO `yb_area_district` VALUES ('735', '丰县', '70');
INSERT INTO `yb_area_district` VALUES ('736', '沛县', '70');
INSERT INTO `yb_area_district` VALUES ('737', '铜山县', '70');
INSERT INTO `yb_area_district` VALUES ('738', '睢宁县', '70');
INSERT INTO `yb_area_district` VALUES ('739', '新沂市', '70');
INSERT INTO `yb_area_district` VALUES ('740', '邳州市', '70');
INSERT INTO `yb_area_district` VALUES ('741', '清河区', '71');
INSERT INTO `yb_area_district` VALUES ('742', '楚州区', '71');
INSERT INTO `yb_area_district` VALUES ('743', '淮阴区', '71');
INSERT INTO `yb_area_district` VALUES ('744', '清浦区', '71');
INSERT INTO `yb_area_district` VALUES ('745', '涟水县', '71');
INSERT INTO `yb_area_district` VALUES ('746', '洪泽县', '71');
INSERT INTO `yb_area_district` VALUES ('747', '盱眙县', '71');
INSERT INTO `yb_area_district` VALUES ('748', '金湖县', '71');
INSERT INTO `yb_area_district` VALUES ('749', '连云区', '72');
INSERT INTO `yb_area_district` VALUES ('750', '新浦区', '72');
INSERT INTO `yb_area_district` VALUES ('751', '海州区', '72');
INSERT INTO `yb_area_district` VALUES ('752', '赣榆县', '72');
INSERT INTO `yb_area_district` VALUES ('753', '东海县', '72');
INSERT INTO `yb_area_district` VALUES ('754', '灌云县', '72');
INSERT INTO `yb_area_district` VALUES ('755', '灌南县', '72');
INSERT INTO `yb_area_district` VALUES ('756', '天宁区', '73');
INSERT INTO `yb_area_district` VALUES ('757', '钟楼区', '73');
INSERT INTO `yb_area_district` VALUES ('758', '戚墅堰区', '73');
INSERT INTO `yb_area_district` VALUES ('759', '新北区', '73');
INSERT INTO `yb_area_district` VALUES ('760', '武进区', '73');
INSERT INTO `yb_area_district` VALUES ('761', '溧阳市', '73');
INSERT INTO `yb_area_district` VALUES ('762', '金坛市', '73');
INSERT INTO `yb_area_district` VALUES ('763', '海陵区', '74');
INSERT INTO `yb_area_district` VALUES ('764', '高港区', '74');
INSERT INTO `yb_area_district` VALUES ('765', '兴化市', '74');
INSERT INTO `yb_area_district` VALUES ('766', '靖江市', '74');
INSERT INTO `yb_area_district` VALUES ('767', '泰兴市', '74');
INSERT INTO `yb_area_district` VALUES ('768', '姜堰市', '74');
INSERT INTO `yb_area_district` VALUES ('769', '宿城区', '75');
INSERT INTO `yb_area_district` VALUES ('770', '宿豫区', '75');
INSERT INTO `yb_area_district` VALUES ('771', '沭阳县', '75');
INSERT INTO `yb_area_district` VALUES ('772', '泗阳县', '75');
INSERT INTO `yb_area_district` VALUES ('773', '泗洪县', '75');
INSERT INTO `yb_area_district` VALUES ('774', '定海区', '76');
INSERT INTO `yb_area_district` VALUES ('775', '普陀区', '76');
INSERT INTO `yb_area_district` VALUES ('776', '岱山县', '76');
INSERT INTO `yb_area_district` VALUES ('777', '嵊泗县', '76');
INSERT INTO `yb_area_district` VALUES ('778', '柯城区', '77');
INSERT INTO `yb_area_district` VALUES ('779', '衢江区', '77');
INSERT INTO `yb_area_district` VALUES ('780', '常山县', '77');
INSERT INTO `yb_area_district` VALUES ('781', '开化县', '77');
INSERT INTO `yb_area_district` VALUES ('782', '龙游县', '77');
INSERT INTO `yb_area_district` VALUES ('783', '江山市', '77');
INSERT INTO `yb_area_district` VALUES ('784', '上城区', '78');
INSERT INTO `yb_area_district` VALUES ('785', '下城区', '78');
INSERT INTO `yb_area_district` VALUES ('786', '江干区', '78');
INSERT INTO `yb_area_district` VALUES ('787', '拱墅区', '78');
INSERT INTO `yb_area_district` VALUES ('788', '西湖区', '78');
INSERT INTO `yb_area_district` VALUES ('789', '滨江区', '78');
INSERT INTO `yb_area_district` VALUES ('790', '余杭区', '78');
INSERT INTO `yb_area_district` VALUES ('791', '桐庐县', '78');
INSERT INTO `yb_area_district` VALUES ('792', '淳安县', '78');
INSERT INTO `yb_area_district` VALUES ('793', '建德市', '78');
INSERT INTO `yb_area_district` VALUES ('794', '富阳市', '78');
INSERT INTO `yb_area_district` VALUES ('795', '临安市', '78');
INSERT INTO `yb_area_district` VALUES ('796', '萧山区', '78');
INSERT INTO `yb_area_district` VALUES ('797', '吴兴区', '79');
INSERT INTO `yb_area_district` VALUES ('798', '南浔区', '79');
INSERT INTO `yb_area_district` VALUES ('799', '德清县', '79');
INSERT INTO `yb_area_district` VALUES ('800', '长兴县', '79');
INSERT INTO `yb_area_district` VALUES ('801', '安吉县', '79');
INSERT INTO `yb_area_district` VALUES ('802', ' 南湖区', '80');
INSERT INTO `yb_area_district` VALUES ('803', ' 秀洲区', '80');
INSERT INTO `yb_area_district` VALUES ('804', ' 嘉善县', '80');
INSERT INTO `yb_area_district` VALUES ('805', ' 海盐县', '80');
INSERT INTO `yb_area_district` VALUES ('806', ' 海宁市', '80');
INSERT INTO `yb_area_district` VALUES ('807', ' 平湖市', '80');
INSERT INTO `yb_area_district` VALUES ('808', ' 桐乡市 ', '80');
INSERT INTO `yb_area_district` VALUES ('809', '海曙区', '81');
INSERT INTO `yb_area_district` VALUES ('810', '江东区', '81');
INSERT INTO `yb_area_district` VALUES ('811', '江北区', '81');
INSERT INTO `yb_area_district` VALUES ('812', '北仑区', '81');
INSERT INTO `yb_area_district` VALUES ('813', '镇海区', '81');
INSERT INTO `yb_area_district` VALUES ('814', '鄞州区', '81');
INSERT INTO `yb_area_district` VALUES ('815', '象山县', '81');
INSERT INTO `yb_area_district` VALUES ('816', '宁海县', '81');
INSERT INTO `yb_area_district` VALUES ('817', '余姚市', '81');
INSERT INTO `yb_area_district` VALUES ('818', '慈溪市', '81');
INSERT INTO `yb_area_district` VALUES ('819', '奉化市', '81');
INSERT INTO `yb_area_district` VALUES ('820', '越城区', '82');
INSERT INTO `yb_area_district` VALUES ('821', '绍兴县', '82');
INSERT INTO `yb_area_district` VALUES ('822', '新昌县', '82');
INSERT INTO `yb_area_district` VALUES ('823', '诸暨市', '82');
INSERT INTO `yb_area_district` VALUES ('824', '上虞市', '82');
INSERT INTO `yb_area_district` VALUES ('825', '嵊州市', '82');
INSERT INTO `yb_area_district` VALUES ('826', '鹿城区', '83');
INSERT INTO `yb_area_district` VALUES ('827', '龙湾区', '83');
INSERT INTO `yb_area_district` VALUES ('828', '瓯海区', '83');
INSERT INTO `yb_area_district` VALUES ('829', '洞头县', '83');
INSERT INTO `yb_area_district` VALUES ('830', '永嘉县', '83');
INSERT INTO `yb_area_district` VALUES ('831', '平阳县', '83');
INSERT INTO `yb_area_district` VALUES ('832', '苍南县', '83');
INSERT INTO `yb_area_district` VALUES ('833', '文成县', '83');
INSERT INTO `yb_area_district` VALUES ('834', '泰顺县', '83');
INSERT INTO `yb_area_district` VALUES ('835', '瑞安市', '83');
INSERT INTO `yb_area_district` VALUES ('836', '乐清市', '83');
INSERT INTO `yb_area_district` VALUES ('837', '莲都区', '84');
INSERT INTO `yb_area_district` VALUES ('838', '青田县', '84');
INSERT INTO `yb_area_district` VALUES ('839', '缙云县', '84');
INSERT INTO `yb_area_district` VALUES ('840', '遂昌县', '84');
INSERT INTO `yb_area_district` VALUES ('841', '松阳县', '84');
INSERT INTO `yb_area_district` VALUES ('842', '云和县', '84');
INSERT INTO `yb_area_district` VALUES ('843', '庆元县', '84');
INSERT INTO `yb_area_district` VALUES ('844', '景宁畲族自治县', '84');
INSERT INTO `yb_area_district` VALUES ('845', '龙泉市', '84');
INSERT INTO `yb_area_district` VALUES ('846', '婺城区', '85');
INSERT INTO `yb_area_district` VALUES ('847', '金东区', '85');
INSERT INTO `yb_area_district` VALUES ('848', '武义县', '85');
INSERT INTO `yb_area_district` VALUES ('849', '浦江县', '85');
INSERT INTO `yb_area_district` VALUES ('850', '磐安县', '85');
INSERT INTO `yb_area_district` VALUES ('851', '兰溪市', '85');
INSERT INTO `yb_area_district` VALUES ('852', '义乌市', '85');
INSERT INTO `yb_area_district` VALUES ('853', '东阳市', '85');
INSERT INTO `yb_area_district` VALUES ('854', '永康市', '85');
INSERT INTO `yb_area_district` VALUES ('855', '椒江区', '86');
INSERT INTO `yb_area_district` VALUES ('856', '黄岩区', '86');
INSERT INTO `yb_area_district` VALUES ('857', '路桥区', '86');
INSERT INTO `yb_area_district` VALUES ('858', '玉环县', '86');
INSERT INTO `yb_area_district` VALUES ('859', '三门县', '86');
INSERT INTO `yb_area_district` VALUES ('860', '天台县', '86');
INSERT INTO `yb_area_district` VALUES ('861', '仙居县', '86');
INSERT INTO `yb_area_district` VALUES ('862', '温岭市', '86');
INSERT INTO `yb_area_district` VALUES ('863', '临海市', '86');
INSERT INTO `yb_area_district` VALUES ('864', '瑶海区', '87');
INSERT INTO `yb_area_district` VALUES ('865', '庐阳区', '87');
INSERT INTO `yb_area_district` VALUES ('866', '蜀山区', '87');
INSERT INTO `yb_area_district` VALUES ('867', '包河区', '87');
INSERT INTO `yb_area_district` VALUES ('868', '长丰县', '87');
INSERT INTO `yb_area_district` VALUES ('869', '肥东县', '87');
INSERT INTO `yb_area_district` VALUES ('870', '肥西县', '87');
INSERT INTO `yb_area_district` VALUES ('871', '镜湖区', '88');
INSERT INTO `yb_area_district` VALUES ('872', '弋江区', '88');
INSERT INTO `yb_area_district` VALUES ('873', '鸠江区', '88');
INSERT INTO `yb_area_district` VALUES ('874', '三山区', '88');
INSERT INTO `yb_area_district` VALUES ('875', '芜湖县', '88');
INSERT INTO `yb_area_district` VALUES ('876', '繁昌县', '88');
INSERT INTO `yb_area_district` VALUES ('877', '南陵县', '88');
INSERT INTO `yb_area_district` VALUES ('878', '龙子湖区', '89');
INSERT INTO `yb_area_district` VALUES ('879', '蚌山区', '89');
INSERT INTO `yb_area_district` VALUES ('880', '禹会区', '89');
INSERT INTO `yb_area_district` VALUES ('881', '淮上区', '89');
INSERT INTO `yb_area_district` VALUES ('882', '怀远县', '89');
INSERT INTO `yb_area_district` VALUES ('883', '五河县', '89');
INSERT INTO `yb_area_district` VALUES ('884', '固镇县', '89');
INSERT INTO `yb_area_district` VALUES ('885', '大通区', '90');
INSERT INTO `yb_area_district` VALUES ('886', '田家庵区', '90');
INSERT INTO `yb_area_district` VALUES ('887', '谢家集区', '90');
INSERT INTO `yb_area_district` VALUES ('888', '八公山区', '90');
INSERT INTO `yb_area_district` VALUES ('889', '潘集区', '90');
INSERT INTO `yb_area_district` VALUES ('890', '凤台县', '90');
INSERT INTO `yb_area_district` VALUES ('891', '金家庄区', '91');
INSERT INTO `yb_area_district` VALUES ('892', '花山区', '91');
INSERT INTO `yb_area_district` VALUES ('893', '雨山区', '91');
INSERT INTO `yb_area_district` VALUES ('894', '当涂县', '91');
INSERT INTO `yb_area_district` VALUES ('895', '杜集区', '92');
INSERT INTO `yb_area_district` VALUES ('896', '相山区', '92');
INSERT INTO `yb_area_district` VALUES ('897', '烈山区', '92');
INSERT INTO `yb_area_district` VALUES ('898', '濉溪县 ', '92');
INSERT INTO `yb_area_district` VALUES ('899', '铜官山区', '93');
INSERT INTO `yb_area_district` VALUES ('900', '狮子山区', '93');
INSERT INTO `yb_area_district` VALUES ('901', '铜陵县', '93');
INSERT INTO `yb_area_district` VALUES ('902', '迎江区', '94');
INSERT INTO `yb_area_district` VALUES ('903', '大观区', '94');
INSERT INTO `yb_area_district` VALUES ('904', '宜秀区', '94');
INSERT INTO `yb_area_district` VALUES ('905', '怀宁县', '94');
INSERT INTO `yb_area_district` VALUES ('906', '枞阳县', '94');
INSERT INTO `yb_area_district` VALUES ('907', '潜山县', '94');
INSERT INTO `yb_area_district` VALUES ('908', '太湖县', '94');
INSERT INTO `yb_area_district` VALUES ('909', '宿松县', '94');
INSERT INTO `yb_area_district` VALUES ('910', '望江县', '94');
INSERT INTO `yb_area_district` VALUES ('911', '岳西县', '94');
INSERT INTO `yb_area_district` VALUES ('912', '桐城市', '94');
INSERT INTO `yb_area_district` VALUES ('913', '屯溪区', '95');
INSERT INTO `yb_area_district` VALUES ('914', '黄山区', '95');
INSERT INTO `yb_area_district` VALUES ('915', '徽州区', '95');
INSERT INTO `yb_area_district` VALUES ('916', '歙县', '95');
INSERT INTO `yb_area_district` VALUES ('917', '休宁县', '95');
INSERT INTO `yb_area_district` VALUES ('918', '黟县', '95');
INSERT INTO `yb_area_district` VALUES ('919', '祁门县', '95');
INSERT INTO `yb_area_district` VALUES ('920', '琅琊区', '96');
INSERT INTO `yb_area_district` VALUES ('921', '南谯区', '96');
INSERT INTO `yb_area_district` VALUES ('922', '来安县', '96');
INSERT INTO `yb_area_district` VALUES ('923', '全椒县', '96');
INSERT INTO `yb_area_district` VALUES ('924', '定远县', '96');
INSERT INTO `yb_area_district` VALUES ('925', '凤阳县', '96');
INSERT INTO `yb_area_district` VALUES ('926', '天长市', '96');
INSERT INTO `yb_area_district` VALUES ('927', '明光市', '96');
INSERT INTO `yb_area_district` VALUES ('928', '颍州区', '97');
INSERT INTO `yb_area_district` VALUES ('929', '颍东区', '97');
INSERT INTO `yb_area_district` VALUES ('930', '颍泉区', '97');
INSERT INTO `yb_area_district` VALUES ('931', '临泉县', '97');
INSERT INTO `yb_area_district` VALUES ('932', '太和县', '97');
INSERT INTO `yb_area_district` VALUES ('933', '阜南县', '97');
INSERT INTO `yb_area_district` VALUES ('934', '颍上县', '97');
INSERT INTO `yb_area_district` VALUES ('935', '界首市', '97');
INSERT INTO `yb_area_district` VALUES ('936', '埇桥区', '98');
INSERT INTO `yb_area_district` VALUES ('937', '砀山县', '98');
INSERT INTO `yb_area_district` VALUES ('938', '萧县', '98');
INSERT INTO `yb_area_district` VALUES ('939', '灵璧县', '98');
INSERT INTO `yb_area_district` VALUES ('940', '泗县 ', '98');
INSERT INTO `yb_area_district` VALUES ('941', '居巢区', '99');
INSERT INTO `yb_area_district` VALUES ('942', '庐江县', '99');
INSERT INTO `yb_area_district` VALUES ('943', '无为县', '99');
INSERT INTO `yb_area_district` VALUES ('944', '含山县', '99');
INSERT INTO `yb_area_district` VALUES ('945', '和县 ', '99');
INSERT INTO `yb_area_district` VALUES ('946', '金安区', '100');
INSERT INTO `yb_area_district` VALUES ('947', '裕安区', '100');
INSERT INTO `yb_area_district` VALUES ('948', '寿县', '100');
INSERT INTO `yb_area_district` VALUES ('949', '霍邱县', '100');
INSERT INTO `yb_area_district` VALUES ('950', '舒城县', '100');
INSERT INTO `yb_area_district` VALUES ('951', '金寨县', '100');
INSERT INTO `yb_area_district` VALUES ('952', '霍山县', '100');
INSERT INTO `yb_area_district` VALUES ('953', '谯城区', '101');
INSERT INTO `yb_area_district` VALUES ('954', '涡阳县', '101');
INSERT INTO `yb_area_district` VALUES ('955', '蒙城县', '101');
INSERT INTO `yb_area_district` VALUES ('956', '利辛县', '101');
INSERT INTO `yb_area_district` VALUES ('957', '贵池区', '102');
INSERT INTO `yb_area_district` VALUES ('958', '东至县', '102');
INSERT INTO `yb_area_district` VALUES ('959', '石台县', '102');
INSERT INTO `yb_area_district` VALUES ('960', '青阳县', '102');
INSERT INTO `yb_area_district` VALUES ('961', '宣州区', '103');
INSERT INTO `yb_area_district` VALUES ('962', '郎溪县', '103');
INSERT INTO `yb_area_district` VALUES ('963', '广德县', '103');
INSERT INTO `yb_area_district` VALUES ('964', '泾县', '103');
INSERT INTO `yb_area_district` VALUES ('965', '绩溪县', '103');
INSERT INTO `yb_area_district` VALUES ('966', '旌德县', '103');
INSERT INTO `yb_area_district` VALUES ('967', '宁国市', '103');
INSERT INTO `yb_area_district` VALUES ('968', '鼓楼区', '104');
INSERT INTO `yb_area_district` VALUES ('969', '台江区', '104');
INSERT INTO `yb_area_district` VALUES ('970', '仓山区', '104');
INSERT INTO `yb_area_district` VALUES ('971', '马尾区', '104');
INSERT INTO `yb_area_district` VALUES ('972', '晋安区', '104');
INSERT INTO `yb_area_district` VALUES ('973', '闽侯县', '104');
INSERT INTO `yb_area_district` VALUES ('974', '连江县', '104');
INSERT INTO `yb_area_district` VALUES ('975', '罗源县', '104');
INSERT INTO `yb_area_district` VALUES ('976', '闽清县', '104');
INSERT INTO `yb_area_district` VALUES ('977', '永泰县', '104');
INSERT INTO `yb_area_district` VALUES ('978', '平潭县', '104');
INSERT INTO `yb_area_district` VALUES ('979', '福清市', '104');
INSERT INTO `yb_area_district` VALUES ('980', '长乐市', '104');
INSERT INTO `yb_area_district` VALUES ('981', '思明区', '105');
INSERT INTO `yb_area_district` VALUES ('982', '海沧区', '105');
INSERT INTO `yb_area_district` VALUES ('983', '湖里区', '105');
INSERT INTO `yb_area_district` VALUES ('984', '集美区', '105');
INSERT INTO `yb_area_district` VALUES ('985', '同安区', '105');
INSERT INTO `yb_area_district` VALUES ('986', '翔安区', '105');
INSERT INTO `yb_area_district` VALUES ('987', '蕉城区', '106');
INSERT INTO `yb_area_district` VALUES ('988', '霞浦县', '106');
INSERT INTO `yb_area_district` VALUES ('989', '古田县', '106');
INSERT INTO `yb_area_district` VALUES ('990', '屏南县', '106');
INSERT INTO `yb_area_district` VALUES ('991', '寿宁县', '106');
INSERT INTO `yb_area_district` VALUES ('992', '周宁县', '106');
INSERT INTO `yb_area_district` VALUES ('993', '柘荣县', '106');
INSERT INTO `yb_area_district` VALUES ('994', '福安市', '106');
INSERT INTO `yb_area_district` VALUES ('995', '福鼎市', '106');
INSERT INTO `yb_area_district` VALUES ('996', '城厢区', '107');
INSERT INTO `yb_area_district` VALUES ('997', '涵江区', '107');
INSERT INTO `yb_area_district` VALUES ('998', '荔城区', '107');
INSERT INTO `yb_area_district` VALUES ('999', '秀屿区', '107');
INSERT INTO `yb_area_district` VALUES ('1000', '仙游县', '107');
INSERT INTO `yb_area_district` VALUES ('1001', '鲤城区', '108');
INSERT INTO `yb_area_district` VALUES ('1002', '丰泽区', '108');
INSERT INTO `yb_area_district` VALUES ('1003', '洛江区', '108');
INSERT INTO `yb_area_district` VALUES ('1004', '泉港区', '108');
INSERT INTO `yb_area_district` VALUES ('1005', '惠安县', '108');
INSERT INTO `yb_area_district` VALUES ('1006', '安溪县', '108');
INSERT INTO `yb_area_district` VALUES ('1007', '永春县', '108');
INSERT INTO `yb_area_district` VALUES ('1008', '德化县', '108');
INSERT INTO `yb_area_district` VALUES ('1009', '石狮市', '108');
INSERT INTO `yb_area_district` VALUES ('1010', '晋江市', '108');
INSERT INTO `yb_area_district` VALUES ('1011', '南安市', '108');
INSERT INTO `yb_area_district` VALUES ('1012', '芗城区', '109');
INSERT INTO `yb_area_district` VALUES ('1013', '龙文区', '109');
INSERT INTO `yb_area_district` VALUES ('1014', '云霄县', '109');
INSERT INTO `yb_area_district` VALUES ('1015', '漳浦县', '109');
INSERT INTO `yb_area_district` VALUES ('1016', '诏安县', '109');
INSERT INTO `yb_area_district` VALUES ('1017', '长泰县', '109');
INSERT INTO `yb_area_district` VALUES ('1018', '东山县', '109');
INSERT INTO `yb_area_district` VALUES ('1019', '南靖县', '109');
INSERT INTO `yb_area_district` VALUES ('1020', '平和县', '109');
INSERT INTO `yb_area_district` VALUES ('1021', '华安县', '109');
INSERT INTO `yb_area_district` VALUES ('1022', '龙海市', '109');
INSERT INTO `yb_area_district` VALUES ('1023', '新罗区', '110');
INSERT INTO `yb_area_district` VALUES ('1024', '长汀县', '110');
INSERT INTO `yb_area_district` VALUES ('1025', '永定县', '110');
INSERT INTO `yb_area_district` VALUES ('1026', '上杭县', '110');
INSERT INTO `yb_area_district` VALUES ('1027', '武平县', '110');
INSERT INTO `yb_area_district` VALUES ('1028', '连城县', '110');
INSERT INTO `yb_area_district` VALUES ('1029', '漳平市', '110');
INSERT INTO `yb_area_district` VALUES ('1030', '梅列区', '111');
INSERT INTO `yb_area_district` VALUES ('1031', '三元区', '111');
INSERT INTO `yb_area_district` VALUES ('1032', '明溪县', '111');
INSERT INTO `yb_area_district` VALUES ('1033', '清流县', '111');
INSERT INTO `yb_area_district` VALUES ('1034', '宁化县', '111');
INSERT INTO `yb_area_district` VALUES ('1035', '大田县', '111');
INSERT INTO `yb_area_district` VALUES ('1036', '尤溪县', '111');
INSERT INTO `yb_area_district` VALUES ('1037', '沙县', '111');
INSERT INTO `yb_area_district` VALUES ('1038', '将乐县', '111');
INSERT INTO `yb_area_district` VALUES ('1039', '泰宁县', '111');
INSERT INTO `yb_area_district` VALUES ('1040', '建宁县', '111');
INSERT INTO `yb_area_district` VALUES ('1041', '永安市', '111');
INSERT INTO `yb_area_district` VALUES ('1042', '延平区', '112');
INSERT INTO `yb_area_district` VALUES ('1043', '顺昌县', '112');
INSERT INTO `yb_area_district` VALUES ('1044', '浦城县', '112');
INSERT INTO `yb_area_district` VALUES ('1045', '光泽县', '112');
INSERT INTO `yb_area_district` VALUES ('1046', '松溪县', '112');
INSERT INTO `yb_area_district` VALUES ('1047', '政和县', '112');
INSERT INTO `yb_area_district` VALUES ('1048', '邵武市', '112');
INSERT INTO `yb_area_district` VALUES ('1049', '武夷山市', '112');
INSERT INTO `yb_area_district` VALUES ('1050', '建瓯市', '112');
INSERT INTO `yb_area_district` VALUES ('1051', '建阳市', '112');
INSERT INTO `yb_area_district` VALUES ('1052', '月湖区', '113');
INSERT INTO `yb_area_district` VALUES ('1053', '余江县', '113');
INSERT INTO `yb_area_district` VALUES ('1054', '贵溪市', '113');
INSERT INTO `yb_area_district` VALUES ('1055', '渝水区', '114');
INSERT INTO `yb_area_district` VALUES ('1056', '分宜县', '114');
INSERT INTO `yb_area_district` VALUES ('1057', '东湖区', '115');
INSERT INTO `yb_area_district` VALUES ('1058', '西湖区', '115');
INSERT INTO `yb_area_district` VALUES ('1059', '青云谱区', '115');
INSERT INTO `yb_area_district` VALUES ('1060', '湾里区', '115');
INSERT INTO `yb_area_district` VALUES ('1061', '青山湖区', '115');
INSERT INTO `yb_area_district` VALUES ('1062', '南昌县', '115');
INSERT INTO `yb_area_district` VALUES ('1063', '新建县', '115');
INSERT INTO `yb_area_district` VALUES ('1064', '安义县', '115');
INSERT INTO `yb_area_district` VALUES ('1065', '进贤县', '115');
INSERT INTO `yb_area_district` VALUES ('1066', '庐山区', '116');
INSERT INTO `yb_area_district` VALUES ('1067', '浔阳区', '116');
INSERT INTO `yb_area_district` VALUES ('1068', '九江县', '116');
INSERT INTO `yb_area_district` VALUES ('1069', '武宁县', '116');
INSERT INTO `yb_area_district` VALUES ('1070', '修水县', '116');
INSERT INTO `yb_area_district` VALUES ('1071', '永修县', '116');
INSERT INTO `yb_area_district` VALUES ('1072', '德安县', '116');
INSERT INTO `yb_area_district` VALUES ('1073', '星子县', '116');
INSERT INTO `yb_area_district` VALUES ('1074', '都昌县', '116');
INSERT INTO `yb_area_district` VALUES ('1075', '湖口县', '116');
INSERT INTO `yb_area_district` VALUES ('1076', '彭泽县', '116');
INSERT INTO `yb_area_district` VALUES ('1077', '瑞昌市', '116');
INSERT INTO `yb_area_district` VALUES ('1078', '信州区', '117');
INSERT INTO `yb_area_district` VALUES ('1079', '上饶县', '117');
INSERT INTO `yb_area_district` VALUES ('1080', '广丰县', '117');
INSERT INTO `yb_area_district` VALUES ('1081', '玉山县', '117');
INSERT INTO `yb_area_district` VALUES ('1082', '铅山县', '117');
INSERT INTO `yb_area_district` VALUES ('1083', '横峰县', '117');
INSERT INTO `yb_area_district` VALUES ('1084', '弋阳县', '117');
INSERT INTO `yb_area_district` VALUES ('1085', '余干县', '117');
INSERT INTO `yb_area_district` VALUES ('1086', '鄱阳县', '117');
INSERT INTO `yb_area_district` VALUES ('1087', '万年县', '117');
INSERT INTO `yb_area_district` VALUES ('1088', '婺源县', '117');
INSERT INTO `yb_area_district` VALUES ('1089', '德兴市', '117');
INSERT INTO `yb_area_district` VALUES ('1090', '临川区', '118');
INSERT INTO `yb_area_district` VALUES ('1091', '南城县', '118');
INSERT INTO `yb_area_district` VALUES ('1092', '黎川县', '118');
INSERT INTO `yb_area_district` VALUES ('1093', '南丰县', '118');
INSERT INTO `yb_area_district` VALUES ('1094', '崇仁县', '118');
INSERT INTO `yb_area_district` VALUES ('1095', '乐安县', '118');
INSERT INTO `yb_area_district` VALUES ('1096', '宜黄县', '118');
INSERT INTO `yb_area_district` VALUES ('1097', '金溪县', '118');
INSERT INTO `yb_area_district` VALUES ('1098', '资溪县', '118');
INSERT INTO `yb_area_district` VALUES ('1099', '东乡县', '118');
INSERT INTO `yb_area_district` VALUES ('1100', '广昌县', '118');
INSERT INTO `yb_area_district` VALUES ('1101', '袁州区', '119');
INSERT INTO `yb_area_district` VALUES ('1102', '奉新县', '119');
INSERT INTO `yb_area_district` VALUES ('1103', '万载县', '119');
INSERT INTO `yb_area_district` VALUES ('1104', '上高县', '119');
INSERT INTO `yb_area_district` VALUES ('1105', '宜丰县', '119');
INSERT INTO `yb_area_district` VALUES ('1106', '靖安县', '119');
INSERT INTO `yb_area_district` VALUES ('1107', '铜鼓县', '119');
INSERT INTO `yb_area_district` VALUES ('1108', '丰城市', '119');
INSERT INTO `yb_area_district` VALUES ('1109', '樟树市', '119');
INSERT INTO `yb_area_district` VALUES ('1110', '高安市', '119');
INSERT INTO `yb_area_district` VALUES ('1111', '吉州区', '120');
INSERT INTO `yb_area_district` VALUES ('1112', '青原区', '120');
INSERT INTO `yb_area_district` VALUES ('1113', '吉安县', '120');
INSERT INTO `yb_area_district` VALUES ('1114', '吉水县', '120');
INSERT INTO `yb_area_district` VALUES ('1115', '峡江县', '120');
INSERT INTO `yb_area_district` VALUES ('1116', '新干县', '120');
INSERT INTO `yb_area_district` VALUES ('1117', '永丰县', '120');
INSERT INTO `yb_area_district` VALUES ('1118', '泰和县', '120');
INSERT INTO `yb_area_district` VALUES ('1119', '遂川县', '120');
INSERT INTO `yb_area_district` VALUES ('1120', '万安县', '120');
INSERT INTO `yb_area_district` VALUES ('1121', '安福县', '120');
INSERT INTO `yb_area_district` VALUES ('1122', '永新县', '120');
INSERT INTO `yb_area_district` VALUES ('1123', '井冈山市', '120');
INSERT INTO `yb_area_district` VALUES ('1124', '章贡区', '121');
INSERT INTO `yb_area_district` VALUES ('1125', '赣县', '121');
INSERT INTO `yb_area_district` VALUES ('1126', '信丰县', '121');
INSERT INTO `yb_area_district` VALUES ('1127', '大余县', '121');
INSERT INTO `yb_area_district` VALUES ('1128', '上犹县', '121');
INSERT INTO `yb_area_district` VALUES ('1129', '崇义县', '121');
INSERT INTO `yb_area_district` VALUES ('1130', '安远县', '121');
INSERT INTO `yb_area_district` VALUES ('1131', '龙南县', '121');
INSERT INTO `yb_area_district` VALUES ('1132', '定南县', '121');
INSERT INTO `yb_area_district` VALUES ('1133', '全南县', '121');
INSERT INTO `yb_area_district` VALUES ('1134', '宁都县', '121');
INSERT INTO `yb_area_district` VALUES ('1135', '于都县', '121');
INSERT INTO `yb_area_district` VALUES ('1136', '兴国县', '121');
INSERT INTO `yb_area_district` VALUES ('1137', '会昌县', '121');
INSERT INTO `yb_area_district` VALUES ('1138', '寻乌县', '121');
INSERT INTO `yb_area_district` VALUES ('1139', '石城县', '121');
INSERT INTO `yb_area_district` VALUES ('1140', '瑞金市', '121');
INSERT INTO `yb_area_district` VALUES ('1141', '南康市', '121');
INSERT INTO `yb_area_district` VALUES ('1142', '昌江区', '122');
INSERT INTO `yb_area_district` VALUES ('1143', '珠山区', '122');
INSERT INTO `yb_area_district` VALUES ('1144', '浮梁县', '122');
INSERT INTO `yb_area_district` VALUES ('1145', '乐平市', '122');
INSERT INTO `yb_area_district` VALUES ('1146', '安源区', '123');
INSERT INTO `yb_area_district` VALUES ('1147', '湘东区', '123');
INSERT INTO `yb_area_district` VALUES ('1148', '莲花县', '123');
INSERT INTO `yb_area_district` VALUES ('1149', '上栗县', '123');
INSERT INTO `yb_area_district` VALUES ('1150', '芦溪县', '123');
INSERT INTO `yb_area_district` VALUES ('1151', '牡丹区', '124');
INSERT INTO `yb_area_district` VALUES ('1152', '曹县', '124');
INSERT INTO `yb_area_district` VALUES ('1153', '单县', '124');
INSERT INTO `yb_area_district` VALUES ('1154', '成武县', '124');
INSERT INTO `yb_area_district` VALUES ('1155', '巨野县', '124');
INSERT INTO `yb_area_district` VALUES ('1156', '郓城县', '124');
INSERT INTO `yb_area_district` VALUES ('1157', '鄄城县', '124');
INSERT INTO `yb_area_district` VALUES ('1158', '定陶县', '124');
INSERT INTO `yb_area_district` VALUES ('1159', '东明县', '124');
INSERT INTO `yb_area_district` VALUES ('1160', '历下区', '125');
INSERT INTO `yb_area_district` VALUES ('1161', '市中区', '125');
INSERT INTO `yb_area_district` VALUES ('1162', '槐荫区', '125');
INSERT INTO `yb_area_district` VALUES ('1163', '天桥区', '125');
INSERT INTO `yb_area_district` VALUES ('1164', '历城区', '125');
INSERT INTO `yb_area_district` VALUES ('1165', '长清区', '125');
INSERT INTO `yb_area_district` VALUES ('1166', '平阴县', '125');
INSERT INTO `yb_area_district` VALUES ('1167', '济阳县', '125');
INSERT INTO `yb_area_district` VALUES ('1168', '商河县', '125');
INSERT INTO `yb_area_district` VALUES ('1169', '章丘市', '125');
INSERT INTO `yb_area_district` VALUES ('1170', '市南区', '126');
INSERT INTO `yb_area_district` VALUES ('1171', '市北区', '126');
INSERT INTO `yb_area_district` VALUES ('1172', '四方区', '126');
INSERT INTO `yb_area_district` VALUES ('1173', '黄岛区', '126');
INSERT INTO `yb_area_district` VALUES ('1174', '崂山区', '126');
INSERT INTO `yb_area_district` VALUES ('1175', '李沧区', '126');
INSERT INTO `yb_area_district` VALUES ('1176', '城阳区', '126');
INSERT INTO `yb_area_district` VALUES ('1177', '胶州市', '126');
INSERT INTO `yb_area_district` VALUES ('1178', '即墨市', '126');
INSERT INTO `yb_area_district` VALUES ('1179', '平度市', '126');
INSERT INTO `yb_area_district` VALUES ('1180', '胶南市', '126');
INSERT INTO `yb_area_district` VALUES ('1181', '莱西市', '126');
INSERT INTO `yb_area_district` VALUES ('1182', '淄川区', '127');
INSERT INTO `yb_area_district` VALUES ('1183', '张店区', '127');
INSERT INTO `yb_area_district` VALUES ('1184', '博山区', '127');
INSERT INTO `yb_area_district` VALUES ('1185', '临淄区', '127');
INSERT INTO `yb_area_district` VALUES ('1186', '周村区', '127');
INSERT INTO `yb_area_district` VALUES ('1187', '桓台县', '127');
INSERT INTO `yb_area_district` VALUES ('1188', '高青县', '127');
INSERT INTO `yb_area_district` VALUES ('1189', '沂源县', '127');
INSERT INTO `yb_area_district` VALUES ('1190', '德城区', '128');
INSERT INTO `yb_area_district` VALUES ('1191', '陵县', '128');
INSERT INTO `yb_area_district` VALUES ('1192', '宁津县', '128');
INSERT INTO `yb_area_district` VALUES ('1193', '庆云县', '128');
INSERT INTO `yb_area_district` VALUES ('1194', '临邑县', '128');
INSERT INTO `yb_area_district` VALUES ('1195', '齐河县', '128');
INSERT INTO `yb_area_district` VALUES ('1196', '平原县', '128');
INSERT INTO `yb_area_district` VALUES ('1197', '夏津县', '128');
INSERT INTO `yb_area_district` VALUES ('1198', '武城县', '128');
INSERT INTO `yb_area_district` VALUES ('1199', '乐陵市', '128');
INSERT INTO `yb_area_district` VALUES ('1200', '禹城市', '128');
INSERT INTO `yb_area_district` VALUES ('1201', '芝罘区', '129');
INSERT INTO `yb_area_district` VALUES ('1202', '福山区', '129');
INSERT INTO `yb_area_district` VALUES ('1203', '牟平区', '129');
INSERT INTO `yb_area_district` VALUES ('1204', '莱山区', '129');
INSERT INTO `yb_area_district` VALUES ('1205', '长岛县', '129');
INSERT INTO `yb_area_district` VALUES ('1206', '龙口市', '129');
INSERT INTO `yb_area_district` VALUES ('1207', '莱阳市', '129');
INSERT INTO `yb_area_district` VALUES ('1208', '莱州市', '129');
INSERT INTO `yb_area_district` VALUES ('1209', '蓬莱市', '129');
INSERT INTO `yb_area_district` VALUES ('1210', '招远市', '129');
INSERT INTO `yb_area_district` VALUES ('1211', '栖霞市', '129');
INSERT INTO `yb_area_district` VALUES ('1212', '海阳市', '129');
INSERT INTO `yb_area_district` VALUES ('1213', '潍城区', '130');
INSERT INTO `yb_area_district` VALUES ('1214', '寒亭区', '130');
INSERT INTO `yb_area_district` VALUES ('1215', '坊子区', '130');
INSERT INTO `yb_area_district` VALUES ('1216', '奎文区', '130');
INSERT INTO `yb_area_district` VALUES ('1217', '临朐县', '130');
INSERT INTO `yb_area_district` VALUES ('1218', '昌乐县', '130');
INSERT INTO `yb_area_district` VALUES ('1219', '青州市', '130');
INSERT INTO `yb_area_district` VALUES ('1220', '诸城市', '130');
INSERT INTO `yb_area_district` VALUES ('1221', '寿光市', '130');
INSERT INTO `yb_area_district` VALUES ('1222', '安丘市', '130');
INSERT INTO `yb_area_district` VALUES ('1223', '高密市', '130');
INSERT INTO `yb_area_district` VALUES ('1224', '昌邑市', '130');
INSERT INTO `yb_area_district` VALUES ('1225', '市中区', '131');
INSERT INTO `yb_area_district` VALUES ('1226', '任城区', '131');
INSERT INTO `yb_area_district` VALUES ('1227', '微山县', '131');
INSERT INTO `yb_area_district` VALUES ('1228', '鱼台县', '131');
INSERT INTO `yb_area_district` VALUES ('1229', '金乡县', '131');
INSERT INTO `yb_area_district` VALUES ('1230', '嘉祥县', '131');
INSERT INTO `yb_area_district` VALUES ('1231', '汶上县', '131');
INSERT INTO `yb_area_district` VALUES ('1232', '泗水县', '131');
INSERT INTO `yb_area_district` VALUES ('1233', '梁山县', '131');
INSERT INTO `yb_area_district` VALUES ('1234', '曲阜市', '131');
INSERT INTO `yb_area_district` VALUES ('1235', '兖州市', '131');
INSERT INTO `yb_area_district` VALUES ('1236', '邹城市', '131');
INSERT INTO `yb_area_district` VALUES ('1237', '泰山区', '132');
INSERT INTO `yb_area_district` VALUES ('1238', '岱岳区', '132');
INSERT INTO `yb_area_district` VALUES ('1239', '宁阳县', '132');
INSERT INTO `yb_area_district` VALUES ('1240', '东平县', '132');
INSERT INTO `yb_area_district` VALUES ('1241', '新泰市', '132');
INSERT INTO `yb_area_district` VALUES ('1242', '肥城市', '132');
INSERT INTO `yb_area_district` VALUES ('1243', '兰山区', '133');
INSERT INTO `yb_area_district` VALUES ('1244', '罗庄区', '133');
INSERT INTO `yb_area_district` VALUES ('1245', '河东区', '133');
INSERT INTO `yb_area_district` VALUES ('1246', '沂南县', '133');
INSERT INTO `yb_area_district` VALUES ('1247', '郯城县', '133');
INSERT INTO `yb_area_district` VALUES ('1248', '沂水县', '133');
INSERT INTO `yb_area_district` VALUES ('1249', '苍山县', '133');
INSERT INTO `yb_area_district` VALUES ('1250', '费县', '133');
INSERT INTO `yb_area_district` VALUES ('1251', '平邑县', '133');
INSERT INTO `yb_area_district` VALUES ('1252', '莒南县', '133');
INSERT INTO `yb_area_district` VALUES ('1253', '蒙阴县', '133');
INSERT INTO `yb_area_district` VALUES ('1254', '临沭县', '133');
INSERT INTO `yb_area_district` VALUES ('1255', '滨城区', '134');
INSERT INTO `yb_area_district` VALUES ('1256', '惠民县', '134');
INSERT INTO `yb_area_district` VALUES ('1257', '阳信县', '134');
INSERT INTO `yb_area_district` VALUES ('1258', '无棣县', '134');
INSERT INTO `yb_area_district` VALUES ('1259', '沾化县', '134');
INSERT INTO `yb_area_district` VALUES ('1260', '博兴县', '134');
INSERT INTO `yb_area_district` VALUES ('1261', '邹平县', '134');
INSERT INTO `yb_area_district` VALUES ('1262', '东营区', '135');
INSERT INTO `yb_area_district` VALUES ('1263', '河口区', '135');
INSERT INTO `yb_area_district` VALUES ('1264', '垦利县', '135');
INSERT INTO `yb_area_district` VALUES ('1265', '利津县', '135');
INSERT INTO `yb_area_district` VALUES ('1266', '广饶县', '135');
INSERT INTO `yb_area_district` VALUES ('1267', '环翠区', '136');
INSERT INTO `yb_area_district` VALUES ('1268', '文登市', '136');
INSERT INTO `yb_area_district` VALUES ('1269', '荣成市', '136');
INSERT INTO `yb_area_district` VALUES ('1270', '乳山市', '136');
INSERT INTO `yb_area_district` VALUES ('1271', '市中区', '137');
INSERT INTO `yb_area_district` VALUES ('1272', '薛城区', '137');
INSERT INTO `yb_area_district` VALUES ('1273', '峄城区', '137');
INSERT INTO `yb_area_district` VALUES ('1274', '台儿庄区', '137');
INSERT INTO `yb_area_district` VALUES ('1275', '山亭区', '137');
INSERT INTO `yb_area_district` VALUES ('1276', '滕州市', '137');
INSERT INTO `yb_area_district` VALUES ('1277', '东港区', '138');
INSERT INTO `yb_area_district` VALUES ('1278', '岚山区', '138');
INSERT INTO `yb_area_district` VALUES ('1279', '五莲县', '138');
INSERT INTO `yb_area_district` VALUES ('1280', '莒县', '138');
INSERT INTO `yb_area_district` VALUES ('1281', '莱城区', '139');
INSERT INTO `yb_area_district` VALUES ('1282', '钢城区', '139');
INSERT INTO `yb_area_district` VALUES ('1283', '东昌府区', '140');
INSERT INTO `yb_area_district` VALUES ('1284', '阳谷县', '140');
INSERT INTO `yb_area_district` VALUES ('1285', '莘县', '140');
INSERT INTO `yb_area_district` VALUES ('1286', '茌平县', '140');
INSERT INTO `yb_area_district` VALUES ('1287', '东阿县', '140');
INSERT INTO `yb_area_district` VALUES ('1288', '冠县', '140');
INSERT INTO `yb_area_district` VALUES ('1289', '高唐县', '140');
INSERT INTO `yb_area_district` VALUES ('1290', '临清市', '140');
INSERT INTO `yb_area_district` VALUES ('1291', '梁园区', '141');
INSERT INTO `yb_area_district` VALUES ('1292', '睢阳区', '141');
INSERT INTO `yb_area_district` VALUES ('1293', '民权县', '141');
INSERT INTO `yb_area_district` VALUES ('1294', '睢县', '141');
INSERT INTO `yb_area_district` VALUES ('1295', '宁陵县', '141');
INSERT INTO `yb_area_district` VALUES ('1296', '柘城县', '141');
INSERT INTO `yb_area_district` VALUES ('1297', '虞城县', '141');
INSERT INTO `yb_area_district` VALUES ('1298', '夏邑县', '141');
INSERT INTO `yb_area_district` VALUES ('1299', '永城市', '141');
INSERT INTO `yb_area_district` VALUES ('1300', '中原区', '142');
INSERT INTO `yb_area_district` VALUES ('1301', '二七区', '142');
INSERT INTO `yb_area_district` VALUES ('1302', '管城回族区', '142');
INSERT INTO `yb_area_district` VALUES ('1303', '金水区', '142');
INSERT INTO `yb_area_district` VALUES ('1304', '上街区', '142');
INSERT INTO `yb_area_district` VALUES ('1305', '惠济区', '142');
INSERT INTO `yb_area_district` VALUES ('1306', '中牟县', '142');
INSERT INTO `yb_area_district` VALUES ('1307', '巩义市', '142');
INSERT INTO `yb_area_district` VALUES ('1308', '荥阳市', '142');
INSERT INTO `yb_area_district` VALUES ('1309', '新密市', '142');
INSERT INTO `yb_area_district` VALUES ('1310', '新郑市', '142');
INSERT INTO `yb_area_district` VALUES ('1311', '登封市', '142');
INSERT INTO `yb_area_district` VALUES ('1312', '文峰区', '143');
INSERT INTO `yb_area_district` VALUES ('1313', '北关区', '143');
INSERT INTO `yb_area_district` VALUES ('1314', '殷都区', '143');
INSERT INTO `yb_area_district` VALUES ('1315', '龙安区', '143');
INSERT INTO `yb_area_district` VALUES ('1316', '安阳县', '143');
INSERT INTO `yb_area_district` VALUES ('1317', '汤阴县', '143');
INSERT INTO `yb_area_district` VALUES ('1318', '滑县', '143');
INSERT INTO `yb_area_district` VALUES ('1319', '内黄县', '143');
INSERT INTO `yb_area_district` VALUES ('1320', '林州市', '143');
INSERT INTO `yb_area_district` VALUES ('1321', '红旗区', '144');
INSERT INTO `yb_area_district` VALUES ('1322', '卫滨区', '144');
INSERT INTO `yb_area_district` VALUES ('1323', '凤泉区', '144');
INSERT INTO `yb_area_district` VALUES ('1324', '牧野区', '144');
INSERT INTO `yb_area_district` VALUES ('1325', '新乡县', '144');
INSERT INTO `yb_area_district` VALUES ('1326', '获嘉县', '144');
INSERT INTO `yb_area_district` VALUES ('1327', '原阳县', '144');
INSERT INTO `yb_area_district` VALUES ('1328', '延津县', '144');
INSERT INTO `yb_area_district` VALUES ('1329', '封丘县', '144');
INSERT INTO `yb_area_district` VALUES ('1330', '长垣县', '144');
INSERT INTO `yb_area_district` VALUES ('1331', '卫辉市', '144');
INSERT INTO `yb_area_district` VALUES ('1332', '辉县市', '144');
INSERT INTO `yb_area_district` VALUES ('1333', '魏都区', '145');
INSERT INTO `yb_area_district` VALUES ('1334', '许昌县', '145');
INSERT INTO `yb_area_district` VALUES ('1335', '鄢陵县', '145');
INSERT INTO `yb_area_district` VALUES ('1336', '襄城县', '145');
INSERT INTO `yb_area_district` VALUES ('1337', '禹州市', '145');
INSERT INTO `yb_area_district` VALUES ('1338', '长葛市', '145');
INSERT INTO `yb_area_district` VALUES ('1339', '新华区', '146');
INSERT INTO `yb_area_district` VALUES ('1340', '卫东区', '146');
INSERT INTO `yb_area_district` VALUES ('1341', '石龙区', '146');
INSERT INTO `yb_area_district` VALUES ('1342', '湛河区', '146');
INSERT INTO `yb_area_district` VALUES ('1343', '宝丰县', '146');
INSERT INTO `yb_area_district` VALUES ('1344', '叶县', '146');
INSERT INTO `yb_area_district` VALUES ('1345', '鲁山县', '146');
INSERT INTO `yb_area_district` VALUES ('1346', '郏县', '146');
INSERT INTO `yb_area_district` VALUES ('1347', '舞钢市', '146');
INSERT INTO `yb_area_district` VALUES ('1348', '汝州市', '146');
INSERT INTO `yb_area_district` VALUES ('1349', '浉河区', '147');
INSERT INTO `yb_area_district` VALUES ('1350', '平桥区', '147');
INSERT INTO `yb_area_district` VALUES ('1351', '罗山县', '147');
INSERT INTO `yb_area_district` VALUES ('1352', '光山县', '147');
INSERT INTO `yb_area_district` VALUES ('1353', '新县', '147');
INSERT INTO `yb_area_district` VALUES ('1354', '商城县', '147');
INSERT INTO `yb_area_district` VALUES ('1355', '固始县', '147');
INSERT INTO `yb_area_district` VALUES ('1356', '潢川县', '147');
INSERT INTO `yb_area_district` VALUES ('1357', '淮滨县', '147');
INSERT INTO `yb_area_district` VALUES ('1358', '息县', '147');
INSERT INTO `yb_area_district` VALUES ('1359', '宛城区', '148');
INSERT INTO `yb_area_district` VALUES ('1360', '卧龙区', '148');
INSERT INTO `yb_area_district` VALUES ('1361', '南召县', '148');
INSERT INTO `yb_area_district` VALUES ('1362', '方城县', '148');
INSERT INTO `yb_area_district` VALUES ('1363', '西峡县', '148');
INSERT INTO `yb_area_district` VALUES ('1364', '镇平县', '148');
INSERT INTO `yb_area_district` VALUES ('1365', '内乡县', '148');
INSERT INTO `yb_area_district` VALUES ('1366', '淅川县', '148');
INSERT INTO `yb_area_district` VALUES ('1367', '社旗县', '148');
INSERT INTO `yb_area_district` VALUES ('1368', '唐河县', '148');
INSERT INTO `yb_area_district` VALUES ('1369', '新野县', '148');
INSERT INTO `yb_area_district` VALUES ('1370', '桐柏县', '148');
INSERT INTO `yb_area_district` VALUES ('1371', '邓州市', '148');
INSERT INTO `yb_area_district` VALUES ('1372', '龙亭区', '149');
INSERT INTO `yb_area_district` VALUES ('1373', '顺河回族区', '149');
INSERT INTO `yb_area_district` VALUES ('1374', '鼓楼区', '149');
INSERT INTO `yb_area_district` VALUES ('1375', '禹王台区', '149');
INSERT INTO `yb_area_district` VALUES ('1376', '金明区', '149');
INSERT INTO `yb_area_district` VALUES ('1377', '杞县', '149');
INSERT INTO `yb_area_district` VALUES ('1378', '通许县', '149');
INSERT INTO `yb_area_district` VALUES ('1379', '尉氏县', '149');
INSERT INTO `yb_area_district` VALUES ('1380', '开封县', '149');
INSERT INTO `yb_area_district` VALUES ('1381', '兰考县', '149');
INSERT INTO `yb_area_district` VALUES ('1382', '老城区', '150');
INSERT INTO `yb_area_district` VALUES ('1383', '西工区', '150');
INSERT INTO `yb_area_district` VALUES ('1384', '瀍河回族区', '150');
INSERT INTO `yb_area_district` VALUES ('1385', '涧西区', '150');
INSERT INTO `yb_area_district` VALUES ('1386', '吉利区', '150');
INSERT INTO `yb_area_district` VALUES ('1387', '洛龙区', '150');
INSERT INTO `yb_area_district` VALUES ('1388', '孟津县', '150');
INSERT INTO `yb_area_district` VALUES ('1389', '新安县', '150');
INSERT INTO `yb_area_district` VALUES ('1390', '栾川县', '150');
INSERT INTO `yb_area_district` VALUES ('1391', '嵩县', '150');
INSERT INTO `yb_area_district` VALUES ('1392', '汝阳县', '150');
INSERT INTO `yb_area_district` VALUES ('1393', '宜阳县', '150');
INSERT INTO `yb_area_district` VALUES ('1394', '洛宁县', '150');
INSERT INTO `yb_area_district` VALUES ('1395', '伊川县', '150');
INSERT INTO `yb_area_district` VALUES ('1396', '偃师市', '150');
INSERT INTO `yb_area_district` VALUES ('1397', '解放区', '152');
INSERT INTO `yb_area_district` VALUES ('1398', '中站区', '152');
INSERT INTO `yb_area_district` VALUES ('1399', '马村区', '152');
INSERT INTO `yb_area_district` VALUES ('1400', '山阳区', '152');
INSERT INTO `yb_area_district` VALUES ('1401', '修武县', '152');
INSERT INTO `yb_area_district` VALUES ('1402', '博爱县', '152');
INSERT INTO `yb_area_district` VALUES ('1403', '武陟县', '152');
INSERT INTO `yb_area_district` VALUES ('1404', '温县', '152');
INSERT INTO `yb_area_district` VALUES ('1405', '沁阳市', '152');
INSERT INTO `yb_area_district` VALUES ('1406', '孟州市', '152');
INSERT INTO `yb_area_district` VALUES ('1407', '鹤山区', '153');
INSERT INTO `yb_area_district` VALUES ('1408', '山城区', '153');
INSERT INTO `yb_area_district` VALUES ('1409', '淇滨区', '153');
INSERT INTO `yb_area_district` VALUES ('1410', '浚县', '153');
INSERT INTO `yb_area_district` VALUES ('1411', '淇县', '153');
INSERT INTO `yb_area_district` VALUES ('1412', '华龙区', '154');
INSERT INTO `yb_area_district` VALUES ('1413', '清丰县', '154');
INSERT INTO `yb_area_district` VALUES ('1414', '南乐县', '154');
INSERT INTO `yb_area_district` VALUES ('1415', '范县', '154');
INSERT INTO `yb_area_district` VALUES ('1416', '台前县', '154');
INSERT INTO `yb_area_district` VALUES ('1417', '濮阳县', '154');
INSERT INTO `yb_area_district` VALUES ('1418', '川汇区', '155');
INSERT INTO `yb_area_district` VALUES ('1419', '扶沟县', '155');
INSERT INTO `yb_area_district` VALUES ('1420', '西华县', '155');
INSERT INTO `yb_area_district` VALUES ('1421', '商水县', '155');
INSERT INTO `yb_area_district` VALUES ('1422', '沈丘县', '155');
INSERT INTO `yb_area_district` VALUES ('1423', '郸城县', '155');
INSERT INTO `yb_area_district` VALUES ('1424', '淮阳县', '155');
INSERT INTO `yb_area_district` VALUES ('1425', '太康县', '155');
INSERT INTO `yb_area_district` VALUES ('1426', '鹿邑县', '155');
INSERT INTO `yb_area_district` VALUES ('1427', '项城市', '155');
INSERT INTO `yb_area_district` VALUES ('1428', '源汇区', '156');
INSERT INTO `yb_area_district` VALUES ('1429', '郾城区', '156');
INSERT INTO `yb_area_district` VALUES ('1430', '召陵区', '156');
INSERT INTO `yb_area_district` VALUES ('1431', '舞阳县', '156');
INSERT INTO `yb_area_district` VALUES ('1432', '临颍县', '156');
INSERT INTO `yb_area_district` VALUES ('1433', '驿城区', '157');
INSERT INTO `yb_area_district` VALUES ('1434', '西平县', '157');
INSERT INTO `yb_area_district` VALUES ('1435', '上蔡县', '157');
INSERT INTO `yb_area_district` VALUES ('1436', '平舆县', '157');
INSERT INTO `yb_area_district` VALUES ('1437', '正阳县', '157');
INSERT INTO `yb_area_district` VALUES ('1438', '确山县', '157');
INSERT INTO `yb_area_district` VALUES ('1439', '泌阳县', '157');
INSERT INTO `yb_area_district` VALUES ('1440', '汝南县', '157');
INSERT INTO `yb_area_district` VALUES ('1441', '遂平县', '157');
INSERT INTO `yb_area_district` VALUES ('1442', '新蔡县', '157');
INSERT INTO `yb_area_district` VALUES ('1443', '湖滨区', '158');
INSERT INTO `yb_area_district` VALUES ('1444', '渑池县', '158');
INSERT INTO `yb_area_district` VALUES ('1445', '陕县', '158');
INSERT INTO `yb_area_district` VALUES ('1446', '卢氏县', '158');
INSERT INTO `yb_area_district` VALUES ('1447', '义马市', '158');
INSERT INTO `yb_area_district` VALUES ('1448', '灵宝市', '158');
INSERT INTO `yb_area_district` VALUES ('1449', '江岸区', '159');
INSERT INTO `yb_area_district` VALUES ('1450', '江汉区', '159');
INSERT INTO `yb_area_district` VALUES ('1451', '硚口区', '159');
INSERT INTO `yb_area_district` VALUES ('1452', '汉阳区', '159');
INSERT INTO `yb_area_district` VALUES ('1453', '武昌区', '159');
INSERT INTO `yb_area_district` VALUES ('1454', '青山区', '159');
INSERT INTO `yb_area_district` VALUES ('1455', '洪山区', '159');
INSERT INTO `yb_area_district` VALUES ('1456', '东西湖区', '159');
INSERT INTO `yb_area_district` VALUES ('1457', '汉南区', '159');
INSERT INTO `yb_area_district` VALUES ('1458', '蔡甸区', '159');
INSERT INTO `yb_area_district` VALUES ('1459', '江夏区', '159');
INSERT INTO `yb_area_district` VALUES ('1460', '黄陂区', '159');
INSERT INTO `yb_area_district` VALUES ('1461', '新洲区', '159');
INSERT INTO `yb_area_district` VALUES ('1462', '襄城区', '160');
INSERT INTO `yb_area_district` VALUES ('1463', '樊城区', '160');
INSERT INTO `yb_area_district` VALUES ('1464', '襄阳区', '160');
INSERT INTO `yb_area_district` VALUES ('1465', '南漳县', '160');
INSERT INTO `yb_area_district` VALUES ('1466', '谷城县', '160');
INSERT INTO `yb_area_district` VALUES ('1467', '保康县', '160');
INSERT INTO `yb_area_district` VALUES ('1468', '老河口市', '160');
INSERT INTO `yb_area_district` VALUES ('1469', '枣阳市', '160');
INSERT INTO `yb_area_district` VALUES ('1470', '宜城市', '160');
INSERT INTO `yb_area_district` VALUES ('1471', '梁子湖区', '161');
INSERT INTO `yb_area_district` VALUES ('1472', '华容区', '161');
INSERT INTO `yb_area_district` VALUES ('1473', '鄂城区', '161');
INSERT INTO `yb_area_district` VALUES ('1474', '孝南区', '162');
INSERT INTO `yb_area_district` VALUES ('1475', '孝昌县', '162');
INSERT INTO `yb_area_district` VALUES ('1476', '大悟县', '162');
INSERT INTO `yb_area_district` VALUES ('1477', '云梦县', '162');
INSERT INTO `yb_area_district` VALUES ('1478', '应城市', '162');
INSERT INTO `yb_area_district` VALUES ('1479', '安陆市', '162');
INSERT INTO `yb_area_district` VALUES ('1480', '汉川市', '162');
INSERT INTO `yb_area_district` VALUES ('1481', '黄州区', '163');
INSERT INTO `yb_area_district` VALUES ('1482', '团风县', '163');
INSERT INTO `yb_area_district` VALUES ('1483', '红安县', '163');
INSERT INTO `yb_area_district` VALUES ('1484', '罗田县', '163');
INSERT INTO `yb_area_district` VALUES ('1485', '英山县', '163');
INSERT INTO `yb_area_district` VALUES ('1486', '浠水县', '163');
INSERT INTO `yb_area_district` VALUES ('1487', '蕲春县', '163');
INSERT INTO `yb_area_district` VALUES ('1488', '黄梅县', '163');
INSERT INTO `yb_area_district` VALUES ('1489', '麻城市', '163');
INSERT INTO `yb_area_district` VALUES ('1490', '武穴市', '163');
INSERT INTO `yb_area_district` VALUES ('1491', '黄石港区', '164');
INSERT INTO `yb_area_district` VALUES ('1492', '西塞山区', '164');
INSERT INTO `yb_area_district` VALUES ('1493', '下陆区', '164');
INSERT INTO `yb_area_district` VALUES ('1494', '铁山区', '164');
INSERT INTO `yb_area_district` VALUES ('1495', '阳新县', '164');
INSERT INTO `yb_area_district` VALUES ('1496', '大冶市', '164');
INSERT INTO `yb_area_district` VALUES ('1497', '咸安区', '165');
INSERT INTO `yb_area_district` VALUES ('1498', '嘉鱼县', '165');
INSERT INTO `yb_area_district` VALUES ('1499', '通城县', '165');
INSERT INTO `yb_area_district` VALUES ('1500', '崇阳县', '165');
INSERT INTO `yb_area_district` VALUES ('1501', '通山县', '165');
INSERT INTO `yb_area_district` VALUES ('1502', '赤壁市', '165');
INSERT INTO `yb_area_district` VALUES ('1503', '沙市区', '166');
INSERT INTO `yb_area_district` VALUES ('1504', '荆州区', '166');
INSERT INTO `yb_area_district` VALUES ('1505', '公安县', '166');
INSERT INTO `yb_area_district` VALUES ('1506', '监利县', '166');
INSERT INTO `yb_area_district` VALUES ('1507', '江陵县', '166');
INSERT INTO `yb_area_district` VALUES ('1508', '石首市', '166');
INSERT INTO `yb_area_district` VALUES ('1509', '洪湖市', '166');
INSERT INTO `yb_area_district` VALUES ('1510', '松滋市', '166');
INSERT INTO `yb_area_district` VALUES ('1511', '西陵区', '167');
INSERT INTO `yb_area_district` VALUES ('1512', '伍家岗区', '167');
INSERT INTO `yb_area_district` VALUES ('1513', '点军区', '167');
INSERT INTO `yb_area_district` VALUES ('1514', '猇亭区', '167');
INSERT INTO `yb_area_district` VALUES ('1515', '夷陵区', '167');
INSERT INTO `yb_area_district` VALUES ('1516', '远安县', '167');
INSERT INTO `yb_area_district` VALUES ('1517', '兴山县', '167');
INSERT INTO `yb_area_district` VALUES ('1518', '秭归县', '167');
INSERT INTO `yb_area_district` VALUES ('1519', '长阳土家族自治县', '167');
INSERT INTO `yb_area_district` VALUES ('1520', '五峰土家族自治县', '167');
INSERT INTO `yb_area_district` VALUES ('1521', '宜都市', '167');
INSERT INTO `yb_area_district` VALUES ('1522', '当阳市', '167');
INSERT INTO `yb_area_district` VALUES ('1523', '枝江市', '167');
INSERT INTO `yb_area_district` VALUES ('1524', '恩施市', '168');
INSERT INTO `yb_area_district` VALUES ('1525', '利川市', '168');
INSERT INTO `yb_area_district` VALUES ('1526', '建始县', '168');
INSERT INTO `yb_area_district` VALUES ('1527', '巴东县', '168');
INSERT INTO `yb_area_district` VALUES ('1528', '宣恩县', '168');
INSERT INTO `yb_area_district` VALUES ('1529', '咸丰县', '168');
INSERT INTO `yb_area_district` VALUES ('1530', '来凤县', '168');
INSERT INTO `yb_area_district` VALUES ('1531', '鹤峰县', '168');
INSERT INTO `yb_area_district` VALUES ('1532', '茅箭区', '170');
INSERT INTO `yb_area_district` VALUES ('1533', '张湾区', '170');
INSERT INTO `yb_area_district` VALUES ('1534', '郧县', '170');
INSERT INTO `yb_area_district` VALUES ('1535', '郧西县', '170');
INSERT INTO `yb_area_district` VALUES ('1536', '竹山县', '170');
INSERT INTO `yb_area_district` VALUES ('1537', '竹溪县', '170');
INSERT INTO `yb_area_district` VALUES ('1538', '房县', '170');
INSERT INTO `yb_area_district` VALUES ('1539', '丹江口市', '170');
INSERT INTO `yb_area_district` VALUES ('1540', '曾都区', '171');
INSERT INTO `yb_area_district` VALUES ('1541', '广水市', '171');
INSERT INTO `yb_area_district` VALUES ('1542', '东宝区', '172');
INSERT INTO `yb_area_district` VALUES ('1543', '掇刀区', '172');
INSERT INTO `yb_area_district` VALUES ('1544', '京山县', '172');
INSERT INTO `yb_area_district` VALUES ('1545', '沙洋县', '172');
INSERT INTO `yb_area_district` VALUES ('1546', '钟祥市', '172');
INSERT INTO `yb_area_district` VALUES ('1547', '岳阳楼区', '176');
INSERT INTO `yb_area_district` VALUES ('1548', '云溪区', '176');
INSERT INTO `yb_area_district` VALUES ('1549', '君山区', '176');
INSERT INTO `yb_area_district` VALUES ('1550', '岳阳县', '176');
INSERT INTO `yb_area_district` VALUES ('1551', '华容县', '176');
INSERT INTO `yb_area_district` VALUES ('1552', '湘阴县', '176');
INSERT INTO `yb_area_district` VALUES ('1553', '平江县', '176');
INSERT INTO `yb_area_district` VALUES ('1554', '汨罗市', '176');
INSERT INTO `yb_area_district` VALUES ('1555', '临湘市', '176');
INSERT INTO `yb_area_district` VALUES ('1556', '芙蓉区', '177');
INSERT INTO `yb_area_district` VALUES ('1557', '天心区', '177');
INSERT INTO `yb_area_district` VALUES ('1558', '岳麓区', '177');
INSERT INTO `yb_area_district` VALUES ('1559', '开福区', '177');
INSERT INTO `yb_area_district` VALUES ('1560', '雨花区', '177');
INSERT INTO `yb_area_district` VALUES ('1561', '长沙县', '177');
INSERT INTO `yb_area_district` VALUES ('1562', '望城县', '177');
INSERT INTO `yb_area_district` VALUES ('1563', '宁乡县', '177');
INSERT INTO `yb_area_district` VALUES ('1564', '浏阳市', '177');
INSERT INTO `yb_area_district` VALUES ('1565', '雨湖区', '178');
INSERT INTO `yb_area_district` VALUES ('1566', '岳塘区', '178');
INSERT INTO `yb_area_district` VALUES ('1567', '湘潭县', '178');
INSERT INTO `yb_area_district` VALUES ('1568', '湘乡市', '178');
INSERT INTO `yb_area_district` VALUES ('1569', '韶山市', '178');
INSERT INTO `yb_area_district` VALUES ('1570', '荷塘区', '179');
INSERT INTO `yb_area_district` VALUES ('1571', '芦淞区', '179');
INSERT INTO `yb_area_district` VALUES ('1572', '石峰区', '179');
INSERT INTO `yb_area_district` VALUES ('1573', '天元区', '179');
INSERT INTO `yb_area_district` VALUES ('1574', '株洲县', '179');
INSERT INTO `yb_area_district` VALUES ('1575', '攸县', '179');
INSERT INTO `yb_area_district` VALUES ('1576', '茶陵县', '179');
INSERT INTO `yb_area_district` VALUES ('1577', '炎陵县', '179');
INSERT INTO `yb_area_district` VALUES ('1578', '醴陵市', '179');
INSERT INTO `yb_area_district` VALUES ('1579', '珠晖区', '180');
INSERT INTO `yb_area_district` VALUES ('1580', '雁峰区', '180');
INSERT INTO `yb_area_district` VALUES ('1581', '石鼓区', '180');
INSERT INTO `yb_area_district` VALUES ('1582', '蒸湘区', '180');
INSERT INTO `yb_area_district` VALUES ('1583', '南岳区', '180');
INSERT INTO `yb_area_district` VALUES ('1584', '衡阳县', '180');
INSERT INTO `yb_area_district` VALUES ('1585', '衡南县', '180');
INSERT INTO `yb_area_district` VALUES ('1586', '衡山县', '180');
INSERT INTO `yb_area_district` VALUES ('1587', '衡东县', '180');
INSERT INTO `yb_area_district` VALUES ('1588', '祁东县', '180');
INSERT INTO `yb_area_district` VALUES ('1589', '耒阳市', '180');
INSERT INTO `yb_area_district` VALUES ('1590', '常宁市', '180');
INSERT INTO `yb_area_district` VALUES ('1591', '北湖区', '181');
INSERT INTO `yb_area_district` VALUES ('1592', '苏仙区', '181');
INSERT INTO `yb_area_district` VALUES ('1593', '桂阳县', '181');
INSERT INTO `yb_area_district` VALUES ('1594', '宜章县', '181');
INSERT INTO `yb_area_district` VALUES ('1595', '永兴县', '181');
INSERT INTO `yb_area_district` VALUES ('1596', '嘉禾县', '181');
INSERT INTO `yb_area_district` VALUES ('1597', '临武县', '181');
INSERT INTO `yb_area_district` VALUES ('1598', '汝城县', '181');
INSERT INTO `yb_area_district` VALUES ('1599', '桂东县', '181');
INSERT INTO `yb_area_district` VALUES ('1600', '安仁县', '181');
INSERT INTO `yb_area_district` VALUES ('1601', '资兴市', '181');
INSERT INTO `yb_area_district` VALUES ('1602', '武陵区', '182');
INSERT INTO `yb_area_district` VALUES ('1603', '鼎城区', '182');
INSERT INTO `yb_area_district` VALUES ('1604', '安乡县', '182');
INSERT INTO `yb_area_district` VALUES ('1605', '汉寿县', '182');
INSERT INTO `yb_area_district` VALUES ('1606', '澧县', '182');
INSERT INTO `yb_area_district` VALUES ('1607', '临澧县', '182');
INSERT INTO `yb_area_district` VALUES ('1608', '桃源县', '182');
INSERT INTO `yb_area_district` VALUES ('1609', '石门县', '182');
INSERT INTO `yb_area_district` VALUES ('1610', '津市市', '182');
INSERT INTO `yb_area_district` VALUES ('1611', '资阳区', '183');
INSERT INTO `yb_area_district` VALUES ('1612', '赫山区', '183');
INSERT INTO `yb_area_district` VALUES ('1613', '南县', '183');
INSERT INTO `yb_area_district` VALUES ('1614', '桃江县', '183');
INSERT INTO `yb_area_district` VALUES ('1615', '安化县', '183');
INSERT INTO `yb_area_district` VALUES ('1616', '沅江市', '183');
INSERT INTO `yb_area_district` VALUES ('1617', '娄星区', '184');
INSERT INTO `yb_area_district` VALUES ('1618', '双峰县', '184');
INSERT INTO `yb_area_district` VALUES ('1619', '新化县', '184');
INSERT INTO `yb_area_district` VALUES ('1620', '冷水江市', '184');
INSERT INTO `yb_area_district` VALUES ('1621', '涟源市', '184');
INSERT INTO `yb_area_district` VALUES ('1622', '双清区', '185');
INSERT INTO `yb_area_district` VALUES ('1623', '大祥区', '185');
INSERT INTO `yb_area_district` VALUES ('1624', '北塔区', '185');
INSERT INTO `yb_area_district` VALUES ('1625', '邵东县', '185');
INSERT INTO `yb_area_district` VALUES ('1626', '新邵县', '185');
INSERT INTO `yb_area_district` VALUES ('1627', '邵阳县', '185');
INSERT INTO `yb_area_district` VALUES ('1628', '隆回县', '185');
INSERT INTO `yb_area_district` VALUES ('1629', '洞口县', '185');
INSERT INTO `yb_area_district` VALUES ('1630', '绥宁县', '185');
INSERT INTO `yb_area_district` VALUES ('1631', '新宁县', '185');
INSERT INTO `yb_area_district` VALUES ('1632', '城步苗族自治县', '185');
INSERT INTO `yb_area_district` VALUES ('1633', '武冈市', '185');
INSERT INTO `yb_area_district` VALUES ('1634', '吉首市', '186');
INSERT INTO `yb_area_district` VALUES ('1635', '泸溪县', '186');
INSERT INTO `yb_area_district` VALUES ('1636', '凤凰县', '186');
INSERT INTO `yb_area_district` VALUES ('1637', '花垣县', '186');
INSERT INTO `yb_area_district` VALUES ('1638', '保靖县', '186');
INSERT INTO `yb_area_district` VALUES ('1639', '古丈县', '186');
INSERT INTO `yb_area_district` VALUES ('1640', '永顺县', '186');
INSERT INTO `yb_area_district` VALUES ('1641', '龙山县', '186');
INSERT INTO `yb_area_district` VALUES ('1642', '永定区', '187');
INSERT INTO `yb_area_district` VALUES ('1643', '武陵源区', '187');
INSERT INTO `yb_area_district` VALUES ('1644', '慈利县', '187');
INSERT INTO `yb_area_district` VALUES ('1645', '桑植县', '187');
INSERT INTO `yb_area_district` VALUES ('1646', '鹤城区', '188');
INSERT INTO `yb_area_district` VALUES ('1647', '中方县', '188');
INSERT INTO `yb_area_district` VALUES ('1648', '沅陵县', '188');
INSERT INTO `yb_area_district` VALUES ('1649', '辰溪县', '188');
INSERT INTO `yb_area_district` VALUES ('1650', '溆浦县', '188');
INSERT INTO `yb_area_district` VALUES ('1651', '会同县', '188');
INSERT INTO `yb_area_district` VALUES ('1652', '麻阳苗族自治县', '188');
INSERT INTO `yb_area_district` VALUES ('1653', '新晃侗族自治县', '188');
INSERT INTO `yb_area_district` VALUES ('1654', '芷江侗族自治县', '188');
INSERT INTO `yb_area_district` VALUES ('1655', '靖州苗族侗族自治县', '188');
INSERT INTO `yb_area_district` VALUES ('1656', '通道侗族自治县', '188');
INSERT INTO `yb_area_district` VALUES ('1657', '洪江市', '188');
INSERT INTO `yb_area_district` VALUES ('1658', '零陵区', '189');
INSERT INTO `yb_area_district` VALUES ('1659', '冷水滩区', '189');
INSERT INTO `yb_area_district` VALUES ('1660', '祁阳县', '189');
INSERT INTO `yb_area_district` VALUES ('1661', '东安县', '189');
INSERT INTO `yb_area_district` VALUES ('1662', '双牌县', '189');
INSERT INTO `yb_area_district` VALUES ('1663', '道县', '189');
INSERT INTO `yb_area_district` VALUES ('1664', '江永县', '189');
INSERT INTO `yb_area_district` VALUES ('1665', '宁远县', '189');
INSERT INTO `yb_area_district` VALUES ('1666', '蓝山县', '189');
INSERT INTO `yb_area_district` VALUES ('1667', '新田县', '189');
INSERT INTO `yb_area_district` VALUES ('1668', '江华瑶族自治县', '189');
INSERT INTO `yb_area_district` VALUES ('1669', '从化市', '190');
INSERT INTO `yb_area_district` VALUES ('1670', '荔湾区', '190');
INSERT INTO `yb_area_district` VALUES ('1671', '越秀区', '190');
INSERT INTO `yb_area_district` VALUES ('1672', '海珠区', '190');
INSERT INTO `yb_area_district` VALUES ('1673', '天河区', '190');
INSERT INTO `yb_area_district` VALUES ('1674', '白云区', '190');
INSERT INTO `yb_area_district` VALUES ('1675', '花都区', '190');
INSERT INTO `yb_area_district` VALUES ('1676', '黄埔区', '190');
INSERT INTO `yb_area_district` VALUES ('1677', '萝岗区', '190');
INSERT INTO `yb_area_district` VALUES ('1678', '南沙区', '190');
INSERT INTO `yb_area_district` VALUES ('1679', '番禺区', '190');
INSERT INTO `yb_area_district` VALUES ('1680', '增城市', '190');
INSERT INTO `yb_area_district` VALUES ('1681', '海丰县', '191');
INSERT INTO `yb_area_district` VALUES ('1682', '陆河县', '191');
INSERT INTO `yb_area_district` VALUES ('1683', '陆丰市', '191');
INSERT INTO `yb_area_district` VALUES ('1684', '江城区', '192');
INSERT INTO `yb_area_district` VALUES ('1685', '阳西县', '192');
INSERT INTO `yb_area_district` VALUES ('1686', '阳东县', '192');
INSERT INTO `yb_area_district` VALUES ('1687', '阳春市', '192');
INSERT INTO `yb_area_district` VALUES ('1688', '榕城区', '193');
INSERT INTO `yb_area_district` VALUES ('1689', '揭东县', '193');
INSERT INTO `yb_area_district` VALUES ('1690', '揭西县', '193');
INSERT INTO `yb_area_district` VALUES ('1691', '惠来县', '193');
INSERT INTO `yb_area_district` VALUES ('1692', '普宁市', '193');
INSERT INTO `yb_area_district` VALUES ('1693', '茂南区', '194');
INSERT INTO `yb_area_district` VALUES ('1694', '茂港区', '194');
INSERT INTO `yb_area_district` VALUES ('1695', '电白县', '194');
INSERT INTO `yb_area_district` VALUES ('1696', '高州市', '194');
INSERT INTO `yb_area_district` VALUES ('1697', '化州市', '194');
INSERT INTO `yb_area_district` VALUES ('1698', '信宜市', '194');
INSERT INTO `yb_area_district` VALUES ('1699', '惠城区', '195');
INSERT INTO `yb_area_district` VALUES ('1700', '惠阳区', '195');
INSERT INTO `yb_area_district` VALUES ('1701', '博罗县', '195');
INSERT INTO `yb_area_district` VALUES ('1702', '惠东县', '195');
INSERT INTO `yb_area_district` VALUES ('1703', '龙门县', '195');
INSERT INTO `yb_area_district` VALUES ('1704', '蓬江区', '196');
INSERT INTO `yb_area_district` VALUES ('1705', '江海区', '196');
INSERT INTO `yb_area_district` VALUES ('1706', '新会区', '196');
INSERT INTO `yb_area_district` VALUES ('1707', '台山市', '196');
INSERT INTO `yb_area_district` VALUES ('1708', '开平市', '196');
INSERT INTO `yb_area_district` VALUES ('1709', '鹤山市', '196');
INSERT INTO `yb_area_district` VALUES ('1710', '恩平市', '196');
INSERT INTO `yb_area_district` VALUES ('1711', '武江区', '197');
INSERT INTO `yb_area_district` VALUES ('1712', '浈江区', '197');
INSERT INTO `yb_area_district` VALUES ('1713', '曲江区', '197');
INSERT INTO `yb_area_district` VALUES ('1714', '始兴县', '197');
INSERT INTO `yb_area_district` VALUES ('1715', '仁化县', '197');
INSERT INTO `yb_area_district` VALUES ('1716', '翁源县', '197');
INSERT INTO `yb_area_district` VALUES ('1717', '乳源瑶族自治县', '197');
INSERT INTO `yb_area_district` VALUES ('1718', '新丰县', '197');
INSERT INTO `yb_area_district` VALUES ('1719', '乐昌市', '197');
INSERT INTO `yb_area_district` VALUES ('1720', '南雄市', '197');
INSERT INTO `yb_area_district` VALUES ('1721', '梅江区', '198');
INSERT INTO `yb_area_district` VALUES ('1722', '梅县', '198');
INSERT INTO `yb_area_district` VALUES ('1723', '大埔县', '198');
INSERT INTO `yb_area_district` VALUES ('1724', '丰顺县', '198');
INSERT INTO `yb_area_district` VALUES ('1725', '五华县', '198');
INSERT INTO `yb_area_district` VALUES ('1726', '平远县', '198');
INSERT INTO `yb_area_district` VALUES ('1727', '蕉岭县', '198');
INSERT INTO `yb_area_district` VALUES ('1728', '兴宁市', '198');
INSERT INTO `yb_area_district` VALUES ('1729', '龙湖区', '199');
INSERT INTO `yb_area_district` VALUES ('1730', '金平区', '199');
INSERT INTO `yb_area_district` VALUES ('1731', '濠江区', '199');
INSERT INTO `yb_area_district` VALUES ('1732', '潮阳区', '199');
INSERT INTO `yb_area_district` VALUES ('1733', '潮南区', '199');
INSERT INTO `yb_area_district` VALUES ('1734', '澄海区', '199');
INSERT INTO `yb_area_district` VALUES ('1735', '南澳县', '199');
INSERT INTO `yb_area_district` VALUES ('1736', '罗湖区', '200');
INSERT INTO `yb_area_district` VALUES ('1737', '福田区', '200');
INSERT INTO `yb_area_district` VALUES ('1738', '南山区', '200');
INSERT INTO `yb_area_district` VALUES ('1739', '宝安区', '200');
INSERT INTO `yb_area_district` VALUES ('1740', '龙岗区', '200');
INSERT INTO `yb_area_district` VALUES ('1741', '盐田区', '200');
INSERT INTO `yb_area_district` VALUES ('1742', '香洲区', '201');
INSERT INTO `yb_area_district` VALUES ('1743', '斗门区', '201');
INSERT INTO `yb_area_district` VALUES ('1744', '金湾区', '201');
INSERT INTO `yb_area_district` VALUES ('1745', '禅城区', '202');
INSERT INTO `yb_area_district` VALUES ('1746', '南海区', '202');
INSERT INTO `yb_area_district` VALUES ('1747', '顺德区', '202');
INSERT INTO `yb_area_district` VALUES ('1748', '三水区', '202');
INSERT INTO `yb_area_district` VALUES ('1749', '高明区', '202');
INSERT INTO `yb_area_district` VALUES ('1750', '端州区', '203');
INSERT INTO `yb_area_district` VALUES ('1751', '鼎湖区', '203');
INSERT INTO `yb_area_district` VALUES ('1752', '广宁县', '203');
INSERT INTO `yb_area_district` VALUES ('1753', '怀集县', '203');
INSERT INTO `yb_area_district` VALUES ('1754', '封开县', '203');
INSERT INTO `yb_area_district` VALUES ('1755', '德庆县', '203');
INSERT INTO `yb_area_district` VALUES ('1756', '高要市', '203');
INSERT INTO `yb_area_district` VALUES ('1757', '四会市', '203');
INSERT INTO `yb_area_district` VALUES ('1758', '赤坎区', '204');
INSERT INTO `yb_area_district` VALUES ('1759', '霞山区', '204');
INSERT INTO `yb_area_district` VALUES ('1760', '坡头区', '204');
INSERT INTO `yb_area_district` VALUES ('1761', '麻章区', '204');
INSERT INTO `yb_area_district` VALUES ('1762', '遂溪县', '204');
INSERT INTO `yb_area_district` VALUES ('1763', '徐闻县', '204');
INSERT INTO `yb_area_district` VALUES ('1764', '廉江市', '204');
INSERT INTO `yb_area_district` VALUES ('1765', '雷州市', '204');
INSERT INTO `yb_area_district` VALUES ('1766', '吴川市', '204');
INSERT INTO `yb_area_district` VALUES ('1767', '源城区', '206');
INSERT INTO `yb_area_district` VALUES ('1768', '紫金县', '206');
INSERT INTO `yb_area_district` VALUES ('1769', '龙川县', '206');
INSERT INTO `yb_area_district` VALUES ('1770', '连平县', '206');
INSERT INTO `yb_area_district` VALUES ('1771', '和平县', '206');
INSERT INTO `yb_area_district` VALUES ('1772', '东源县', '206');
INSERT INTO `yb_area_district` VALUES ('1773', '清城区', '207');
INSERT INTO `yb_area_district` VALUES ('1774', '佛冈县', '207');
INSERT INTO `yb_area_district` VALUES ('1775', '阳山县', '207');
INSERT INTO `yb_area_district` VALUES ('1776', '连山壮族瑶族自治县', '207');
INSERT INTO `yb_area_district` VALUES ('1777', '连南瑶族自治县', '207');
INSERT INTO `yb_area_district` VALUES ('1778', '清新县', '207');
INSERT INTO `yb_area_district` VALUES ('1779', '英德市', '207');
INSERT INTO `yb_area_district` VALUES ('1780', '连州市', '207');
INSERT INTO `yb_area_district` VALUES ('1781', '云城区', '208');
INSERT INTO `yb_area_district` VALUES ('1782', '新兴县', '208');
INSERT INTO `yb_area_district` VALUES ('1783', '郁南县', '208');
INSERT INTO `yb_area_district` VALUES ('1784', '云安县', '208');
INSERT INTO `yb_area_district` VALUES ('1785', '罗定市', '208');
INSERT INTO `yb_area_district` VALUES ('1786', '湘桥区', '209');
INSERT INTO `yb_area_district` VALUES ('1787', '潮安县', '209');
INSERT INTO `yb_area_district` VALUES ('1788', '饶平县', '209');
INSERT INTO `yb_area_district` VALUES ('1789', '城关区', '211');
INSERT INTO `yb_area_district` VALUES ('1790', '七里河区', '211');
INSERT INTO `yb_area_district` VALUES ('1791', '西固区', '211');
INSERT INTO `yb_area_district` VALUES ('1792', '安宁区', '211');
INSERT INTO `yb_area_district` VALUES ('1793', '红古区', '211');
INSERT INTO `yb_area_district` VALUES ('1794', '永登县', '211');
INSERT INTO `yb_area_district` VALUES ('1795', '皋兰县', '211');
INSERT INTO `yb_area_district` VALUES ('1796', '榆中县', '211');
INSERT INTO `yb_area_district` VALUES ('1797', '金川区', '212');
INSERT INTO `yb_area_district` VALUES ('1798', '永昌县', '212');
INSERT INTO `yb_area_district` VALUES ('1799', '白银区', '213');
INSERT INTO `yb_area_district` VALUES ('1800', '平川区', '213');
INSERT INTO `yb_area_district` VALUES ('1801', '靖远县', '213');
INSERT INTO `yb_area_district` VALUES ('1802', '会宁县', '213');
INSERT INTO `yb_area_district` VALUES ('1803', '景泰县', '213');
INSERT INTO `yb_area_district` VALUES ('1804', '秦州区', '214');
INSERT INTO `yb_area_district` VALUES ('1805', '麦积区', '214');
INSERT INTO `yb_area_district` VALUES ('1806', '清水县', '214');
INSERT INTO `yb_area_district` VALUES ('1807', '秦安县', '214');
INSERT INTO `yb_area_district` VALUES ('1808', '甘谷县', '214');
INSERT INTO `yb_area_district` VALUES ('1809', '武山县', '214');
INSERT INTO `yb_area_district` VALUES ('1810', '张家川回族自治县', '214');
INSERT INTO `yb_area_district` VALUES ('1811', '凉州区', '216');
INSERT INTO `yb_area_district` VALUES ('1812', '民勤县', '216');
INSERT INTO `yb_area_district` VALUES ('1813', '古浪县', '216');
INSERT INTO `yb_area_district` VALUES ('1814', '天祝藏族自治县', '216');
INSERT INTO `yb_area_district` VALUES ('1815', '甘州区', '217');
INSERT INTO `yb_area_district` VALUES ('1816', '肃南裕固族自治县', '217');
INSERT INTO `yb_area_district` VALUES ('1817', '民乐县', '217');
INSERT INTO `yb_area_district` VALUES ('1818', '临泽县', '217');
INSERT INTO `yb_area_district` VALUES ('1819', '高台县', '217');
INSERT INTO `yb_area_district` VALUES ('1820', '山丹县', '217');
INSERT INTO `yb_area_district` VALUES ('1821', '崆峒区', '218');
INSERT INTO `yb_area_district` VALUES ('1822', '泾川县', '218');
INSERT INTO `yb_area_district` VALUES ('1823', '灵台县', '218');
INSERT INTO `yb_area_district` VALUES ('1824', '崇信县', '218');
INSERT INTO `yb_area_district` VALUES ('1825', '华亭县', '218');
INSERT INTO `yb_area_district` VALUES ('1826', '庄浪县', '218');
INSERT INTO `yb_area_district` VALUES ('1827', '静宁县', '218');
INSERT INTO `yb_area_district` VALUES ('1828', '肃州区', '219');
INSERT INTO `yb_area_district` VALUES ('1829', '金塔县', '219');
INSERT INTO `yb_area_district` VALUES ('1830', '瓜州县', '219');
INSERT INTO `yb_area_district` VALUES ('1831', '肃北蒙古族自治县', '219');
INSERT INTO `yb_area_district` VALUES ('1832', '阿克塞哈萨克族自治县', '219');
INSERT INTO `yb_area_district` VALUES ('1833', '玉门市', '219');
INSERT INTO `yb_area_district` VALUES ('1834', '敦煌市', '219');
INSERT INTO `yb_area_district` VALUES ('1835', '西峰区', '220');
INSERT INTO `yb_area_district` VALUES ('1836', '庆城县', '220');
INSERT INTO `yb_area_district` VALUES ('1837', '环县', '220');
INSERT INTO `yb_area_district` VALUES ('1838', '华池县', '220');
INSERT INTO `yb_area_district` VALUES ('1839', '合水县', '220');
INSERT INTO `yb_area_district` VALUES ('1840', '正宁县', '220');
INSERT INTO `yb_area_district` VALUES ('1841', '宁县', '220');
INSERT INTO `yb_area_district` VALUES ('1842', '镇原县', '220');
INSERT INTO `yb_area_district` VALUES ('1843', '安定区', '221');
INSERT INTO `yb_area_district` VALUES ('1844', '通渭县', '221');
INSERT INTO `yb_area_district` VALUES ('1845', '陇西县', '221');
INSERT INTO `yb_area_district` VALUES ('1846', '渭源县', '221');
INSERT INTO `yb_area_district` VALUES ('1847', '临洮县', '221');
INSERT INTO `yb_area_district` VALUES ('1848', '漳县', '221');
INSERT INTO `yb_area_district` VALUES ('1849', '岷县', '221');
INSERT INTO `yb_area_district` VALUES ('1850', '武都区', '222');
INSERT INTO `yb_area_district` VALUES ('1851', '成县', '222');
INSERT INTO `yb_area_district` VALUES ('1852', '文县', '222');
INSERT INTO `yb_area_district` VALUES ('1853', '宕昌县', '222');
INSERT INTO `yb_area_district` VALUES ('1854', '康县', '222');
INSERT INTO `yb_area_district` VALUES ('1855', '西和县', '222');
INSERT INTO `yb_area_district` VALUES ('1856', '礼县', '222');
INSERT INTO `yb_area_district` VALUES ('1857', '徽县', '222');
INSERT INTO `yb_area_district` VALUES ('1858', '两当县', '222');
INSERT INTO `yb_area_district` VALUES ('1859', '临夏市', '223');
INSERT INTO `yb_area_district` VALUES ('1860', '临夏县', '223');
INSERT INTO `yb_area_district` VALUES ('1861', '康乐县', '223');
INSERT INTO `yb_area_district` VALUES ('1862', '永靖县', '223');
INSERT INTO `yb_area_district` VALUES ('1863', '广河县', '223');
INSERT INTO `yb_area_district` VALUES ('1864', '和政县', '223');
INSERT INTO `yb_area_district` VALUES ('1865', '东乡族自治县', '223');
INSERT INTO `yb_area_district` VALUES ('1866', '积石山保安族东乡族撒拉族自治县', '223');
INSERT INTO `yb_area_district` VALUES ('1867', '合作市', '224');
INSERT INTO `yb_area_district` VALUES ('1868', '临潭县', '224');
INSERT INTO `yb_area_district` VALUES ('1869', '卓尼县', '224');
INSERT INTO `yb_area_district` VALUES ('1870', '舟曲县', '224');
INSERT INTO `yb_area_district` VALUES ('1871', '迭部县', '224');
INSERT INTO `yb_area_district` VALUES ('1872', '玛曲县', '224');
INSERT INTO `yb_area_district` VALUES ('1873', '碌曲县', '224');
INSERT INTO `yb_area_district` VALUES ('1874', '夏河县', '224');
INSERT INTO `yb_area_district` VALUES ('1875', '锦江区', '225');
INSERT INTO `yb_area_district` VALUES ('1876', '青羊区', '225');
INSERT INTO `yb_area_district` VALUES ('1877', '金牛区', '225');
INSERT INTO `yb_area_district` VALUES ('1878', '武侯区', '225');
INSERT INTO `yb_area_district` VALUES ('1879', '成华区', '225');
INSERT INTO `yb_area_district` VALUES ('1880', '龙泉驿区', '225');
INSERT INTO `yb_area_district` VALUES ('1881', '青白江区', '225');
INSERT INTO `yb_area_district` VALUES ('1882', '新都区', '225');
INSERT INTO `yb_area_district` VALUES ('1883', '温江区', '225');
INSERT INTO `yb_area_district` VALUES ('1884', '金堂县', '225');
INSERT INTO `yb_area_district` VALUES ('1885', '双流县', '225');
INSERT INTO `yb_area_district` VALUES ('1886', '郫县', '225');
INSERT INTO `yb_area_district` VALUES ('1887', '大邑县', '225');
INSERT INTO `yb_area_district` VALUES ('1888', '蒲江县', '225');
INSERT INTO `yb_area_district` VALUES ('1889', '新津县', '225');
INSERT INTO `yb_area_district` VALUES ('1890', '都江堰市', '225');
INSERT INTO `yb_area_district` VALUES ('1891', '彭州市', '225');
INSERT INTO `yb_area_district` VALUES ('1892', '邛崃市', '225');
INSERT INTO `yb_area_district` VALUES ('1893', '崇州市', '225');
INSERT INTO `yb_area_district` VALUES ('1894', '东区', '226');
INSERT INTO `yb_area_district` VALUES ('1895', '西区', '226');
INSERT INTO `yb_area_district` VALUES ('1896', '仁和区', '226');
INSERT INTO `yb_area_district` VALUES ('1897', '米易县', '226');
INSERT INTO `yb_area_district` VALUES ('1898', '盐边县', '226');
INSERT INTO `yb_area_district` VALUES ('1899', '自流井区', '227');
INSERT INTO `yb_area_district` VALUES ('1900', '贡井区', '227');
INSERT INTO `yb_area_district` VALUES ('1901', '大安区', '227');
INSERT INTO `yb_area_district` VALUES ('1902', '沿滩区', '227');
INSERT INTO `yb_area_district` VALUES ('1903', '荣县', '227');
INSERT INTO `yb_area_district` VALUES ('1904', '富顺县', '227');
INSERT INTO `yb_area_district` VALUES ('1905', '涪城区', '228');
INSERT INTO `yb_area_district` VALUES ('1906', '游仙区', '228');
INSERT INTO `yb_area_district` VALUES ('1907', '三台县', '228');
INSERT INTO `yb_area_district` VALUES ('1908', '盐亭县', '228');
INSERT INTO `yb_area_district` VALUES ('1909', '安县', '228');
INSERT INTO `yb_area_district` VALUES ('1910', '梓潼县', '228');
INSERT INTO `yb_area_district` VALUES ('1911', '北川羌族自治县', '228');
INSERT INTO `yb_area_district` VALUES ('1912', '平武县', '228');
INSERT INTO `yb_area_district` VALUES ('1913', '江油市', '228');
INSERT INTO `yb_area_district` VALUES ('1914', '顺庆区', '229');
INSERT INTO `yb_area_district` VALUES ('1915', '高坪区', '229');
INSERT INTO `yb_area_district` VALUES ('1916', '嘉陵区', '229');
INSERT INTO `yb_area_district` VALUES ('1917', '南部县', '229');
INSERT INTO `yb_area_district` VALUES ('1918', '营山县', '229');
INSERT INTO `yb_area_district` VALUES ('1919', '蓬安县', '229');
INSERT INTO `yb_area_district` VALUES ('1920', '仪陇县', '229');
INSERT INTO `yb_area_district` VALUES ('1921', '西充县', '229');
INSERT INTO `yb_area_district` VALUES ('1922', '阆中市', '229');
INSERT INTO `yb_area_district` VALUES ('1923', '通川区', '230');
INSERT INTO `yb_area_district` VALUES ('1924', '达县', '230');
INSERT INTO `yb_area_district` VALUES ('1925', '宣汉县', '230');
INSERT INTO `yb_area_district` VALUES ('1926', '开江县', '230');
INSERT INTO `yb_area_district` VALUES ('1927', '大竹县', '230');
INSERT INTO `yb_area_district` VALUES ('1928', '渠县', '230');
INSERT INTO `yb_area_district` VALUES ('1929', '万源市', '230');
INSERT INTO `yb_area_district` VALUES ('1930', '船山区', '231');
INSERT INTO `yb_area_district` VALUES ('1931', '安居区', '231');
INSERT INTO `yb_area_district` VALUES ('1932', '蓬溪县', '231');
INSERT INTO `yb_area_district` VALUES ('1933', '射洪县', '231');
INSERT INTO `yb_area_district` VALUES ('1934', '大英县', '231');
INSERT INTO `yb_area_district` VALUES ('1935', '广安区', '232');
INSERT INTO `yb_area_district` VALUES ('1936', '岳池县', '232');
INSERT INTO `yb_area_district` VALUES ('1937', '武胜县', '232');
INSERT INTO `yb_area_district` VALUES ('1938', '邻水县', '232');
INSERT INTO `yb_area_district` VALUES ('1939', '华蓥市', '232');
INSERT INTO `yb_area_district` VALUES ('1940', '巴州区', '233');
INSERT INTO `yb_area_district` VALUES ('1941', '通江县', '233');
INSERT INTO `yb_area_district` VALUES ('1942', '南江县', '233');
INSERT INTO `yb_area_district` VALUES ('1943', '平昌县', '233');
INSERT INTO `yb_area_district` VALUES ('1944', '江阳区', '234');
INSERT INTO `yb_area_district` VALUES ('1945', '纳溪区', '234');
INSERT INTO `yb_area_district` VALUES ('1946', '龙马潭区', '234');
INSERT INTO `yb_area_district` VALUES ('1947', '泸县', '234');
INSERT INTO `yb_area_district` VALUES ('1948', '合江县', '234');
INSERT INTO `yb_area_district` VALUES ('1949', '叙永县', '234');
INSERT INTO `yb_area_district` VALUES ('1950', '古蔺县', '234');
INSERT INTO `yb_area_district` VALUES ('1951', '翠屏区', '235');
INSERT INTO `yb_area_district` VALUES ('1952', '宜宾县', '235');
INSERT INTO `yb_area_district` VALUES ('1953', '南溪县', '235');
INSERT INTO `yb_area_district` VALUES ('1954', '江安县', '235');
INSERT INTO `yb_area_district` VALUES ('1955', '长宁县', '235');
INSERT INTO `yb_area_district` VALUES ('1956', '高县', '235');
INSERT INTO `yb_area_district` VALUES ('1957', '珙县', '235');
INSERT INTO `yb_area_district` VALUES ('1958', '筠连县', '235');
INSERT INTO `yb_area_district` VALUES ('1959', '兴文县', '235');
INSERT INTO `yb_area_district` VALUES ('1960', '屏山县', '235');
INSERT INTO `yb_area_district` VALUES ('1961', '雁江区', '236');
INSERT INTO `yb_area_district` VALUES ('1962', '安岳县', '236');
INSERT INTO `yb_area_district` VALUES ('1963', '乐至县', '236');
INSERT INTO `yb_area_district` VALUES ('1964', '简阳市', '236');
INSERT INTO `yb_area_district` VALUES ('1965', '市中区', '237');
INSERT INTO `yb_area_district` VALUES ('1966', '东兴区', '237');
INSERT INTO `yb_area_district` VALUES ('1967', '威远县', '237');
INSERT INTO `yb_area_district` VALUES ('1968', '资中县', '237');
INSERT INTO `yb_area_district` VALUES ('1969', '隆昌县', '237');
INSERT INTO `yb_area_district` VALUES ('1970', '市中区', '238');
INSERT INTO `yb_area_district` VALUES ('1971', '沙湾区', '238');
INSERT INTO `yb_area_district` VALUES ('1972', '五通桥区', '238');
INSERT INTO `yb_area_district` VALUES ('1973', '金口河区', '238');
INSERT INTO `yb_area_district` VALUES ('1974', '犍为县', '238');
INSERT INTO `yb_area_district` VALUES ('1975', '井研县', '238');
INSERT INTO `yb_area_district` VALUES ('1976', '夹江县', '238');
INSERT INTO `yb_area_district` VALUES ('1977', '沐川县', '238');
INSERT INTO `yb_area_district` VALUES ('1978', '峨边彝族自治县', '238');
INSERT INTO `yb_area_district` VALUES ('1979', '马边彝族自治县', '238');
INSERT INTO `yb_area_district` VALUES ('1980', '峨眉山市', '238');
INSERT INTO `yb_area_district` VALUES ('1981', '东坡区', '239');
INSERT INTO `yb_area_district` VALUES ('1982', '仁寿县', '239');
INSERT INTO `yb_area_district` VALUES ('1983', '彭山县', '239');
INSERT INTO `yb_area_district` VALUES ('1984', '洪雅县', '239');
INSERT INTO `yb_area_district` VALUES ('1985', '丹棱县', '239');
INSERT INTO `yb_area_district` VALUES ('1986', '青神县', '239');
INSERT INTO `yb_area_district` VALUES ('1987', '西昌市', '240');
INSERT INTO `yb_area_district` VALUES ('1988', '木里藏族自治县', '240');
INSERT INTO `yb_area_district` VALUES ('1989', '盐源县', '240');
INSERT INTO `yb_area_district` VALUES ('1990', '德昌县', '240');
INSERT INTO `yb_area_district` VALUES ('1991', '会理县', '240');
INSERT INTO `yb_area_district` VALUES ('1992', '会东县', '240');
INSERT INTO `yb_area_district` VALUES ('1993', '宁南县', '240');
INSERT INTO `yb_area_district` VALUES ('1994', '普格县', '240');
INSERT INTO `yb_area_district` VALUES ('1995', '布拖县', '240');
INSERT INTO `yb_area_district` VALUES ('1996', '金阳县', '240');
INSERT INTO `yb_area_district` VALUES ('1997', '昭觉县', '240');
INSERT INTO `yb_area_district` VALUES ('1998', '喜德县', '240');
INSERT INTO `yb_area_district` VALUES ('1999', '冕宁县', '240');
INSERT INTO `yb_area_district` VALUES ('2000', '越西县', '240');
INSERT INTO `yb_area_district` VALUES ('2001', '甘洛县', '240');
INSERT INTO `yb_area_district` VALUES ('2002', '美姑县', '240');
INSERT INTO `yb_area_district` VALUES ('2003', '雷波县', '240');
INSERT INTO `yb_area_district` VALUES ('2004', '雨城区', '241');
INSERT INTO `yb_area_district` VALUES ('2005', '名山县', '241');
INSERT INTO `yb_area_district` VALUES ('2006', '荥经县', '241');
INSERT INTO `yb_area_district` VALUES ('2007', '汉源县', '241');
INSERT INTO `yb_area_district` VALUES ('2008', '石棉县', '241');
INSERT INTO `yb_area_district` VALUES ('2009', '天全县', '241');
INSERT INTO `yb_area_district` VALUES ('2010', '芦山县', '241');
INSERT INTO `yb_area_district` VALUES ('2011', '宝兴县', '241');
INSERT INTO `yb_area_district` VALUES ('2012', '康定县', '242');
INSERT INTO `yb_area_district` VALUES ('2013', '泸定县', '242');
INSERT INTO `yb_area_district` VALUES ('2014', '丹巴县', '242');
INSERT INTO `yb_area_district` VALUES ('2015', '九龙县', '242');
INSERT INTO `yb_area_district` VALUES ('2016', '雅江县', '242');
INSERT INTO `yb_area_district` VALUES ('2017', '道孚县', '242');
INSERT INTO `yb_area_district` VALUES ('2018', '炉霍县', '242');
INSERT INTO `yb_area_district` VALUES ('2019', '甘孜县', '242');
INSERT INTO `yb_area_district` VALUES ('2020', '新龙县', '242');
INSERT INTO `yb_area_district` VALUES ('2021', '德格县', '242');
INSERT INTO `yb_area_district` VALUES ('2022', '白玉县', '242');
INSERT INTO `yb_area_district` VALUES ('2023', '石渠县', '242');
INSERT INTO `yb_area_district` VALUES ('2024', '色达县', '242');
INSERT INTO `yb_area_district` VALUES ('2025', '理塘县', '242');
INSERT INTO `yb_area_district` VALUES ('2026', '巴塘县', '242');
INSERT INTO `yb_area_district` VALUES ('2027', '乡城县', '242');
INSERT INTO `yb_area_district` VALUES ('2028', '稻城县', '242');
INSERT INTO `yb_area_district` VALUES ('2029', '得荣县', '242');
INSERT INTO `yb_area_district` VALUES ('2030', '汶川县', '243');
INSERT INTO `yb_area_district` VALUES ('2031', '理县', '243');
INSERT INTO `yb_area_district` VALUES ('2032', '茂县', '243');
INSERT INTO `yb_area_district` VALUES ('2033', '松潘县', '243');
INSERT INTO `yb_area_district` VALUES ('2034', '九寨沟县', '243');
INSERT INTO `yb_area_district` VALUES ('2035', '金川县', '243');
INSERT INTO `yb_area_district` VALUES ('2036', '小金县', '243');
INSERT INTO `yb_area_district` VALUES ('2037', '黑水县', '243');
INSERT INTO `yb_area_district` VALUES ('2038', '马尔康县', '243');
INSERT INTO `yb_area_district` VALUES ('2039', '壤塘县', '243');
INSERT INTO `yb_area_district` VALUES ('2040', '阿坝县', '243');
INSERT INTO `yb_area_district` VALUES ('2041', '若尔盖县', '243');
INSERT INTO `yb_area_district` VALUES ('2042', '红原县', '243');
INSERT INTO `yb_area_district` VALUES ('2043', '旌阳区', '244');
INSERT INTO `yb_area_district` VALUES ('2044', '中江县', '244');
INSERT INTO `yb_area_district` VALUES ('2045', '罗江县', '244');
INSERT INTO `yb_area_district` VALUES ('2046', '广汉市', '244');
INSERT INTO `yb_area_district` VALUES ('2047', '什邡市', '244');
INSERT INTO `yb_area_district` VALUES ('2048', '绵竹市', '244');
INSERT INTO `yb_area_district` VALUES ('2049', '市中区', '245');
INSERT INTO `yb_area_district` VALUES ('2050', '元坝区', '245');
INSERT INTO `yb_area_district` VALUES ('2051', '朝天区', '245');
INSERT INTO `yb_area_district` VALUES ('2052', '旺苍县', '245');
INSERT INTO `yb_area_district` VALUES ('2053', '青川县', '245');
INSERT INTO `yb_area_district` VALUES ('2054', '剑阁县', '245');
INSERT INTO `yb_area_district` VALUES ('2055', '苍溪县', '245');
INSERT INTO `yb_area_district` VALUES ('2056', '南明区', '246');
INSERT INTO `yb_area_district` VALUES ('2057', '云岩区', '246');
INSERT INTO `yb_area_district` VALUES ('2058', '花溪区', '246');
INSERT INTO `yb_area_district` VALUES ('2059', '乌当区', '246');
INSERT INTO `yb_area_district` VALUES ('2060', '白云区', '246');
INSERT INTO `yb_area_district` VALUES ('2061', '小河区', '246');
INSERT INTO `yb_area_district` VALUES ('2062', '开阳县', '246');
INSERT INTO `yb_area_district` VALUES ('2063', '息烽县', '246');
INSERT INTO `yb_area_district` VALUES ('2064', '修文县', '246');
INSERT INTO `yb_area_district` VALUES ('2065', '清镇市', '246');
INSERT INTO `yb_area_district` VALUES ('2066', '红花岗区', '247');
INSERT INTO `yb_area_district` VALUES ('2067', '汇川区', '247');
INSERT INTO `yb_area_district` VALUES ('2068', '遵义县', '247');
INSERT INTO `yb_area_district` VALUES ('2069', '桐梓县', '247');
INSERT INTO `yb_area_district` VALUES ('2070', '绥阳县', '247');
INSERT INTO `yb_area_district` VALUES ('2071', '正安县', '247');
INSERT INTO `yb_area_district` VALUES ('2072', '道真仡佬族苗族自治县', '247');
INSERT INTO `yb_area_district` VALUES ('2073', '务川仡佬族苗族自治县', '247');
INSERT INTO `yb_area_district` VALUES ('2074', '凤冈县', '247');
INSERT INTO `yb_area_district` VALUES ('2075', '湄潭县', '247');
INSERT INTO `yb_area_district` VALUES ('2076', '余庆县', '247');
INSERT INTO `yb_area_district` VALUES ('2077', '习水县', '247');
INSERT INTO `yb_area_district` VALUES ('2078', '赤水市', '247');
INSERT INTO `yb_area_district` VALUES ('2079', '仁怀市', '247');
INSERT INTO `yb_area_district` VALUES ('2080', '西秀区', '248');
INSERT INTO `yb_area_district` VALUES ('2081', '平坝县', '248');
INSERT INTO `yb_area_district` VALUES ('2082', '普定县', '248');
INSERT INTO `yb_area_district` VALUES ('2083', '镇宁布依族苗族自治县', '248');
INSERT INTO `yb_area_district` VALUES ('2084', '关岭布依族苗族自治县', '248');
INSERT INTO `yb_area_district` VALUES ('2085', '紫云苗族布依族自治县', '248');
INSERT INTO `yb_area_district` VALUES ('2086', '都匀市', '249');
INSERT INTO `yb_area_district` VALUES ('2087', '福泉市', '249');
INSERT INTO `yb_area_district` VALUES ('2088', '荔波县', '249');
INSERT INTO `yb_area_district` VALUES ('2089', '贵定县', '249');
INSERT INTO `yb_area_district` VALUES ('2090', '瓮安县', '249');
INSERT INTO `yb_area_district` VALUES ('2091', '独山县', '249');
INSERT INTO `yb_area_district` VALUES ('2092', '平塘县', '249');
INSERT INTO `yb_area_district` VALUES ('2093', '罗甸县', '249');
INSERT INTO `yb_area_district` VALUES ('2094', '长顺县', '249');
INSERT INTO `yb_area_district` VALUES ('2095', '龙里县', '249');
INSERT INTO `yb_area_district` VALUES ('2096', '惠水县', '249');
INSERT INTO `yb_area_district` VALUES ('2097', '三都水族自治县', '249');
INSERT INTO `yb_area_district` VALUES ('2098', '凯里市', '250');
INSERT INTO `yb_area_district` VALUES ('2099', '黄平县', '250');
INSERT INTO `yb_area_district` VALUES ('2100', '施秉县', '250');
INSERT INTO `yb_area_district` VALUES ('2101', '三穗县', '250');
INSERT INTO `yb_area_district` VALUES ('2102', '镇远县', '250');
INSERT INTO `yb_area_district` VALUES ('2103', '岑巩县', '250');
INSERT INTO `yb_area_district` VALUES ('2104', '天柱县', '250');
INSERT INTO `yb_area_district` VALUES ('2105', '锦屏县', '250');
INSERT INTO `yb_area_district` VALUES ('2106', '剑河县', '250');
INSERT INTO `yb_area_district` VALUES ('2107', '台江县', '250');
INSERT INTO `yb_area_district` VALUES ('2108', '黎平县', '250');
INSERT INTO `yb_area_district` VALUES ('2109', '榕江县', '250');
INSERT INTO `yb_area_district` VALUES ('2110', '从江县', '250');
INSERT INTO `yb_area_district` VALUES ('2111', '雷山县', '250');
INSERT INTO `yb_area_district` VALUES ('2112', '麻江县', '250');
INSERT INTO `yb_area_district` VALUES ('2113', '丹寨县', '250');
INSERT INTO `yb_area_district` VALUES ('2114', '铜仁市', '251');
INSERT INTO `yb_area_district` VALUES ('2115', '江口县', '251');
INSERT INTO `yb_area_district` VALUES ('2116', '玉屏侗族自治县', '251');
INSERT INTO `yb_area_district` VALUES ('2117', '石阡县', '251');
INSERT INTO `yb_area_district` VALUES ('2118', '思南县', '251');
INSERT INTO `yb_area_district` VALUES ('2119', '印江土家族苗族自治县', '251');
INSERT INTO `yb_area_district` VALUES ('2120', '德江县', '251');
INSERT INTO `yb_area_district` VALUES ('2121', '沿河土家族自治县', '251');
INSERT INTO `yb_area_district` VALUES ('2122', '松桃苗族自治县', '251');
INSERT INTO `yb_area_district` VALUES ('2123', '万山特区', '251');
INSERT INTO `yb_area_district` VALUES ('2124', '毕节市', '252');
INSERT INTO `yb_area_district` VALUES ('2125', '大方县', '252');
INSERT INTO `yb_area_district` VALUES ('2126', '黔西县', '252');
INSERT INTO `yb_area_district` VALUES ('2127', '金沙县', '252');
INSERT INTO `yb_area_district` VALUES ('2128', '织金县', '252');
INSERT INTO `yb_area_district` VALUES ('2129', '纳雍县', '252');
INSERT INTO `yb_area_district` VALUES ('2130', '威宁彝族回族苗族自治县', '252');
INSERT INTO `yb_area_district` VALUES ('2131', '赫章县', '252');
INSERT INTO `yb_area_district` VALUES ('2132', '钟山区', '253');
INSERT INTO `yb_area_district` VALUES ('2133', '六枝特区', '253');
INSERT INTO `yb_area_district` VALUES ('2134', '水城县', '253');
INSERT INTO `yb_area_district` VALUES ('2135', '盘县', '253');
INSERT INTO `yb_area_district` VALUES ('2136', '兴义市', '254');
INSERT INTO `yb_area_district` VALUES ('2137', '兴仁县', '254');
INSERT INTO `yb_area_district` VALUES ('2138', '普安县', '254');
INSERT INTO `yb_area_district` VALUES ('2139', '晴隆县', '254');
INSERT INTO `yb_area_district` VALUES ('2140', '贞丰县', '254');
INSERT INTO `yb_area_district` VALUES ('2141', '望谟县', '254');
INSERT INTO `yb_area_district` VALUES ('2142', '册亨县', '254');
INSERT INTO `yb_area_district` VALUES ('2143', '安龙县', '254');
INSERT INTO `yb_area_district` VALUES ('2144', '秀英区', '255');
INSERT INTO `yb_area_district` VALUES ('2145', '龙华区', '255');
INSERT INTO `yb_area_district` VALUES ('2146', '琼山区', '255');
INSERT INTO `yb_area_district` VALUES ('2147', '美兰区', '255');
INSERT INTO `yb_area_district` VALUES ('2148', '景洪市', '273');
INSERT INTO `yb_area_district` VALUES ('2149', '勐海县', '273');
INSERT INTO `yb_area_district` VALUES ('2150', '勐腊县', '273');
INSERT INTO `yb_area_district` VALUES ('2151', '瑞丽市', '274');
INSERT INTO `yb_area_district` VALUES ('2152', '潞西市', '274');
INSERT INTO `yb_area_district` VALUES ('2153', '梁河县', '274');
INSERT INTO `yb_area_district` VALUES ('2154', '盈江县', '274');
INSERT INTO `yb_area_district` VALUES ('2155', '陇川县', '274');
INSERT INTO `yb_area_district` VALUES ('2156', '昭阳区', '275');
INSERT INTO `yb_area_district` VALUES ('2157', '鲁甸县', '275');
INSERT INTO `yb_area_district` VALUES ('2158', '巧家县', '275');
INSERT INTO `yb_area_district` VALUES ('2159', '盐津县', '275');
INSERT INTO `yb_area_district` VALUES ('2160', '大关县', '275');
INSERT INTO `yb_area_district` VALUES ('2161', '永善县', '275');
INSERT INTO `yb_area_district` VALUES ('2162', '绥江县', '275');
INSERT INTO `yb_area_district` VALUES ('2163', '镇雄县', '275');
INSERT INTO `yb_area_district` VALUES ('2164', '彝良县', '275');
INSERT INTO `yb_area_district` VALUES ('2165', '威信县', '275');
INSERT INTO `yb_area_district` VALUES ('2166', '水富县', '275');
INSERT INTO `yb_area_district` VALUES ('2167', '五华区', '276');
INSERT INTO `yb_area_district` VALUES ('2168', '盘龙区', '276');
INSERT INTO `yb_area_district` VALUES ('2169', '官渡区', '276');
INSERT INTO `yb_area_district` VALUES ('2170', '西山区', '276');
INSERT INTO `yb_area_district` VALUES ('2171', '东川区', '276');
INSERT INTO `yb_area_district` VALUES ('2172', '呈贡县', '276');
INSERT INTO `yb_area_district` VALUES ('2173', '晋宁县', '276');
INSERT INTO `yb_area_district` VALUES ('2174', '富民县', '276');
INSERT INTO `yb_area_district` VALUES ('2175', '宜良县', '276');
INSERT INTO `yb_area_district` VALUES ('2176', '石林彝族自治县', '276');
INSERT INTO `yb_area_district` VALUES ('2177', '嵩明县', '276');
INSERT INTO `yb_area_district` VALUES ('2178', '禄劝彝族苗族自治县', '276');
INSERT INTO `yb_area_district` VALUES ('2179', '寻甸回族彝族自治县', '276');
INSERT INTO `yb_area_district` VALUES ('2180', '安宁市', '276');
INSERT INTO `yb_area_district` VALUES ('2181', '大理市', '277');
INSERT INTO `yb_area_district` VALUES ('2182', '漾濞彝族自治县', '277');
INSERT INTO `yb_area_district` VALUES ('2183', '祥云县', '277');
INSERT INTO `yb_area_district` VALUES ('2184', '宾川县', '277');
INSERT INTO `yb_area_district` VALUES ('2185', '弥渡县', '277');
INSERT INTO `yb_area_district` VALUES ('2186', '南涧彝族自治县', '277');
INSERT INTO `yb_area_district` VALUES ('2187', '巍山彝族回族自治县', '277');
INSERT INTO `yb_area_district` VALUES ('2188', '永平县', '277');
INSERT INTO `yb_area_district` VALUES ('2189', '云龙县', '277');
INSERT INTO `yb_area_district` VALUES ('2190', '洱源县', '277');
INSERT INTO `yb_area_district` VALUES ('2191', '剑川县', '277');
INSERT INTO `yb_area_district` VALUES ('2192', '鹤庆县', '277');
INSERT INTO `yb_area_district` VALUES ('2193', '个旧市', '278');
INSERT INTO `yb_area_district` VALUES ('2194', '开远市', '278');
INSERT INTO `yb_area_district` VALUES ('2195', '蒙自县', '278');
INSERT INTO `yb_area_district` VALUES ('2196', '屏边苗族自治县', '278');
INSERT INTO `yb_area_district` VALUES ('2197', '建水县', '278');
INSERT INTO `yb_area_district` VALUES ('2198', '石屏县', '278');
INSERT INTO `yb_area_district` VALUES ('2199', '弥勒县', '278');
INSERT INTO `yb_area_district` VALUES ('2200', '泸西县', '278');
INSERT INTO `yb_area_district` VALUES ('2201', '元阳县', '278');
INSERT INTO `yb_area_district` VALUES ('2202', '红河县', '278');
INSERT INTO `yb_area_district` VALUES ('2203', '金平苗族瑶族傣族自治县', '278');
INSERT INTO `yb_area_district` VALUES ('2204', '绿春县', '278');
INSERT INTO `yb_area_district` VALUES ('2205', '河口瑶族自治县', '278');
INSERT INTO `yb_area_district` VALUES ('2206', '麒麟区', '279');
INSERT INTO `yb_area_district` VALUES ('2207', '马龙县', '279');
INSERT INTO `yb_area_district` VALUES ('2208', '陆良县', '279');
INSERT INTO `yb_area_district` VALUES ('2209', '师宗县', '279');
INSERT INTO `yb_area_district` VALUES ('2210', '罗平县', '279');
INSERT INTO `yb_area_district` VALUES ('2211', '富源县', '279');
INSERT INTO `yb_area_district` VALUES ('2212', '会泽县', '279');
INSERT INTO `yb_area_district` VALUES ('2213', '沾益县', '279');
INSERT INTO `yb_area_district` VALUES ('2214', '宣威市', '279');
INSERT INTO `yb_area_district` VALUES ('2215', '隆阳区', '280');
INSERT INTO `yb_area_district` VALUES ('2216', '施甸县', '280');
INSERT INTO `yb_area_district` VALUES ('2217', '腾冲县', '280');
INSERT INTO `yb_area_district` VALUES ('2218', '龙陵县', '280');
INSERT INTO `yb_area_district` VALUES ('2219', '昌宁县', '280');
INSERT INTO `yb_area_district` VALUES ('2220', '文山县', '281');
INSERT INTO `yb_area_district` VALUES ('2221', '砚山县', '281');
INSERT INTO `yb_area_district` VALUES ('2222', '西畴县', '281');
INSERT INTO `yb_area_district` VALUES ('2223', '麻栗坡县', '281');
INSERT INTO `yb_area_district` VALUES ('2224', '马关县', '281');
INSERT INTO `yb_area_district` VALUES ('2225', '丘北县', '281');
INSERT INTO `yb_area_district` VALUES ('2226', '广南县', '281');
INSERT INTO `yb_area_district` VALUES ('2227', '富宁县', '281');
INSERT INTO `yb_area_district` VALUES ('2228', '红塔区', '282');
INSERT INTO `yb_area_district` VALUES ('2229', '江川县', '282');
INSERT INTO `yb_area_district` VALUES ('2230', '澄江县', '282');
INSERT INTO `yb_area_district` VALUES ('2231', '通海县', '282');
INSERT INTO `yb_area_district` VALUES ('2232', '华宁县', '282');
INSERT INTO `yb_area_district` VALUES ('2233', '易门县', '282');
INSERT INTO `yb_area_district` VALUES ('2234', '峨山彝族自治县', '282');
INSERT INTO `yb_area_district` VALUES ('2235', '新平彝族傣族自治县', '282');
INSERT INTO `yb_area_district` VALUES ('2236', '元江哈尼族彝族傣族自治县', '282');
INSERT INTO `yb_area_district` VALUES ('2237', '楚雄市', '283');
INSERT INTO `yb_area_district` VALUES ('2238', '双柏县', '283');
INSERT INTO `yb_area_district` VALUES ('2239', '牟定县', '283');
INSERT INTO `yb_area_district` VALUES ('2240', '南华县', '283');
INSERT INTO `yb_area_district` VALUES ('2241', '姚安县', '283');
INSERT INTO `yb_area_district` VALUES ('2242', '大姚县', '283');
INSERT INTO `yb_area_district` VALUES ('2243', '永仁县', '283');
INSERT INTO `yb_area_district` VALUES ('2244', '元谋县', '283');
INSERT INTO `yb_area_district` VALUES ('2245', '武定县', '283');
INSERT INTO `yb_area_district` VALUES ('2246', '禄丰县', '283');
INSERT INTO `yb_area_district` VALUES ('2247', '思茅区', '284');
INSERT INTO `yb_area_district` VALUES ('2248', '宁洱哈尼族彝族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2249', '墨江哈尼族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2250', '景东彝族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2251', '景谷傣族彝族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2252', '镇沅彝族哈尼族拉祜族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2253', '江城哈尼族彝族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2254', '孟连傣族拉祜族佤族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2255', '澜沧拉祜族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2256', '西盟佤族自治县', '284');
INSERT INTO `yb_area_district` VALUES ('2257', '临翔区', '285');
INSERT INTO `yb_area_district` VALUES ('2258', '凤庆县', '285');
INSERT INTO `yb_area_district` VALUES ('2259', '云县', '285');
INSERT INTO `yb_area_district` VALUES ('2260', '永德县', '285');
INSERT INTO `yb_area_district` VALUES ('2261', '镇康县', '285');
INSERT INTO `yb_area_district` VALUES ('2262', '双江拉祜族佤族布朗族傣族自治县', '285');
INSERT INTO `yb_area_district` VALUES ('2263', '耿马傣族佤族自治县', '285');
INSERT INTO `yb_area_district` VALUES ('2264', '沧源佤族自治县', '285');
INSERT INTO `yb_area_district` VALUES ('2265', '泸水县', '286');
INSERT INTO `yb_area_district` VALUES ('2266', '福贡县', '286');
INSERT INTO `yb_area_district` VALUES ('2267', '贡山独龙族怒族自治县', '286');
INSERT INTO `yb_area_district` VALUES ('2268', '兰坪白族普米族自治县', '286');
INSERT INTO `yb_area_district` VALUES ('2269', '香格里拉县', '287');
INSERT INTO `yb_area_district` VALUES ('2270', '德钦县', '287');
INSERT INTO `yb_area_district` VALUES ('2271', '维西傈僳族自治县', '287');
INSERT INTO `yb_area_district` VALUES ('2272', '古城区', '288');
INSERT INTO `yb_area_district` VALUES ('2273', '玉龙纳西族自治县', '288');
INSERT INTO `yb_area_district` VALUES ('2274', '永胜县', '288');
INSERT INTO `yb_area_district` VALUES ('2275', '华坪县', '288');
INSERT INTO `yb_area_district` VALUES ('2276', '宁蒗彝族自治县', '288');
INSERT INTO `yb_area_district` VALUES ('2277', '门源回族自治县', '289');
INSERT INTO `yb_area_district` VALUES ('2278', '祁连县', '289');
INSERT INTO `yb_area_district` VALUES ('2279', '海晏县', '289');
INSERT INTO `yb_area_district` VALUES ('2280', '刚察县', '289');
INSERT INTO `yb_area_district` VALUES ('2281', '城东区', '290');
INSERT INTO `yb_area_district` VALUES ('2282', '城中区', '290');
INSERT INTO `yb_area_district` VALUES ('2283', '城西区', '290');
INSERT INTO `yb_area_district` VALUES ('2284', '城北区', '290');
INSERT INTO `yb_area_district` VALUES ('2285', '大通回族土族自治县', '290');
INSERT INTO `yb_area_district` VALUES ('2286', '湟中县', '290');
INSERT INTO `yb_area_district` VALUES ('2287', '湟源县', '290');
INSERT INTO `yb_area_district` VALUES ('2288', '平安县', '291');
INSERT INTO `yb_area_district` VALUES ('2289', '民和回族土族自治县', '291');
INSERT INTO `yb_area_district` VALUES ('2290', '乐都县', '291');
INSERT INTO `yb_area_district` VALUES ('2291', '互助土族自治县', '291');
INSERT INTO `yb_area_district` VALUES ('2292', '化隆回族自治县', '291');
INSERT INTO `yb_area_district` VALUES ('2293', '循化撒拉族自治县', '291');
INSERT INTO `yb_area_district` VALUES ('2294', '同仁县', '292');
INSERT INTO `yb_area_district` VALUES ('2295', '尖扎县', '292');
INSERT INTO `yb_area_district` VALUES ('2296', '泽库县', '292');
INSERT INTO `yb_area_district` VALUES ('2297', '河南蒙古族自治县', '292');
INSERT INTO `yb_area_district` VALUES ('2298', '共和县', '293');
INSERT INTO `yb_area_district` VALUES ('2299', '同德县', '293');
INSERT INTO `yb_area_district` VALUES ('2300', '贵德县', '293');
INSERT INTO `yb_area_district` VALUES ('2301', '兴海县', '293');
INSERT INTO `yb_area_district` VALUES ('2302', '贵南县', '293');
INSERT INTO `yb_area_district` VALUES ('2303', '玛沁县', '294');
INSERT INTO `yb_area_district` VALUES ('2304', '班玛县', '294');
INSERT INTO `yb_area_district` VALUES ('2305', '甘德县', '294');
INSERT INTO `yb_area_district` VALUES ('2306', '达日县', '294');
INSERT INTO `yb_area_district` VALUES ('2307', '久治县', '294');
INSERT INTO `yb_area_district` VALUES ('2308', '玛多县', '294');
INSERT INTO `yb_area_district` VALUES ('2309', '玉树县', '295');
INSERT INTO `yb_area_district` VALUES ('2310', '杂多县', '295');
INSERT INTO `yb_area_district` VALUES ('2311', '称多县', '295');
INSERT INTO `yb_area_district` VALUES ('2312', '治多县', '295');
INSERT INTO `yb_area_district` VALUES ('2313', '囊谦县', '295');
INSERT INTO `yb_area_district` VALUES ('2314', '曲麻莱县', '295');
INSERT INTO `yb_area_district` VALUES ('2315', '格尔木市', '296');
INSERT INTO `yb_area_district` VALUES ('2316', '德令哈市', '296');
INSERT INTO `yb_area_district` VALUES ('2317', '乌兰县', '296');
INSERT INTO `yb_area_district` VALUES ('2318', '都兰县', '296');
INSERT INTO `yb_area_district` VALUES ('2319', '天峻县', '296');
INSERT INTO `yb_area_district` VALUES ('2320', '新城区', '297');
INSERT INTO `yb_area_district` VALUES ('2321', '碑林区', '297');
INSERT INTO `yb_area_district` VALUES ('2322', '莲湖区', '297');
INSERT INTO `yb_area_district` VALUES ('2323', '灞桥区', '297');
INSERT INTO `yb_area_district` VALUES ('2324', '未央区', '297');
INSERT INTO `yb_area_district` VALUES ('2325', '雁塔区', '297');
INSERT INTO `yb_area_district` VALUES ('2326', '阎良区', '297');
INSERT INTO `yb_area_district` VALUES ('2327', '临潼区', '297');
INSERT INTO `yb_area_district` VALUES ('2328', '长安区', '297');
INSERT INTO `yb_area_district` VALUES ('2329', '蓝田县', '297');
INSERT INTO `yb_area_district` VALUES ('2330', '周至县', '297');
INSERT INTO `yb_area_district` VALUES ('2331', '户县', '297');
INSERT INTO `yb_area_district` VALUES ('2332', '高陵县', '297');
INSERT INTO `yb_area_district` VALUES ('2333', '秦都区', '298');
INSERT INTO `yb_area_district` VALUES ('2334', '杨陵区', '298');
INSERT INTO `yb_area_district` VALUES ('2335', '渭城区', '298');
INSERT INTO `yb_area_district` VALUES ('2336', '三原县', '298');
INSERT INTO `yb_area_district` VALUES ('2337', '泾阳县', '298');
INSERT INTO `yb_area_district` VALUES ('2338', '乾县', '298');
INSERT INTO `yb_area_district` VALUES ('2339', '礼泉县', '298');
INSERT INTO `yb_area_district` VALUES ('2340', '永寿县', '298');
INSERT INTO `yb_area_district` VALUES ('2341', '彬县', '298');
INSERT INTO `yb_area_district` VALUES ('2342', '长武县', '298');
INSERT INTO `yb_area_district` VALUES ('2343', '旬邑县', '298');
INSERT INTO `yb_area_district` VALUES ('2344', '淳化县', '298');
INSERT INTO `yb_area_district` VALUES ('2345', '武功县', '298');
INSERT INTO `yb_area_district` VALUES ('2346', '兴平市', '298');
INSERT INTO `yb_area_district` VALUES ('2347', '宝塔区', '299');
INSERT INTO `yb_area_district` VALUES ('2348', '延长县', '299');
INSERT INTO `yb_area_district` VALUES ('2349', '延川县', '299');
INSERT INTO `yb_area_district` VALUES ('2350', '子长县', '299');
INSERT INTO `yb_area_district` VALUES ('2351', '安塞县', '299');
INSERT INTO `yb_area_district` VALUES ('2352', '志丹县', '299');
INSERT INTO `yb_area_district` VALUES ('2353', '吴起县', '299');
INSERT INTO `yb_area_district` VALUES ('2354', '甘泉县', '299');
INSERT INTO `yb_area_district` VALUES ('2355', '富县', '299');
INSERT INTO `yb_area_district` VALUES ('2356', '洛川县', '299');
INSERT INTO `yb_area_district` VALUES ('2357', '宜川县', '299');
INSERT INTO `yb_area_district` VALUES ('2358', '黄龙县', '299');
INSERT INTO `yb_area_district` VALUES ('2359', '黄陵县', '299');
INSERT INTO `yb_area_district` VALUES ('2360', '榆阳区', '300');
INSERT INTO `yb_area_district` VALUES ('2361', '神木县', '300');
INSERT INTO `yb_area_district` VALUES ('2362', '府谷县', '300');
INSERT INTO `yb_area_district` VALUES ('2363', '横山县', '300');
INSERT INTO `yb_area_district` VALUES ('2364', '靖边县', '300');
INSERT INTO `yb_area_district` VALUES ('2365', '定边县', '300');
INSERT INTO `yb_area_district` VALUES ('2366', '绥德县', '300');
INSERT INTO `yb_area_district` VALUES ('2367', '米脂县', '300');
INSERT INTO `yb_area_district` VALUES ('2368', '佳县', '300');
INSERT INTO `yb_area_district` VALUES ('2369', '吴堡县', '300');
INSERT INTO `yb_area_district` VALUES ('2370', '清涧县', '300');
INSERT INTO `yb_area_district` VALUES ('2371', '子洲县', '300');
INSERT INTO `yb_area_district` VALUES ('2372', '临渭区', '301');
INSERT INTO `yb_area_district` VALUES ('2373', '华县', '301');
INSERT INTO `yb_area_district` VALUES ('2374', '潼关县', '301');
INSERT INTO `yb_area_district` VALUES ('2375', '大荔县', '301');
INSERT INTO `yb_area_district` VALUES ('2376', '合阳县', '301');
INSERT INTO `yb_area_district` VALUES ('2377', '澄城县', '301');
INSERT INTO `yb_area_district` VALUES ('2378', '蒲城县', '301');
INSERT INTO `yb_area_district` VALUES ('2379', '白水县', '301');
INSERT INTO `yb_area_district` VALUES ('2380', '富平县', '301');
INSERT INTO `yb_area_district` VALUES ('2381', '韩城市', '301');
INSERT INTO `yb_area_district` VALUES ('2382', '华阴市', '301');
INSERT INTO `yb_area_district` VALUES ('2383', '商州区', '302');
INSERT INTO `yb_area_district` VALUES ('2384', '洛南县', '302');
INSERT INTO `yb_area_district` VALUES ('2385', '丹凤县', '302');
INSERT INTO `yb_area_district` VALUES ('2386', '商南县', '302');
INSERT INTO `yb_area_district` VALUES ('2387', '山阳县', '302');
INSERT INTO `yb_area_district` VALUES ('2388', '镇安县', '302');
INSERT INTO `yb_area_district` VALUES ('2389', '柞水县', '302');
INSERT INTO `yb_area_district` VALUES ('2390', '汉滨区', '303');
INSERT INTO `yb_area_district` VALUES ('2391', '汉阴县', '303');
INSERT INTO `yb_area_district` VALUES ('2392', '石泉县', '303');
INSERT INTO `yb_area_district` VALUES ('2393', '宁陕县', '303');
INSERT INTO `yb_area_district` VALUES ('2394', '紫阳县', '303');
INSERT INTO `yb_area_district` VALUES ('2395', '岚皋县', '303');
INSERT INTO `yb_area_district` VALUES ('2396', '平利县', '303');
INSERT INTO `yb_area_district` VALUES ('2397', '镇坪县', '303');
INSERT INTO `yb_area_district` VALUES ('2398', '旬阳县', '303');
INSERT INTO `yb_area_district` VALUES ('2399', '白河县', '303');
INSERT INTO `yb_area_district` VALUES ('2400', '汉台区', '304');
INSERT INTO `yb_area_district` VALUES ('2401', '南郑县', '304');
INSERT INTO `yb_area_district` VALUES ('2402', '城固县', '304');
INSERT INTO `yb_area_district` VALUES ('2403', '洋县', '304');
INSERT INTO `yb_area_district` VALUES ('2404', '西乡县', '304');
INSERT INTO `yb_area_district` VALUES ('2405', '勉县', '304');
INSERT INTO `yb_area_district` VALUES ('2406', '宁强县', '304');
INSERT INTO `yb_area_district` VALUES ('2407', '略阳县', '304');
INSERT INTO `yb_area_district` VALUES ('2408', '镇巴县', '304');
INSERT INTO `yb_area_district` VALUES ('2409', '留坝县', '304');
INSERT INTO `yb_area_district` VALUES ('2410', '佛坪县', '304');
INSERT INTO `yb_area_district` VALUES ('2411', '渭滨区', '305');
INSERT INTO `yb_area_district` VALUES ('2412', '金台区', '305');
INSERT INTO `yb_area_district` VALUES ('2413', '陈仓区', '305');
INSERT INTO `yb_area_district` VALUES ('2414', '凤翔县', '305');
INSERT INTO `yb_area_district` VALUES ('2415', '岐山县', '305');
INSERT INTO `yb_area_district` VALUES ('2416', '扶风县', '305');
INSERT INTO `yb_area_district` VALUES ('2417', '眉县', '305');
INSERT INTO `yb_area_district` VALUES ('2418', '陇县', '305');
INSERT INTO `yb_area_district` VALUES ('2419', '千阳县', '305');
INSERT INTO `yb_area_district` VALUES ('2420', '麟游县', '305');
INSERT INTO `yb_area_district` VALUES ('2421', '凤县', '305');
INSERT INTO `yb_area_district` VALUES ('2422', '太白县', '305');
INSERT INTO `yb_area_district` VALUES ('2423', '王益区', '306');
INSERT INTO `yb_area_district` VALUES ('2424', '印台区', '306');
INSERT INTO `yb_area_district` VALUES ('2425', '耀州区', '306');
INSERT INTO `yb_area_district` VALUES ('2426', '宜君县', '306');
INSERT INTO `yb_area_district` VALUES ('2427', '港口区', '307');
INSERT INTO `yb_area_district` VALUES ('2428', '防城区', '307');
INSERT INTO `yb_area_district` VALUES ('2429', '上思县', '307');
INSERT INTO `yb_area_district` VALUES ('2430', '东兴市', '307');
INSERT INTO `yb_area_district` VALUES ('2431', '兴宁区', '308');
INSERT INTO `yb_area_district` VALUES ('2432', '青秀区', '308');
INSERT INTO `yb_area_district` VALUES ('2433', '江南区', '308');
INSERT INTO `yb_area_district` VALUES ('2434', '西乡塘区', '308');
INSERT INTO `yb_area_district` VALUES ('2435', '良庆区', '308');
INSERT INTO `yb_area_district` VALUES ('2436', '邕宁区', '308');
INSERT INTO `yb_area_district` VALUES ('2437', '武鸣县', '308');
INSERT INTO `yb_area_district` VALUES ('2438', '隆安县', '308');
INSERT INTO `yb_area_district` VALUES ('2439', '马山县', '308');
INSERT INTO `yb_area_district` VALUES ('2440', '上林县', '308');
INSERT INTO `yb_area_district` VALUES ('2441', '宾阳县', '308');
INSERT INTO `yb_area_district` VALUES ('2442', '横县', '308');
INSERT INTO `yb_area_district` VALUES ('2443', '江洲区', '309');
INSERT INTO `yb_area_district` VALUES ('2444', '扶绥县', '309');
INSERT INTO `yb_area_district` VALUES ('2445', '宁明县', '309');
INSERT INTO `yb_area_district` VALUES ('2446', '龙州县', '309');
INSERT INTO `yb_area_district` VALUES ('2447', '大新县', '309');
INSERT INTO `yb_area_district` VALUES ('2448', '天等县', '309');
INSERT INTO `yb_area_district` VALUES ('2449', '凭祥市', '309');
INSERT INTO `yb_area_district` VALUES ('2450', '兴宾区', '310');
INSERT INTO `yb_area_district` VALUES ('2451', '忻城县', '310');
INSERT INTO `yb_area_district` VALUES ('2452', '象州县', '310');
INSERT INTO `yb_area_district` VALUES ('2453', '武宣县', '310');
INSERT INTO `yb_area_district` VALUES ('2454', '金秀瑶族自治县', '310');
INSERT INTO `yb_area_district` VALUES ('2455', '合山市', '310');
INSERT INTO `yb_area_district` VALUES ('2456', '城中区', '311');
INSERT INTO `yb_area_district` VALUES ('2457', '鱼峰区', '311');
INSERT INTO `yb_area_district` VALUES ('2458', '柳南区', '311');
INSERT INTO `yb_area_district` VALUES ('2459', '柳北区', '311');
INSERT INTO `yb_area_district` VALUES ('2460', '柳江县', '311');
INSERT INTO `yb_area_district` VALUES ('2461', '柳城县', '311');
INSERT INTO `yb_area_district` VALUES ('2462', '鹿寨县', '311');
INSERT INTO `yb_area_district` VALUES ('2463', '融安县', '311');
INSERT INTO `yb_area_district` VALUES ('2464', '融水苗族自治县', '311');
INSERT INTO `yb_area_district` VALUES ('2465', '三江侗族自治县', '311');
INSERT INTO `yb_area_district` VALUES ('2466', '秀峰区', '312');
INSERT INTO `yb_area_district` VALUES ('2467', '叠彩区', '312');
INSERT INTO `yb_area_district` VALUES ('2468', '象山区', '312');
INSERT INTO `yb_area_district` VALUES ('2469', '七星区', '312');
INSERT INTO `yb_area_district` VALUES ('2470', '雁山区', '312');
INSERT INTO `yb_area_district` VALUES ('2471', '阳朔县', '312');
INSERT INTO `yb_area_district` VALUES ('2472', '临桂县', '312');
INSERT INTO `yb_area_district` VALUES ('2473', '灵川县', '312');
INSERT INTO `yb_area_district` VALUES ('2474', '全州县', '312');
INSERT INTO `yb_area_district` VALUES ('2475', '兴安县', '312');
INSERT INTO `yb_area_district` VALUES ('2476', '永福县', '312');
INSERT INTO `yb_area_district` VALUES ('2477', '灌阳县', '312');
INSERT INTO `yb_area_district` VALUES ('2478', '龙胜各族自治县', '312');
INSERT INTO `yb_area_district` VALUES ('2479', '资源县', '312');
INSERT INTO `yb_area_district` VALUES ('2480', '平乐县', '312');
INSERT INTO `yb_area_district` VALUES ('2481', '荔浦县', '312');
INSERT INTO `yb_area_district` VALUES ('2482', '恭城瑶族自治县', '312');
INSERT INTO `yb_area_district` VALUES ('2483', '万秀区', '313');
INSERT INTO `yb_area_district` VALUES ('2484', '碟山区', '313');
INSERT INTO `yb_area_district` VALUES ('2485', '长洲区', '313');
INSERT INTO `yb_area_district` VALUES ('2486', '苍梧县', '313');
INSERT INTO `yb_area_district` VALUES ('2487', '藤县', '313');
INSERT INTO `yb_area_district` VALUES ('2488', '蒙山县', '313');
INSERT INTO `yb_area_district` VALUES ('2489', '岑溪市', '313');
INSERT INTO `yb_area_district` VALUES ('2490', '八步区', '314');
INSERT INTO `yb_area_district` VALUES ('2491', '昭平县', '314');
INSERT INTO `yb_area_district` VALUES ('2492', '钟山县', '314');
INSERT INTO `yb_area_district` VALUES ('2493', '富川瑶族自治县', '314');
INSERT INTO `yb_area_district` VALUES ('2494', '港北区', '315');
INSERT INTO `yb_area_district` VALUES ('2495', '港南区', '315');
INSERT INTO `yb_area_district` VALUES ('2496', '覃塘区', '315');
INSERT INTO `yb_area_district` VALUES ('2497', '平南县', '315');
INSERT INTO `yb_area_district` VALUES ('2498', '桂平市', '315');
INSERT INTO `yb_area_district` VALUES ('2499', '玉州区', '316');
INSERT INTO `yb_area_district` VALUES ('2500', '容县', '316');
INSERT INTO `yb_area_district` VALUES ('2501', '陆川县', '316');
INSERT INTO `yb_area_district` VALUES ('2502', '博白县', '316');
INSERT INTO `yb_area_district` VALUES ('2503', '兴业县', '316');
INSERT INTO `yb_area_district` VALUES ('2504', '北流市', '316');
INSERT INTO `yb_area_district` VALUES ('2505', '右江区', '317');
INSERT INTO `yb_area_district` VALUES ('2506', '田阳县', '317');
INSERT INTO `yb_area_district` VALUES ('2507', '田东县', '317');
INSERT INTO `yb_area_district` VALUES ('2508', '平果县', '317');
INSERT INTO `yb_area_district` VALUES ('2509', '德保县', '317');
INSERT INTO `yb_area_district` VALUES ('2510', '靖西县', '317');
INSERT INTO `yb_area_district` VALUES ('2511', '那坡县', '317');
INSERT INTO `yb_area_district` VALUES ('2512', '凌云县', '317');
INSERT INTO `yb_area_district` VALUES ('2513', '乐业县', '317');
INSERT INTO `yb_area_district` VALUES ('2514', '田林县', '317');
INSERT INTO `yb_area_district` VALUES ('2515', '西林县', '317');
INSERT INTO `yb_area_district` VALUES ('2516', '隆林各族自治县', '317');
INSERT INTO `yb_area_district` VALUES ('2517', '钦南区', '318');
INSERT INTO `yb_area_district` VALUES ('2518', '钦北区', '318');
INSERT INTO `yb_area_district` VALUES ('2519', '灵山县', '318');
INSERT INTO `yb_area_district` VALUES ('2520', '浦北县', '318');
INSERT INTO `yb_area_district` VALUES ('2521', '金城江区', '319');
INSERT INTO `yb_area_district` VALUES ('2522', '南丹县', '319');
INSERT INTO `yb_area_district` VALUES ('2523', '天峨县', '319');
INSERT INTO `yb_area_district` VALUES ('2524', '凤山县', '319');
INSERT INTO `yb_area_district` VALUES ('2525', '东兰县', '319');
INSERT INTO `yb_area_district` VALUES ('2526', '罗城仫佬族自治县', '319');
INSERT INTO `yb_area_district` VALUES ('2527', '环江毛南族自治县', '319');
INSERT INTO `yb_area_district` VALUES ('2528', '巴马瑶族自治县', '319');
INSERT INTO `yb_area_district` VALUES ('2529', '都安瑶族自治县', '319');
INSERT INTO `yb_area_district` VALUES ('2530', '大化瑶族自治县', '319');
INSERT INTO `yb_area_district` VALUES ('2531', '宜州市', '319');
INSERT INTO `yb_area_district` VALUES ('2532', '海城区', '320');
INSERT INTO `yb_area_district` VALUES ('2533', '银海区', '320');
INSERT INTO `yb_area_district` VALUES ('2534', '铁山港区', '320');
INSERT INTO `yb_area_district` VALUES ('2535', '合浦县', '320');
INSERT INTO `yb_area_district` VALUES ('2536', '城关区', '321');
INSERT INTO `yb_area_district` VALUES ('2537', '林周县', '321');
INSERT INTO `yb_area_district` VALUES ('2538', '当雄县', '321');
INSERT INTO `yb_area_district` VALUES ('2539', '尼木县', '321');
INSERT INTO `yb_area_district` VALUES ('2540', '曲水县', '321');
INSERT INTO `yb_area_district` VALUES ('2541', '堆龙德庆县', '321');
INSERT INTO `yb_area_district` VALUES ('2542', '达孜县', '321');
INSERT INTO `yb_area_district` VALUES ('2543', '墨竹工卡县', '321');
INSERT INTO `yb_area_district` VALUES ('2544', '日喀则市', '322');
INSERT INTO `yb_area_district` VALUES ('2545', '南木林县', '322');
INSERT INTO `yb_area_district` VALUES ('2546', '江孜县', '322');
INSERT INTO `yb_area_district` VALUES ('2547', '定日县', '322');
INSERT INTO `yb_area_district` VALUES ('2548', '萨迦县', '322');
INSERT INTO `yb_area_district` VALUES ('2549', '拉孜县', '322');
INSERT INTO `yb_area_district` VALUES ('2550', '昂仁县', '322');
INSERT INTO `yb_area_district` VALUES ('2551', '谢通门县', '322');
INSERT INTO `yb_area_district` VALUES ('2552', '白朗县', '322');
INSERT INTO `yb_area_district` VALUES ('2553', '仁布县', '322');
INSERT INTO `yb_area_district` VALUES ('2554', '康马县', '322');
INSERT INTO `yb_area_district` VALUES ('2555', '定结县', '322');
INSERT INTO `yb_area_district` VALUES ('2556', '仲巴县', '322');
INSERT INTO `yb_area_district` VALUES ('2557', '亚东县', '322');
INSERT INTO `yb_area_district` VALUES ('2558', '吉隆县', '322');
INSERT INTO `yb_area_district` VALUES ('2559', '聂拉木县', '322');
INSERT INTO `yb_area_district` VALUES ('2560', '萨嘎县', '322');
INSERT INTO `yb_area_district` VALUES ('2561', '岗巴县', '322');
INSERT INTO `yb_area_district` VALUES ('2562', '乃东县', '323');
INSERT INTO `yb_area_district` VALUES ('2563', '扎囊县', '323');
INSERT INTO `yb_area_district` VALUES ('2564', '贡嘎县', '323');
INSERT INTO `yb_area_district` VALUES ('2565', '桑日县', '323');
INSERT INTO `yb_area_district` VALUES ('2566', '琼结县', '323');
INSERT INTO `yb_area_district` VALUES ('2567', '曲松县', '323');
INSERT INTO `yb_area_district` VALUES ('2568', '措美县', '323');
INSERT INTO `yb_area_district` VALUES ('2569', '洛扎县', '323');
INSERT INTO `yb_area_district` VALUES ('2570', '加查县', '323');
INSERT INTO `yb_area_district` VALUES ('2571', '隆子县', '323');
INSERT INTO `yb_area_district` VALUES ('2572', '错那县', '323');
INSERT INTO `yb_area_district` VALUES ('2573', '浪卡子县', '323');
INSERT INTO `yb_area_district` VALUES ('2574', '林芝县', '324');
INSERT INTO `yb_area_district` VALUES ('2575', '工布江达县', '324');
INSERT INTO `yb_area_district` VALUES ('2576', '米林县', '324');
INSERT INTO `yb_area_district` VALUES ('2577', '墨脱县', '324');
INSERT INTO `yb_area_district` VALUES ('2578', '波密县', '324');
INSERT INTO `yb_area_district` VALUES ('2579', '察隅县', '324');
INSERT INTO `yb_area_district` VALUES ('2580', '朗县', '324');
INSERT INTO `yb_area_district` VALUES ('2581', '昌都县', '325');
INSERT INTO `yb_area_district` VALUES ('2582', '江达县', '325');
INSERT INTO `yb_area_district` VALUES ('2583', '贡觉县', '325');
INSERT INTO `yb_area_district` VALUES ('2584', '类乌齐县', '325');
INSERT INTO `yb_area_district` VALUES ('2585', '丁青县', '325');
INSERT INTO `yb_area_district` VALUES ('2586', '察雅县', '325');
INSERT INTO `yb_area_district` VALUES ('2587', '八宿县', '325');
INSERT INTO `yb_area_district` VALUES ('2588', '左贡县', '325');
INSERT INTO `yb_area_district` VALUES ('2589', '芒康县', '325');
INSERT INTO `yb_area_district` VALUES ('2590', '洛隆县', '325');
INSERT INTO `yb_area_district` VALUES ('2591', '边坝县', '325');
INSERT INTO `yb_area_district` VALUES ('2592', '那曲县', '326');
INSERT INTO `yb_area_district` VALUES ('2593', '嘉黎县', '326');
INSERT INTO `yb_area_district` VALUES ('2594', '比如县', '326');
INSERT INTO `yb_area_district` VALUES ('2595', '聂荣县', '326');
INSERT INTO `yb_area_district` VALUES ('2596', '安多县', '326');
INSERT INTO `yb_area_district` VALUES ('2597', '申扎县', '326');
INSERT INTO `yb_area_district` VALUES ('2598', '索县', '326');
INSERT INTO `yb_area_district` VALUES ('2599', '班戈县', '326');
INSERT INTO `yb_area_district` VALUES ('2600', '巴青县', '326');
INSERT INTO `yb_area_district` VALUES ('2601', '尼玛县', '326');
INSERT INTO `yb_area_district` VALUES ('2602', '普兰县', '327');
INSERT INTO `yb_area_district` VALUES ('2603', '札达县', '327');
INSERT INTO `yb_area_district` VALUES ('2604', '噶尔县', '327');
INSERT INTO `yb_area_district` VALUES ('2605', '日土县', '327');
INSERT INTO `yb_area_district` VALUES ('2606', '革吉县', '327');
INSERT INTO `yb_area_district` VALUES ('2607', '改则县', '327');
INSERT INTO `yb_area_district` VALUES ('2608', '措勤县', '327');
INSERT INTO `yb_area_district` VALUES ('2609', '兴庆区', '328');
INSERT INTO `yb_area_district` VALUES ('2610', '西夏区', '328');
INSERT INTO `yb_area_district` VALUES ('2611', '金凤区', '328');
INSERT INTO `yb_area_district` VALUES ('2612', '永宁县', '328');
INSERT INTO `yb_area_district` VALUES ('2613', '贺兰县', '328');
INSERT INTO `yb_area_district` VALUES ('2614', '灵武市', '328');
INSERT INTO `yb_area_district` VALUES ('2615', '大武口区', '329');
INSERT INTO `yb_area_district` VALUES ('2616', '惠农区', '329');
INSERT INTO `yb_area_district` VALUES ('2617', '平罗县', '329');
INSERT INTO `yb_area_district` VALUES ('2618', '利通区', '330');
INSERT INTO `yb_area_district` VALUES ('2619', '盐池县', '330');
INSERT INTO `yb_area_district` VALUES ('2620', '同心县', '330');
INSERT INTO `yb_area_district` VALUES ('2621', '青铜峡市', '330');
INSERT INTO `yb_area_district` VALUES ('2622', '原州区', '331');
INSERT INTO `yb_area_district` VALUES ('2623', '西吉县', '331');
INSERT INTO `yb_area_district` VALUES ('2624', '隆德县', '331');
INSERT INTO `yb_area_district` VALUES ('2625', '泾源县', '331');
INSERT INTO `yb_area_district` VALUES ('2626', '彭阳县', '331');
INSERT INTO `yb_area_district` VALUES ('2627', '沙坡头区', '332');
INSERT INTO `yb_area_district` VALUES ('2628', '中宁县', '332');
INSERT INTO `yb_area_district` VALUES ('2629', '海原县', '332');
INSERT INTO `yb_area_district` VALUES ('2630', '塔城市', '333');
INSERT INTO `yb_area_district` VALUES ('2631', '乌苏市', '333');
INSERT INTO `yb_area_district` VALUES ('2632', '额敏县', '333');
INSERT INTO `yb_area_district` VALUES ('2633', '沙湾县', '333');
INSERT INTO `yb_area_district` VALUES ('2634', '托里县', '333');
INSERT INTO `yb_area_district` VALUES ('2635', '裕民县', '333');
INSERT INTO `yb_area_district` VALUES ('2636', '和布克赛尔蒙古自治县', '333');
INSERT INTO `yb_area_district` VALUES ('2637', '哈密市', '334');
INSERT INTO `yb_area_district` VALUES ('2638', '巴里坤哈萨克自治县', '334');
INSERT INTO `yb_area_district` VALUES ('2639', '伊吾县', '334');
INSERT INTO `yb_area_district` VALUES ('2640', '和田市', '335');
INSERT INTO `yb_area_district` VALUES ('2641', '和田县', '335');
INSERT INTO `yb_area_district` VALUES ('2642', '墨玉县', '335');
INSERT INTO `yb_area_district` VALUES ('2643', '皮山县', '335');
INSERT INTO `yb_area_district` VALUES ('2644', '洛浦县', '335');
INSERT INTO `yb_area_district` VALUES ('2645', '策勒县', '335');
INSERT INTO `yb_area_district` VALUES ('2646', '于田县', '335');
INSERT INTO `yb_area_district` VALUES ('2647', '民丰县', '335');
INSERT INTO `yb_area_district` VALUES ('2648', '阿勒泰市', '336');
INSERT INTO `yb_area_district` VALUES ('2649', '布尔津县', '336');
INSERT INTO `yb_area_district` VALUES ('2650', '富蕴县', '336');
INSERT INTO `yb_area_district` VALUES ('2651', '福海县', '336');
INSERT INTO `yb_area_district` VALUES ('2652', '哈巴河县', '336');
INSERT INTO `yb_area_district` VALUES ('2653', '青河县', '336');
INSERT INTO `yb_area_district` VALUES ('2654', '吉木乃县', '336');
INSERT INTO `yb_area_district` VALUES ('2655', '阿图什市', '337');
INSERT INTO `yb_area_district` VALUES ('2656', '阿克陶县', '337');
INSERT INTO `yb_area_district` VALUES ('2657', '阿合奇县', '337');
INSERT INTO `yb_area_district` VALUES ('2658', '乌恰县', '337');
INSERT INTO `yb_area_district` VALUES ('2659', '博乐市', '338');
INSERT INTO `yb_area_district` VALUES ('2660', '精河县', '338');
INSERT INTO `yb_area_district` VALUES ('2661', '温泉县', '338');
INSERT INTO `yb_area_district` VALUES ('2662', '独山子区', '339');
INSERT INTO `yb_area_district` VALUES ('2663', '克拉玛依区', '339');
INSERT INTO `yb_area_district` VALUES ('2664', '白碱滩区', '339');
INSERT INTO `yb_area_district` VALUES ('2665', '乌尔禾区', '339');
INSERT INTO `yb_area_district` VALUES ('2666', '天山区', '340');
INSERT INTO `yb_area_district` VALUES ('2667', '沙依巴克区', '340');
INSERT INTO `yb_area_district` VALUES ('2668', '新市区', '340');
INSERT INTO `yb_area_district` VALUES ('2669', '水磨沟区', '340');
INSERT INTO `yb_area_district` VALUES ('2670', '头屯河区', '340');
INSERT INTO `yb_area_district` VALUES ('2671', '达坂城区', '340');
INSERT INTO `yb_area_district` VALUES ('2672', '米东区', '340');
INSERT INTO `yb_area_district` VALUES ('2673', '乌鲁木齐县', '340');
INSERT INTO `yb_area_district` VALUES ('2674', '昌吉市', '342');
INSERT INTO `yb_area_district` VALUES ('2675', '阜康市', '342');
INSERT INTO `yb_area_district` VALUES ('2676', '呼图壁县', '342');
INSERT INTO `yb_area_district` VALUES ('2677', '玛纳斯县', '342');
INSERT INTO `yb_area_district` VALUES ('2678', '奇台县', '342');
INSERT INTO `yb_area_district` VALUES ('2679', '吉木萨尔县', '342');
INSERT INTO `yb_area_district` VALUES ('2680', '木垒哈萨克自治县', '342');
INSERT INTO `yb_area_district` VALUES ('2681', '吐鲁番市', '344');
INSERT INTO `yb_area_district` VALUES ('2682', '鄯善县', '344');
INSERT INTO `yb_area_district` VALUES ('2683', '托克逊县', '344');
INSERT INTO `yb_area_district` VALUES ('2684', '库尔勒市', '345');
INSERT INTO `yb_area_district` VALUES ('2685', '轮台县', '345');
INSERT INTO `yb_area_district` VALUES ('2686', '尉犁县', '345');
INSERT INTO `yb_area_district` VALUES ('2687', '若羌县', '345');
INSERT INTO `yb_area_district` VALUES ('2688', '且末县', '345');
INSERT INTO `yb_area_district` VALUES ('2689', '焉耆回族自治县', '345');
INSERT INTO `yb_area_district` VALUES ('2690', '和静县', '345');
INSERT INTO `yb_area_district` VALUES ('2691', '和硕县', '345');
INSERT INTO `yb_area_district` VALUES ('2692', '博湖县', '345');
INSERT INTO `yb_area_district` VALUES ('2693', '阿克苏市', '346');
INSERT INTO `yb_area_district` VALUES ('2694', '温宿县', '346');
INSERT INTO `yb_area_district` VALUES ('2695', '库车县', '346');
INSERT INTO `yb_area_district` VALUES ('2696', '沙雅县', '346');
INSERT INTO `yb_area_district` VALUES ('2697', '新和县', '346');
INSERT INTO `yb_area_district` VALUES ('2698', '拜城县', '346');
INSERT INTO `yb_area_district` VALUES ('2699', '乌什县', '346');
INSERT INTO `yb_area_district` VALUES ('2700', '阿瓦提县', '346');
INSERT INTO `yb_area_district` VALUES ('2701', '柯坪县', '346');
INSERT INTO `yb_area_district` VALUES ('2702', '喀什市', '348');
INSERT INTO `yb_area_district` VALUES ('2703', '疏附县', '348');
INSERT INTO `yb_area_district` VALUES ('2704', '疏勒县', '348');
INSERT INTO `yb_area_district` VALUES ('2705', '英吉沙县', '348');
INSERT INTO `yb_area_district` VALUES ('2706', '泽普县', '348');
INSERT INTO `yb_area_district` VALUES ('2707', '莎车县', '348');
INSERT INTO `yb_area_district` VALUES ('2708', '叶城县', '348');
INSERT INTO `yb_area_district` VALUES ('2709', '麦盖提县', '348');
INSERT INTO `yb_area_district` VALUES ('2710', '岳普湖县', '348');
INSERT INTO `yb_area_district` VALUES ('2711', '伽师县', '348');
INSERT INTO `yb_area_district` VALUES ('2712', '巴楚县', '348');
INSERT INTO `yb_area_district` VALUES ('2713', '塔什库尔干塔吉克自治县', '348');
INSERT INTO `yb_area_district` VALUES ('2714', '伊宁市', '350');
INSERT INTO `yb_area_district` VALUES ('2715', '奎屯市', '350');
INSERT INTO `yb_area_district` VALUES ('2716', '伊宁县', '350');
INSERT INTO `yb_area_district` VALUES ('2717', '察布查尔锡伯自治县', '350');
INSERT INTO `yb_area_district` VALUES ('2718', '霍城县', '350');
INSERT INTO `yb_area_district` VALUES ('2719', '巩留县', '350');
INSERT INTO `yb_area_district` VALUES ('2720', '新源县', '350');
INSERT INTO `yb_area_district` VALUES ('2721', '昭苏县', '350');
INSERT INTO `yb_area_district` VALUES ('2722', '特克斯县', '350');
INSERT INTO `yb_area_district` VALUES ('2723', '尼勒克县', '350');
INSERT INTO `yb_area_district` VALUES ('2724', '海拉尔区', '351');
INSERT INTO `yb_area_district` VALUES ('2725', '阿荣旗', '351');
INSERT INTO `yb_area_district` VALUES ('2726', '莫力达瓦达斡尔族自治旗', '351');
INSERT INTO `yb_area_district` VALUES ('2727', '鄂伦春自治旗', '351');
INSERT INTO `yb_area_district` VALUES ('2728', '鄂温克族自治旗', '351');
INSERT INTO `yb_area_district` VALUES ('2729', '陈巴尔虎旗', '351');
INSERT INTO `yb_area_district` VALUES ('2730', '新巴尔虎左旗', '351');
INSERT INTO `yb_area_district` VALUES ('2731', '新巴尔虎右旗', '351');
INSERT INTO `yb_area_district` VALUES ('2732', '满洲里市', '351');
INSERT INTO `yb_area_district` VALUES ('2733', '牙克石市', '351');
INSERT INTO `yb_area_district` VALUES ('2734', '扎兰屯市', '351');
INSERT INTO `yb_area_district` VALUES ('2735', '额尔古纳市', '351');
INSERT INTO `yb_area_district` VALUES ('2736', '根河市', '351');
INSERT INTO `yb_area_district` VALUES ('2737', '新城区', '352');
INSERT INTO `yb_area_district` VALUES ('2738', '回民区', '352');
INSERT INTO `yb_area_district` VALUES ('2739', '玉泉区', '352');
INSERT INTO `yb_area_district` VALUES ('2740', '赛罕区', '352');
INSERT INTO `yb_area_district` VALUES ('2741', '土默特左旗', '352');
INSERT INTO `yb_area_district` VALUES ('2742', '托克托县', '352');
INSERT INTO `yb_area_district` VALUES ('2743', '和林格尔县', '352');
INSERT INTO `yb_area_district` VALUES ('2744', '清水河县', '352');
INSERT INTO `yb_area_district` VALUES ('2745', '武川县', '352');
INSERT INTO `yb_area_district` VALUES ('2746', '东河区', '353');
INSERT INTO `yb_area_district` VALUES ('2747', '昆都仑区', '353');
INSERT INTO `yb_area_district` VALUES ('2748', '青山区', '353');
INSERT INTO `yb_area_district` VALUES ('2749', '石拐区', '353');
INSERT INTO `yb_area_district` VALUES ('2750', '白云鄂博矿区', '353');
INSERT INTO `yb_area_district` VALUES ('2751', '九原区', '353');
INSERT INTO `yb_area_district` VALUES ('2752', '土默特右旗', '353');
INSERT INTO `yb_area_district` VALUES ('2753', '固阳县', '353');
INSERT INTO `yb_area_district` VALUES ('2754', '达尔罕茂明安联合旗', '353');
INSERT INTO `yb_area_district` VALUES ('2755', '海勃湾区', '354');
INSERT INTO `yb_area_district` VALUES ('2756', '海南区', '354');
INSERT INTO `yb_area_district` VALUES ('2757', '乌达区', '354');
INSERT INTO `yb_area_district` VALUES ('2758', '集宁区', '355');
INSERT INTO `yb_area_district` VALUES ('2759', '卓资县', '355');
INSERT INTO `yb_area_district` VALUES ('2760', '化德县', '355');
INSERT INTO `yb_area_district` VALUES ('2761', '商都县', '355');
INSERT INTO `yb_area_district` VALUES ('2762', '兴和县', '355');
INSERT INTO `yb_area_district` VALUES ('2763', '凉城县', '355');
INSERT INTO `yb_area_district` VALUES ('2764', '察哈尔右翼前旗', '355');
INSERT INTO `yb_area_district` VALUES ('2765', '察哈尔右翼中旗', '355');
INSERT INTO `yb_area_district` VALUES ('2766', '察哈尔右翼后旗', '355');
INSERT INTO `yb_area_district` VALUES ('2767', '四子王旗', '355');
INSERT INTO `yb_area_district` VALUES ('2768', '丰镇市', '355');
INSERT INTO `yb_area_district` VALUES ('2769', '科尔沁区', '356');
INSERT INTO `yb_area_district` VALUES ('2770', '科尔沁左翼中旗', '356');
INSERT INTO `yb_area_district` VALUES ('2771', '科尔沁左翼后旗', '356');
INSERT INTO `yb_area_district` VALUES ('2772', '开鲁县', '356');
INSERT INTO `yb_area_district` VALUES ('2773', '库伦旗', '356');
INSERT INTO `yb_area_district` VALUES ('2774', '奈曼旗', '356');
INSERT INTO `yb_area_district` VALUES ('2775', '扎鲁特旗', '356');
INSERT INTO `yb_area_district` VALUES ('2776', '霍林郭勒市', '356');
INSERT INTO `yb_area_district` VALUES ('2777', '红山区', '357');
INSERT INTO `yb_area_district` VALUES ('2778', '元宝山区', '357');
INSERT INTO `yb_area_district` VALUES ('2779', '松山区', '357');
INSERT INTO `yb_area_district` VALUES ('2780', '阿鲁科尔沁旗', '357');
INSERT INTO `yb_area_district` VALUES ('2781', '巴林左旗', '357');
INSERT INTO `yb_area_district` VALUES ('2782', '巴林右旗', '357');
INSERT INTO `yb_area_district` VALUES ('2783', '林西县', '357');
INSERT INTO `yb_area_district` VALUES ('2784', '克什克腾旗', '357');
INSERT INTO `yb_area_district` VALUES ('2785', '翁牛特旗', '357');
INSERT INTO `yb_area_district` VALUES ('2786', '喀喇沁旗', '357');
INSERT INTO `yb_area_district` VALUES ('2787', '宁城县', '357');
INSERT INTO `yb_area_district` VALUES ('2788', '敖汉旗', '357');
INSERT INTO `yb_area_district` VALUES ('2789', '东胜区', '358');
INSERT INTO `yb_area_district` VALUES ('2790', '达拉特旗', '358');
INSERT INTO `yb_area_district` VALUES ('2791', '准格尔旗', '358');
INSERT INTO `yb_area_district` VALUES ('2792', '鄂托克前旗', '358');
INSERT INTO `yb_area_district` VALUES ('2793', '鄂托克旗', '358');
INSERT INTO `yb_area_district` VALUES ('2794', '杭锦旗', '358');
INSERT INTO `yb_area_district` VALUES ('2795', '乌审旗', '358');
INSERT INTO `yb_area_district` VALUES ('2796', '伊金霍洛旗', '358');
INSERT INTO `yb_area_district` VALUES ('2797', '临河区', '359');
INSERT INTO `yb_area_district` VALUES ('2798', '五原县', '359');
INSERT INTO `yb_area_district` VALUES ('2799', '磴口县', '359');
INSERT INTO `yb_area_district` VALUES ('2800', '乌拉特前旗', '359');
INSERT INTO `yb_area_district` VALUES ('2801', '乌拉特中旗', '359');
INSERT INTO `yb_area_district` VALUES ('2802', '乌拉特后旗', '359');
INSERT INTO `yb_area_district` VALUES ('2803', '杭锦后旗', '359');
INSERT INTO `yb_area_district` VALUES ('2804', '二连浩特市', '360');
INSERT INTO `yb_area_district` VALUES ('2805', '锡林浩特市', '360');
INSERT INTO `yb_area_district` VALUES ('2806', '阿巴嘎旗', '360');
INSERT INTO `yb_area_district` VALUES ('2807', '苏尼特左旗', '360');
INSERT INTO `yb_area_district` VALUES ('2808', '苏尼特右旗', '360');
INSERT INTO `yb_area_district` VALUES ('2809', '东乌珠穆沁旗', '360');
INSERT INTO `yb_area_district` VALUES ('2810', '西乌珠穆沁旗', '360');
INSERT INTO `yb_area_district` VALUES ('2811', '太仆寺旗', '360');
INSERT INTO `yb_area_district` VALUES ('2812', '镶黄旗', '360');
INSERT INTO `yb_area_district` VALUES ('2813', '正镶白旗', '360');
INSERT INTO `yb_area_district` VALUES ('2814', '正蓝旗', '360');
INSERT INTO `yb_area_district` VALUES ('2815', '多伦县', '360');
INSERT INTO `yb_area_district` VALUES ('2816', '乌兰浩特市', '361');
INSERT INTO `yb_area_district` VALUES ('2817', '阿尔山市', '361');
INSERT INTO `yb_area_district` VALUES ('2818', '科尔沁右翼前旗', '361');
INSERT INTO `yb_area_district` VALUES ('2819', '科尔沁右翼中旗', '361');
INSERT INTO `yb_area_district` VALUES ('2820', '扎赉特旗', '361');
INSERT INTO `yb_area_district` VALUES ('2821', '突泉县', '361');
INSERT INTO `yb_area_district` VALUES ('2822', '阿拉善左旗', '362');
INSERT INTO `yb_area_district` VALUES ('2823', '阿拉善右旗', '362');
INSERT INTO `yb_area_district` VALUES ('2824', '额济纳旗', '362');
INSERT INTO `yb_area_district` VALUES ('2825', '中西区', '386');
INSERT INTO `yb_area_district` VALUES ('2826', '湾仔区', '386');
INSERT INTO `yb_area_district` VALUES ('2827', '东区', '386');
INSERT INTO `yb_area_district` VALUES ('2828', '新界', '386');
INSERT INTO `yb_area_district` VALUES ('2829', '九龙城区', '387');
INSERT INTO `yb_area_district` VALUES ('2830', '油尖旺区', '387');
INSERT INTO `yb_area_district` VALUES ('2831', '深水埗区', '387');
INSERT INTO `yb_area_district` VALUES ('2832', '黄大仙区', '387');
INSERT INTO `yb_area_district` VALUES ('2833', '观塘区', '387');
INSERT INTO `yb_area_district` VALUES ('2834', '北区', '388');
INSERT INTO `yb_area_district` VALUES ('2835', '大埔区', '388');
INSERT INTO `yb_area_district` VALUES ('2836', '沙田区', '388');
INSERT INTO `yb_area_district` VALUES ('2837', '西贡区', '388');
INSERT INTO `yb_area_district` VALUES ('2838', '元朗区', '388');
INSERT INTO `yb_area_district` VALUES ('2839', '屯门区', '388');
INSERT INTO `yb_area_district` VALUES ('2840', '荃湾区', '388');
INSERT INTO `yb_area_district` VALUES ('2841', '葵青区', '388');
INSERT INTO `yb_area_district` VALUES ('2842', '离岛区', '388');
INSERT INTO `yb_area_district` VALUES ('2843', '中正区', '364');
INSERT INTO `yb_area_district` VALUES ('2844', '大同区', '364');
INSERT INTO `yb_area_district` VALUES ('2845', '中山区', '364');
INSERT INTO `yb_area_district` VALUES ('2846', '松山区', '364');
INSERT INTO `yb_area_district` VALUES ('2847', '大安区', '364');
INSERT INTO `yb_area_district` VALUES ('2848', '万华区', '364');
INSERT INTO `yb_area_district` VALUES ('2849', '信义区', '364');
INSERT INTO `yb_area_district` VALUES ('2850', '士林区', '364');
INSERT INTO `yb_area_district` VALUES ('2851', '北投区', '364');
INSERT INTO `yb_area_district` VALUES ('2852', '内湖区', '364');
INSERT INTO `yb_area_district` VALUES ('2853', '南港区', '364');
INSERT INTO `yb_area_district` VALUES ('2854', '文山区', '364');
INSERT INTO `yb_area_district` VALUES ('2855', '新兴区', '365');
INSERT INTO `yb_area_district` VALUES ('2856', '前金区', '365');
INSERT INTO `yb_area_district` VALUES ('2857', '芩雅区', '365');
INSERT INTO `yb_area_district` VALUES ('2858', '盐埕区', '365');
INSERT INTO `yb_area_district` VALUES ('2859', '鼓山区', '365');
INSERT INTO `yb_area_district` VALUES ('2860', '旗津区', '365');
INSERT INTO `yb_area_district` VALUES ('2861', '前镇区', '365');
INSERT INTO `yb_area_district` VALUES ('2862', '三民区', '365');
INSERT INTO `yb_area_district` VALUES ('2863', '左营区', '365');
INSERT INTO `yb_area_district` VALUES ('2864', '楠梓区', '365');
INSERT INTO `yb_area_district` VALUES ('2865', '小港区', '365');
INSERT INTO `yb_area_district` VALUES ('2866', '苓雅区', '365');
INSERT INTO `yb_area_district` VALUES ('2867', '仁武区', '365');
INSERT INTO `yb_area_district` VALUES ('2868', '大社区', '365');
INSERT INTO `yb_area_district` VALUES ('2869', '冈山区', '365');
INSERT INTO `yb_area_district` VALUES ('2870', '路竹区', '365');
INSERT INTO `yb_area_district` VALUES ('2871', '阿莲区', '365');
INSERT INTO `yb_area_district` VALUES ('2872', '田寮区', '365');
INSERT INTO `yb_area_district` VALUES ('2873', '燕巢区', '365');
INSERT INTO `yb_area_district` VALUES ('2874', '桥头区', '365');
INSERT INTO `yb_area_district` VALUES ('2875', '梓官区', '365');
INSERT INTO `yb_area_district` VALUES ('2876', '弥陀区', '365');
INSERT INTO `yb_area_district` VALUES ('2877', '永安区', '365');
INSERT INTO `yb_area_district` VALUES ('2878', '湖内区', '365');
INSERT INTO `yb_area_district` VALUES ('2879', '凤山区', '365');
INSERT INTO `yb_area_district` VALUES ('2880', '大寮区', '365');
INSERT INTO `yb_area_district` VALUES ('2881', '林园区', '365');
INSERT INTO `yb_area_district` VALUES ('2882', '鸟松区', '365');
INSERT INTO `yb_area_district` VALUES ('2883', '大树区', '365');
INSERT INTO `yb_area_district` VALUES ('2884', '旗山区', '365');
INSERT INTO `yb_area_district` VALUES ('2885', '美浓区', '365');
INSERT INTO `yb_area_district` VALUES ('2886', '六龟区', '365');
INSERT INTO `yb_area_district` VALUES ('2887', '内门区', '365');
INSERT INTO `yb_area_district` VALUES ('2888', '杉林区', '365');
INSERT INTO `yb_area_district` VALUES ('2889', '甲仙区', '365');
INSERT INTO `yb_area_district` VALUES ('2890', '桃源区', '365');
INSERT INTO `yb_area_district` VALUES ('2891', '那玛夏区', '365');
INSERT INTO `yb_area_district` VALUES ('2892', '茂林区', '365');
INSERT INTO `yb_area_district` VALUES ('2893', '茄萣区', '365');
INSERT INTO `yb_area_district` VALUES ('2894', '中西区', '366');
INSERT INTO `yb_area_district` VALUES ('2895', '东区', '366');
INSERT INTO `yb_area_district` VALUES ('2896', '南区', '366');
INSERT INTO `yb_area_district` VALUES ('2897', '北区', '366');
INSERT INTO `yb_area_district` VALUES ('2898', '安平区', '366');
INSERT INTO `yb_area_district` VALUES ('2899', '安南区', '366');
INSERT INTO `yb_area_district` VALUES ('2900', '永康区', '366');
INSERT INTO `yb_area_district` VALUES ('2901', '归仁区', '366');
INSERT INTO `yb_area_district` VALUES ('2902', '新化区', '366');
INSERT INTO `yb_area_district` VALUES ('2903', '左镇区', '366');
INSERT INTO `yb_area_district` VALUES ('2904', '玉井区', '366');
INSERT INTO `yb_area_district` VALUES ('2905', '楠西区', '366');
INSERT INTO `yb_area_district` VALUES ('2906', '南化区', '366');
INSERT INTO `yb_area_district` VALUES ('2907', '仁德区', '366');
INSERT INTO `yb_area_district` VALUES ('2908', '关庙区', '366');
INSERT INTO `yb_area_district` VALUES ('2909', '龙崎区', '366');
INSERT INTO `yb_area_district` VALUES ('2910', '官田区', '366');
INSERT INTO `yb_area_district` VALUES ('2911', '麻豆区', '366');
INSERT INTO `yb_area_district` VALUES ('2912', '佳里区', '366');
INSERT INTO `yb_area_district` VALUES ('2913', '西港区', '366');
INSERT INTO `yb_area_district` VALUES ('2914', '七股区', '366');
INSERT INTO `yb_area_district` VALUES ('2915', '将军区', '366');
INSERT INTO `yb_area_district` VALUES ('2916', '学甲区', '366');
INSERT INTO `yb_area_district` VALUES ('2917', '北门区', '366');
INSERT INTO `yb_area_district` VALUES ('2918', '新营区', '366');
INSERT INTO `yb_area_district` VALUES ('2919', '后壁区', '366');
INSERT INTO `yb_area_district` VALUES ('2920', '白河区', '366');
INSERT INTO `yb_area_district` VALUES ('2921', '东山区', '366');
INSERT INTO `yb_area_district` VALUES ('2922', '六甲区', '366');
INSERT INTO `yb_area_district` VALUES ('2923', '下营区', '366');
INSERT INTO `yb_area_district` VALUES ('2924', '柳营区', '366');
INSERT INTO `yb_area_district` VALUES ('2925', '盐水区', '366');
INSERT INTO `yb_area_district` VALUES ('2926', '善化区', '366');
INSERT INTO `yb_area_district` VALUES ('2927', '大内区', '366');
INSERT INTO `yb_area_district` VALUES ('2928', '山上区', '366');
INSERT INTO `yb_area_district` VALUES ('2929', '新市区', '366');
INSERT INTO `yb_area_district` VALUES ('2930', '安定区', '366');
INSERT INTO `yb_area_district` VALUES ('2931', '中区', '367');
INSERT INTO `yb_area_district` VALUES ('2932', '东区', '367');
INSERT INTO `yb_area_district` VALUES ('2933', '南区', '367');
INSERT INTO `yb_area_district` VALUES ('2934', '西区', '367');
INSERT INTO `yb_area_district` VALUES ('2935', '北区', '367');
INSERT INTO `yb_area_district` VALUES ('2936', '北屯区', '367');
INSERT INTO `yb_area_district` VALUES ('2937', '西屯区', '367');
INSERT INTO `yb_area_district` VALUES ('2938', '南屯区', '367');
INSERT INTO `yb_area_district` VALUES ('2939', '太平区', '367');
INSERT INTO `yb_area_district` VALUES ('2940', '大里区', '367');
INSERT INTO `yb_area_district` VALUES ('2941', '雾峰区', '367');
INSERT INTO `yb_area_district` VALUES ('2942', '乌日区', '367');
INSERT INTO `yb_area_district` VALUES ('2943', '丰原区', '367');
INSERT INTO `yb_area_district` VALUES ('2944', '后里区', '367');
INSERT INTO `yb_area_district` VALUES ('2945', '石冈区', '367');
INSERT INTO `yb_area_district` VALUES ('2946', '东势区', '367');
INSERT INTO `yb_area_district` VALUES ('2947', '和平区', '367');
INSERT INTO `yb_area_district` VALUES ('2948', '新社区', '367');
INSERT INTO `yb_area_district` VALUES ('2949', '潭子区', '367');
INSERT INTO `yb_area_district` VALUES ('2950', '大雅区', '367');
INSERT INTO `yb_area_district` VALUES ('2951', '神冈区', '367');
INSERT INTO `yb_area_district` VALUES ('2952', '大肚区', '367');
INSERT INTO `yb_area_district` VALUES ('2953', '沙鹿区', '367');
INSERT INTO `yb_area_district` VALUES ('2954', '龙井区', '367');
INSERT INTO `yb_area_district` VALUES ('2955', '梧栖区', '367');
INSERT INTO `yb_area_district` VALUES ('2956', '清水区', '367');
INSERT INTO `yb_area_district` VALUES ('2957', '大甲区', '367');
INSERT INTO `yb_area_district` VALUES ('2958', '外埔区', '367');
INSERT INTO `yb_area_district` VALUES ('2959', '大安区', '367');
INSERT INTO `yb_area_district` VALUES ('2960', '金沙镇', '368');
INSERT INTO `yb_area_district` VALUES ('2961', '金湖镇', '368');
INSERT INTO `yb_area_district` VALUES ('2962', '金宁乡', '368');
INSERT INTO `yb_area_district` VALUES ('2963', '金城镇', '368');
INSERT INTO `yb_area_district` VALUES ('2964', '烈屿乡', '368');
INSERT INTO `yb_area_district` VALUES ('2965', '乌坵乡', '368');
INSERT INTO `yb_area_district` VALUES ('2966', '南投市', '369');
INSERT INTO `yb_area_district` VALUES ('2967', '中寮乡', '369');
INSERT INTO `yb_area_district` VALUES ('2968', '草屯镇', '369');
INSERT INTO `yb_area_district` VALUES ('2969', '国姓乡', '369');
INSERT INTO `yb_area_district` VALUES ('2970', '埔里镇', '369');
INSERT INTO `yb_area_district` VALUES ('2971', '仁爱乡', '369');
INSERT INTO `yb_area_district` VALUES ('2972', '名间乡', '369');
INSERT INTO `yb_area_district` VALUES ('2973', '集集镇', '369');
INSERT INTO `yb_area_district` VALUES ('2974', '水里乡', '369');
INSERT INTO `yb_area_district` VALUES ('2975', '鱼池乡', '369');
INSERT INTO `yb_area_district` VALUES ('2976', '信义乡', '369');
INSERT INTO `yb_area_district` VALUES ('2977', '竹山镇', '369');
INSERT INTO `yb_area_district` VALUES ('2978', '鹿谷乡', '369');
INSERT INTO `yb_area_district` VALUES ('2979', '仁爱区', '370');
INSERT INTO `yb_area_district` VALUES ('2980', '信义区', '370');
INSERT INTO `yb_area_district` VALUES ('2981', '中正区', '370');
INSERT INTO `yb_area_district` VALUES ('2982', '中山区', '370');
INSERT INTO `yb_area_district` VALUES ('2983', '安乐区', '370');
INSERT INTO `yb_area_district` VALUES ('2984', '暖暖区', '370');
INSERT INTO `yb_area_district` VALUES ('2985', '七堵区', '370');
INSERT INTO `yb_area_district` VALUES ('2986', '东区', '371');
INSERT INTO `yb_area_district` VALUES ('2987', '北区', '371');
INSERT INTO `yb_area_district` VALUES ('2988', '香山区', '371');
INSERT INTO `yb_area_district` VALUES ('2989', '东区', '372');
INSERT INTO `yb_area_district` VALUES ('2990', '西区', '372');
INSERT INTO `yb_area_district` VALUES ('2991', '万里区', '373');
INSERT INTO `yb_area_district` VALUES ('2992', '金山区', '373');
INSERT INTO `yb_area_district` VALUES ('2993', '板桥区', '373');
INSERT INTO `yb_area_district` VALUES ('2994', '汐止区', '373');
INSERT INTO `yb_area_district` VALUES ('2995', '深坑区', '373');
INSERT INTO `yb_area_district` VALUES ('2996', '石碇区', '373');
INSERT INTO `yb_area_district` VALUES ('2997', '瑞芳区', '373');
INSERT INTO `yb_area_district` VALUES ('2998', '平溪区', '373');
INSERT INTO `yb_area_district` VALUES ('2999', '双溪区', '373');
INSERT INTO `yb_area_district` VALUES ('3000', '贡寮区', '373');
INSERT INTO `yb_area_district` VALUES ('3001', '新店区', '373');
INSERT INTO `yb_area_district` VALUES ('3002', '坪林区', '373');
INSERT INTO `yb_area_district` VALUES ('3003', '乌来区', '373');
INSERT INTO `yb_area_district` VALUES ('3004', '永和区', '373');
INSERT INTO `yb_area_district` VALUES ('3005', '中和区', '373');
INSERT INTO `yb_area_district` VALUES ('3006', '土城区', '373');
INSERT INTO `yb_area_district` VALUES ('3007', '三峡区', '373');
INSERT INTO `yb_area_district` VALUES ('3008', '树林区', '373');
INSERT INTO `yb_area_district` VALUES ('3009', '莺歌区', '373');
INSERT INTO `yb_area_district` VALUES ('3010', '三重区', '373');
INSERT INTO `yb_area_district` VALUES ('3011', '新庄区', '373');
INSERT INTO `yb_area_district` VALUES ('3012', '泰山区', '373');
INSERT INTO `yb_area_district` VALUES ('3013', '林口区', '373');
INSERT INTO `yb_area_district` VALUES ('3014', '芦洲区', '373');
INSERT INTO `yb_area_district` VALUES ('3015', '五股区', '373');
INSERT INTO `yb_area_district` VALUES ('3016', '八里区', '373');
INSERT INTO `yb_area_district` VALUES ('3017', '淡水区', '373');
INSERT INTO `yb_area_district` VALUES ('3018', '三芝区', '373');
INSERT INTO `yb_area_district` VALUES ('3019', '石门区', '373');
INSERT INTO `yb_area_district` VALUES ('3020', '宜兰市', '374');
INSERT INTO `yb_area_district` VALUES ('3021', '头城镇', '374');
INSERT INTO `yb_area_district` VALUES ('3022', '礁溪乡', '374');
INSERT INTO `yb_area_district` VALUES ('3023', '壮围乡', '374');
INSERT INTO `yb_area_district` VALUES ('3024', '员山乡', '374');
INSERT INTO `yb_area_district` VALUES ('3025', '罗东镇', '374');
INSERT INTO `yb_area_district` VALUES ('3026', '三星乡', '374');
INSERT INTO `yb_area_district` VALUES ('3027', '大同乡', '374');
INSERT INTO `yb_area_district` VALUES ('3028', '五结乡', '374');
INSERT INTO `yb_area_district` VALUES ('3029', '冬山乡', '374');
INSERT INTO `yb_area_district` VALUES ('3030', '苏澳镇', '374');
INSERT INTO `yb_area_district` VALUES ('3031', '南澳乡', '374');
INSERT INTO `yb_area_district` VALUES ('3032', '钓鱼台', '374');
INSERT INTO `yb_area_district` VALUES ('3033', '竹北市', '375');
INSERT INTO `yb_area_district` VALUES ('3034', '湖口乡', '375');
INSERT INTO `yb_area_district` VALUES ('3035', '新丰乡', '375');
INSERT INTO `yb_area_district` VALUES ('3036', '新埔镇', '375');
INSERT INTO `yb_area_district` VALUES ('3037', '关西镇', '375');
INSERT INTO `yb_area_district` VALUES ('3038', '芎林乡', '375');
INSERT INTO `yb_area_district` VALUES ('3039', '宝山乡', '375');
INSERT INTO `yb_area_district` VALUES ('3040', '竹东镇', '375');
INSERT INTO `yb_area_district` VALUES ('3041', '五峰乡', '375');
INSERT INTO `yb_area_district` VALUES ('3042', '横山乡', '375');
INSERT INTO `yb_area_district` VALUES ('3043', '尖石乡', '375');
INSERT INTO `yb_area_district` VALUES ('3044', '北埔乡', '375');
INSERT INTO `yb_area_district` VALUES ('3045', '峨眉乡', '375');
INSERT INTO `yb_area_district` VALUES ('3046', '中坜市', '376');
INSERT INTO `yb_area_district` VALUES ('3047', '平镇市', '376');
INSERT INTO `yb_area_district` VALUES ('3048', '龙潭乡', '376');
INSERT INTO `yb_area_district` VALUES ('3049', '杨梅市', '376');
INSERT INTO `yb_area_district` VALUES ('3050', '新屋乡', '376');
INSERT INTO `yb_area_district` VALUES ('3051', '观音乡', '376');
INSERT INTO `yb_area_district` VALUES ('3052', '桃园市', '376');
INSERT INTO `yb_area_district` VALUES ('3053', '龟山乡', '376');
INSERT INTO `yb_area_district` VALUES ('3054', '八德市', '376');
INSERT INTO `yb_area_district` VALUES ('3055', '大溪镇', '376');
INSERT INTO `yb_area_district` VALUES ('3056', '复兴乡', '376');
INSERT INTO `yb_area_district` VALUES ('3057', '大园乡', '376');
INSERT INTO `yb_area_district` VALUES ('3058', '芦竹乡', '376');
INSERT INTO `yb_area_district` VALUES ('3059', '竹南镇', '377');
INSERT INTO `yb_area_district` VALUES ('3060', '头份镇', '377');
INSERT INTO `yb_area_district` VALUES ('3061', '三湾乡', '377');
INSERT INTO `yb_area_district` VALUES ('3062', '南庄乡', '377');
INSERT INTO `yb_area_district` VALUES ('3063', '狮潭乡', '377');
INSERT INTO `yb_area_district` VALUES ('3064', '后龙镇', '377');
INSERT INTO `yb_area_district` VALUES ('3065', '通霄镇', '377');
INSERT INTO `yb_area_district` VALUES ('3066', '苑里镇', '377');
INSERT INTO `yb_area_district` VALUES ('3067', '苗栗市', '377');
INSERT INTO `yb_area_district` VALUES ('3068', '造桥乡', '377');
INSERT INTO `yb_area_district` VALUES ('3069', '头屋乡', '377');
INSERT INTO `yb_area_district` VALUES ('3070', '公馆乡', '377');
INSERT INTO `yb_area_district` VALUES ('3071', '大湖乡', '377');
INSERT INTO `yb_area_district` VALUES ('3072', '泰安乡', '377');
INSERT INTO `yb_area_district` VALUES ('3073', '铜锣乡', '377');
INSERT INTO `yb_area_district` VALUES ('3074', '三义乡', '377');
INSERT INTO `yb_area_district` VALUES ('3075', '西湖乡', '377');
INSERT INTO `yb_area_district` VALUES ('3076', '卓兰镇', '377');
INSERT INTO `yb_area_district` VALUES ('3077', '彰化市', '378');
INSERT INTO `yb_area_district` VALUES ('3078', '芬园乡', '378');
INSERT INTO `yb_area_district` VALUES ('3079', '花坛乡', '378');
INSERT INTO `yb_area_district` VALUES ('3080', '秀水乡', '378');
INSERT INTO `yb_area_district` VALUES ('3081', '鹿港镇', '378');
INSERT INTO `yb_area_district` VALUES ('3082', '福兴乡', '378');
INSERT INTO `yb_area_district` VALUES ('3083', '线西乡', '378');
INSERT INTO `yb_area_district` VALUES ('3084', '和美镇', '378');
INSERT INTO `yb_area_district` VALUES ('3085', '伸港乡', '378');
INSERT INTO `yb_area_district` VALUES ('3086', '造桥乡', '378');
INSERT INTO `yb_area_district` VALUES ('3087', '头屋乡', '378');
INSERT INTO `yb_area_district` VALUES ('3088', '员林镇', '378');
INSERT INTO `yb_area_district` VALUES ('3089', '社头乡', '378');
INSERT INTO `yb_area_district` VALUES ('3090', '永靖乡', '378');
INSERT INTO `yb_area_district` VALUES ('3091', '埔心乡', '378');
INSERT INTO `yb_area_district` VALUES ('3092', '溪湖镇', '378');
INSERT INTO `yb_area_district` VALUES ('3093', '大村乡', '378');
INSERT INTO `yb_area_district` VALUES ('3094', '埔盐乡', '378');
INSERT INTO `yb_area_district` VALUES ('3095', '田中镇', '378');
INSERT INTO `yb_area_district` VALUES ('3096', '北斗镇', '378');
INSERT INTO `yb_area_district` VALUES ('3097', '田尾乡', '378');
INSERT INTO `yb_area_district` VALUES ('3098', '埤头乡', '378');
INSERT INTO `yb_area_district` VALUES ('3099', '溪州乡', '378');
INSERT INTO `yb_area_district` VALUES ('3100', '竹塘乡', '378');
INSERT INTO `yb_area_district` VALUES ('3101', '二林镇', '378');
INSERT INTO `yb_area_district` VALUES ('3102', '大城乡', '378');
INSERT INTO `yb_area_district` VALUES ('3103', '芳苑乡', '378');
INSERT INTO `yb_area_district` VALUES ('3104', '二水乡', '378');
INSERT INTO `yb_area_district` VALUES ('3105', '番路乡', '379');
INSERT INTO `yb_area_district` VALUES ('3106', '梅山乡', '379');
INSERT INTO `yb_area_district` VALUES ('3107', '竹崎乡', '379');
INSERT INTO `yb_area_district` VALUES ('3108', '阿里山乡', '379');
INSERT INTO `yb_area_district` VALUES ('3109', '中埔乡', '379');
INSERT INTO `yb_area_district` VALUES ('3110', '大埔乡', '379');
INSERT INTO `yb_area_district` VALUES ('3111', '水上乡', '379');
INSERT INTO `yb_area_district` VALUES ('3112', '鹿草乡', '379');
INSERT INTO `yb_area_district` VALUES ('3113', '太保市', '379');
INSERT INTO `yb_area_district` VALUES ('3114', '朴子市', '379');
INSERT INTO `yb_area_district` VALUES ('3115', '东石乡', '379');
INSERT INTO `yb_area_district` VALUES ('3116', '六脚乡', '379');
INSERT INTO `yb_area_district` VALUES ('3117', '新港乡', '379');
INSERT INTO `yb_area_district` VALUES ('3118', '民雄乡', '379');
INSERT INTO `yb_area_district` VALUES ('3119', '大林镇', '379');
INSERT INTO `yb_area_district` VALUES ('3120', '溪口乡', '379');
INSERT INTO `yb_area_district` VALUES ('3121', '义竹乡', '379');
INSERT INTO `yb_area_district` VALUES ('3122', '布袋镇', '379');
INSERT INTO `yb_area_district` VALUES ('3123', '斗南镇', '380');
INSERT INTO `yb_area_district` VALUES ('3124', '大埤乡', '380');
INSERT INTO `yb_area_district` VALUES ('3125', '虎尾镇', '380');
INSERT INTO `yb_area_district` VALUES ('3126', '土库镇', '380');
INSERT INTO `yb_area_district` VALUES ('3127', '褒忠乡', '380');
INSERT INTO `yb_area_district` VALUES ('3128', '东势乡', '380');
INSERT INTO `yb_area_district` VALUES ('3129', '台西乡', '380');
INSERT INTO `yb_area_district` VALUES ('3130', '仑背乡', '380');
INSERT INTO `yb_area_district` VALUES ('3131', '麦寮乡', '380');
INSERT INTO `yb_area_district` VALUES ('3132', '斗六市', '380');
INSERT INTO `yb_area_district` VALUES ('3133', '林内乡', '380');
INSERT INTO `yb_area_district` VALUES ('3134', '古坑乡', '380');
INSERT INTO `yb_area_district` VALUES ('3135', '莿桐乡', '380');
INSERT INTO `yb_area_district` VALUES ('3136', '西螺镇', '380');
INSERT INTO `yb_area_district` VALUES ('3137', '二仑乡', '380');
INSERT INTO `yb_area_district` VALUES ('3138', '北港镇', '380');
INSERT INTO `yb_area_district` VALUES ('3139', '水林乡', '380');
INSERT INTO `yb_area_district` VALUES ('3140', '口湖乡', '380');
INSERT INTO `yb_area_district` VALUES ('3141', '四湖乡', '380');
INSERT INTO `yb_area_district` VALUES ('3142', '元长乡', '380');
INSERT INTO `yb_area_district` VALUES ('3143', '屏东市', '381');
INSERT INTO `yb_area_district` VALUES ('3144', '三地门乡', '381');
INSERT INTO `yb_area_district` VALUES ('3145', '雾台乡', '381');
INSERT INTO `yb_area_district` VALUES ('3146', '玛家乡', '381');
INSERT INTO `yb_area_district` VALUES ('3147', '九如乡', '381');
INSERT INTO `yb_area_district` VALUES ('3148', '里港乡', '381');
INSERT INTO `yb_area_district` VALUES ('3149', '高树乡', '381');
INSERT INTO `yb_area_district` VALUES ('3150', '盐埔乡', '381');
INSERT INTO `yb_area_district` VALUES ('3151', '长治乡', '381');
INSERT INTO `yb_area_district` VALUES ('3152', '麟洛乡', '381');
INSERT INTO `yb_area_district` VALUES ('3153', '竹田乡', '381');
INSERT INTO `yb_area_district` VALUES ('3154', '内埔乡', '381');
INSERT INTO `yb_area_district` VALUES ('3155', '万丹乡', '381');
INSERT INTO `yb_area_district` VALUES ('3156', '潮州镇', '381');
INSERT INTO `yb_area_district` VALUES ('3157', '泰武乡', '381');
INSERT INTO `yb_area_district` VALUES ('3158', '来义乡', '381');
INSERT INTO `yb_area_district` VALUES ('3159', '万峦乡', '381');
INSERT INTO `yb_area_district` VALUES ('3160', '崁顶乡', '381');
INSERT INTO `yb_area_district` VALUES ('3161', '新埤乡', '381');
INSERT INTO `yb_area_district` VALUES ('3162', '南州乡', '381');
INSERT INTO `yb_area_district` VALUES ('3163', '林边乡', '381');
INSERT INTO `yb_area_district` VALUES ('3164', '东港镇', '381');
INSERT INTO `yb_area_district` VALUES ('3165', '琉球乡', '381');
INSERT INTO `yb_area_district` VALUES ('3166', '佳冬乡', '381');
INSERT INTO `yb_area_district` VALUES ('3167', '新园乡', '381');
INSERT INTO `yb_area_district` VALUES ('3168', '枋寮乡', '381');
INSERT INTO `yb_area_district` VALUES ('3169', '枋山乡', '381');
INSERT INTO `yb_area_district` VALUES ('3170', '春日乡', '381');
INSERT INTO `yb_area_district` VALUES ('3171', '狮子乡', '381');
INSERT INTO `yb_area_district` VALUES ('3172', '车城乡', '381');
INSERT INTO `yb_area_district` VALUES ('3173', '牡丹乡', '381');
INSERT INTO `yb_area_district` VALUES ('3174', '恒春镇', '381');
INSERT INTO `yb_area_district` VALUES ('3175', '满州乡', '381');
INSERT INTO `yb_area_district` VALUES ('3176', '台东市', '382');
INSERT INTO `yb_area_district` VALUES ('3177', '绿岛乡', '382');
INSERT INTO `yb_area_district` VALUES ('3178', '兰屿乡', '382');
INSERT INTO `yb_area_district` VALUES ('3179', '延平乡', '382');
INSERT INTO `yb_area_district` VALUES ('3180', '卑南乡', '382');
INSERT INTO `yb_area_district` VALUES ('3181', '鹿野乡', '382');
INSERT INTO `yb_area_district` VALUES ('3182', '关山镇', '382');
INSERT INTO `yb_area_district` VALUES ('3183', '海端乡', '382');
INSERT INTO `yb_area_district` VALUES ('3184', '池上乡', '382');
INSERT INTO `yb_area_district` VALUES ('3185', '东河乡', '382');
INSERT INTO `yb_area_district` VALUES ('3186', '成功镇', '382');
INSERT INTO `yb_area_district` VALUES ('3187', '长滨乡', '382');
INSERT INTO `yb_area_district` VALUES ('3188', '金峰乡', '382');
INSERT INTO `yb_area_district` VALUES ('3189', '大武乡', '382');
INSERT INTO `yb_area_district` VALUES ('3190', '达仁乡', '382');
INSERT INTO `yb_area_district` VALUES ('3191', '太麻里乡', '382');
INSERT INTO `yb_area_district` VALUES ('3192', '花莲市', '383');
INSERT INTO `yb_area_district` VALUES ('3193', '新城乡', '383');
INSERT INTO `yb_area_district` VALUES ('3194', '太鲁阁', '383');
INSERT INTO `yb_area_district` VALUES ('3195', '秀林乡', '383');
INSERT INTO `yb_area_district` VALUES ('3196', '寿丰乡', '383');
INSERT INTO `yb_area_district` VALUES ('3197', '凤林镇', '383');
INSERT INTO `yb_area_district` VALUES ('3198', '光复乡', '383');
INSERT INTO `yb_area_district` VALUES ('3199', '丰滨乡', '383');
INSERT INTO `yb_area_district` VALUES ('3200', '瑞穗乡', '383');
INSERT INTO `yb_area_district` VALUES ('3201', '万荣乡', '383');
INSERT INTO `yb_area_district` VALUES ('3202', '玉里镇', '383');
INSERT INTO `yb_area_district` VALUES ('3203', '卓溪乡', '383');
INSERT INTO `yb_area_district` VALUES ('3204', '富里乡', '383');
INSERT INTO `yb_area_district` VALUES ('3205', '马公市', '384');
INSERT INTO `yb_area_district` VALUES ('3206', '西屿乡', '384');
INSERT INTO `yb_area_district` VALUES ('3207', '望安乡', '384');
INSERT INTO `yb_area_district` VALUES ('3208', '七美乡', '384');
INSERT INTO `yb_area_district` VALUES ('3209', '白沙乡', '384');
INSERT INTO `yb_area_district` VALUES ('3210', '湖西乡', '384');
INSERT INTO `yb_area_district` VALUES ('3211', '南竿乡', '385');
INSERT INTO `yb_area_district` VALUES ('3212', '北竿乡', '385');
INSERT INTO `yb_area_district` VALUES ('3213', '莒光乡', '385');
INSERT INTO `yb_area_district` VALUES ('3214', '东引乡', '385');

-- ----------------------------
-- Table structure for yb_area_province
-- ----------------------------
DROP TABLE IF EXISTS `yb_area_province`;
CREATE TABLE `yb_area_province` (
  `provinceid` int(2) NOT NULL COMMENT '省份id',
  `provincename` varchar(15) NOT NULL COMMENT '省份名称',
  ` disorder` int(3) NOT NULL COMMENT '排序',
  `type` varchar(10) NOT NULL COMMENT '类别'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='省份';

-- ----------------------------
-- Records of yb_area_province
-- ----------------------------
INSERT INTO `yb_area_province` VALUES ('1', '北京', '1', '直辖市');
INSERT INTO `yb_area_province` VALUES ('2', '天津', '2', '直辖市');
INSERT INTO `yb_area_province` VALUES ('3', '河北省', '5', '省份');
INSERT INTO `yb_area_province` VALUES ('4', '山西省', '6', '省份');
INSERT INTO `yb_area_province` VALUES ('5', '内蒙古自治区', '32', '自治区');
INSERT INTO `yb_area_province` VALUES ('6', '辽宁省', '8', '省份');
INSERT INTO `yb_area_province` VALUES ('7', '吉林省', '9', '省份');
INSERT INTO `yb_area_province` VALUES ('8', '黑龙江省', '10', '省份');
INSERT INTO `yb_area_province` VALUES ('9', '上海市', '3', '直辖市');
INSERT INTO `yb_area_province` VALUES ('10', '江苏省', '11', '省份');
INSERT INTO `yb_area_province` VALUES ('11', '浙江省', '12', '省份');
INSERT INTO `yb_area_province` VALUES ('12', '安徽省', '13', '省份');
INSERT INTO `yb_area_province` VALUES ('13', '福建省', '14', '省份');
INSERT INTO `yb_area_province` VALUES ('14', '江西省', '15', '省份');
INSERT INTO `yb_area_province` VALUES ('15', '山东省', '16', '省份');
INSERT INTO `yb_area_province` VALUES ('16', '河南省', '17', '省份');
INSERT INTO `yb_area_province` VALUES ('17', '湖北省', '18', '省份');
INSERT INTO `yb_area_province` VALUES ('18', '湖南省', '19', '省份');
INSERT INTO `yb_area_province` VALUES ('19', '广东省', '20', '省份');
INSERT INTO `yb_area_province` VALUES ('20', '海南省', '24', '省份');
INSERT INTO `yb_area_province` VALUES ('21', '广西壮族自治区', '28', '自治区');
INSERT INTO `yb_area_province` VALUES ('22', '甘肃省', '21', '省份');
INSERT INTO `yb_area_province` VALUES ('23', '陕西省', '27', '省份');
INSERT INTO `yb_area_province` VALUES ('24', '新 疆维吾尔自治区', '31', '自治区');
INSERT INTO `yb_area_province` VALUES ('25', '青海省', '26', '省份');
INSERT INTO `yb_area_province` VALUES ('26', '宁夏回族自治区', '30', '自治区');
INSERT INTO `yb_area_province` VALUES ('27', '重庆市', '4', '直辖市');
INSERT INTO `yb_area_province` VALUES ('28', '四川省', '22', '省份');
INSERT INTO `yb_area_province` VALUES ('29', '贵州省', '23', '省份');
INSERT INTO `yb_area_province` VALUES ('30', '云南省', '25', '省份');
INSERT INTO `yb_area_province` VALUES ('31', '西藏自治区', '29', '自治区');
INSERT INTO `yb_area_province` VALUES ('32', '台湾省', '7', '省份');
INSERT INTO `yb_area_province` VALUES ('33', '澳门特别行政区', '33', '特别行政区');
INSERT INTO `yb_area_province` VALUES ('34', '香港特别行政区', '34', '特别行政区');

-- ----------------------------
-- Table structure for yb_attaches
-- ----------------------------
DROP TABLE IF EXISTS `yb_attaches`;
CREATE TABLE `yb_attaches` (
  `attachid` int(11) NOT NULL AUTO_INCREMENT,
  `attachname` varchar(125) NOT NULL,
  `attachsize` int(11) NOT NULL,
  `attachtype` varchar(125) NOT NULL,
  `attachtime` int(10) NOT NULL,
  `attachpath` varchar(512) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`attachid`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_attaches
-- ----------------------------
INSERT INTO `yb_attaches` VALUES ('41', 'bottomwx.png', '28820', 'image', '1448611814', '/upload/image/20151127/20151127161014_69859.png', '1');
INSERT INTO `yb_attaches` VALUES ('40', 'banner.png', '7638', 'image', '1448607140', '/upload/image/20151127/20151127145220_17300.png', '1');
INSERT INTO `yb_attaches` VALUES ('42', '205_3.jpg', '19646', 'image', '1448672301', '/upload/image/20151128/20151128085821_91719.jpg', '1');
INSERT INTO `yb_attaches` VALUES ('43', '3801213fb80e7bec13a502a02b2eb9389b506b77.jpg', '211375', 'image', '1448672331', '/upload/image/20151128/20151128085851_47705.jpg', '1');
INSERT INTO `yb_attaches` VALUES ('44', 'u=3057728060,1719224035&fm=21&gp=0.jpg', '13353', 'image', '1448672355', '/upload/image/20151128/20151128085915_49438.jpg', '1');
INSERT INTO `yb_attaches` VALUES ('45', 'u=2262999517,356756866&fm=21&gp=0.jpg', '19016', 'image', '1448672379', '/upload/image/20151128/20151128085939_57537.jpg', '1');
INSERT INTO `yb_attaches` VALUES ('46', 'u=3836714263,228803294&fm=21&gp=0.jpg', '17553', 'image', '1448672405', '/upload/image/20151128/20151128090005_91216.jpg', '1');
INSERT INTO `yb_attaches` VALUES ('47', 'u=3639003673,3513904029&fm=21&gp=0.jpg', '24957', 'image', '1448672422', '/upload/image/20151128/20151128090022_17651.jpg', '1');
INSERT INTO `yb_attaches` VALUES ('48', 'u=1759024281,134651032&fm=11&gp=0.jpg', '24780', 'image', '1448672439', '/upload/image/20151128/20151128090039_46732.jpg', '1');

-- ----------------------------
-- Table structure for yb_caches
-- ----------------------------
DROP TABLE IF EXISTS `yb_caches`;
CREATE TABLE `yb_caches` (
  `cachekey` varchar(125) NOT NULL,
  `cachedata` text,
  `cachetime` int(10) NOT NULL,
  `cachespace` varchar(125) NOT NULL,
  KEY `cachekey` (`cachekey`,`cachetime`,`cachespace`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_caches
-- ----------------------------

-- ----------------------------
-- Table structure for yb_category
-- ----------------------------
DROP TABLE IF EXISTS `yb_category`;
CREATE TABLE `yb_category` (
  `cid` int(5) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `catetable` varchar(125) NOT NULL COMMENT '栏目表名',
  `catid` int(11) NOT NULL COMMENT '真实的栏目id',
  `category_view` varchar(125) DEFAULT NULL COMMENT '默认的模板位置',
  `contable` varchar(125) DEFAULT NULL COMMENT '内容所在表',
  `list_view` varchar(125) DEFAULT NULL,
  `show_view` varchar(125) NOT NULL,
  `parent` int(5) unsigned DEFAULT '0' COMMENT '父级栏目ID',
  `children` varchar(255) DEFAULT NULL COMMENT '所有子栏目',
  `listorder` int(5) unsigned DEFAULT '0',
  `con_modelid` int(5) NOT NULL,
  `cat_modelid` int(5) NOT NULL COMMENT '栏目的',
  `siteid` int(5) NOT NULL DEFAULT '1' COMMENT '站点ID',
  `catname` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_category
-- ----------------------------
INSERT INTO `yb_category` VALUES ('1', 'module_category', '37', 'Content/category', 'module_article', 'Content/list', 'Content/show', '0', 'a:4:{i:9;s:1:\"3\";i:10;s:1:\"4\";i:11;s:1:\"5\";i:12;s:1:\"2\";}', '1', '59', '61', '1', '企业介绍');
INSERT INTO `yb_category` VALUES ('2', 'module_page', '20', '', '', '', 'Content/page_gsjs', '1', null, '2', '0', '60', '1', '公司简介');
INSERT INTO `yb_category` VALUES ('3', 'module_page', '21', '', '', '', 'Content/page_gsjs', '1', null, '3', '0', '60', '1', '市场前景');
INSERT INTO `yb_category` VALUES ('4', 'module_page', '22', '', '', '', 'Content/page_gsjs', '1', null, '4', '0', '60', '1', '企业文化');
INSERT INTO `yb_category` VALUES ('5', 'module_page', '23', '', '', '', 'Content/page_gsjs', '1', null, '5', '0', '60', '1', '品牌优势');
INSERT INTO `yb_category` VALUES ('29', 'module_category', '51', 'Content/category', 'module_cpmm', 'Content/list_mm', 'Content/show_mm', '0', 'a:3:{i:0;s:2:\"32\";i:1;s:2:\"33\";i:2;s:2:\"34\";}', '20', '83', '61', '1', '店面展示');
INSERT INTO `yb_category` VALUES ('30', 'module_setting', '1', '', '', '', 'Content/page', '0', null, '30', '0', '84', '1', '山东省青岛市黄岛区舟山岛路95号');
INSERT INTO `yb_category` VALUES ('28', 'module_category', '50', 'Content/category', 'module_cpmm', 'Content/list_mm', 'Content/show_mm', '26', null, '28', '83', '61', '1', '本店特色');
INSERT INTO `yb_category` VALUES ('27', 'module_category', '49', 'Content/category', 'module_cpmm', 'Content/list_mm', 'Content/show_mm', '26', null, '27', '83', '61', '1', '热门推荐');
INSERT INTO `yb_category` VALUES ('13', 'module_category', '44', 'Content/category', 'module_article', 'Content/list', 'Content/show', '0', 'a:6:{i:6;s:2:\"14\";i:7;s:2:\"15\";i:8;s:2:\"16\";i:9;s:2:\"17\";i:10;s:2:\"18\";i:11;s:2:\"19\";}', '13', '59', '61', '1', '招商政策');
INSERT INTO `yb_category` VALUES ('14', 'module_page', '25', '', '', '', 'Content/page_gsjs', '13', null, '14', '0', '60', '1', '单店政策');
INSERT INTO `yb_category` VALUES ('15', 'module_page', '26', '', '', '', 'Content/page_gsjs', '13', null, '15', '0', '60', '1', '总部支持');
INSERT INTO `yb_category` VALUES ('16', 'module_page', '27', '', '', '', 'Content/page_gsjs', '13', null, '16', '0', '60', '1', '合作答疑');
INSERT INTO `yb_category` VALUES ('17', 'module_page', '28', '', '', '', 'Content/page_gsjs', '13', null, '17', '0', '60', '1', '营销策略');
INSERT INTO `yb_category` VALUES ('18', 'module_page', '29', '', '', '', 'Content/page_gsjs', '13', null, '18', '0', '60', '1', '合作条件');
INSERT INTO `yb_category` VALUES ('19', 'module_page', '30', '', '', '', 'Content/page_gsjs', '13', null, '19', '0', '60', '1', '合作流程');
INSERT INTO `yb_category` VALUES ('26', 'module_category', '48', 'Content/category', 'module_cpmm', 'Content/list_mm', 'Content/show_mm', '0', 'a:2:{i:2;s:2:\"27\";i:3;s:2:\"28\";}', '6', '83', '61', '1', '菜品总汇');
INSERT INTO `yb_category` VALUES ('21', 'module_page', '31', '', '', '', 'Content/page_gsjs', '0', null, '21', '0', '60', '1', '人才招聘');
INSERT INTO `yb_category` VALUES ('22', 'module_category', '46', 'Content/category', 'module_article', 'Content/list', 'Content/show', '0', 'a:2:{i:2;s:2:\"23\";i:3;s:2:\"31\";}', '22', '59', '61', '1', '企业动态');
INSERT INTO `yb_category` VALUES ('23', 'module_category', '47', 'Content/category', 'module_article', 'Content/list', 'Content/show', '22', null, '23', '59', '61', '1', '加盟信息');
INSERT INTO `yb_category` VALUES ('24', 'module_page', '32', '', '', '', 'Content/page_gsjs', '0', null, '24', '0', '60', '1', '联系我们');
INSERT INTO `yb_category` VALUES ('31', 'module_category', '52', 'Content/category', 'module_article', 'Content/list', 'Content/show', '22', null, '31', '59', '61', '1', '企业动态');
INSERT INTO `yb_category` VALUES ('32', 'module_category', '53', 'Content/category', 'module_dm', 'Content/list_mm', 'Content/show_mm', '29', null, '32', '85', '61', '1', '华北地区');
INSERT INTO `yb_category` VALUES ('33', 'module_category', '54', 'Content/category', 'module_dm', 'Content/list_mm', 'Content/show_mm', '29', null, '33', '85', '61', '1', '华东地区');
INSERT INTO `yb_category` VALUES ('34', 'module_category', '55', 'Content/category', 'module_dm', 'Content/list_mm', 'Content/show_mm', '29', null, '34', '85', '61', '1', '华南地区');

-- ----------------------------
-- Table structure for yb_form
-- ----------------------------
DROP TABLE IF EXISTS `yb_form`;
CREATE TABLE `yb_form` (
  `formid` int(10) NOT NULL AUTO_INCREMENT,
  `formname` varchar(50) NOT NULL COMMENT '表单名称',
  `formsetting` text NOT NULL COMMENT '表单配置',
  `checkcode` tinyint(1) DEFAULT '0',
  `siteid` int(5) DEFAULT '1' COMMENT '站点ID',
  PRIMARY KEY (`formid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='自定义表单存放';

-- ----------------------------
-- Records of yb_form
-- ----------------------------
INSERT INTO `yb_form` VALUES ('10', '申请音浪加盟代理', 'a:7:{i:0;s:6:\"姓名\";i:1;s:6:\"性别\";i:2;s:6:\"年龄\";i:3;s:18:\"创业启动资金\";i:4;s:18:\"申请代理城市\";i:5;s:12:\"手机号码\";i:6;s:12:\"联系电话\";}', '1', '1');
INSERT INTO `yb_form` VALUES ('9', '申请全国联采', 'a:7:{i:0;s:12:\"单位名称\";i:1;s:21:\"营业执照注册号\";i:2;s:12:\"注册资金\";i:3;s:18:\"计划采购金额\";i:4;s:18:\"计划采购日期\";i:5;s:15:\"负责人姓名\";i:6;s:15:\"负责人电话\";}', '1', '1');
INSERT INTO `yb_form` VALUES ('11', '申请音浪金牌网吧', 'a:7:{i:0;s:12:\"网吧名称\";i:1;s:12:\"经营地址\";i:2;s:12:\"电脑数量\";i:3;s:18:\"普通上网价格\";i:4;s:18:\"会员上网价格\";i:5;s:15:\"负责人姓名\";i:6;s:15:\"负责人电话\";}', '1', '1');

-- ----------------------------
-- Table structure for yb_form_content
-- ----------------------------
DROP TABLE IF EXISTS `yb_form_content`;
CREATE TABLE `yb_form_content` (
  `formid` int(10) NOT NULL AUTO_INCREMENT COMMENT '表单ID',
  `value` longtext NOT NULL,
  `fid` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`formid`),
  KEY `formid` (`formid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_form_content
-- ----------------------------
INSERT INTO `yb_form_content` VALUES ('3', 'a:7:{s:12:\"网吧名称\";s:9:\"阿萨德\";s:12:\"经营地址\";s:12:\"撒大声地\";s:12:\"电脑数量\";s:9:\"阿萨德\";s:18:\"普通上网价格\";s:6:\"十大\";s:18:\"会员上网价格\";s:6:\"大厦\";s:15:\"负责人姓名\";s:8:\" 十大 \";s:15:\"负责人电话\";s:10:\" 阿萨德\";}', '11', '127.0.0.1', '1444294535');
INSERT INTO `yb_form_content` VALUES ('4', 'a:7:{s:12:\"网吧名称\";s:9:\"阿萨德\";s:12:\"经营地址\";s:12:\"撒大声地\";s:12:\"电脑数量\";s:9:\"阿萨德\";s:18:\"普通上网价格\";s:6:\"十大\";s:18:\"会员上网价格\";s:6:\"大厦\";s:15:\"负责人姓名\";s:8:\" 十大 \";s:15:\"负责人电话\";s:10:\" 阿萨德\";}', '11', '127.0.0.1', '1444294604');
INSERT INTO `yb_form_content` VALUES ('9', 'a:7:{s:12:\"网吧名称\";s:1:\"r\";s:12:\"经营地址\";s:1:\"r\";s:12:\"电脑数量\";s:1:\"r\";s:18:\"普通上网价格\";s:3:\"方\";s:18:\"会员上网价格\";s:1:\"1\";s:15:\"负责人姓名\";s:1:\"1\";s:15:\"负责人电话\";s:2:\"11\";}', '11', '127.0.0.1', '1444354093');

-- ----------------------------
-- Table structure for yb_member
-- ----------------------------
DROP TABLE IF EXISTS `yb_member`;
CREATE TABLE `yb_member` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `username` varchar(60) NOT NULL,
  `nikername` int(25) DEFAULT NULL COMMENT '用户昵称',
  `password` varchar(32) NOT NULL COMMENT '32位md5',
  `sex` tinyint(1) DEFAULT '0' COMMENT '性别',
  `birthday` date DEFAULT '0000-00-00' COMMENT '生日',
  `usermoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paypoints` int(10) DEFAULT NULL COMMENT '用户消费积分',
  `rankpoints` int(10) DEFAULT '0' COMMENT '等级积分，相当于经验值',
  `addressid` int(10) DEFAULT NULL COMMENT '默认地址ID',
  `regtime` int(10) DEFAULT '0' COMMENT '注册时间',
  `lastlogin` int(10) DEFAULT NULL,
  `lasttime` int(10) DEFAULT NULL COMMENT '最后活动时间',
  `lastip` varchar(15) DEFAULT NULL COMMENT '最后活动IP',
  `userrank` varchar(3) DEFAULT '1' COMMENT '用户等级',
  `encrypt` varchar(6) DEFAULT NULL COMMENT '盐值',
  `groupid` int(5) NOT NULL COMMENT '用户组ID',
  `qq` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_member
-- ----------------------------
INSERT INTO `yb_member` VALUES ('1', null, '123456', null, '537da4573cc95fa19eeb634e9246c140', '0', '0000-00-00', '0.00', null, '0', null, '0', '1449295781', null, null, '0', 'o_O5kI', '0', null, null);

-- ----------------------------
-- Table structure for yb_member_group
-- ----------------------------
DROP TABLE IF EXISTS `yb_member_group`;
CREATE TABLE `yb_member_group` (
  `groupid` int(5) NOT NULL AUTO_INCREMENT COMMENT '会员组ID',
  `groupname` varchar(25) NOT NULL COMMENT '会员组名称',
  `description` varchar(125) DEFAULT NULL COMMENT '介绍',
  `disabled` int(1) DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_member_group
-- ----------------------------
INSERT INTO `yb_member_group` VALUES ('6', '普通会员', '111\r\n555\r\n999', '0');

-- ----------------------------
-- Table structure for yb_model
-- ----------------------------
DROP TABLE IF EXISTS `yb_model`;
CREATE TABLE `yb_model` (
  `modelid` int(5) NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` varchar(30) NOT NULL COMMENT '模型名',
  `description` varchar(100) DEFAULT NULL COMMENT '介绍',
  `tablename` varchar(20) NOT NULL COMMENT '表名',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `disabled` int(1) DEFAULT '0' COMMENT '是否禁用',
  `is_system` int(2) DEFAULT '1',
  `is_category` int(1) DEFAULT '0',
  `is_page` int(1) DEFAULT '0' COMMENT '是否为单页面',
  PRIMARY KEY (`modelid`),
  KEY `modelid` (`modelid`),
  KEY `is_category` (`is_category`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_model
-- ----------------------------
INSERT INTO `yb_model` VALUES ('60', '单网页', '这是一个单网页模型，平时最好不修改。', 'page', '1440058628', '0', '1', '1', '1');
INSERT INTO `yb_model` VALUES ('61', '普通栏目', '普通栏目模型！', 'category', '1440654464', '0', '1', '1', '0');
INSERT INTO `yb_model` VALUES ('59', '普通文章', '这是一个普通文章模型。', 'article', '1440055360', '0', '1', '0', '0');
INSERT INTO `yb_model` VALUES ('71', '测试单网页模型', '测试的', 'test', '1444027332', '0', '1', '1', '1');
INSERT INTO `yb_model` VALUES ('63', '相册模型', '相册', 'photos', '1440812468', '0', '1', '0', '0');
INSERT INTO `yb_model` VALUES ('73', 'banner', '', 'banner', '1444112144', '0', '1', '0', '0');
INSERT INTO `yb_model` VALUES ('74', '首页模型', '首页单网页页面', 'pages', '1444177048', '0', '1', '1', '1');
INSERT INTO `yb_model` VALUES ('75', '音浪商城', '', 'pagey', '1444350622', '0', '1', '1', '1');
INSERT INTO `yb_model` VALUES ('76', '音浪金牌网吧', '音浪金牌网吧。', 'wangba', '1444372042', '0', '1', '0', '0');
INSERT INTO `yb_model` VALUES ('84', '配置', '网站配置。', 'setting', '1448601552', '0', '1', '1', '1');
INSERT INTO `yb_model` VALUES ('83', '菜品&门面', '菜品和门面模型。', 'cpmm', '1448601514', '0', '1', '0', '0');
INSERT INTO `yb_model` VALUES ('85', '店面模型', '店面，根据客户建议添加模型！', 'dm', '1448689074', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for yb_model_field
-- ----------------------------
DROP TABLE IF EXISTS `yb_model_field`;
CREATE TABLE `yb_model_field` (
  `fieldid` int(5) NOT NULL AUTO_INCREMENT COMMENT '字段ID',
  `modelid` int(5) NOT NULL COMMENT '模型ID',
  `name` varchar(20) NOT NULL COMMENT '字段输入前提示的内容',
  `tname` varchar(25) CHARACTER SET ucs2 COLLATE ucs2_estonian_ci NOT NULL COMMENT '提示信息',
  `tips` text COMMENT '提示内容',
  `pattern` varchar(225) DEFAULT NULL COMMENT '验证规则',
  `errortips` text COMMENT '验证失败的提示',
  `formtype` varchar(20) NOT NULL COMMENT '表单类型',
  `is_system` int(1) DEFAULT '0' COMMENT '是否是系统定义字段',
  `is_null` int(1) DEFAULT '1' COMMENT '是否可为空',
  `is_index` int(1) DEFAULT '0',
  `setting` text,
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COMMENT='模型字段';

-- ----------------------------
-- Records of yb_model_field
-- ----------------------------
INSERT INTO `yb_model_field` VALUES ('138', '61', 'description', '描述', null, '', '', 'textarea', '0', '1', '0', 'a:3:{s:15:\"textarea_height\";s:5:\"100px\";s:14:\"textarea_width\";s:5:\"150px\";s:11:\"placeholder\";s:6:\"描述\";}');
INSERT INTO `yb_model_field` VALUES ('136', '61', 'catname', '栏目名称', null, '', '', 'title', '0', '0', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('137', '61', 'thumb', '缩略图', null, null, null, 'picture', '0', '1', '0', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('127', '60', 'enname', '英文名称', null, '', '', 'text', '0', '1', '0', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('124', '60', 'catname', '网页标题', null, '', '', 'text', '0', '0', '1', 'a:2:{s:11:\"input_width\";s:5:\"751px\";s:12:\"input_height\";s:4:\"28px\";}');
INSERT INTO `yb_model_field` VALUES ('129', '59', 'keywords', '关键字', null, '', '', 'text', '0', '0', '1', 'a:3:{s:11:\"input_width\";s:5:\"750px\";s:12:\"input_height\";s:4:\"28px\";s:11:\"placeholder\";s:9:\"关键字\";}');
INSERT INTO `yb_model_field` VALUES ('126', '60', 'keywords', '关键字', null, '', '', 'text', '0', '1', '1', 'a:3:{s:11:\"input_width\";s:5:\"750px\";s:12:\"input_height\";s:4:\"28px\";s:11:\"placeholder\";s:9:\"关键字\";}');
INSERT INTO `yb_model_field` VALUES ('123', '59', 'title', '标题', null, '', '', 'text', '0', '0', '1', 'a:3:{s:11:\"input_width\";s:5:\"750px\";s:12:\"input_height\";s:4:\"28px\";s:11:\"placeholder\";s:6:\"标题\";}');
INSERT INTO `yb_model_field` VALUES ('128', '60', 'content', '页面内容', null, null, null, 'editor', '0', '1', '0', 'a:2:{s:13:\"editor_height\";s:5:\"480px\";s:12:\"editor_width\";s:5:\"750px\";}');
INSERT INTO `yb_model_field` VALUES ('130', '59', 'description', '描述', null, '', '', 'editor', '0', '1', '0', 'a:2:{s:13:\"editor_height\";s:5:\"200px\";s:12:\"editor_width\";s:5:\"760px\";}');
INSERT INTO `yb_model_field` VALUES ('131', '59', 'content', '内容', null, null, null, 'editor', '0', '1', '0', 'a:3:{s:11:\"input_value\";s:6:\"内容\";s:13:\"editor_height\";s:5:\"180px\";s:12:\"editor_width\";s:5:\"750px\";}');
INSERT INTO `yb_model_field` VALUES ('188', '83', 'img', '菜品图片', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('189', '83', 'description', '菜品描述', null, '', '', 'textarea', '0', '1', '0', 'a:3:{s:15:\"textarea_height\";s:5:\"100px\";s:14:\"textarea_width\";s:5:\"150px\";s:11:\"placeholder\";s:15:\"请输入描述\";}');
INSERT INTO `yb_model_field` VALUES ('141', '63', 'title', '图片名称', null, '', '', 'text', '0', '0', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('142', '63', 'description', '图片描述', null, '', '', 'textarea', '0', '1', '1', 'a:3:{s:15:\"textarea_height\";s:5:\"100px\";s:14:\"textarea_width\";s:5:\"150px\";s:11:\"placeholder\";s:12:\"图片描述\";}');
INSERT INTO `yb_model_field` VALUES ('143', '63', 'pic', '图片', null, null, null, 'picture', '0', '0', '0', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('149', '71', 'catname', '栏目名称', null, '', '', 'text', '1', '0', '1', 'a:0:{}');
INSERT INTO `yb_model_field` VALUES ('152', '73', 'title', '标题', null, '', '', 'title', '1', '0', '1', 'a:0:{}');
INSERT INTO `yb_model_field` VALUES ('153', '73', 'img', '图片', null, null, null, 'picture', '0', '0', '0', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('154', '73', 'description', '描述', null, '', '', 'textarea', '0', '1', '0', 'a:2:{s:15:\"textarea_height\";s:5:\"100px\";s:14:\"textarea_width\";s:5:\"150px\";}');
INSERT INTO `yb_model_field` VALUES ('155', '74', 'catname', '栏目名称', null, '', '', 'text', '1', '0', '1', 'a:0:{}');
INSERT INTO `yb_model_field` VALUES ('156', '74', 'title', '公告', null, '', '', 'title', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('157', '74', 'con', '公告内容 ', null, null, null, 'editor', '0', '1', '1', 'a:2:{s:13:\"editor_height\";s:5:\"360px\";s:12:\"editor_width\";s:4:\"100%\";}');
INSERT INTO `yb_model_field` VALUES ('158', '74', 'titlehuo', '活动', null, '', '', 'title', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('159', '74', 'img', '活动图片', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('160', '74', 'time', '时间', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('161', '74', 'name', '主办单位', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('179', '84', 'catname', '底部地址', null, '', '', 'text', '0', '0', '1', 'a:3:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";s:11:\"placeholder\";s:21:\"底部显示的地址\";}');
INSERT INTO `yb_model_field` VALUES ('163', '75', 'catname', '栏目名称', null, '', '', 'text', '1', '0', '1', 'a:0:{}');
INSERT INTO `yb_model_field` VALUES ('164', '75', 'img1', '淘宝', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('165', '75', 'lianjie1', '淘宝链接', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('166', '75', 'img2', '1号店', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('167', '75', 'lianjie2', '1号店链接', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('168', '75', 'img3', '京东', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('169', '75', 'lianjie3', '京东链接', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('170', '76', 'title', '网吧名称', null, '', '', 'title', '0', '0', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('171', '76', 'phonenumber', '联系电话', null, '', '', 'text', '0', '1', '0', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('172', '76', 'area', '网吧地区', null, null, null, 'areaSelect', '0', '0', '0', 'a:1:{s:15:\"areaSelectLevel\";s:1:\"3\";}');
INSERT INTO `yb_model_field` VALUES ('173', '76', 'address', '详细地址', null, '', '', 'textarea', '0', '0', '0', 'a:3:{s:15:\"textarea_height\";s:4:\"50px\";s:14:\"textarea_width\";s:5:\"240px\";s:11:\"placeholder\";s:30:\"请输入网吧的详细地址\";}');
INSERT INTO `yb_model_field` VALUES ('174', '76', 'pic', '门面图片', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('176', '74', 'phone', '手机站联系电话', null, '/^[0-9.-]+$/', '请输入数字', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('175', '76', 'comnum', '网吧规模', null, '', '', 'text', '0', '1', '1', 'a:4:{s:11:\"input_value\";s:12:\"100台以上\";s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";s:11:\"placeholder\";s:21:\"请输入网吧规模\";}');
INSERT INTO `yb_model_field` VALUES ('178', '83', 'title', '标题', null, '', '', 'title', '1', '0', '1', 'a:0:{}');
INSERT INTO `yb_model_field` VALUES ('180', '84', 'tel', '底部电话', null, '', '', 'text', '0', '1', '1', 'a:3:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";s:11:\"placeholder\";s:21:\"底部显示的电话\";}');
INSERT INTO `yb_model_field` VALUES ('181', '84', 'fax', '底部传真', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('182', '84', 'email', '底部邮箱', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('183', '84', 'banner', '首页banner', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('184', '84', 'ewm', '底部二维码', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('185', '84', 'jmrx', '加盟热线', null, '', '', 'text', '0', '1', '1', 'a:3:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";s:11:\"placeholder\";s:12:\"加盟热线\";}');
INSERT INTO `yb_model_field` VALUES ('186', '84', 'video', '视频链接', null, '', '', 'text', '0', '1', '1', 'a:3:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";s:11:\"placeholder\";s:18:\"首页视频链接\";}');
INSERT INTO `yb_model_field` VALUES ('187', '61', 'enname', '英文名称', null, '', '', 'text', '0', '1', '1', 'a:2:{s:11:\"input_width\";s:5:\"180px\";s:12:\"input_height\";s:4:\"18px\";}');
INSERT INTO `yb_model_field` VALUES ('190', '85', 'title', '标题', null, '', '', 'title', '1', '0', '1', 'a:0:{}');
INSERT INTO `yb_model_field` VALUES ('191', '85', 'img', '店面图片', null, null, null, 'picture', '0', '1', '1', 'a:1:{s:12:\"p_allow_type\";s:20:\"gif|jpg|jpeg|png|bmp\";}');
INSERT INTO `yb_model_field` VALUES ('192', '85', 'description', '店面描述', null, '', '', 'textarea', '0', '1', '1', 'a:3:{s:15:\"textarea_height\";s:5:\"100px\";s:14:\"textarea_width\";s:5:\"150px\";s:11:\"placeholder\";s:12:\"店面描述\";}');
INSERT INTO `yb_model_field` VALUES ('194', '60', 'tags', '标签', null, null, null, 'tags', '0', '1', '1', 'a:2:{s:10:\"tags_width\";s:5:\"500px\";s:11:\"tags_height\";s:5:\"120px\";}');

-- ----------------------------
-- Table structure for yb_module_article
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_article`;
CREATE TABLE `yb_module_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '0' COMMENT '点击数量',
  `template` varchar(125) DEFAULT NULL,
  `cid` char(50) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` longtext,
  `content` longtext,
  PRIMARY KEY (`id`),
  KEY `catid` (`cid`),
  KEY `title` (`title`),
  KEY `关键字` (`keywords`),
  KEY `keywords` (`keywords`),
  KEY `title_2` (`title`),
  KEY `title_3` (`title`),
  KEY `title_4` (`title`),
  KEY `title_5` (`title`),
  KEY `keywords_2` (`keywords`),
  KEY `keywords_3` (`keywords`),
  KEY `keywords_4` (`keywords`),
  KEY `keywords_5` (`keywords`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_article
-- ----------------------------
INSERT INTO `yb_module_article` VALUES ('59', '1448614721', '1448614721', '0', 'Content/show', '31', '59', '测试的企业动态', '企业动态', '测试的企业动态测试的企业动态测试的企业动态测试的企业动态', '测试的企业动态测试的企业动态测试的企业动态测试的企业动态测试的企业动态');
INSERT INTO `yb_module_article` VALUES ('60', '1448614794', '1448614794', '0', 'Content/show', '31', '60', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('61', '1448614796', '1448614796', '0', 'Content/show', '31', '61', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('62', '1448614797', '1448614797', '0', 'Content/show', '31', '62', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('63', '1448614798', '1448614798', '0', 'Content/show', '31', '63', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('64', '1448614800', '1448614800', '0', 'Content/show', '31', '64', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('65', '1448614801', '1448614801', '0', 'Content/show', '31', '65', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('66', '1448614803', '1448614803', '0', 'Content/show', '31', '66', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('67', '1448614804', '1448614804', '0', 'Content/show', '31', '67', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('68', '1448614806', '1448614806', '0', 'Content/show', '31', '68', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('69', '1448614807', '1448614807', '0', 'Content/show', '31', '69', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('70', '1448614809', '1448614809', '0', 'Content/show', '31', '70', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('71', '1448614810', '1448614810', '0', 'Content/show', '31', '71', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('72', '1448614811', '1448614811', '0', 'Content/show', '31', '72', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('73', '1448614813', '1448614813', '0', 'Content/show', '31', '73', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('74', '1448614814', '1448614814', '0', 'Content/show', '31', '74', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('75', '1448614815', '1448614815', '0', 'Content/show', '31', '75', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('76', '1448614816', '1448614816', '0', 'Content/show', '31', '76', '测试企业动态', '企业动态', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>', '<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>\r\n<h1 style=\"font-size:24px;margin:0px;font-family:ff-tisa-web-pro-1, ff-tisa-web-pro-2, \'Lucida Grande\', \'Helvetica Neue\', Helvetica, Arial, \'Hiragino Sans GB\', \'Hiragino Sans GB W3\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif;font-weight:500;line-height:1.5;color:#333333;white-space:normal;background-color:#FFFFFF;\">\r\n	企业动态\r\n</h1>');
INSERT INTO `yb_module_article` VALUES ('77', '1448673119', '1448673119', '0', 'Content/show', '23', '77', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('78', '1448673121', '1448673121', '0', 'Content/show', '23', '78', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('79', '1448673122', '1448673122', '0', 'Content/show', '23', '79', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('80', '1448673124', '1448673124', '0', 'Content/show', '23', '80', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('81', '1448673125', '1448673125', '0', 'Content/show', '23', '81', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('82', '1448673127', '1448673127', '0', 'Content/show', '23', '82', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('83', '1448673128', '1448673128', '0', 'Content/show', '23', '83', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('84', '1448673129', '1448673129', '0', 'Content/show', '23', '84', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('85', '1448673131', '1448673131', '0', 'Content/show', '23', '85', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('86', '1448673132', '1448673132', '0', 'Content/show', '23', '86', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('87', '1448673134', '1448673134', '0', 'Content/show', '23', '87', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('88', '1448673135', '1448673135', '0', 'Content/show', '23', '88', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('89', '1448673137', '1448673137', '0', 'Content/show', '23', '89', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('90', '1448673138', '1448673138', '0', 'Content/show', '23', '90', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('91', '1448673140', '1448673140', '0', 'Content/show', '23', '91', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('92', '1448673141', '1448673141', '0', 'Content/show', '23', '92', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('93', '1448673143', '1448673143', '0', 'Content/show', '23', '93', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('94', '1448673144', '1448673144', '0', 'Content/show', '23', '94', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('95', '1448673146', '1448673146', '0', 'Content/show', '23', '95', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('96', '1448673148', '1448673148', '0', 'Content/show', '23', '96', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('97', '1448673149', '1448673149', '0', 'Content/show', '23', '97', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('98', '1448673151', '1448673151', '0', 'Content/show', '23', '98', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('99', '1448673152', '1448673152', '0', 'Content/show', '23', '99', '测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('100', '1448673153', '1448673709', '0', 'Content/show', '23', '100', '测试的加盟信息阿斯顿阿萨', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');
INSERT INTO `yb_module_article` VALUES ('101', '1448673155', '1448673698', '0', 'Content/show', '23', '101', '测试的加盟信息测试的加盟信息测试的加盟信息', '加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息', '测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息测试的加盟信息');

-- ----------------------------
-- Table structure for yb_module_banner
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_banner`;
CREATE TABLE `yb_module_banner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `template` varchar(125) DEFAULT NULL,
  `hits` int(10) DEFAULT '0',
  `cid` char(50) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`),
  KEY `catid` (`cid`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_banner
-- ----------------------------

-- ----------------------------
-- Table structure for yb_module_category
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_category`;
CREATE TABLE `yb_module_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `thumb` varchar(512) DEFAULT NULL,
  `description` longtext,
  `enname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catname` (`catname`),
  KEY `catname_2` (`catname`),
  KEY `enname` (`enname`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_category
-- ----------------------------
INSERT INTO `yb_module_category` VALUES ('37', '1449104730', '1449104730', '企业介绍', '', '', 'About Us');
INSERT INTO `yb_module_category` VALUES ('41', '1448595297', '1448595297', '汤锅种类', '', '', null);
INSERT INTO `yb_module_category` VALUES ('40', '1448595279', '1448595279', '菜品总汇', '', '', null);
INSERT INTO `yb_module_category` VALUES ('42', '1448595313', '1448595313', '精品推荐', '', '', null);
INSERT INTO `yb_module_category` VALUES ('43', '1448595342', '1448595342', '特色菜品', '', '', null);
INSERT INTO `yb_module_category` VALUES ('44', '1448595520', '1448595520', '招商政策', '', '招商政策', null);
INSERT INTO `yb_module_category` VALUES ('45', '1448596041', '1448596041', '店面展示', '', '店面展示', null);
INSERT INTO `yb_module_category` VALUES ('46', '1448681366', '1448681366', '企业动态', '', '企业动态', 'News');
INSERT INTO `yb_module_category` VALUES ('47', '1448681311', '1448681311', '加盟信息', '', '', 'Join information');
INSERT INTO `yb_module_category` VALUES ('48', '1448694772', '1448694772', '菜品总汇', '', '', 'Good Foods');
INSERT INTO `yb_module_category` VALUES ('49', '1448694780', '1448694780', '热门推荐', '', '', '');
INSERT INTO `yb_module_category` VALUES ('50', '1448694790', '1448694790', '本店特色', '', '', '');
INSERT INTO `yb_module_category` VALUES ('51', '1448688507', '1448688507', '店面展示', '', '', 'About Us');
INSERT INTO `yb_module_category` VALUES ('52', '1448681372', '1448681372', '企业动态', '', '', 'Enterprise dynamics');
INSERT INTO `yb_module_category` VALUES ('53', '1448689125', '1448689125', '华北地区', '', '华北地区', 'Location');
INSERT INTO `yb_module_category` VALUES ('54', '1448689192', '1448689192', '华东地区', '', '华东地区', 'Location');
INSERT INTO `yb_module_category` VALUES ('55', '1448689224', '1448689224', '华南地区', '', '华南地区', 'Location');

-- ----------------------------
-- Table structure for yb_module_cpmm
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_cpmm`;
CREATE TABLE `yb_module_cpmm` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `template` varchar(125) DEFAULT NULL,
  `hits` int(10) DEFAULT '0',
  `cid` char(50) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`),
  KEY `catid` (`cid`),
  KEY `title` (`title`),
  KEY `img` (`img`(333)),
  KEY `img_2` (`img`(333)),
  KEY `img_3` (`img`(333))
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_cpmm
-- ----------------------------

-- ----------------------------
-- Table structure for yb_module_dm
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_dm`;
CREATE TABLE `yb_module_dm` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `template` varchar(125) DEFAULT NULL,
  `hits` int(10) DEFAULT '0',
  `cid` char(50) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`),
  KEY `catid` (`cid`),
  KEY `title` (`title`),
  KEY `img` (`img`(333))
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_dm
-- ----------------------------
INSERT INTO `yb_module_dm` VALUES ('1', '1448689578', '1448689578', 'Content/show_mm', '0', '32', '1', '测试店面1', '/upload/image/20151128/20151128085821_91719.jpg', '测试店面1');
INSERT INTO `yb_module_dm` VALUES ('2', '1448689594', '1448689594', 'Content/show_mm', '0', '32', '2', '测试店面2', '/upload/image/20151128/20151128085851_47705.jpg', '测试店面2');
INSERT INTO `yb_module_dm` VALUES ('3', '1448689621', '1448689621', 'Content/show_mm', '0', '33', '3', '测试店面3', '/upload/image/20151128/20151128085915_49438.jpg', '测试店面3测试店面3测试店面3测试店面3测试店面3');
INSERT INTO `yb_module_dm` VALUES ('4', '1448689643', '1448689643', 'Content/show_mm', '0', '33', '4', '测试店面4', '/upload/image/20151128/20151128085939_57537.jpg', '测试店面4测试店面4测试店面4测试店面4测试店面4');
INSERT INTO `yb_module_dm` VALUES ('5', '1448689660', '1448689660', 'Content/show_mm', '0', '33', '5', '测试店面5', '/upload/image/20151128/20151128090005_91216.jpg', '测试店面5测试店面5测试店面5测试店面5');
INSERT INTO `yb_module_dm` VALUES ('6', '1448689681', '1448689681', 'Content/show_mm', '0', '33', '6', '测试店面6', '/upload/image/20151128/20151128090022_17651.jpg', '测试店面6测试店面6测试店面6测试店面6测试店面6测试店面6');
INSERT INTO `yb_module_dm` VALUES ('7', '1448689697', '1448689697', 'Content/show_mm', '0', '33', '7', '测试店面7', '/upload/image/20151128/20151128090039_46732.jpg', '测试店面7测试店面7测试店面7测试店面7测试店面7测试店面7测试店面7');

-- ----------------------------
-- Table structure for yb_module_page
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_page`;
CREATE TABLE `yb_module_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `enname` varchar(255) DEFAULT NULL,
  `content` longtext,
  `tags` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catname` (`catname`),
  KEY `keywords` (`keywords`),
  KEY `catname_2` (`catname`),
  KEY `catname_3` (`catname`),
  KEY `catname_4` (`catname`),
  KEY `keywords_2` (`keywords`),
  KEY `keywords_3` (`keywords`),
  KEY `keywords_4` (`keywords`),
  KEY `catname_5` (`catname`),
  KEY `catname_6` (`catname`),
  KEY `keywords_5` (`keywords`),
  KEY `tags` (`tags`(333)),
  KEY `tags_2` (`tags`(333))
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_page
-- ----------------------------
INSERT INTO `yb_module_page` VALUES ('20', '1449464460', '1449464460', '公司简介', '', 'Company profile', '<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;青岛十三月餐饮管理有限公司成立于2012年，在餐饮行业拥有20度年丰富的经验，铸就十三月这一成果品牌，发展成专业从事烤肉的餐饮行业，为广大消费者提供欢乐聚会的场所。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<br />\r\n   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;坚持 “盟友既战友，腾飞四海” 的加盟理念。公司下辖直营管理中心、加盟管理中心、培训中心、物品配送中心、专家顾问机构，为公司未来的发展做出科学的战略规划。为中国加盟商提供强有力的后续支持。现公司拥有中、高级管理人员20余人，可长期为加盟商现场解决经营和技术等各类问题。<br />\r\n <br />\r\n   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们把关爱他人、为顾客着想摆在第一位，没有豪言壮语，没有惊天动地，我们只是籍着每一种美味的烤肉，每一道新鲜的菜品，没一款独特的笑料，每一张甜美的笑容，每一个问下的行动给顾客带来热情、细腻、皱到、耐心的服务和心凌的享受，把顾客的没意见小时当成我们的大事来完成，让十三月火锅走进千家万户，走个性化、差异化、品味化的发展道路。<br />', '');
INSERT INTO `yb_module_page` VALUES ('19', '1448428348', '1448428348', '111', '222', '5555&nbsp;&nbsp;&nbsp;&nbsp;', 'aaa', null);
INSERT INTO `yb_module_page` VALUES ('21', '1448675070', '1448675070', '市场前景', '', 'about us', '市场前景市场前景市场前景市场前景市场前景市场前景市场前景市场前景市场前景市场前景市场前景市场前景市场前景', null);
INSERT INTO `yb_module_page` VALUES ('22', '1448675078', '1448675078', '企业文化', '', 'about us', '<span style=\"white-space:normal;\">企业文化</span>', null);
INSERT INTO `yb_module_page` VALUES ('23', '1448675084', '1448675084', '品牌优势', '', 'about us', '<span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span><span style=\"white-space:normal;\">品牌优势</span>', null);
INSERT INTO `yb_module_page` VALUES ('25', '1448679907', '1448679907', '单店政策', '', 'Cooperation', '单店政策单店政策单店政策', null);
INSERT INTO `yb_module_page` VALUES ('26', '1448679914', '1448679914', '总部支持', '总部支持', 'Support', '', null);
INSERT INTO `yb_module_page` VALUES ('27', '1448679925', '1448679925', '合作答疑', '', 'Q&amp;A', '合作答疑合作答疑合作答疑合作答疑合作答疑合作答疑合作答疑合作答疑合作答疑合作答疑合作答疑', null);
INSERT INTO `yb_module_page` VALUES ('28', '1448679932', '1448679932', '营销策略', '营销策略', 'Strategy', '营销策略营销策略营销策略营销策略营销策略营销策略', null);
INSERT INTO `yb_module_page` VALUES ('29', '1448679939', '1448679939', '合作条件', '合作条件', 'Conditions', '<p>\r\n	合作条件合作条件合作条件合作条件合作条件合作条件\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', null);
INSERT INTO `yb_module_page` VALUES ('30', '1448679946', '1448679946', '合作流程', '', 'Procedures', '合作流程合作流程合作流程合作流程合作流程合作流程合作流程合作流程合作流程', null);
INSERT INTO `yb_module_page` VALUES ('31', '1448679961', '1448679961', '人才招聘', '', '', '人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘人才招聘', null);
INSERT INTO `yb_module_page` VALUES ('32', '1448679954', '1448679954', '联系我们', '', 'contact', '联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们', null);

-- ----------------------------
-- Table structure for yb_module_pages
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_pages`;
CREATE TABLE `yb_module_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `con` longtext,
  `titlehuo` varchar(255) DEFAULT NULL,
  `img` varchar(512) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catname` (`catname`),
  KEY `公告` (`title`),
  KEY `活动` (`titlehuo`),
  KEY `title` (`title`),
  KEY `titlehuo` (`titlehuo`),
  KEY `img` (`img`(333)),
  KEY `time` (`time`),
  KEY `name` (`name`),
  KEY `phone` (`phone`),
  KEY `phone_2` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_pages
-- ----------------------------

-- ----------------------------
-- Table structure for yb_module_pagey
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_pagey`;
CREATE TABLE `yb_module_pagey` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `img1` varchar(512) DEFAULT NULL,
  `lianjie1` varchar(255) DEFAULT NULL,
  `img2` varchar(512) DEFAULT NULL,
  `lianjie2` varchar(255) DEFAULT NULL,
  `img3` varchar(512) DEFAULT NULL,
  `lianjie3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catname` (`catname`),
  KEY `img1` (`img1`(333)),
  KEY `lianjie1` (`lianjie1`),
  KEY `img2` (`img2`(333)),
  KEY `lianjie2` (`lianjie2`),
  KEY `img3` (`img3`(333)),
  KEY `lianjie2_2` (`lianjie2`),
  KEY `lianjie3` (`lianjie3`),
  KEY `img1_2` (`img1`(333)),
  KEY `img1_3` (`img1`(333))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_pagey
-- ----------------------------

-- ----------------------------
-- Table structure for yb_module_photos
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_photos`;
CREATE TABLE `yb_module_photos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `template` varchar(125) DEFAULT NULL,
  `hits` int(10) DEFAULT '0',
  `cid` char(50) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `pic` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`cid`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  KEY `title_3` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_photos
-- ----------------------------

-- ----------------------------
-- Table structure for yb_module_setting
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_setting`;
CREATE TABLE `yb_module_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `banner` varchar(512) DEFAULT NULL,
  `ewm` varchar(512) DEFAULT NULL,
  `jmrx` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catname` (`catname`),
  KEY `catname_2` (`catname`),
  KEY `catname_3` (`catname`),
  KEY `tel` (`tel`),
  KEY `fax` (`fax`),
  KEY `email` (`email`),
  KEY `banner` (`banner`(333)),
  KEY `ewm` (`ewm`(333)),
  KEY `jmrx` (`jmrx`),
  KEY `tel_2` (`tel`),
  KEY `catname_4` (`catname`),
  KEY `jmrx_2` (`jmrx`),
  KEY `video` (`video`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_setting
-- ----------------------------
INSERT INTO `yb_module_setting` VALUES ('1', '1448611815', '1448611815', '山东省青岛市黄岛区舟山岛路95号', '+861(532)86867555', '+861(532)68686792', 'pindeshengke@126.com', '/upload/image/20151127/20151127145220_17300.png', '/upload/image/20151127/20151127161014_69859.png', '0532-80980777', '');

-- ----------------------------
-- Table structure for yb_module_test
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_test`;
CREATE TABLE `yb_module_test` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `catname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catname` (`catname`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_test
-- ----------------------------

-- ----------------------------
-- Table structure for yb_module_wangba
-- ----------------------------
DROP TABLE IF EXISTS `yb_module_wangba`;
CREATE TABLE `yb_module_wangba` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inputtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  `template` varchar(125) DEFAULT NULL,
  `hits` int(10) DEFAULT '0',
  `cid` char(50) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `area` varchar(11) DEFAULT NULL,
  `address` longtext,
  `pic` varchar(512) DEFAULT NULL,
  `comnum` varchar(512) DEFAULT '100台以上',
  PRIMARY KEY (`id`),
  KEY `catid` (`cid`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  KEY `pic` (`pic`(333)),
  KEY `comnum` (`comnum`(333))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_module_wangba
-- ----------------------------

-- ----------------------------
-- Table structure for yb_regexp
-- ----------------------------
DROP TABLE IF EXISTS `yb_regexp`;
CREATE TABLE `yb_regexp` (
  `regexpid` int(11) NOT NULL AUTO_INCREMENT,
  `regexp` varchar(55) NOT NULL,
  `name` varchar(25) NOT NULL,
  `tip` varchar(25) NOT NULL COMMENT '提示信息',
  PRIMARY KEY (`regexpid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_regexp
-- ----------------------------
INSERT INTO `yb_regexp` VALUES ('1', '/^[0-9.-]+$/', '数字', '请输入数字');
INSERT INTO `yb_regexp` VALUES ('2', '/^[0-9-]+$/', '整数', '请输入一个整数');
INSERT INTO `yb_regexp` VALUES ('3', '/^[a-z]+$/i', '字母', '请输入字母');
INSERT INTO `yb_regexp` VALUES ('4', '/^[0-9a-z]+$/i', '数字+字母', '请输入数字+字母');
INSERT INTO `yb_regexp` VALUES ('5', '/^[\\w\\-\\.]+@[\\w\\-\\.]+(\\.\\w+)+$/', 'E-mail', '请输入正确的E-mail');
INSERT INTO `yb_regexp` VALUES ('6', '/^[0-9]{5,10}$/', 'QQ', '请输入正确的QQ');
INSERT INTO `yb_regexp` VALUES ('7', '/^http:\\/\\//', '超级链接', '请输入正确的超级链接，需要 http://');
INSERT INTO `yb_regexp` VALUES ('8', '/^(1)[0-9]{10}$/', '手机号码', '请输入正确的手机号码');
INSERT INTO `yb_regexp` VALUES ('9', '/^[0-9-]{6,13}$/', '电话号码', '请输入正确的电话号码');
INSERT INTO `yb_regexp` VALUES ('10', '/^[0-9]{6}$/', '邮编', '请输入正确的邮编');
INSERT INTO `yb_regexp` VALUES ('11', '/^(\\d+)\\.(\\d+)\\.(\\d+)\\.(\\d+)$/', 'IP', '请输入正确的IP地址');

-- ----------------------------
-- Table structure for yb_tags
-- ----------------------------
DROP TABLE IF EXISTS `yb_tags`;
CREATE TABLE `yb_tags` (
  `tagid` int(10) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(52) NOT NULL,
  `tagcount` int(11) DEFAULT '0',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `tagname` (`tagname`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_tags
-- ----------------------------

-- ----------------------------
-- Table structure for yb_website
-- ----------------------------
DROP TABLE IF EXISTS `yb_website`;
CREATE TABLE `yb_website` (
  `siteid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(125) NOT NULL,
  `keywords` varchar(225) DEFAULT NULL,
  `description` text,
  `template` varchar(25) DEFAULT 'default',
  `sitename` varchar(125) NOT NULL,
  `view_cache` int(1) NOT NULL DEFAULT '1',
  `view_cache_time` int(11) NOT NULL DEFAULT '20',
  `domain` varchar(225) NOT NULL COMMENT '域名',
  `logincheckcode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登陆验证码开关',
  `registercheckcode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '注册验证码开关',
  `membertokentype` varchar(10) NOT NULL DEFAULT 'COOKIE',
  PRIMARY KEY (`siteid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yb_website
-- ----------------------------
INSERT INTO `yb_website` VALUES ('1', '十三月官方网站', '十三月官方网站', '十三月官方网站', 'default', '', '0', '0', '', '1', '1', 'SESSION');
