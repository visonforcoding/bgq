CREATE TABLE `user_like` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '点赞表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '点赞相关id，例：活动文章id或者是活动评论id',
	`create_time` DATETIME NOT NULL COMMENT '点赞时间',
	`update_time` DATETIME NOT NULL COMMENT '更新时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动文章；1：活动评论；2：资讯文章；3：资讯评论',
	`status` TINYINT DEFAULT 1 COMMENT '状态值：0：取消赞；1：点赞',
	PRIMARY KEY (`id`)
)
COMMENT='点赞表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB