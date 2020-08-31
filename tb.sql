-- --------------------------------------------------------
-- 主机:                           60.205.189.220
-- 服务器版本:                        8.0.15 - MySQL Community Server - GPL
-- 服务器OS:                        Linux
-- HeidiSQL 版本:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_tbsd
CREATE DATABASE IF NOT EXISTS `db_tb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_tb`;

-- Dumping structure for table db_tbsd.tb_area
CREATE TABLE IF NOT EXISTS `tb_area` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(3) unsigned DEFAULT '1' COMMENT '1:华东地区 2:华南地区 3:华中地区 4:华北地区 5:西北地区 6:西南地区 7:东北地区 8:台港澳区 9:偏远地区',
  `name` varchar(50) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_tbsd.tb_area: ~35 rows (大约)
/*!40000 ALTER TABLE `tb_area` DISABLE KEYS */;
INSERT INTO `tb_area` (`id`, `group_id`, `name`, `create_time`) VALUES
	(1, 1, '山东', '2020-08-17 16:43:45'),
	(2, 1, '江苏', '2020-08-17 16:44:23'),
	(3, 1, '安徽', '2020-08-17 16:44:23'),
	(4, 1, '浙江', '2020-08-17 16:44:23'),
	(5, 1, '福建', '2020-08-17 16:44:23'),
	(6, 1, '上海', '2020-08-17 16:44:23'),
	(7, 2, '广东', '2020-08-17 16:44:44'),
	(8, 2, '广西', '2020-08-17 16:48:32'),
	(9, 2, '海南', '2020-08-17 16:48:32'),
	(10, 3, '湖北', '2020-08-17 16:48:32'),
	(11, 3, '湖南', '2020-08-17 16:48:32'),
	(12, 3, '河南', '2020-08-17 16:48:32'),
	(13, 3, '江西', '2020-08-17 16:48:32'),
	(14, 4, '北京', '2020-08-17 16:48:32'),
	(15, 4, '天津', '2020-08-17 16:48:32'),
	(16, 4, '河北', '2020-08-17 16:48:32'),
	(17, 4, '山西', '2020-08-17 16:48:33'),
	(18, 5, '青海', '2020-08-17 16:48:33'),
	(19, 5, '陕西', '2020-08-17 16:48:33'),
	(20, 5, '甘肃', '2020-08-17 16:48:33'),
	(21, 6, '四川', '2020-08-17 16:48:33'),
	(22, 6, '云南', '2020-08-17 16:48:33'),
	(23, 6, '贵州', '2020-08-17 16:48:33'),
	(24, 6, '重庆', '2020-08-17 16:48:33'),
	(25, 7, '辽宁', '2020-08-17 16:48:33'),
	(26, 7, '吉林', '2020-08-17 16:48:34'),
	(27, 7, '黑龙江', '2020-08-17 16:48:34'),
	(28, 7, '重庆', '2020-08-17 16:48:34'),
	(29, 8, '台湾', '2020-08-17 16:48:34'),
	(30, 8, '香港', '2020-08-17 16:48:34'),
	(31, 8, '澳门', '2020-08-17 16:48:34'),
	(32, 9, '宁夏', '2020-08-17 16:48:34'),
	(33, 9, '新疆', '2020-08-17 16:48:34'),
	(34, 9, '西藏', '2020-08-17 16:48:34'),
	(35, 9, '内蒙古', '2020-08-17 16:48:35');
/*!40000 ALTER TABLE `tb_area` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_auth_access
CREATE TABLE IF NOT EXISTS `tb_auth_access` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色',
  `rule_name` varchar(255) NOT NULL COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) DEFAULT NULL COMMENT '权限规则分类，admin_url:角色权限 admin:用户权限',
  `menu_id` int(11) DEFAULT NULL COMMENT '后台菜单ID',
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`rule_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限授权表';

-- Dumping data for table db_tbsd.tb_auth_access: ~13 rows (大约)
/*!40000 ALTER TABLE `tb_auth_access` DISABLE KEYS */;
INSERT INTO `tb_auth_access` (`role_id`, `rule_name`, `type`, `menu_id`) VALUES
	(2, '/admin/operator/index', 'admin', 1),
	(2, '/admin/operator/index', 'admin', 2),
	(2, '/admin/operator/add', 'admin', 3),
	(2, '/admin/operator/edit', 'admin', 10),
	(2, '/admin/operator/auth', 'admin', 11),
	(2, '/admin/operator/menu', 'admin', 4),
	(2, '/admin/operator/add-menu', 'admin', 5),
	(2, '/admin/operator/delete-menu', 'admin', 7),
	(2, '/admin/operator/edit-menu', 'admin', 8),
	(2, '/admin/operator/role', 'admin', 12),
	(2, '/admin/operator/add-role', 'admin', 13),
	(2, '/admin/operator/edit-role', 'admin', 14),
	(2, '/admin/operator/delete-role', 'admin', 15);
/*!40000 ALTER TABLE `tb_auth_access` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_auth_menu
CREATE TABLE IF NOT EXISTS `tb_auth_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parent_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `app` char(20) NOT NULL COMMENT '应用名称app',
  `controller` char(20) NOT NULL COMMENT '控制器',
  `action` char(20) NOT NULL COMMENT '操作名称',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单类型  1：一级菜单 2：权限认证 + 二级菜单 3：权限认证',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，1：显示 2：不显示',
  `icon` varchar(50) DEFAULT NULL COMMENT '菜单图标',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `model` (`controller`),
  KEY `parent_id` (`parent_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- Dumping data for table db_tbsd.tb_auth_menu: 21 rows
/*!40000 ALTER TABLE `tb_auth_menu` DISABLE KEYS */;
INSERT INTO `tb_auth_menu` (`id`, `parent_id`, `name`, `app`, `controller`, `action`, `type`, `status`, `icon`, `remark`) VALUES
	(1, 0, '管理员管理', 'admin', 'operator', 'index', 1, 1, 'fa fa-lock', ''),
	(2, 1, '管理员列表', 'admin', 'operator', 'index', 2, 1, NULL, ''),
	(3, 2, '添加管理员', 'admin', 'operator', 'add', 3, 1, NULL, ''),
	(4, 1, '菜单列表', 'admin', 'operator', 'menu', 2, 1, NULL, ''),
	(5, 4, '添加菜单', 'admin', 'operator', 'add-menu', 3, 1, NULL, ''),
	(7, 4, '删除菜单', 'admin', 'operator', 'delete-menu', 3, 1, NULL, ''),
	(8, 4, '编辑菜单', 'admin', 'operator', 'edit-menu', 3, 1, NULL, ''),
	(10, 2, '编辑管理员', 'admin', 'operator', 'edit', 3, 1, NULL, ''),
	(11, 2, '权限分配', 'admin', 'operator', 'auth', 3, 1, NULL, ''),
	(12, 1, '角色列表', 'admin', 'operator', 'role', 2, 1, NULL, ''),
	(13, 12, '添加角色', 'admin', 'operator', 'add-role', 3, 1, NULL, ''),
	(14, 12, '编辑角色', 'admin', 'operator', 'edit-role', 3, 1, NULL, ''),
	(15, 12, '删除角色', 'admin', 'operator', 'delete-role', 3, 1, NULL, ''),
	(33, 0, '产品管理', 'admin', 'product', 'index', 1, 1, 'fa fa-gift', ''),
	(32, 31, '店铺列表', 'admin', 'shop', 'index', 2, 1, '', ''),
	(31, 0, '店铺管理', 'admin', 'shop', 'index', 1, 1, 'fa fa-shopping-cart', ''),
	(30, 29, '用户列表', 'admin', 'user', 'index', 2, 1, '', ''),
	(29, 0, '用户管理', 'admin', 'user', 'index', 1, 1, 'fa fa-user', ''),
	(34, 33, '产品列表', 'admin', 'product', 'index', 2, 1, '', ''),
	(35, 0, '任务管理', 'admin', 'task', 'index', 1, 1, 'glyphicon glyphicon-th', ''),
	(36, 35, '任务列表', 'admin', 'task', 'index', 2, 1, '', '');
