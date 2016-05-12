CREATE TABLE `comment_like` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '评论点赞表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
	`create_time` DATETIME NOT NULL COMMENT '点赞时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动；1：资讯',
	`is_delete` TINYINT(2) DEFAULT 0 NOT NULL COMMENT '状态值：0：未删除；1：已删除',
	PRIMARY KEY (`id`)
)
COMMENT='评论点赞表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB