CREATE TABLE `comment_like` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '评论点赞表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
	`create_time` DATETIME NOT NULL COMMENT '点赞时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动；1：资讯',
	`is_delete` TINYINT DEFAULT 1 COMMENT '状态值：0：取消赞；1：点赞',
	PRIMARY KEY (`id`)
)
COMMENT='评论点赞表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB