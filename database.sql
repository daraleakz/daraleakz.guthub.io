CREATE TABLE IF NOT EXISTS `invites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `createdby` int NOT NULL,
  `usedby` int NOT NULL,
  `used` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados não seleccionada.

-- A despejar estrutura para tabela scammerm_database.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `customimg` varchar(255) NOT NULL,
  `registerdate` varchar(255) NOT NULL DEFAULT '01/01/1990 00:00:00',
  `ip` varchar(255) NOT NULL,
  `hasperms` int NOT NULL DEFAULT '0',
  `invite_used` varchar(255) NOT NULL,
  `owner` int DEFAULT '0',
  `dev` int DEFAULT '0',
  `bhunt` int DEFAULT '0',
  `support` int DEFAULT '0',
  `staff` int DEFAULT '0',
  `premium` int DEFAULT '0',
  `bio` varchar(50) DEFAULT 'example | text | hehe',
  `background` varchar(255) DEFAULT '(image url)',
  `discord` varchar(50) DEFAULT 'Discord Invite (Example: weapons)',
  `github` varchar(50) DEFAULT 'Github account name',
  `telegram` varchar(50) DEFAULT NULL,
  `roblox` varchar(50) DEFAULT 'Roblox user id',
  `tiktok` varchar(50) DEFAULT 'Tiktok account name',
  `imgredirect` varchar(30) DEFAULT '(your link)',
  `music` varchar(255) DEFAULT '(your link mp3)',
  `collor` varchar(50) DEFAULT '#FFF',
  `sparkles` varchar(50) DEFAULT NULL,
  `paidemoji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `etext` varchar(25) DEFAULT 'anc',
  `pmoji` varchar(50) DEFAULT NULL,
  `feather` int DEFAULT '0',
  `views` varchar(50) DEFAULT '0',
  `last_view` timestamp NULL DEFAULT NULL,
  `last_ip` varchar(50) DEFAULT NULL,
  `searcher` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Exportação de dados não seleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
