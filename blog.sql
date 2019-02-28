/*
Navicat MySQL Data Transfer

Source Server         : cdyun
Source Server Version : 50560
Source Host           : 47.104.15.143:3307
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-02-28 15:06:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_node
-- ----------------------------
DROP TABLE IF EXISTS `blog_node`;
CREATE TABLE `blog_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(11) DEFAULT NULL COMMENT '编号',
  `node_name` varchar(10) NOT NULL DEFAULT '' COMMENT '节点名称',
  `module_name` varchar(10) NOT NULL DEFAULT '' COMMENT '模块名',
  `control_name` varchar(10) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(10) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `typeid` int(11) NOT NULL COMMENT '父级节点id',
  `icon` varchar(15) DEFAULT '' COMMENT '菜单样式',
  `sort` int(11) DEFAULT NULL,
  `op_name` varchar(11) DEFAULT NULL COMMENT '操作人',
  `create_time` varchar(11) DEFAULT NULL,
  `update_time` varchar(11) DEFAULT NULL,
  `delete_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_node
-- ----------------------------
INSERT INTO `blog_node` VALUES ('1', 'JD152369501', '系统配置', '#', '#', '#', '2', '0', 'fa fa-cog', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('2', 'JD152369502', '用户管理', 'admin', 'user', 'index', '2', '1', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('3', 'JD152369503', '添加用户页面', 'admin', 'user', 'create', '1', '2', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('4', 'JD152369504', '读取用户页面', 'admin', 'user', 'read', '1', '2', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('5', 'JD152369505', '用户新增更新', 'admin', 'user', 'save', '1', '2', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('6', 'JD152369506', '获取所有用户', 'admin', 'user', 'getall', '1', '2', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('7', 'JD152369507', '获取指定用户', 'admin', 'user', 'getone', '1', '2', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('8', 'JD152369508', '删除用户功能', 'admin', 'user', 'delete', '1', '2', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('9', 'JD152369509', '角色管理', 'admin', 'role', 'index', '2', '1', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('10', 'JD152369510', '添加角色页面', 'admin', 'role', 'create', '1', '9', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('11', 'JD152369511', '读取角色页面', 'admin', 'role', 'read', '1', '9', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('12', 'JD152369512', '角色新增更新', 'admin', 'role', 'save', '1', '9', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('13', 'JD152369513', '获取所有角色', 'admin', 'role', 'getall', '1', '9', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('14', 'JD152369514', '获取指定角色', 'admin', 'role', 'getone', '1', '9', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('15', 'JD152369515', '权限列表', 'admin', 'role', 'listrole', '1', '9', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('16', 'JD152369516', '节点管理', 'admin', 'node', 'index', '2', '1', '', null, '超级管理员', '1551328880', '1551331978', null);
INSERT INTO `blog_node` VALUES ('17', 'JD152369517', '添加节点页面', 'admin', 'node', 'create', '1', '16', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('18', 'JD152369518', '读取节点页面', 'admin', 'node', 'read', '1', '16', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('19', 'JD152369519', '节点新增更新', 'admin', 'node', 'save', '1', '16', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('20', 'JD152369520', '获取所有节点', 'admin', 'node', 'getall', '1', '16', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('21', 'JD152369521', '获取所有节点', 'admin', 'node', 'listall', '1', '16', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('22', 'JD152369522', '获取指定节点', 'admin', 'node', 'getone', '1', '16', '', null, '超级管理员', '1551328880', null, null);
INSERT INTO `blog_node` VALUES ('23', 'JD152369523', '删除节点功能', 'admin', 'node', 'delete', '1', '16', '', null, '超级管理员', '1551328880', null, null);

-- ----------------------------
-- Table structure for blog_role
-- ----------------------------
DROP TABLE IF EXISTS `blog_role`;
CREATE TABLE `blog_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `sn` varchar(12) NOT NULL COMMENT '序号/编号',
  `rolename` varchar(15) NOT NULL COMMENT '角色名称',
  `rule` varchar(800) DEFAULT '' COMMENT '权限节点数据（所有父子）',
  `rule_children` varchar(800) DEFAULT NULL COMMENT '权限节点数据（只包含子级）',
  `op_name` varchar(11) DEFAULT NULL COMMENT '操作人',
  `create_time` varchar(11) DEFAULT NULL,
  `update_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_role
-- ----------------------------
INSERT INTO `blog_role` VALUES ('1', 'JS1523671247', '管理员', '', null, null, null, null);

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` char(12) COLLATE utf8_bin NOT NULL COMMENT '序号/编号',
  `real_name` char(6) COLLATE utf8_bin DEFAULT '' COMMENT '真实姓名',
  `username` char(11) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` char(32) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '密码',
  `role_id` char(30) COLLATE utf8_bin NOT NULL COMMENT '用户角色id [可以一用户多个角色]',
  `login_num` int(5) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` char(20) COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(10) DEFAULT '0' COMMENT '最后登录时间',
  `sort` int(5) DEFAULT NULL COMMENT '排序',
  `status` int(1) NOT NULL COMMENT '状态1:正常；-1：停用；-3：删除',
  `op_name` char(6) COLLATE utf8_bin NOT NULL COMMENT '操作人',
  `create_time` char(10) COLLATE utf8_bin DEFAULT NULL,
  `update_time` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '编辑更新时间',
  `delete_time` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES ('1', 'YH1551334063', '超级管理员', 'admin', '2d8cc94a8c8b5ca7400969c5b2e572c1', '1', '0', null, null, null, '1', '', null, null, null);
