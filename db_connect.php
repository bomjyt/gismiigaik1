<?php
  $host = "localhost";
  $database = "journal2";
  $login = "root";
  $password = "";
  $connect = mysql_connect ($host, $login, $password) or die(mysql_error());
  $select_db = mysql_select_db($database, $connect) or die(mysql_error());
  mysql_query("set names cp1251");
  $q=mysql_query("select * from `Name` where `id`='1'");
  @$nam=mysql_fetch_assoc($q);

  echo "<table height=100% width=100%>
  			<tr>
  			<td align=center height=10><H3>".$nam['name']."</H3><hr>
  			</td>
  			</tr>
  			<tr>
  				<td valign=top>";
?>
