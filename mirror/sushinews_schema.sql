CREATE TABLE `cache_queue` (
  `cache_name` char(32) NOT NULL,
  `query` text NOT NULL,
  `function` char(32) NOT NULL,
  `add_timestamp` datetime NOT NULL
);

CREATE TABLE `client_session` (
  `client_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
);

CREATE TABLE `client_variable` (
  `client_id` int(11) NOT NULL,
  `var_name` char(32) NOT NULL,
  `var_value` varchar(255) NOT NULL,
  UNIQUE KEY `client_id` (`client_id`,`var_name`)
);

CREATE TABLE `config` (
  `key` char(31) NOT NULL,
  `value` char(255) NOT NULL,
  UNIQUE KEY `key` (`key`)
);

CREATE TABLE `fp_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`client_id`)
);

CREATE TABLE `fp_field` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `store` tinyint(1) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `return_param` char(16) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`field_id`)
);

CREATE TABLE `fp_record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`record_id`),
  UNIQUE KEY `field_id` (`field_id`,`field_value`)
);

CREATE TABLE `fp_session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`session_id`)
);

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` char(64) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `group_id` char(64) CHARACTER SET utf8 NOT NULL,
  `title` char(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `summary` text CHARACTER SET utf8 NOT NULL,
  `publish_timestamp` datetime NOT NULL,
  `reindex_timestamp` datetime NOT NULL,
  `language` char(2) DEFAULT NULL,
  `author` varchar(31) DEFAULT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
);

CREATE TABLE `item_tag` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `tag_weight` int(11) NOT NULL,
  `voter_id` char(32) NOT NULL,
  UNIQUE KEY `item_id_tag_id_client_id` (`item_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `item_tag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
);

CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `last_accessed` datetime NOT NULL,
  `last_item_hash` char(64) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `node_history` (
  `node_id` int(11) NOT NULL,
  `access_timestamp` datetime NOT NULL,
  `result` char(128) NOT NULL,
  KEY `node_id` (`node_id`),
  CONSTRAINT `node_history_ibfk_1` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE
);

CREATE TABLE `session` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(7) DEFAULT NULL,
  `hash` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `session_record` (
  `session_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`session_id`,`record_id`)
);

CREATE TABLE `sherlock_config` (
  `name` varchar(32) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `name` (`name`)
);

CREATE TABLE `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `format` char(16) NOT NULL,
  `last_attempt` datetime NOT NULL,
  `last_success` datetime NOT NULL,
  `last_guid` char(32) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `weight` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` char(255) DEFAULT NULL,
  `username` char(31) DEFAULT NULL,
  `address` char(63) DEFAULT NULL,
  `fuzzy_client_id` char(63) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `voter_id_rate` (
  `host` binary(32) NOT NULL,
  `last_assignment` datetime NOT NULL,
  KEY `host` (`host`)
);

