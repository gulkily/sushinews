-- Adminer 3.3.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `sushinews` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sushinews`;

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` char(64) CHARACTER SET utf8 NOT NULL,
  `title` char(255) CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `summary` text CHARACTER SET utf8 NOT NULL,
  `publish_timestamp` datetime NOT NULL,
  `source_item_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `language` char(2) DEFAULT NULL,
  `author` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `item` (`id`, `guid`, `title`, `body`, `summary`, `publish_timestamp`, `source_item_id`, `language`, `author`) VALUES
(1,	'fbb8f9640a95d00b660b169683a2efef',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(2,	'941e5355bb3d2e118617c618ee44f4d5',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(3,	'7ee25d0312d8fe7b7de263502993d3a6',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(4,	'80cf61c87743b20c717e37338db871fe',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(5,	'aa92157b6689ade82f0b062f9d80a1b8',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(6,	'72bd27cf9114c43eff6e31621445e605',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(7,	'a026c68e09b4f3d3c6f7a17dba74ffc9',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(8,	'e800d5bf08379e7bd7553887cd938e07',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(9,	'ff4da8c5dc35eebbd53b68f1fe94091b',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(10,	'1895b27b66ed75fadb642530777e97f8',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(11,	'5d753732394230876fda54ebfed5781c',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(12,	'd5bde0dd383c02d8cd0bad6f55ac67d1',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(13,	'3a6479fa88664467e4aa2ff9d4ac7d3a',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(14,	'4d122d026153752ba48d1b98ca34ddce',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(15,	'45117b4c574a905f86871e9a19fa3ba5',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(16,	'28c20f328829708cad5bd8bdd8a31901',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(17,	'7bc55bd403e4113d08d32a0aadaa7e9b',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(18,	'e16499a230a138c2ec953ae61691ac84',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(19,	'c21267d9f7c8f966641b60d32a1be189',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(20,	'1dda5f26ac56e705ed419dd6fff3ce0c',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(21,	'e1ec9a3cd099aa779850e409dbf1d021',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(22,	'2cc0c98bb9701378584dfc835b40db76',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(23,	'c37ab82a130e6b1de3fa38a077e721b6',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(24,	'7aa71c89a75af72f535490ce84d7bd30',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(25,	'7e8286a4bbb6017ed8dbbb52c849576e',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(26,	'112c5c461c85a00238857aa515448a8c',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(27,	'8ec904b3f70023c8cfc59e17dd18262a',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(28,	'a94029e68d5a67b83607dc7248e6a59f',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(29,	'580ad73d10b44d5b1ab7ed318ab7720e',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(30,	'b2efd249e9f71a4865b4d86be7c80bd2',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(31,	'0cd3246fcf6f04e5648b74d2d2a59d5e',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(32,	'2cdbaaeb2208f048358c19a0415dfe9a',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(33,	'6ea202130a764eb610c77bcbd31587cb',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(34,	'95a0d18b7da7935facaecb6b9109f7f2',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(35,	'894eab237325117d967eeff61f850c10',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(36,	'9169a24917751f8e536a4f45852d52f3',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(37,	'943aa3f7c8399e35f87a4f8a7f84eb50',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(38,	'779aecd3af9018bb97f79783c5cc4245',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(39,	'33087a42a2cf1df32b80091959ce5977',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(40,	'69ac701c058d550f5a68611f1d8a847c',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(41,	'd20458a95de66d3270b75210963cc07c',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(42,	'8b49a294259f3c7d3464efb3a01549e1',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(43,	'3a31ec673be2aaa3f59134d9c07c3d3a',	'hello',	'blah',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(44,	'6ab253cbdfe7c0fbbc012b53e0865f05',	'fadsfadsfadsfadsf',	'fadsfadsfadsfadsfads',	'',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(45,	'2c504095e349be99b900cfe3adc0dcb6',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(46,	'0fe78470c1f6e532eec1759b9073204d',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(47,	'37c64eb516469c72d0b11ee2c88a9072',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'0000-00-00 00:00:00',	'',	NULL,	NULL),
(48,	'8a95c4ffc7f9c8decb03fda585dc5517',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 16:26:35',	'',	NULL,	NULL),
(49,	'f99db2d63f93b831d6f0cf88aeff7ca2',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 16:30:39',	'',	NULL,	NULL),
(50,	'920c4eac0d0ceca3121edfd7f5e241c7',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 17:33:45',	'',	NULL,	NULL),
(51,	'667e5da86193c7b915adb2dab3325f02',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 17:33:47',	'',	NULL,	NULL),
(52,	'b7843c7b7c52a5cb90e64beaf2d06685',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 17:34:58',	'',	NULL,	NULL),
(53,	'2adfadcdf150afc9583c0816a809b635',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 17:35:01',	'',	NULL,	NULL),
(54,	'4bc2b20befecc0771a0de135efe28139',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 17:35:33',	'',	NULL,	NULL),
(55,	'467e962d382478cab7e9f7f5759508a9',	'fadsfadsfadsfadsf',	'adfadfads',	'fadsfadsfadsfadsfads',	'2014-06-26 17:35:47',	'',	NULL,	NULL),
(56,	'97a125540b908863981b4ab884ded4fa',	'asdfadafds',	'afq34rx14fxdqdfa',	'534rc1xt2rfadsfxa',	'2014-06-26 20:39:06',	'',	NULL,	NULL),
(57,	'7978269211419acef727afa28dde2825',	'asdfadafds',	'afq34rx14fxdqdfa',	'534rc1xt2rfadsfxa',	'2014-06-27 19:43:58',	'',	NULL,	NULL),
(58,	'ddb3e042b2dfc32a4ca010b095e426ac',	'asdfadafds',	'afq34rx14fxdqdfa',	'534rc1xt2rfadsfxa',	'2014-06-27 19:44:35',	'',	NULL,	NULL),
(59,	'44b80dd72b772b734e44365267546973',	'asdfadafdsfasdfads',	'afq34rx14fxdqdfaadfad',	'534rc1xt2rfadsfxafadsfad',	'2014-06-27 19:44:50',	'',	NULL,	NULL),
(60,	'47e9fa90bed32ef2869c074e66bed636',	'New Story',	'afq34rx14fxdqdfaadfad\r\n\r\n44b80dd72b772b734e44365267546973',	'534rc1xt2rfadsfxafadsfad\r\n\r\n44b80dd72b772b734e44365267546973',	'2014-07-14 05:13:24',	'',	NULL,	NULL),
(61,	'd3cc7e409ed5cf843e4c88f6cb79f31d',	'New Story',	'afq34rx14fxdqdfaadfad\r\n\r\n44b80dd72b772b734e4436526754697',	'534rc1xt2rfadsfxafadsfad\r\n\r\n44b80dd72b772b734e4436526754697',	'2014-07-14 05:13:38',	'',	NULL,	NULL),
(62,	'79af2a092d8a2fe9b4a63d1aad74a1c3',	'Four key takeaways from World Cup 2014',	'a',	'a',	'2014-07-14 05:14:53',	'',	NULL,	NULL),
(63,	'fe14d6cba8162ab25023b0d69e7346b0',	'Four key takeaways from World Cup 2014',	'(CNN) -- This World Cup final looked to answer a question that has been surfacing throughout this tournament, and perhaps -- considering the hold King James has had on U.S. basketball fans in the past few weeks -- all of sports: Is it the team, or is it the star?\r\nThe last game of this tournament pitted the best player in the world, Messi, against the best team in the world, Germany. And if nothing else, this match demonstrated definitively that while players like Messi might win games, teams like Germany win titles.\r\nSo Messi gets the Golden Ball. Germany gets everything else.\r\nAmy Bass\r\nAmy Bass\r\nAfter steamrolling its way over Brazil to make the final, Germany looked to be a favorite for the title despite its early draw with Ghana. For Argentina, at stake was the lure of claiming the title on the home turf of its arch rival, Brazil, which finished a devastatingly disappointing fourth after losing in Saturday\'s match against the Dutch.\r\n',	'The final World Cup match looked to answer a question that surfaced throughout this tournament: Is it the team, or is it the star? asks history professor Amy Bass.',	'2014-07-14 05:15:34',	'',	NULL,	NULL),
(64,	'c671211370875154df0c96fa9f28f4b9',	'Four key takeaways from World Cup 2014',	'(CNN) -- This World Cup final looked to answer a question that has been surfacing throughout this tournament, and perhaps -- considering the hold King James has had on U.S. basketball fans in the past few weeks -- all of sports: Is it the team, or is it the star?\r\n\r\nThe last game of this tournament pitted the best player in the world, Messi, against the best team in the world, Germany. And if nothing else, this match demonstrated definitively that while players like Messi might win games, teams like Germany win titles.\r\n\r\nSo Messi gets the Golden Ball. Germany gets everything else.\r\n\r\nAfter steamrolling its way over Brazil to make the final, Germany looked to be a favorite for the title despite its early draw with Ghana. For Argentina, at stake was the lure of claiming the title on the home turf of its arch rival, Brazil, which finished a devastatingly disappointing fourth after losing in Saturday\'s match against the Dutch.\r\n',	'The final World Cup match looked to answer a question that surfaced throughout this tournament: Is it the team, or is it the star? asks history professor Amy Bass.',	'2014-07-14 05:15:55',	'',	NULL,	NULL),
(65,	'3cca5cdf9d9b2d7839820cd5533b3159',	'Four key takeaways from World Cup 2014',	'(CNN) -- This World Cup final looked to answer a question that has been surfacing throughout this tournament, and perhaps -- considering the hold King James has had on U.S. basketball fans in the past few weeks -- all of sports: Is it the team, or is it the star?<b>test</b>\r\n\r\nThe last game of this tournament pitted the best player in the world, Messi, against the best team in the world, Germany. And if nothing else, this match demonstrated definitively that while players like Messi might win games, teams like Germany win titles.\r\n\r\nSo Messi gets the Golden Ball. Germany gets everything else.\r\n\r\nAfter steamrolling its way over Brazil to make the final, Germany looked to be a favorite for the title despite its early draw with Ghana. For Argentina, at stake was the lure of claiming the title on the home turf of its arch rival, Brazil, which finished a devastatingly disappointing fourth after losing in Saturday\'s match against the Dutch.\r\n',	'The final World Cup match looked to answer a question that surfaced throughout this tournament: Is it the team, or is it the star? asks history professor Amy Bass.',	'2014-07-14 05:16:09',	'',	NULL,	NULL),
(66,	'2615391668d1cb7b89fd38116d51070b',	'Голландия заняла третье место на ЧМ-2014, разгромив Бразилию',	'12 июля 2014 года Голландия обыграла Бразилию и стала бронзовым призёром ЧМ-2014 на Национальном стадионе в Бразилиа.\r\n\r\nУже на 3-й минуте счёт с пенальти открыл голландец Робин ван Перси, освежив позорный проигрыш Бразилии в предыдущем матче.\r\n\r\nНа 16-й минуте голландец Дэйли Блинд удвоил преимущество.\r\n\r\nВсё остальное время бразильская команда сражалась в полную силу, что, в общем, делали и Нидерландцы. Ни одна из команд долго не могла поразить ворота соперника.\r\n\r\nЛишь на 90-й минуте Джорджиньо Вейналдум забил третий мяч.\r\n',	'12 июля 2014 года Голландия обыграла Бразилию и стала бронзовым призёром ЧМ-2014 на Национальном стадионе в Бразилиа.\r\n',	'2014-07-14 05:16:56',	'',	NULL,	NULL),
(67,	'a91d1068bb3eb285e17014f78036cf0e',	'adfad',	'fadsfa',	'fadsfad',	'2014-07-14 05:31:41',	'',	NULL,	NULL),
(68,	'432d690a9c73369386e30e626c00d763',	'Israel Says It Downed Drone as Gaza Death Toll Climbs',	'Hamas\' Al Qassam Brigades boasted on Twitter that the drones carried out \"three missions over Israeli military bases\" and a \"specific mission over Israeli war ministry.\" The group claimed to have domestically built three different kinds of drones for surveillance and bombing missions.\r\n\r\nThe unmanned aerial vehicle (UAV) that Israel brought down was targeted with a Patriot missile, the Israeli military said, near the southern city of Ashdod. There’s no evidence the small downed drone was armed, a senior Israeli military intelligence official told ABC News, adding they believe it was launched for the benefit of media attention.\r\n\r\nIsrael has not commented on Hamas claims that more than one drone flew over Israel.\r\n\r\nWith a price tag of well over $1 million each, “using a Patriot to shoot down a UAV is like using a shotgun to kill a fly,” ABC News military consultant Steve Ganyard said.\r\n',	'The military wing of the Palestinian militant group Hamas claimed today that it sent homemade drones over Israel, after Israel said that it had shot down a Palestinian drone flying along the coast in southern Israel.\r\n',	'2014-07-14 09:13:51',	'',	NULL,	NULL);

DROP TABLE IF EXISTS `item_tag`;
CREATE TABLE `item_tag` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `item_tag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(7) DEFAULT NULL,
  `hash` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `source`;
