#小秘书
CREATE TABLE `need` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '小秘书',
	`user_id` INT(11) NOT NULL COMMENT '用户',
	`msg` VARCHAR(550) NOT NULL COMMENT '内容',
	`status` TINYINT(4) NOT NULL COMMENT '状态0未读1已读',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	`update_time` DATETIME NOT NULL COMMENT '修改时间',
	PRIMARY KEY (`id`)
)
COMMENT='小秘书'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动增加发布审查
ALTER TABLE activity add is_check TINYINT(2) DEFAULT 0 COMMENT '是否审核，0：未审核；1：发布；2：未通过审核';

#活动增加是否置顶
ALTER TABLE activity add is_top TINYINT(2) DEFAULT 0 COMMENT '是否置顶';

#活动增加报名人数
ALTER TABLE activity add apply_nums INT(11) DEFAULT 0 COMMENT '报名人数';

#活动增加报名费用
ALTER TABLE activity add apply_fee INT(11) DEFAULT 0 COMMENT '报名费用';

#活动增加参与嘉宾
ALTER TABLE activity add guest varchar(255) COMMENT '参与嘉宾';

#活动增加未通过审查理由
ALTER TABLE activity add reason varchar(255) COMMENT '未通过审核理由';

#活动增加是否众筹
ALTER TABLE activity add is_crowdfunding TINYINT(2) DEFAULT 0 COMMENT '是否众筹活动';

#活动评论
CREATE TABLE `activitycom` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动评论表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`activity_id` INT(11) NOT NULL COMMENT '活动id',
	`body` VARCHAR(550) NOT NULL COMMENT '评论内容',
	`praise_nums` INT(11) DEFAULT 0 NOT NULL COMMENT '点赞数',
	`create_time` DATETIME NOT NULL COMMENT '评论时间',
	PRIMARY KEY (`id`)
)
COMMENT='活动评论表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动申请
CREATE TABLE `activityapply` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动申请表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`activity_id` INT(11) NOT NULL COMMENT '活动id',
	`create_time` DATETIME NOT NULL COMMENT '提交时间',
	`update_time` DATETIME NOT NULL COMMENT '更新时间',
	`is_pass` TINYINT(2) DEFAULT 0 COMMENT '审核是否通过',
	`is_top` TINYINT(2) DEFAULT 0 COMMENT '是否置顶',
	PRIMARY KEY (`id`)
)
COMMENT='活动申请表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动-我要推荐
CREATE TABLE `sponsor` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动赞助表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`activity_id` INT(11) NOT NULL COMMENT '活动id',
	`create_time` DATETIME NOT NULL COMMENT '提交时间',
	`type` TINYINT NOT NULL COMMENT '类型值：1：嘉宾推荐；2：场地赞助；3：现金赞助；4：物品赞助；5：其他',
	`description` varchar(550) COMMENT '描述',
	`name` varchar(20) COMMENT '姓名',
	`company` varchar(100) COMMENT '公司/机构',
	`department` varchar(20) COMMENT '部门',
	`position` varchar(20) COMMENT '职务',
	`address` varchar(255) COMMENT '地址',
	`people` INT COMMENT '容纳人数',
	PRIMARY KEY (`id`)
)
COMMENT='活动赞助表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#评论点赞
CREATE TABLE `comment_like` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '评论点赞表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
	`create_time` DATETIME NOT NULL COMMENT '点赞时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动；1：资讯',
	PRIMARY KEY (`id`)
)
COMMENT='评论点赞表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动标签
CREATE TABLE `activity_industry` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动标签表',
	`industry_id` INT(11) NOT NULL COMMENT '用户id',
	`activity_id` INT(11) NOT NULL COMMENT '活动id',
	PRIMARY KEY (`id`)
)
COMMENT='活动标签表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动评论增加回复人id
ALTER TABLE activitycom add reply_id INT COMMENT '回复用户id';

#文章点赞
CREATE TABLE `like_logs` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '点赞日志表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '关联id（活动id或资讯id）',
	`msg` varchar(255) NOT NULL COMMENT '日志内容',
	`create_time` DATETIME NOT NULL COMMENT '记录时间',
	`update_time` DATETIME NOT NULL COMMENT '更新时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动；1：资讯',
	PRIMARY KEY (`id`)
)
COMMENT='点赞日志表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
#=======06.07  已执行=======

#修改活动报名费用字段的类型为浮点型
ALTER TABLE `activity` CHANGE COLUMN `apply_fee` `apply_fee` Float NOT NULL DEFAULT 0 COMMENT '报名费用'
#=======06.22  已执行=======

#活动评论增加回复人id
ALTER TABLE activitycom add reply_id INT COMMENT '回复用户id';

#活动评论增加父id
ALTER TABLE activitycom add pid INT NOT NULL COMMENT '父id';

#地区标签表
CREATE TABLE `region` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '地区标签表',
	`name` varchar(50) NOT NULL COMMENT '地区名称',
	PRIMARY KEY (`id`)
)
COMMENT='地区标签表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动增加地区
ALTER TABLE activity add region_id INT NOT NULL COMMENT '地区id';

#专家推荐活动关系表
CREATE TABLE `activity_savant` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '专家推荐活动关系表',
	`activity_id` INT NOT NULL COMMENT '活动id',
	`savant_id` INT NOT NULL COMMENT '专家id',
	PRIMARY KEY (`id`)
)
COMMENT='专家推荐活动关系表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#专家推荐资讯关系表
CREATE TABLE `news_savant` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '专家推荐资讯关系表',
	`news_id` INT NOT NULL COMMENT '资讯id',
	`savant_id` INT NOT NULL COMMENT '专家id',
	PRIMARY KEY (`id`)
)
COMMENT='专家推荐活动关系表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#资讯增加用户id，即作者
ALTER TABLE news add user_id INT NOT NULL COMMENT '用户id';

#赠名片表
CREATE TABLE `card_box` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '赠名片表',
	`ownerid` INT NOT NULL COMMENT '名片夹主人id',
	`uid` INT NOT NULL COMMENT '名片id',
	`resend` TINYINT NOT NULL COMMENT '1回赠2不回赠',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	PRIMARY KEY (`id`)
)
COMMENT='赠名片表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#赠名片记录表
CREATE TABLE `card_box_log` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '赠名片记录表',
	`optid` INT NOT NULL COMMENT '操作人id',
	`targetid` INT NOT NULL COMMENT '目标id',
	`type` TINYINT NOT NULL COMMENT '1发放2回赠',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	PRIMARY KEY (`id`)
)
COMMENT='赠名片记录表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#收藏表修改注释，增加大咖收藏
ALTER TABLE `collect` CHANGE COLUMN `type` `type` tinyint(3) NOT NULL DEFAULT 0 COMMENT '类型值：0：活动；1：资讯；2：大咖'

#大咖广告表
CREATE TABLE `biggie_ad` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '大咖广告表',
	`savant_id` INT NOT NULL COMMENT '大咖id',
	`url` VARCHAR(50) NOT NULL COMMENT '图片地址',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	PRIMARY KEY (`id`)
)
COMMENT='大咖广告表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

#活动报名是否已签到字段
ALTER TABLE activityapply add is_sign TINYINT(2) DEFAULT 0 COMMENT '是否已签到，0：未签到；1：已签到';

#活动表添加分享描述字段
ALTER TABLE activity add share_desc VARCHAR(100) COMMENT '分享描述';

#资讯表添加分享描述字段
ALTER TABLE news add share_desc VARCHAR(100) COMMENT '分享描述';

#约见表添加分享描述字段
ALTER TABLE meet add share_desc VARCHAR(100) COMMENT '分享描述';

#活动增加是否置顶
ALTER TABLE activity add is_top TINYINT(2) DEFAULT 0 COMMENT '是否置顶';

#活动增加二维码路径
ALTER TABLE activity add qrcode VARCHAR(200) COMMENT '签到二维码';

#rd表
CREATE TABLE `rd` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'rd表',
	`ptag` INT NOT NULL COMMENT 'ptag',
	`user_id` INT NOT NULL COMMENT '用户',
	`relate_id` INT NOT NULL COMMENT '关联',
	`description` VARCHAR(100) NOT NULL COMMENT '描述',
	`type` TINYINT(4) NOT NULL COMMENT '类型',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	`is_delete` TINYINT(2) NOT NULL DEFAULT 0 COMMENT '是否删除',
	PRIMARY KEY (`id`)
)
COMMENT='rd表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
#=======06.24  已执行=======

#资讯表添加缩略图
ALTER TABLE news add thumb VARCHAR(200) COMMENT '缩略图';

#活动表添加缩略图
ALTER TABLE activity add thumb VARCHAR(200) COMMENT '缩略图';
#==========0628

#话题表修改6-28
ALTER TABLE `meet_subject`
	CHANGE COLUMN `invite_time` `invite_time` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '约见时间' AFTER `type`,
	CHANGE COLUMN `address` `address` VARCHAR(250) NOT NULL DEFAULT '' COMMENT '地址' AFTER `price`;

#增加表字段 7/2
CREATE TABLE `profiletag` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL DEFAULT '0' COMMENT '个人标签',
	PRIMARY KEY (`id`)
)
COMMENT='个人标签'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=6
;

#添加个人标签
ALTER TABLE `user` ADD COLUMN `grbq` TEXT NULL DEFAULT '' COMMENT '个人标签' AFTER `reason`;

#修改教育经历表日期格式
ALTER TABLE `education`
  CHANGE COLUMN `start_date` `start_date` varchar(20) NULL DEFAULT NULL COMMENT '开始日期';
ALTER TABLE `education`
  CHANGE COLUMN `end_date` `end_date` varchar(20) NULL DEFAULT NULL COMMENT '结束日期';

#修改工作经历表日期格式
ALTER TABLE `career`
  CHANGE COLUMN `start_date` `start_date` varchar(20) NULL DEFAULT NULL COMMENT '开始日期';
ALTER TABLE `career`
  CHANGE COLUMN `end_date` `end_date` varchar(20) NULL DEFAULT NULL COMMENT '结束日期';

#工作描述可以为空
ALTER TABLE `binggq`.`career`
  CHANGE COLUMN `descb` `descb` text NULL COMMENT '描述';
#======07 03 done====
#消息表msg 默认为空
#ALTER TABLE `usermsg`
	CHANGE COLUMN `msg` `msg` VARCHAR(550) NOT NULL DEFAULT '' COMMENT '内容' AFTER `title`;
#user表user_token 的长度
ALTER TABLE `user`
	CHANGE COLUMN `user_token` `user_token` VARCHAR(100) NOT NULL COMMENT '用户标志' AFTER `phone`;
#小秘书表增加pid字段
ALTER TABLE need add pid INT NOT NULL DEFAULT 0 COMMENT '父id' AFTER id;

#小秘书表增加reply_id字段
ALTER TABLE need add reply_id INT NOT NULL DEFAULT 0 COMMENT '回复用户id' AFTER pid;
#======0707========

#添加重要信息数据库记录表
CREATE TABLE `log` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`flag` VARCHAR(50) NOT NULL DEFAULT '',
	`msg` VARCHAR(550) NOT NULL DEFAULT '',
	`data` TEXT NULL,
	`create_time` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='重要的信息日志记录'
ENGINE=InnoDB
;

#user 表修改
ALTER TABLE `user`
	CHANGE COLUMN `level` `level` TINYINT NOT NULL DEFAULT '1' COMMENT '等级,1:普通2:专家' AFTER `truename`,
	ADD COLUMN `grade` TINYINT NOT NULL DEFAULT '1' AFTER `level`;

#删掉旧表
DROP TABLE `flow`;

#交易流水记录表
CREATE TABLE `flow` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL DEFAULT '0' COMMENT '用户',
	`type` INT(11) NOT NULL DEFAULT '0' COMMENT '交易类型',
	`type_msg` VARCHAR(50) NOT NULL COMMENT '类型名称',
	`income` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '是否收入1:收入2:支出',
	`amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
	`pre_amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易前金额',
	`after_amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易后金额',
	`status` TINYINT(4) NOT NULL COMMENT '交易状态',
	`remark` VARCHAR(50) NOT NULL COMMENT '备注',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	`update_time` DATETIME NOT NULL COMMENT '修改时间',
	PRIMARY KEY (`id`)
)
COMMENT='用户资金流水'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

#添加关联字段id
ALTER TABLE `flow`
	ADD COLUMN `relate_id` INT(11) NOT NULL DEFAULT '0' COMMENT '关联id' AFTER `user_id`;

#乱码
ALTER TABLE `activity`
	CHANGE COLUMN `apply_fee` `apply_fee` FLOAT NOT NULL DEFAULT '0' COMMENT '报名费用' AFTER `apply_nums`;

ALTER TABLE `activity`
	CHANGE COLUMN `is_top` `is_top` TINYINT(2) NULL DEFAULT '0' COMMENT '是否置顶' AFTER `is_check`;

ALTER TABLE `activity`
	CHANGE COLUMN `qrcode` `qrcode` VARCHAR(200) NULL DEFAULT NULL COMMENT '二维码' AFTER `region_id`;

ALTER TABLE `activity`
	ADD COLUMN `series_id` TINYINT NOT NULL AFTER `reason`;

#新闻评论表添加是否删除字段
ALTER TABLE `newscom` ADD COLUMN `is_delete` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '是否删除';

#活动评论表添加是否删除字段
ALTER TABLE `activitycom` ADD COLUMN `is_delete` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '是否删除';


#资讯来源
ALTER TABLE `news`
	ADD COLUMN `source` VARCHAR(50) NOT NULL COMMENT '来源' AFTER `user_id`;
ALTER TABLE `news`
	ALTER `source` DROP DEFAULT;
ALTER TABLE `news`
	CHANGE COLUMN `source` `source` VARCHAR(50) NULL COMMENT '来源' AFTER `user_id`;


ALTER TABLE `news`
	CHANGE COLUMN `keywords` `keywords` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '关键字' AFTER `source`;

#求职者信息
CREATE TABLE `candidate` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`job_id` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '招聘信息id',
	`truename` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '姓名',
	`birthday` DATE NOT NULL COMMENT '生日',
	`phone` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '电话',
	`email` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '邮箱',
	`address` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '地址',
	`career` TEXT NOT NULL COMMENT '工作经历',
	`education` TEXT NOT NULL COMMENT '教育经历',
	`salary` VARCHAR(50) NOT NULL COMMENT '期望薪水',
	`create_time` DATETIME NOT NULL,
	`update_time` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='求职者'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;

#工作
CREATE TABLE `job` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`company` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '公司',
	`admin_id` INT(11) NOT NULL DEFAULT '0' COMMENT '负责人id',
	`contact` VARCHAR(150) NOT NULL DEFAULT '' COMMENT '联系方式',
	`earnings` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '分成方式',
	`position` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '招聘职位',
	`salary` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '薪资范围',
	`address` VARCHAR(150) NOT NULL DEFAULT '' COMMENT '工作地点',
	`summary` VARCHAR(750) NOT NULL DEFAULT '' COMMENT '招聘简介',
	`create_time` DATETIME NOT NULL,
	`update_time` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='招聘信息'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;

#工作-标签关联表
CREATE TABLE `job_industry` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`job_id` INT(11) NOT NULL,
	`industry_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='招聘行业标签'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;
	CHANGE COLUMN `keywords` `keywords` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '关键字' AFTER `source`;

#活动表增加活动过期时间字段
ALTER TABLE `activity` ADD COLUMN `apply_end_time` INT(10) NOT NULL DEFAULT 0 COMMENT '活动过期时间';


ALTER TABLE `activity`
	ADD COLUMN `from_user` INT NULL DEFAULT '0' AFTER `is_top`;
	
ALTER TABLE `activity`
	CHANGE COLUMN `from_user` `from_user` INT(11) NOT NULL DEFAULT '0' COMMENT '-1需求0后台>1,copy' AFTER `is_top`;

#user表增加专家主页浏览数
ALTER TABLE `binggq`.`user`
  ADD COLUMN `savant_read_nums` int(11) unsigned NOT NULL DEFAULT 0;

#user表增加专家主页浏览数
ALTER TABLE `binggq`.`user`
  ADD COLUMN `homepage_read_nums` int(11) unsigned NOT NULL DEFAULT 0;

#活动推荐活动关系表
CREATE TABLE `activity_recommend` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动推荐活动关系表',
	`activity_id` INT NOT NULL COMMENT '活动id',
	`activity_recommend_id` INT NOT NULL COMMENT '推荐活动id',
	PRIMARY KEY (`id`)
)
COMMENT='活动推荐活动关系表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;


ALTER TABLE `activity`
	ALTER `scale` DROP DEFAULT;
ALTER TABLE `activity`
	CHANGE COLUMN `scale` `scale` INT NOT NULL COMMENT '规模' AFTER `address`;

ALTER TABLE `activity`
	ADD COLUMN `must_check` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0不需要1需要 报名审核' AFTER `address`;

ALTER TABLE `activity`
	CHANGE COLUMN `must_check` `must_check` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0不需要1需要 报名审核' AFTER `address`;