/*!40000 ALTER TABLE `tb_auth_menu` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_auth_role
CREATE TABLE IF NOT EXISTS `tb_auth_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT '0' COMMENT '父角色ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1：启用 2：禁用',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表';

-- Dumping data for table db_tbsd.tb_auth_role: ~3 rows (大约)
/*!40000 ALTER TABLE `tb_auth_role` DISABLE KEYS */;
INSERT INTO `tb_auth_role` (`id`, `name`, `pid`, `status`, `remark`, `create_time`, `update_time`) VALUES
	(1, '超级管理员', 0, 1, '用户拥有所有权限', '2019-07-11 03:28:50', '2019-07-11 03:28:50'),
	(4, '菜单管理员', 0, 1, '菜单管理员', '2019-07-11 03:37:52', '2019-07-11 03:37:52'),
	(5, '产品管理', 0, 1, '', '2019-07-11 03:56:22', '2019-07-11 03:56:22');
/*!40000 ALTER TABLE `tb_auth_role` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_auth_role_user
CREATE TABLE IF NOT EXISTS `tb_auth_role_user` (
  `role_id` int(11) unsigned DEFAULT '0' COMMENT '角色 id',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色对应表';

-- Dumping data for table db_tbsd.tb_auth_role_user: 1 rows
/*!40000 ALTER TABLE `tb_auth_role_user` DISABLE KEYS */;
INSERT INTO `tb_auth_role_user` (`role_id`, `user_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `tb_auth_role_user` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_auth_rule
CREATE TABLE IF NOT EXISTS `tb_auth_rule` (
  `menu_id` int(11) NOT NULL COMMENT '后台菜单 ID',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` varchar(30) NOT NULL DEFAULT '1' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `url_param` varchar(255) DEFAULT NULL COMMENT '额外url参数',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `rule_param` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `nav_id` int(11) DEFAULT '0' COMMENT 'nav id',
  PRIMARY KEY (`menu_id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限规则表';

-- Dumping data for table db_tbsd.tb_auth_rule: 0 rows
/*!40000 ALTER TABLE `tb_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_auth_rule` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_buy_behavior_template
CREATE TABLE IF NOT EXISTS `tb_buy_behavior_template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `template_name` varchar(50) NOT NULL COMMENT '模板名称',
  `shop_collection_percent` decimal(10,2) unsigned DEFAULT NULL COMMENT '收藏店铺',
  `product_collection_percent` decimal(10,2) unsigned DEFAULT NULL COMMENT '收藏商品',
  `add_cart_percent` decimal(10,2) unsigned DEFAULT NULL COMMENT '加入购物车',
  `chat_percent` decimal(10,2) unsigned DEFAULT NULL COMMENT '拍前咨询',
  `product_contrast_percent_0` decimal(10,2) unsigned DEFAULT NULL COMMENT '货比N家-不货比',
  `product_contrast_percent_1` decimal(10,2) unsigned DEFAULT NULL COMMENT '货比N家-货比一家',
  `product_contrast_percent_2` decimal(10,2) unsigned DEFAULT NULL COMMENT '货比N家-货比两家',
  `product_contrast_percent_3` decimal(10,2) unsigned DEFAULT NULL COMMENT '货比N家-货比三家',
  `scan_percent_0` decimal(10,2) unsigned DEFAULT NULL COMMENT '浏览深度-不浏览',
  `scan_percent_1` decimal(10,2) unsigned DEFAULT NULL COMMENT '浏览深度-店内一款',
  `scan_percent_2` decimal(10,2) unsigned DEFAULT NULL COMMENT '浏览深度-店内两款',
  `scan_percent_3` decimal(10,2) unsigned DEFAULT NULL COMMENT '浏览深度-店内三款',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:启用 2:删除',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table db_tbsd.tb_cate
CREATE TABLE IF NOT EXISTS `tb_cate` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_tbsd.tb_cate: ~17 rows (大约)
/*!40000 ALTER TABLE `tb_cate` DISABLE KEYS */;
INSERT INTO `tb_cate` (`id`, `cate_name`, `create_time`) VALUES
	(1, '潮流女装', '2020-08-17 15:53:47'),
	(2, '时尚男装', '2020-08-17 15:54:59'),
	(3, '鞋子箱包', '2020-08-17 15:54:59'),
	(4, '数码家电', '2020-08-17 15:54:59'),
	(5, '美食特产', '2020-08-17 15:54:59'),
	(6, '居家日用', '2020-08-17 15:54:59'),
	(7, '母婴用品', '2020-08-17 15:54:59'),
	(8, '珠宝配饰', '2020-08-17 15:54:59'),
	(9, '家装家纺', '2020-08-17 15:55:00'),
	(10, '住宅家具', '2020-08-17 15:55:00'),
	(11, '车品车饰', '2020-08-17 15:55:00'),
	(12, '运动户外', '2020-08-17 15:55:00'),
	(13, '家庭保健', '2020-08-17 15:55:00'),
	(14, '中老年用', '2020-08-17 15:55:00'),
	(15, '护肤彩妆', '2020-08-17 15:55:00'),
	(16, '百货食品', '2020-08-17 15:55:01'),
	(17, '其它类目', '2020-08-17 15:55:01');
/*!40000 ALTER TABLE `tb_cate` ENABLE KEYS */;

-- Dumping structure for table db_tbsd.tb_customer_target_template
CREATE TABLE IF NOT EXISTS `tb_customer_target_template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `template_name` varchar(50) NOT NULL COMMENT '模板名称',
  `gender` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别占比设置 0：未设置 1：已设置',
  `male_percent` decimal(10,2) unsigned DEFAULT NULL COMMENT '男性占比',
  `female_percent` decimal(10,2) unsigned DEFAULT NULL COMMENT '女性占比',
  `age` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '年龄设置 0：未设置 1：已设置',
  `age18_24` decimal(10,2) unsigned DEFAULT NULL COMMENT '18-24岁占比',
  `age25_33` decimal(10,2) unsigned DEFAULT NULL COMMENT '25-33岁占比',
  `age34_50` decimal(10,2) unsigned DEFAULT NULL COMMENT '34-50岁占比',
  `exclude_province` text COMMENT '目标客户排除地区',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:启用 2：删除',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table db_tbsd.tb_operator
CREATE TABLE IF NOT EXISTS `tb_operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(50) NOT NULL COMMENT '管理员登录用户名',
  `title` varchar(50) DEFAULT NULL COMMENT '管理员姓名',
  `password` varchar(255) NOT NULL COMMENT '登录密码',
  `salt` varchar(32) NOT NULL COMMENT '加密盐',
  `role` varchar(50) DEFAULT '1' COMMENT '角色',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1：启用 0：禁用 -1：删除',
  `last_logintime` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_loginip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员';


-- Dumping structure for table db_tbsd.tb_product
CREATE TABLE IF NOT EXISTS `tb_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `shop_id` bigint(20) unsigned NOT NULL COMMENT '店铺ID',
  `product_link` varchar(500) NOT NULL COMMENT '商品链接',
  `product_title` varchar(500) NOT NULL DEFAULT '' COMMENT '商品标题',
  `product_id` varchar(50) NOT NULL COMMENT '商品ID',
  `index_image` varchar(255) NOT NULL COMMENT '商品首图',
  `product_shortname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '商品简称',
  `product_weight` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品重量 KG',
  `customer_target_id` bigint(20) unsigned DEFAULT NULL COMMENT '目标客户模板ID',
  `customer_setting` varchar(500) DEFAULT NULL COMMENT '模板内容',
  `buy_behavior_id` bigint(20) unsigned DEFAULT NULL COMMENT '购买行为模板ID',
  `buy_setting` varchar(500) DEFAULT NULL COMMENT '模板内容',
  `app_index_image` varchar(255) DEFAULT NULL COMMENT 'APP主图',
  `qrcode` varchar(255) DEFAULT NULL COMMENT '二维码',
  `zhitongche` text COMMENT '直通车图 JSON',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '1:上架 2:删除',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`),
  KEY `customer_target_id` (`customer_target_id`),
  KEY `buy_behavior_id` (`buy_behavior_id`),
  KEY `user_id` (`user_id`),
  KEY `product_title` (`product_title`),
  KEY `product_shortname` (`product_shortname`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table db_tbsd.tb_shop
CREATE TABLE IF NOT EXISTS `tb_shop` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `shop_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '店铺性质 0:淘宝 1:天猫 3:阿里巴巴',
  `manager` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '掌柜号',
  `shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '店铺名称',
  `shop_cate` varchar(50) NOT NULL COMMENT '所属类目',
  `shop_nature` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '店铺性质 0：个人 1：公司',
  `sender_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '寄件人姓名',
  `send_phone` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '寄件人电话',
  `warehouse_id` int(10) unsigned NOT NULL COMMENT '仓库ID',
  `business_consultan` varchar(255) NOT NULL COMMENT '生意参谋截图',
  `qrcode` varchar(255) DEFAULT NULL COMMENT '加群二维码',
  `password` varchar(255) DEFAULT NULL COMMENT '加群密码',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:待审核 2：已审核 3：审核不过 4:已删除',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouse_id` (`warehouse_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table db_tbsd.tb_task
CREATE TABLE IF NOT EXISTS `tb_task` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `task_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:销量任务 10:标签任务 5:预约任务 13:提前购 16:AB单 8:多链接任务 7:猜你喜欢 11:微淘 / 直播任务',
  `task_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '任务编号',
  `order_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '订单编号',
  `usually_cate` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '买家长购类目',
  `deliver_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '快递类型 1:自发快递 2:平台发货2.3/单',
  `relevance_flow` tinyint(3) unsigned DEFAULT NULL COMMENT '关联流量任务 2：优先派给做过我家流量任务的用户 3：仅派给做过我家流量任务的用户',
  `chat_before_buy` tinyint(3) unsigned DEFAULT '0' COMMENT '拍前聊天 0:否 1:是',
  `collection` tinyint(3) unsigned DEFAULT '0' COMMENT '收藏商品 0:否 1:是',
  `add_to_cart` tinyint(3) unsigned DEFAULT '0' COMMENT '加入购物车 0:否 1:是',
  `get_coupons` tinyint(3) unsigned DEFAULT '0' COMMENT '领取优惠券 0:否 1:是',
  `recommon_product` tinyint(3) unsigned DEFAULT '0' COMMENT '推荐商品  0:否 1:是',
  `screenshot` tinyint(3) unsigned DEFAULT '0' COMMENT '任务过程不截图 1:不截图 0：截图',
  `task_waring` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '任务确认前提醒',
  `remark` text COLLATE utf8mb4_general_ci COMMENT '任务备注',
  `task_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '任务总量',
  `vie_keyword_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '货比词佣金',
  `product_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '产品总费用 佣金 快递 产品费用',
  `basic_flow_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '流量单基础佣金单价',
  `basic_flow_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '流量单基础佣金总费用',
  `value_added_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '流量单增值服务总费用',
  `deliver_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '平台发货费用',
  `total_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '任务总费用',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '任务状态 3:待接  6:已接 9:已完成 12:取消任务',
  `is_hide` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否隐藏 1：否 2：是',
  `create_day` int(8) unsigned NOT NULL COMMENT '发布天',
  `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
  `receive_time` datetime DEFAULT NULL COMMENT '接手时间',
  `receive_user_id` bigint(20) unsigned DEFAULT NULL COMMENT '接手人',
  `order_time` datetime DEFAULT NULL COMMENT '下单时间',
  `finish_time` datetime DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `cancel_remark` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_number` (`task_no`),
  UNIQUE KEY `order_number` (`order_no`),
  KEY `user_id` (`user_id`),
  KEY `task_type` (`task_type`),
  KEY `product_id` (`product_id`),
  KEY `create_day` (`create_day`),
  KEY `receive_user_id` (`receive_user_id`),
  KEY `is_hide` (`is_hide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping structure for table db_tbsd.tb_task_addvalue_setting
CREATE TABLE IF NOT EXISTS `tb_task_addvalue_setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `task_id` bigint(20) unsigned NOT NULL,
  `collect_pro_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '收藏商品占比',
  `collect_pro_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '收藏商品总数量',
  `collect_pro_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '收藏商品单价',
  `collect_pro_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '收藏商品费用',
  `recommend_pro_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '推荐商品占比',
  `recommend_pro_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '推荐商品数量',
  `recommend_pro_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '推荐商品单价',
  `recommend_pro_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '推荐商品总费用',
  `collect_shop_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '关注店铺占比',
  `collect_shop_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '关注店铺数量',
  `collect_shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '关注店铺单价',
  `collect_shop_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '关注店铺总费用',
  `add_cart_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '加入购物车占比',
  `add_cart_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '加入购物车数量',
  `add_cart_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '加入购物车单价',
  `add_cart_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '加入购物车总费用',
  `chat_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '旺旺咨询占比',
  `chat_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '旺旺咨询数量',
  `chat_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '旺旺咨询单价',
  `chat_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '旺旺咨询总费用',
  `coupon_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '领优惠券占比',
  `coupon_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '领优惠券数量',
  `coupon_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '领优惠券单价',
  `coupon_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '领优惠券总费用',
  `ask_percent` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '淘宝问大家占比',
  `ask_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '淘宝问大家数量',
  `ask_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '淘宝问大家单价',
  `ask_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '淘宝问大家总费用',
  `question_1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '问题1',
  `question_2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '问题2',
  `question_3` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '问题3',
  `question_4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '问题4',
  `question_5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '问题5',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping structure for table db_tbsd.tb_task_flow_setting
CREATE TABLE IF NOT EXISTS `tb_task_flow_setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `task_id` bigint(20) unsigned NOT NULL,
  `flow_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:淘宝APP自然搜索 2:淘宝PC自然搜索 3:淘宝APP淘口令 4:淘宝APP直通车 5:淘宝PC直通车 6:淘宝APP二维码 7:淘宝APP猜你喜欢 8:拍立淘 9:聚划算',
  `vie_keyword1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '货比词1',
  `vie_keyword2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '货比词2',
  `vie_keyword3` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '货比词3',
  `target_keyword` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '目标关键词',
  `quantity` bigint(20) unsigned NOT NULL COMMENT '数量',
  `same_flow` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否同时发布流量单 0:否 1:是',
  `sort_type` tinyint(3) unsigned DEFAULT NULL COMMENT '1:综合 2:新品 3:人气 4:销量 5:价格从低到高 6:价格从高到低',
  `price_min` decimal(10,2) unsigned DEFAULT NULL COMMENT ' 价格区间',
  `price_max` decimal(10,2) unsigned DEFAULT NULL COMMENT '价格区间',
  `sendaddress` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '发货地',
  `other` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '其他',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_id` (`task_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping structure for table db_tbsd.tb_task_product
CREATE TABLE IF NOT EXISTS `tb_task_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `product_id` bigint(20) unsigned NOT NULL COMMENT '产品ID',
  `task_id` bigint(20) unsigned NOT NULL COMMENT '任务ID',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `deliver_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '快递费单价',
  `buy_quantity` bigint(20) unsigned NOT NULL COMMENT '拍下件数',
  `sku` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '型号',
  `task_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '任务数量',
  `commission` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '单任务佣金',
  `commission_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总佣金',
  `deliver_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总快递费',
  `product_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '产品费',
  `total_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总费用 ',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping structure for table db_tbsd.tb_task_release_time
CREATE TABLE IF NOT EXISTS `tb_task_release_time` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `product_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `task_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `release_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间 0:立即发布 1:今日平均发布 2:多天平均发布 3:关键词单独发布',
  `release_quantity` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '任务数量',
  `start_time` datetime NOT NULL COMMENT '发布开始时间',
  `end_time` datetime NOT NULL COMMENT '发布结束时间',
  `timeout_time` datetime NOT NULL COMMENT '任务取消时间',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Dumping structure for table db_tbsd.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` bigint(11) unsigned NOT NULL COMMENT '电话号码',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `safety_code` varchar(255) DEFAULT NULL COMMENT '安全码',
  `qq` varchar(50) DEFAULT NULL COMMENT 'QQ',
  `wechat` varchar(50) DEFAULT NULL COMMENT '微信',
  `last_logintime` datetime DEFAULT NULL,
  `last_loginip` varchar(15) DEFAULT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:启用 2：禁用',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