CREATE TABLE `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `title` char(127) NOT NULL,
  `format` char(16) NOT NULL,
  `limit` int(11) NOT NULL,
  `last_accessed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `source` (`id`, `url`, `title`, `format`, `limit`, `last_accessed`) VALUES
(1,	'https://en.wikinews.org/w/index.php?title=Special:NewsFeed&feed=atom&namespace=0&count=15',	'wikinews',	'rss',	15,	'2014-07-14 03:36:20');

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `type` char(16) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tag` (`id`, `name`, `type`, `weight`) VALUES
(1,	'opinion',	'topic',	0),
(2,	'sports',	'topic',	0),
(3,	'world',	'topic',	0),
(4,	'advertising',	'flag',	-1),
(5,	'religious',	'flag',	0),
(6,	'inspiring',	'flag',	0),
(7,	'important',	'given',	0),
(8,	'current',	'flag',	1),
(9,	'accurate',	'given',	1),
(10,	'abusive',	'flag',	-1),
(11,	'violent',	'flag',	0),
(12,	'licensed',	'flag',	0),
(13,	'unlicensed',	'flag',	0),
(14,	'copyrighted',	'flag',	0),
(15,	'derivative',	'flag',	0),
(16,	'kind',	'given',	0);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` char(255) DEFAULT NULL,
  `username` char(31) DEFAULT NULL,
  `address` char(63) DEFAULT NULL,
  `fuzzy_client_id` char(63) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2014-07-15 13:08:36
