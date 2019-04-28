--video video csm1143669542@
--视频分类表
CREATE TABLE `v_category`(
	`id` int(10) unsigned NOT NULL auto_increment,
	`pid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '分类父id',
	`cid` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '分类id',
	`weigh` int(3) unsigned NOT NULL DEFAULT 0 COMMENT '权重0-100 值越大越靠前',
	`title` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '分类名称',
	`ico` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图标名称',
	`ctime` VARCHAR(20) NOT NULL DEFAULT '',
	`item` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '分组 1 2 3 4',
	`status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '状态值 0上线 1下线',
	PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT charset=utf8;