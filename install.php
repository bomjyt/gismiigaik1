<?php
  include('db_connect.php');
  $s=mysql_query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"');
  for ($i='36';$i<'96';$i++)
  {  			$p=mysql_query("CREATE TABLE IF NOT EXISTS `".$i."` (
  					`id` int(11) NOT NULL auto_increment,
  					`user_id` int(11) NULL COMMENT '���� ������� ������',
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
							  `id_teach` int(11) NOT NULL COMMENT '����� � �������� ��������������',
							  PRIMARY KEY  (`id`),
							  UNIQUE KEY `id` (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1");
	$Name=mysql_query("CREATE TABLE IF NOT EXISTS `Name` (
							  `id` int(11) NOT NULL auto_increment,
							  `name` varchar(111) collate utf8_unicode_ci NOT NULL,
							  PRIMARY KEY  (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2");
	$name_d=mysql_query("INSERT INTO `Name` (`id`,  `name`) VALUES
								(1,'������� ����������� �������� ������ ��� �������')");
	$students=mysql_query("CREATE TABLE IF NOT EXISTS `students` (
							  `id` int(11) NOT NULL auto_increment,
							  `class_id` varchar(10) collate utf8_unicode_ci NOT NULL COMMENT '����� � ������� ��������',
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
								
								(56, 4, '���� 4-1�'),
								(55, 4, '�� 4-2�'),
								(54, 4, '�� 4-1�'),
								(53, 4, '�� 4-1�'),
								(52, 3, '���� 3-2�'),
								(51, 3, '���� 3-1�'),
								(50, 3, '�� 3-3�'),
								(49, 3, '�� 3-2�'),
								(48, 3, '�� 3-1�'),
								(47, 3, '�� 3-1�'),
								(46, 2, '���� 2-2�'),
								(45, 2, '���� 2-1�'),
								(44, 2, '�� 2-3�'),
								(43, 2, '�� 2-2�'),
								(42, 2, '�� 2-1�'),
								(41, 2, '�� 2-2�'),
								(40, 2, '�� 2-1�'),
								(39, 1, '���� 1-2�'),
								(38, 1, '�� 1-2�'),
								(37, 1, '�� 1-1�'),
								(36, 1, '�� 1-1�'),
								(72, 1, '�� 1-3�'),
								(73, 1, '���� 1-1�')");
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

 	echo "�������� ���������.";
 	include_once('base.php');

?>
