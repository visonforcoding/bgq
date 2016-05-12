CREATE TABLE `article_like` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '文章点赞表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
	`create_time` DATETIME NOT NULL COMMENT '点赞时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动；1：资讯',
	PRIMARY KEY (`id`)
)
COMMENT='文章点赞表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB