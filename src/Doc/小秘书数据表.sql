CREATE TABLE `need` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'С����',
	`user_id` INT(11) NOT NULL COMMENT '�û�',
	`msg` VARCHAR(550) NOT NULL COMMENT '����',
	`status` TINYINT(4) NOT NULL COMMENT '״̬',
	`create_time` DATETIME NOT NULL COMMENT '����ʱ��',
	`update_time` DATETIME NOT NULL COMMENT '�޸�ʱ��',
	`is_read` TINYINT DEFAULT 0 COMMENT '�Ƿ��Ѷ���0��δ����1���Ѷ���',
	PRIMARY KEY (`id`)
)
COMMENT='С����'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
