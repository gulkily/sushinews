/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_queue` (
  `cache_name` char(32) NOT NULL,
  `query` text NOT NULL,
  `function` char(32) NOT NULL,
  `add_timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `client_record_v` (
  `client_id` tinyint NOT NULL,
  `record_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_session` (
  `client_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `client_session_t` (
  `client_id` tinyint NOT NULL,
  `session_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_variable` (
  `client_id` int(11) NOT NULL,
  `var_name` char(32) NOT NULL,
  `var_value` varchar(255) NOT NULL,
  UNIQUE KEY `client_id` (`client_id`,`var_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `key` char(31) NOT NULL,
  `value` char(255) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_field` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(32) NOT NULL,
  `store` tinyint(1) NOT NULL,
  `validate` tinyint(1) NOT NULL,
  `return_param` char(16) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`record_id`),
  UNIQUE KEY `field_id` (`field_id`,`field_value`)
) ENGINE=InnoDB AUTO_INCREMENT=805 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fp_session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=823 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `group_id` char(64) CHARACTER SET utf8 NOT NULL,
  `title` char(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `summary` text CHARACTER SET utf8 NOT NULL,
  `publish_timestamp` datetime NOT NULL,
  `reindex_timestamp` datetime NOT NULL,
  `language` char(2) DEFAULT NULL,
  `author` varchar(31) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `item_best_v` (
  `id` tinyint NOT NULL,
  `parent_id` tinyint NOT NULL,
  `group_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `body` tinyint NOT NULL,
  `summary` tinyint NOT NULL,
  `publish_timestamp` tinyint NOT NULL,
  `language` tinyint NOT NULL,
  `author` tinyint NOT NULL,
  `score` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_tag` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `voter_id` char(32) NOT NULL,
  UNIQUE KEY `item_id_tag_id_client_id` (`item_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `item_tag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `host` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `record_client_count` (
  `record_id` tinyint NOT NULL,
  `client_count` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(7) DEFAULT NULL,
  `hash` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_record` (
  `session_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`session_id`,`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `session_record_active` (
  `session_id` tinyint NOT NULL,
  `record_id` tinyint NOT NULL,
  `record_timestamp` tinyint NOT NULL,
  `active` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sherlock_config` (
  `name` varchar(32) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `format` char(16) NOT NULL,
  `last_attempt` datetime NOT NULL,
  `last_success` datetime NOT NULL,
  `last_guid` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `weight` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` char(255) DEFAULT NULL,
  `username` char(31) DEFAULT NULL,
  `address` char(63) DEFAULT NULL,
  `fuzzy_client_id` char(63) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voter_id_rate` (
  `host` binary(32) NOT NULL,
  `last_assignment` datetime NOT NULL,
  KEY `host` (`host`)
) ENGINE=InnoDB DEFAULT CHARSET=binary;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50001 DROP TABLE IF EXISTS `client_record_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `client_record_v` AS select distinct `fp_client`.`client_id` AS `client_id`,`fp_record`.`record_id` AS `record_id` from ((((`fp_client` join `client_session`) join `fp_session`) join `session_record`) join `fp_record`) where ((1 = 1) and (`fp_client`.`client_id` = `client_session`.`client_id`) and (`client_session`.`session_id` = `fp_session`.`session_id`) and (`fp_session`.`session_id` = `session_record`.`session_id`) and (`session_record`.`record_id` = `fp_record`.`record_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `client_session_t`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `client_session_t` AS select `client_session`.`client_id` AS `client_id`,`client_session`.`session_id` AS `session_id` from `client_session` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `item_best_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `item_best_v` AS select `item`.`id` AS `id`,`item`.`parent_id` AS `parent_id`,`item`.`group_id` AS `group_id`,`item`.`title` AS `title`,`item`.`body` AS `body`,`item`.`summary` AS `summary`,`item`.`publish_timestamp` AS `publish_timestamp`,`item`.`language` AS `language`,`item`.`author` AS `author`,`item`.`score` AS `score` from `item` group by `item`.`group_id` order by `item`.`group_id` desc,`item`.`score` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `record_client_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `record_client_count` AS select `fp_record`.`record_id` AS `record_id`,count(distinct `fp_client`.`client_id`) AS `client_count` from ((((`fp_record` join `session_record`) join `fp_session`) join `client_session`) join `fp_client`) where ((`fp_record`.`record_id` = `session_record`.`record_id`) and (`session_record`.`session_id` = `fp_session`.`session_id`) and (`fp_session`.`session_id` = `client_session`.`session_id`) and (`client_session`.`client_id` = `fp_client`.`client_id`)) group by `fp_record`.`record_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!50001 DROP TABLE IF EXISTS `session_record_active`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `session_record_active` AS select `session_record`.`session_id` AS `session_id`,`session_record`.`record_id` AS `record_id`,`session_record`.`record_timestamp` AS `record_timestamp`,`session_record`.`active` AS `active` from `session_record` where (`session_record`.`active` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `key` char(31) NOT NULL,
  `value` char(255) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `config` VALUES ('version','1');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `host` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `weight` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `tag` VALUES (1,'opinion',-1,0);
INSERT INTO `tag` VALUES (2,'sports',-1,0);
INSERT INTO `tag` VALUES (3,'world',1,0);
INSERT INTO `tag` VALUES (4,'advertising',-1,1);
INSERT INTO `tag` VALUES (5,'religious',-1,0);
INSERT INTO `tag` VALUES (6,'inspiring',1,1);
INSERT INTO `tag` VALUES (7,'important',1,0);
INSERT INTO `tag` VALUES (8,'current',1,0);
INSERT INTO `tag` VALUES (9,'accurate',1,0);
INSERT INTO `tag` VALUES (10,'abusive',-1,1);
INSERT INTO `tag` VALUES (11,'violent',-1,0);
INSERT INTO `tag` VALUES (12,'licensed',-1,0);
INSERT INTO `tag` VALUES (13,'unlicensed',-1,0);
INSERT INTO `tag` VALUES (14,'copyrighted',-1,0);
INSERT INTO `tag` VALUES (15,'derivative',1,0);
INSERT INTO `tag` VALUES (16,'kind',1,1);
INSERT INTO `tag` VALUES (17,'biased',-1,0);
INSERT INTO `tag` VALUES (18,'inaccurate',-1,1);
INSERT INTO `tag` VALUES (19,'deprecated',-1,0);
INSERT INTO `tag` VALUES (20,'spam',-1,1);
INSERT INTO `tag` VALUES (21,'fiction',1,0);
INSERT INTO `tag` VALUES (23,'incomplete',-1,0);
INSERT INTO `tag` VALUES (24,'bullshit',-1,0);
INSERT INTO `tag` VALUES (25,'funny',1,1);
INSERT INTO `tag` VALUES (26,'interesting',1,1);
INSERT INTO `tag` VALUES (27,'informative',1,1);
INSERT INTO `tag` VALUES (28,'novel',1,0);
INSERT INTO `tag` VALUES (29,'smart',1,0);
INSERT INTO `tag` VALUES (30,'fearmongering',-1,0);
INSERT INTO `tag` VALUES (31,'broken',-1,1);
