CREATE TABLE `accountloginbans` (
	`accountloginban_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`account_id` BIGINT(20) UNSIGNED NOT NULL,
	`end` TIMESTAMP NOT NULL,
	PRIMARY KEY (`accountloginban_id`),
	UNIQUE KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
