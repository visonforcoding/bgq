#活动增加发布审查
ALTER TABLE activity add is_check TINYINT(2) DEFAULT 0 COMMENT '是否审核，0：未审核；1：发布；2：未通过审核'