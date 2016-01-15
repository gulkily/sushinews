CREATE TABLE `cache_queue` (
  `cache_name` char(32) NOT NULL,
  `query` text NOT NULL,
  `function` char(32) NOT NULL,
  `add_timestamp` datetime NOT NULL
);

CREATE TABLE `config` (
  `key` char(31) NOT NULL,
  `value` char(255) NOT NULL,
  PRIMARY KEY (`key`)
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
  `vote_timestamp` datetime NOT NULL,
  UNIQUE KEY `item_id_tag_id_voter_id` (`item_id`,`tag_id`,`voter_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `item_tag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
);

CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `access_delay` int(11) NOT NULL DEFAULT '1',
  `last_pull` datetime NOT NULL,
  `last_push` datetime NOT NULL,
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

CREATE TABLE `node_item` (
  `item_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  KEY `item_id` (`item_id`),
  KEY `node_id` (`node_id`),
  CONSTRAINT `node_item_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `node_item_ibfk_2` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`)
);

CREATE TABLE `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(64) NOT NULL,
  `checksum` char(64) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

CREATE TABLE `package_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `piece_no` char(64) NOT NULL,
  `data` blob NOT NULL,
  `out_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `session` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(7) DEFAULT NULL,
  `hash` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
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

