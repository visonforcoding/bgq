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
ENGINE=InnoDB