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


#活动评论增加回复人id
ALTER TABLE activitycom add reply_id INT COMMENT '回复用户id';

#活动评论增加父id
ALTER TABLE activitycom add pid INT NOT NULL COMMENT '父id';

-- ALTER TABLE activitycom add is_delete TINYINT(2) DEFAULT 0 NOT NULL COMMENT '状态值：0：未删除；1：已删除';

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
	`create_time` INT NOT NULL COMMENT '创建时间',
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
	`create_time` INT NOT NULL COMMENT '创建时间',
	PRIMARY KEY (`id`)
)
COMMENT='赠名片记录表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;