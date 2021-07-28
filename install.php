<?php
  include('db_connect.php');
  $s=mysql_query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"');
  for ($i='36';$i<'96';$i++)
  {  			$p=mysql_query("CREATE TABLE IF NOT EXISTS `".$i."` (
  					`id` int(11) NOT NULL auto_increment,
  					`user_id` int(11) NULL COMMENT 'þçåð èìåþùèé äîñòóï',
  					`leson_id` int(11) NOT NULL,
  					`data` date collate utf8_unicode_ci NOT NULL,
  					`name` text collate utf8_unicode_ci NOT NULL,
  					PRIMARY KEY  (`id`),
  					UNIQUE KEY `id` (`id`) )
					ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1
					");
  }
  	$leson_login=mysql_query("CREATE TABLE IF NOT EXISTS `leson_login` (
							  `id` int(5) NOT NULL auto_increment,
							  `cl_id` int(5) NOT NULL,
							  `name` text collate utf8_unicode_ci NOT NULL,
							  `id_teach` int(11) NOT NULL COMMENT 'ñâÿçü ñ òàáëèöåé ïðåïîäàâàòåëåé',
							  PRIMARY KEY  (`id`),
							  UNIQUE KEY `id` (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1");
	$Name=mysql_query("CREATE TABLE IF NOT EXISTS `Name` (
							  `id` int(11) NOT NULL auto_increment,
							  `name` varchar(111) collate utf8_unicode_ci NOT NULL,
							  PRIMARY KEY  (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2");
	$name_d=mysql_query("INSERT INTO `Name` (`id`,  `name`) VALUES
								(1,'Ñèñòåìà ýëåêòðîííîé çà÷¸òíîé êíèæêè ÃÈÑ ÌÈÈÃÀÈÊ')");
	$students=mysql_query("CREATE TABLE IF NOT EXISTS `students` (
							  `id` int(11) NOT NULL auto_increment,
							  `class_id` varchar(10) collate utf8_unicode_ci NOT NULL COMMENT 'ñâÿçü ñ êëàññîì ñòóäåíòà',
							  `name` varchar(20) collate utf8_unicode_ci NOT NULL,
							  `surname` varchar(30) collate utf8_unicode_ci NOT NULL,
							  `fam_name` varchar(30) collate utf8_unicode_ci NOT NULL,
							  `day_r` text collate utf8_unicode_ci NOT NULL,
							  `family` varchar(1000) collate utf8_unicode_ci NOT NULL,
							  `description` varchar(1000) collate utf8_unicode_ci NOT NULL,
							  PRIMARY KEY  (`id`),
							  UNIQUE KEY `id` (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1");
	$sub_class=mysql_query("CREATE TABLE IF NOT EXISTS `sub_class` (
							  `id` int(3) NOT NULL auto_increment,
							  `cl_id` int(3) NOT NULL,
							  `name` varchar(11) character set cp1251 NOT NULL,
							  UNIQUE KEY `id` (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=96");
	$sub_class_dump=mysql_query("INSERT INTO `sub_class` (`id`, `cl_id`, `name`) VALUES
								
								(56, 4, 'ÈÑèÒ 4-1Á'),
								(55, 4, 'ÈÁ 4-2Á'),
								(54, 4, 'ÈÁ 4-1Á'),
								(53, 4, 'ÏÈ 4-1Á'),
								(52, 3, 'ÈÑèÒ 3-2Á'),
								(51, 3, 'ÈÑèÒ 3-1á'),
								(50, 3, 'ÈÁ 3-3Á'),
								(49, 3, 'ÈÁ 3-2Á'),
								(48, 3, 'ÈÁ 3-1Á'),
								(47, 3, 'ÏÈ 3-1Á'),
								(46, 2, 'ÈÑèÒ 2-2Á'),
								(45, 2, 'ÈÑèÒ 2-1Á'),
								(44, 2, 'ÈÁ 2-3Á'),
								(43, 2, 'ÈÁ 2-2Á'),
								(42, 2, 'ÈÁ 2-1Á'),
								(41, 2, 'ÏÈ 2-2Á'),
								(40, 2, 'ÏÈ 2-1Á'),
								(39, 1, 'ÈÑèÒ 1-2á'),
								(38, 1, 'ÈÁ 1-2á'),
								(37, 1, 'ÈÁ 1-1á'),
								(36, 1, 'ÏÈ 1-1á'),
								(72, 1, 'ÈÁ 1-3á'),
								(73, 1, 'ÈÑèÒ 1-1á')");
	$users=mysql_query("CREATE TABLE IF NOT EXISTS `users` (
							  `id` int(11) NOT NULL auto_increment,
							  `name` text collate utf8_unicode_ci NOT NULL,
							  `login` text collate utf8_unicode_ci NOT NULL,
							  `pass` text collate utf8_unicode_ci NOT NULL,
							  PRIMARY KEY  (`id`),
							  UNIQUE KEY `id` (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32");
	$users_dump=mysql_query("INSERT INTO `users` (`id`, `name`, `login`, `pass`) VALUES
								(1, 'Admin', 'admin', 'nimda')");

 	echo "Îïåðàöèè âûïîëíåíû.";
 	include_once('base.php');

?>
