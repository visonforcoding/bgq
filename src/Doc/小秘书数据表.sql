CREATE TABLE `need` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '小秘书',
	`user_id` INT(11) NOT NULL COMMENT '用户',
	`msg` VARCHAR(550) NOT NULL COMMENT '内容',
	`status` TINYINT(4) NOT NULL COMMENT '状态',
	`create_time` DATETIME NOT NULL COMMENT '创建时间',
	`update_time` DATETIME NOT NULL COMMENT '修改时间',
	`is_read` TINYINT DEFAULT 0 COMMENT '是否已读（0：未读；1：已读）',
	PRIMARY KEY (`id`)
)
COMMENT='小秘书'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
