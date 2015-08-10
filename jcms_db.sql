/*
Navicat MySQL Data Transfer

Source Server         : Jcms演示站
Source Server Version : 50538
Source Host           : sql87.mysql.sitecname.com:3306
Source Database       : sq_jcmsss

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-08-01 17:22:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for j_admins
-- ----------------------------
DROP TABLE IF EXISTS `j_admins`;
CREATE TABLE `j_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` smallint(5) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1=正常，2=冻结',
  `last_login_time` int(11) DEFAULT NULL,
  `last_login_ip` varchar(20) DEFAULT NULL,
  `login` int(11) unsigned zerofill DEFAULT '00000000000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `group` (`role`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_admins
-- ----------------------------
INSERT INTO `j_admins` VALUES ('1', 'admin', '14c12f125faa6f945a02df11c238b8cc', 'fde47db292', 'is-zwj@qq.com', '1', '1', '1438420492', '202.105.14.30', '00000000041');

-- ----------------------------
-- Table structure for j_block
-- ----------------------------
DROP TABLE IF EXISTS `j_block`;
CREATE TABLE `j_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cell_name` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `cell_name` (`cell_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_block
-- ----------------------------
INSERT INTO `j_block` VALUES ('1', 'footer', '版权信息', '<p> ©2015 j-cms 版权所有</p>', '1', 'zh-cn');
INSERT INTO `j_block` VALUES ('4', 'index', '首页内容', '<p><img src=\"/data/ueditor/php/upload/88251428055615.jpg\" width=\"960\" height=\"492\" /><br /></p>', '1', 'zh-cn');

-- ----------------------------
-- Table structure for j_category
-- ----------------------------
DROP TABLE IF EXISTS `j_category`;
CREATE TABLE `j_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `spid` varchar(50) NOT NULL,
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `ordid` int(3) NOT NULL DEFAULT '0',
  `isnav` tinyint(1) NOT NULL DEFAULT '1',
  `body` longtext NOT NULL,
  `image` varchar(100) NOT NULL,
  `modelid` tinyint(5) NOT NULL,
  `seotitle` varchar(50) NOT NULL,
  `seokeywords` varchar(50) NOT NULL,
  `seodescription` varchar(255) NOT NULL,
  `template_index` char(30) NOT NULL,
  `template_list` char(30) NOT NULL,
  `template_show` char(30) NOT NULL,
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `typeid` (`type`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_category
-- ----------------------------
INSERT INTO `j_category` VALUES ('1', '0', '0', '0', '关于我们', 'about', '1', '1', '<p>佛山云顶科技有限公司，建立于2010年，是一家富有活力的年轻创作型网络科技公司， 满足客户所需，高效的创意执行，丰富经验的制作团队，庞大的制作资源，是我们的优势。正因为如此使我们在短短几年一跃成为佛山知名的网络科技公司。</p><p><br/></p><p>我们凭借创意和高效的执行力，通过多年的经验，对客户所需作出准确的判断，将平凡的东西变得与众不同。 我们优异的成绩，吸引着众多优秀的合作伙伴和客户，其中不乏本地和港澳甚至国外客户的信赖。</p><p><br/></p><p>我们的服务： PHP项目开发 / 网站建设 / 网页UI设计 / APPS应用 / 企业网络生态链一站式营销服务</p><p><br/></p><p>Foshan Yundes Ltd., established in 2010, is a dynamic young technology companies create networks, meet customer requirements and efficient implementation of creative and experienced production team, a huge production resources is our advantage. That is why in a few years so that we became well-known network technology companies in Foshan.</p><p><br/></p><p>With our creative and efficient execution, through years of experience, the customer is required to make accurate judgments, the ordinary things become different. Our excellent results, attracting many outstanding partners and customers, many of whom trust the local and foreign clients and even Hong Kong and Macao.</p><p><br/></p><p>Our services: PHP project development / construction site / Web UI design / Phone&nbsp;application / enterprise network ecosystem-stop marketing services</p><p><br/></p>', '', '1', '关于我们', '', '', 'page', 'page', 'page', 'zh-cn');
INSERT INTO `j_category` VALUES ('2', '0', '0', '0', '新闻中心', 'news', '10', '0', '', '', '1', '', '', '', 'index_news', 'list_news', 'show_news', 'zh-cn');
INSERT INTO `j_category` VALUES ('28', '0', '0', '1', '我们的服务', 'sevrice', '3', '1', '<p>我们从事互联网工作十年多，提供专业的互联网生态营销方案</p>', '', '1', '', '', '', 'service', 'service', 'service', 'zh-cn');
INSERT INTO `j_category` VALUES ('27', '0', '0', '0', '案例展示', 'case', '2', '1', '<p>我们真心对待每一个客户，您的项目也将有机会显示在这里<br/></p>', '', '2', '', '', '', 'project', 'project', 'view', 'zh-cn');
INSERT INTO `j_category` VALUES ('32', '0', '0', '1', '联系我们', 'contact', '4', '1', '<p>我们总是收到关于你的项目的任何激动。我们愿意帮助你建立你的可怕的产品。</p>', '', '0', '', '', '', 'contact', 'list_default.tpl', 'show_default.tpl', 'zh-cn');

-- ----------------------------
-- Table structure for j_clients
-- ----------------------------
DROP TABLE IF EXISTS `j_clients`;
CREATE TABLE `j_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(16) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `host` varchar(150) DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_clients
-- ----------------------------

-- ----------------------------
-- Table structure for j_content
-- ----------------------------
DROP TABLE IF EXISTS `j_content`;
CREATE TABLE `j_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `modelid` tinyint(6) NOT NULL,
  `adminid` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `color` char(10) DEFAULT NULL,
  `seo_title` varchar(250) DEFAULT NULL,
  `seo_key` varchar(250) DEFAULT NULL,
  `seo_desc` text,
  `body` longtext,
  `image` varchar(250) DEFAULT NULL,
  `flag` set('r','t','p') DEFAULT NULL,
  `author` char(20) NOT NULL,
  `click` int(11) NOT NULL DEFAULT '0',
  `ordid` int(11) NOT NULL DEFAULT '0',
  `access` smallint(6) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` int(11) NOT NULL,
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_content
-- ----------------------------
INSERT INTO `j_content` VALUES ('1', '2', '1', '0', '测试新闻标题，有图片', '#fbaf5a', 'SEO标题', 'SEO关键字', 'SEO描述', '<p>新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容</p>', './uploads/20100907141909917.jpg', 'r,p', 'iszwj', '2', '1', '3', '1', '1337349144', 'zh-cn');
INSERT INTO `j_content` VALUES ('2', '2', '1', '0', '测试文章标题', '', '', '', '', '', '', null, '', '0', '3', '1', '1', '0', 'zh-cn');
INSERT INTO `j_content` VALUES ('24', '1', '1', '0', '文杰', '', '', '', '', '<p>热爱网络，拥有6年PHP开发经验，在他的思维里没有是不可能的事情！</p>', 'http://www.dviance.net/themes/dviance/images/team-sylvain.jpg', 'p', '', '0', '10', '1', '1', '1428385474', 'zh-cn');
INSERT INTO `j_content` VALUES ('25', '1', '1', '0', '强少', '', '', '', '', '<p>一个胖子，有5年的html+css工作经验，总有方法可以你要的效果</p>', 'http://www.dviance.net/themes/dviance/images/team-romain.jpg', 'p', '', '0', '9', '1', '1', '1428385573', 'zh-cn');
INSERT INTO `j_content` VALUES ('5', '2', '1', '0', '测试添加文章3', '', '', '', '', '<p>测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3测试添加文章3<br /></p>', '', 'r,t', 'iszwj', '3', '3', '1', '1', '2013', 'zh-cn');
INSERT INTO `j_content` VALUES ('6', '2', '1', '0', '测试添加文章4', '', '', '', '', '<p>测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4测试添加文章4<br /></p>', '', null, 'iszwj', '4', '4', '1', '1', '1369403366', 'zh-cn');
INSERT INTO `j_content` VALUES ('13', '2', '1', '0', '测试文章标题2', '', '', '', '', '<p>测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2<br /></p>', './uploads/06f1cb244330526a5f49131d6d90_800_800.jpg', 'p', 'iszwj', '0', '2', '1', '1', '1371225441', 'zh-cn');
INSERT INTO `j_content` VALUES ('12', '2', '1', '0', '测试文章标题2', '', '', '', '', '<p>测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2测试文章标题2<br /></p>', './uploads/06f1cb244330526a5f49131d6d90_800_800.jpg', 'p', 'iszwj', '0', '2', '1', '1', '1371225441', 'zh-cn');
INSERT INTO `j_content` VALUES ('14', '29', '1', '0', '测试新闻标题，有图片', '', '', '', '', '', './uploads/20100907141909917.jpg', 'p', '', '0', '0', '1', '1', '1372431309', 'en');
INSERT INTO `j_content` VALUES ('15', '2', '1', '0', '测试文章', '', '', '', '', '', '', null, '', '0', '0', '1', '1', '1375457051', 'zh-cn');
INSERT INTO `j_content` VALUES ('16', '2', '1', '0', '测试文章2', '', '', '', '', '', '', null, '', '0', '0', '1', '1', '1375457499', 'zh-cn');
INSERT INTO `j_content` VALUES ('20', '2', '1', '0', '测试文章3', '', '', '', '', '', '', null, '', '0', '0', '1', '1', '1375458294', 'zh-cn');
INSERT INTO `j_content` VALUES ('21', '2', '1', '0', '测试文章3', '', '', '', '', '', '', null, '', '0', '0', '1', '1', '1375458294', 'zh-cn');
INSERT INTO `j_content` VALUES ('26', '27', '2', '0', 'broadcast-播', '', '', '', 'broadcast:播创立于1997年，取意于诗歌总集《诗经》中：“播厥百谷，实函斯活”之句，隐喻希望、传播、播种之意。broadcast:播致力于营造一种时尚但东方的品牌文化，为追求时尚，同时坚持自我的新女性提供崭新的生活方式和独特的生活体验。', '<p><img src=\"/uploads/20150408/14284879693270.gif\" style=\"float:none;\" title=\"broadcast-播.gif\"/></p><p><img src=\"/uploads/20150408/14284879714725.gif\" style=\"float:none;\" title=\"成衣及配饰_broadcast-播.gif\"/></p><p><img src=\"/uploads/20150408/14284879739947.gif\" style=\"float:none;\" title=\"门店_broadcast-播.gif\"/></p><p><br/></p>', '/uploads/20150408/14284879693270.gif', 'p', '', '0', '0', '1', '1', '1428487851', 'zh-cn');
INSERT INTO `j_content` VALUES ('27', '27', '2', '0', 'GPT锋思设计', '', '', '', '法国INTERNATIONAL GPT+锋思设计有限公司（以下简称“GPT+”）是一家集地产开发咨询、规划建筑设计、生态景观设计、环保建筑技术应用为一体的设计管理公司， GPT+的合伙人主要由中法两国杰出建筑师构成，通过垂直控股方式运营多家设计企业成员，包括负责品牌建设的上海锋思建筑设计有限公司，重庆锋思建筑设计有限公司（建筑行业建筑工程乙级，甲级资质申办中），以及上海元众建筑设计事务所（事务所甲级）等。', '<p><img src=\"/uploads/20150408/14284880341540.gif\"/></p><p><img src=\"/uploads/20150408/1428488035681.gif\"/></p><p><img src=\"/uploads/20150408/14284880363136.gif\"/></p>', '/uploads//20150408/14284880341540.gif', 'p', '', '0', '0', '1', '1', '1428488099', 'zh-cn');
INSERT INTO `j_content` VALUES ('28', '27', '2', '0', '鲜芋仙 MeetFresh', '', '', '', '鲜芋仙是休闲国联集团旗下众多优秀子品牌之一。\r\n休闲国联集团自1992年成立以来致力于提供创新、优质饮品之服务，秉持专业，用心，创新三大经营理念，运用丰富的品牌经营经历，强大的研发精英团队及丰富创新的行销设计经验，致力于开创饮食新思维，将产品品质提升，走向精致化。', '<p><img src=\"/uploads/20150408/14284882814638.gif\" title=\"鲜芋仙 MeetFresh 台式甜品专家.gif\" width=\"\" height=\"\" border=\"0\" vspace=\"0\" alt=\"鲜芋仙 MeetFresh 台式甜品专家.gif\"/></p><p><img src=\"/uploads/20150408/14284882787526.gif\" title=\"鲜芋仙 MeetFresh 台式甜品专家 (1).gif\" border=\"0\" vspace=\"0\" alt=\"鲜芋仙 MeetFresh 台式甜品专家 (1).gif\"/></p><p><img src=\"/uploads/20150408/14284882802064.gif\" title=\"鲜芋仙 MeetFresh 台式甜品专家 (2).gif\" border=\"0\" vspace=\"0\" alt=\"鲜芋仙 MeetFresh 台式甜品专家 (2).gif\"/></p>', '/uploads/20150408/14284882814638.gif', 'p', '', '0', '0', '1', '1', '1428488260', 'zh-cn');

-- ----------------------------
-- Table structure for j_diyform
-- ----------------------------
DROP TABLE IF EXISTS `j_diyform`;
CREATE TABLE `j_diyform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `info` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sendmail` tinyint(1) NOT NULL DEFAULT '0',
  `toemail` varchar(50) DEFAULT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_diyform
-- ----------------------------
INSERT INTO `j_diyform` VALUES ('5', '联系表单', '如果您心里有一个想法，在这里跟我们说说。我们想跟你谈谈你的项目。', '1', '1', '710915644@qq.com', 'zh-cn');
INSERT INTO `j_diyform` VALUES ('6', '在线留言', '给团队成员留言', '1', '1', '710915644@qq.com', 'zh-cn');

-- ----------------------------
-- Table structure for j_diyform_list
-- ----------------------------
DROP TABLE IF EXISTS `j_diyform_list`;
CREATE TABLE `j_diyform_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `diyid` int(11) DEFAULT NULL,
  `uid` int(10) unsigned zerofill DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `lang` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modelid` (`diyid`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_diyform_list
-- ----------------------------
INSERT INTO `j_diyform_list` VALUES ('17', '6', '0000000000', '1', 'zh-cn');
INSERT INTO `j_diyform_list` VALUES ('13', '5', '0000000000', '1', 'zh-cn');
INSERT INTO `j_diyform_list` VALUES ('16', '5', '0000000000', '1', 'zh-cn');
INSERT INTO `j_diyform_list` VALUES ('15', '5', '0000000000', '1', 'zh-cn');
INSERT INTO `j_diyform_list` VALUES ('38', '6', '0000000000', '1', 'zh-cn');
INSERT INTO `j_diyform_list` VALUES ('39', '5', '0000000000', '1', 'zh-cn');

-- ----------------------------
-- Table structure for j_lang
-- ----------------------------
DROP TABLE IF EXISTS `j_lang`;
CREATE TABLE `j_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_lang
-- ----------------------------
INSERT INTO `j_lang` VALUES ('1', '简体中文', 'zh-cn', '1');
INSERT INTO `j_lang` VALUES ('2', 'English', 'en', '1');

-- ----------------------------
-- Table structure for j_mflist
-- ----------------------------
DROP TABLE IF EXISTS `j_mflist`;
CREATE TABLE `j_mflist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `fieldsid` int(11) NOT NULL,
  `modelid` int(11) NOT NULL,
  `info` text NOT NULL,
  `mtype` tinyint(1) DEFAULT '1' COMMENT '1:内容模型, 2表单模型',
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`,`fieldsid`,`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_mflist
-- ----------------------------
INSERT INTO `j_mflist` VALUES ('116', '16', '28', '5', '程序员', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('117', '16', '29', '5', '710915644', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('118', '16', '30', '5', '5月份', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('119', '16', '31', '5', '3万左右', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('120', '16', '32', '5', '我想做一个社交网，详细请联系我', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('121', '26', '33', '2', 'http://www.broadcast-bo.com/', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('122', '27', '33', '2', 'http://www.gpt-archi.com/', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('123', '28', '33', '2', 'http://www.meetfresh.com.cn/', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('124', '25', '34', '1', '前端工程师', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('125', '24', '34', '1', '高级程序员', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('126', '17', '36', '6', '@文杰', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('127', '17', '37', '6', '热爱网络，拥有6年PHP开发经验，在他的思维里没有是不可能的事情！', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('171', '38', '37', '6', 'fsdfsdf', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('170', '38', '36', '6', '@强少', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('169', '26', '38', '2', 'website', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('168', '27', '38', '2', 'website', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('167', '28', '38', '2', 'website', '1', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('172', '39', '28', '5', '程序猿', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('173', '39', '29', '5', '13800138000', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('174', '39', '30', '5', '', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('175', '39', '31', '5', '', '2', 'zh-cn');
INSERT INTO `j_mflist` VALUES ('176', '39', '32', '5', '', '2', 'zh-cn');

-- ----------------------------
-- Table structure for j_model
-- ----------------------------
DROP TABLE IF EXISTS `j_model`;
CREATE TABLE `j_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `description` char(100) NOT NULL,
  `tablename` char(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `template_index` char(30) NOT NULL,
  `template_list` char(30) NOT NULL,
  `template_show` char(30) NOT NULL,
  `issystem` tinyint(1) NOT NULL DEFAULT '0',
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_model
-- ----------------------------
INSERT INTO `j_model` VALUES ('1', '文章模型', '常见应用于新闻内容列表', 'news', '1', 'index_news.tpl', 'list_news.tpl', 'show_news.tpl', '1', 'zh-cn');
INSERT INTO `j_model` VALUES ('2', '产品模型', '可以对产品添加多张图片展示', 'products', '1', 'index_default.tpl', 'list_default.tpl', 'show_default.tpl', '0', 'zh-cn');

-- ----------------------------
-- Table structure for j_model_fields
-- ----------------------------
DROP TABLE IF EXISTS `j_model_fields`;
CREATE TABLE `j_model_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` int(10) unsigned NOT NULL,
  `formtype` char(20) NOT NULL,
  `field` char(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `defvalue` text,
  `tips` varchar(255) NOT NULL,
  `verification` varchar(255) NOT NULL,
  `errortips` varchar(255) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `issearch` tinyint(1) NOT NULL DEFAULT '0',
  `isshow` tinyint(1) NOT NULL DEFAULT '1',
  `addattribute` varchar(255) NOT NULL,
  `mtype` tinyint(1) DEFAULT '1' COMMENT '1:内容模型，2表单模型',
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_model_fields
-- ----------------------------
INSERT INTO `j_model_fields` VALUES ('28', '5', 'text', 'name', '名称', '', '您的名称', '', '请填写名称，以便我们礼貌称呼您', '1', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('29', '5', 'text', 'contact', '联系方式', '', '联系方式，可填：电话/QQ/Email', '', '请填写联系方式，以便我们联系您', '1', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('30', '5', 'text', 'timeframe', '上线时间', '', '您希望项目什么时候上线？（可选）', '', '', '0', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('31', '5', 'text', 'budget', '预算', '', '您的预算？（可选）', '', '', '0', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('32', '5', 'textarea', 'message', '内容', '', '向我们解释下您的项目，我们很乐意帮助 ;)', '', '', '0', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('33', '2', 'text', 'itemlink', '项目链接', '', '', '^http:\\/\\/', '项目链接格式不正确', '0', '0', '1', '', '1', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('34', '1', 'text', 'title2', '副标题', '', '', '', '', '0', '0', '1', '', '1', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('35', '1', 'text', 'photo', '头像', '', '', '', '', '0', '0', '1', '', '1', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('36', '6', 'text', 'recipient', '收信人', '', '', '', '请填写收件人', '1', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('37', '6', 'textarea', 'message', '留言内容', '', '', '', '请填写留言内容', '1', '0', '1', '', '2', 'zh-cn');
INSERT INTO `j_model_fields` VALUES ('38', '2', 'text', 'type', '项目类型', 'website', '', '', '', '0', '0', '1', '', '1', 'zh-cn');

-- ----------------------------
-- Table structure for j_picshow
-- ----------------------------
DROP TABLE IF EXISTS `j_picshow`;
CREATE TABLE `j_picshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `advertising` varchar(20) NOT NULL,
  `adurl` varchar(200) DEFAULT NULL,
  `adpic` varchar(200) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_picshow
-- ----------------------------
INSERT INTO `j_picshow` VALUES ('1', '首页热卖广告1', 'home', 'http://www.zwjcms.com', './uploads/06f1cb244330526a5f49131d6d90_800_800.jpg', 'test', 'zh-cn');
INSERT INTO `j_picshow` VALUES ('2', '首页热卖广告2', 'home', 'http://www.google.com.hk', './uploads/06f1cb244330526a5f49131d6d90_800_800.jpg', 'test', 'zh-cn');
INSERT INTO `j_picshow` VALUES ('3', '首页热卖广告3', '列表页', 'http://www.baidu.com', './uploads/06f1cb244330526a5f49131d6d90_800_800.jpg', 'test', 'zh-cn');

-- ----------------------------
-- Table structure for j_sysinfo
-- ----------------------------
DROP TABLE IF EXISTS `j_sysinfo`;
CREATE TABLE `j_sysinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` text,
  `varname` char(30) NOT NULL,
  `vartype` char(10) NOT NULL DEFAULT 'text',
  `tabtype` char(20) NOT NULL DEFAULT 'myset',
  `lang` varchar(20) DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_sysinfo
-- ----------------------------
INSERT INTO `j_sysinfo` VALUES ('1', '网站名称', 'Jcms演示站 - 云顶科技', 'sys_sitename', 'text', 'sys', 'zh-cn');
INSERT INTO `j_sysinfo` VALUES ('2', '网址', 'http://demo.yundes.com', 'sys_siteurl', 'text', 'sys', 'zh-cn');
INSERT INTO `j_sysinfo` VALUES ('3', '模板默认风格', 'jcms', 'sys_skin', 'text', 'sys', 'zh-cn');
INSERT INTO `j_sysinfo` VALUES ('5', 'SEO关键字', 'jcms,CMS建站系统,PHP内容管理系统', 'sys_keywords', 'text', 'sys', 'zh-cn');
INSERT INTO `j_sysinfo` VALUES ('6', 'SEO描述', 'Jcms是由ThinkPHP开发而成，张文杰一力之作', 'sys_description', 'textarea', 'sys', 'zh-cn');
INSERT INTO `j_sysinfo` VALUES ('7', '网站名称', 'Jcms Demo - Yundes.com', 'sys_sitename', 'text', 'sys', 'en');
INSERT INTO `j_sysinfo` VALUES ('8', '网址', 'http://demo.yundes.com', 'sys_siteurl', 'text', 'sys', 'en');
INSERT INTO `j_sysinfo` VALUES ('9', '模板默认风格', 'jcms', 'sys_skin', 'text', 'sys', 'en');
INSERT INTO `j_sysinfo` VALUES ('10', 'SEO关键字', 'jcms,CMS建站系统,PHP内容管理系统', 'sys_keywords', 'text', 'sys', 'en');
INSERT INTO `j_sysinfo` VALUES ('77', 'SEO描述', 'Jcms是由ThinkPHP开发而成，张文杰一力之作', 'sys_description', 'textarea', 'sys', 'en');

-- ----------------------------
-- Table structure for j_user
-- ----------------------------
DROP TABLE IF EXISTS `j_user`;
CREATE TABLE `j_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `salt` varchar(20) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `regtime` int(10) DEFAULT NULL,
  `regip` varchar(20) DEFAULT NULL,
  `lasttime` int(10) DEFAULT NULL,
  `lastip` varchar(20) DEFAULT NULL,
  `login` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `qq_openid` varchar(32) DEFAULT NULL,
  `qq_token` varchar(32) DEFAULT NULL,
  `qq_name` varchar(32) DEFAULT NULL,
  `wb_openid` varchar(32) DEFAULT NULL COMMENT 'UID',
  `wb_token` varchar(32) DEFAULT NULL,
  `wb_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of j_user
-- ----------------------------
INSERT INTO `j_user` VALUES ('4', '张文杰杰', 'test@yundes.com', '8673e6c4d9003c86e6c226ed7a2247e6', '9c56bf2e88e', 'http://tp4.sinaimg.cn/2132426003/180/5600312547/1', '13800138000', '1433212392', '127.0.0.1', '1438396197', '202.105.14.30', '27', '1', null, null, null, null, null, null);
INSERT INTO `j_user` VALUES ('5', '张文杰杰', 'test01@yundes.com', '482d5e4a6d25d78169bc064032f2fc02', '2e79d8f3d', 'http://tp4.sinaimg.cn/2132426003/180/5600312547/1', null, '1438333499', '202.105.14.30', '1438418737', '202.105.14.30', '8', '1', '8592A9AC4B15327448B062C2442D9A8C', '2362E10FBFA790F6C20CD5E35B06D54B', 'Value.', '2132426003', '2.00n68_1CaIsPtC0c2cf0b327ZnHdyB', '张文杰杰');
