<?php
  /*include('db_connect.php');
  session_start();

  for ($i=2;$i<13;$i++)
  {
  	echo $i."Г<BR>";
  	echo $i."Д<BR><BR>";

  	$sql=mysql_query('INSERT INTO `sub_class` values ("NULL","'.$i.'","Г")');
  	$sql=mysql_query('INSERT INTO `sub_class` values ("NULL","'.$i.'","Д")');
  }

   for ($i=1;$i<13;$i++)
   {
	  //die("select `id` from `sub_class` where `name`='Г' or `name`='Д'");
	  $sql=mysql_query("select `id` from `sub_class` where `name`='Г' or `name`='Д'");


	  while($class=mysql_fetch_assoc($sql))
	  {
			$sq=mysql_query("CREATE TABLE `".$class['id']."` (
					`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
					`user_id` INT( 11 ) NOT NULL COMMENT 'юзер имеющий доступ',
					`leson_id` INT( 11 ) NOT NULL ,
					`data` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					`name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					PRIMARY KEY ( `id` ) ,
					UNIQUE (
					`id`
					)
					) ENGINE = MYISAM");

	  }
   } */


?>
