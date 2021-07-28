<?php
  session_start();
  include('db_connect.php');


	error_reporting(0);

	echo '<html>
  		<head>
    	<meta http-equiv="Content-Language" content="ru">
    	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
  		</head>
		';

  /*echo "<table width='100%' border='1'>
  			<tr>";*/
  	  session_start();
  	  //error_reporting(0);
	  $s_acces=mysql_query("select * from `users` where `id`='".$_SESSION['acces']."'");

	  $acces_s=mysql_fetch_assoc($s_acces);

      if(isset($_POST['re']))
      {
      		echo "<a href='index.php'>Назад</a><hr>";
      		if($_POST['re']>'0')
      		{
      				$ins=mysql_query('update `Name` set `name`="'.$_POST['re'].'" where `id`="1"');
      		}
      		else {echo "Заполните поле ввода.";}
      		include('base.php');
			die();
      }

	  if($_GET['act']=='rename')
	  {
	  		echo "<a href='index.php'>Отмена</a><hr>";

	  		echo"<form method='POST' >
	  			<input type='text' name='re'>:Заголовок
	  			<br><br>
	  			<input type='submit' value='Редактировать'>
	  			</form>";

	  		include('base.php');
			die();
	  }
	  if($_GET['exit']=='1')
	  {
	  		session_unset();
	  		header("Location: index.php");
	  }

      if($_SESSION['acces']=='1');
      {

     	if($_GET['act']=='teach')
		{
				if($_SESSION['acces']=='1')
              	{
              		echo 'Операции с: ';
              		echo '<a href="index.php?act=class">Группами</a>'.' | ';
              		echo '<a href="index.php?act=teach">Преподавателями</a>'.' | ';
              		echo '<a href="index.php?act=rename">Редактировать заголовок сайта.</a>'.' | ';
              	}
   				echo "<a href='index.php?exit=1'>Выйти из кабинета</a><hr>";



			echo '<br><a href="add_teach.php">Добавить в базу преподавателя</a><br><br>';
			echo '<a href="add_teach.php?act=redact">Показать список преподавателей для редактирования</a><br>';

			   include('base.php');
			die();
		}
      }

	  if (isset($_POST['action']))
	  {


			$_SESSION['login']=$_POST['login'];
	     	$_SESSION['pass']=$_POST['pass'];
			$s_acces=mysql_query("select * from `users` where `login`='".$_SESSION['login']."' and `pass`='".$_SESSION['pass']."'");

	        $acces_s=mysql_fetch_assoc($s_acces);
	        $_SESSION['acces']=$acces_s['id'];
	        $acces=$acces_s['id'];
      }
      if(isset($_SESSION['acces']) and $_SESSION['acces']<'1')
      {
              		echo "Неверный ввод логина или пароля.<br><br>";
              		unset($_SESSION);
              		echo "<a href='index.php'>Назад</a>";
              		  // include('base.php');
              		die();
      }
      if($_SESSION['acces']=='1')
      {
              	$_SESSION['admin']=true;
              	echo "Вы вошли как <b>Сотрудник деканата</b>";
              	$file='index_admin.php';



      }
      elseif($_SESSION['acces']>'1')
      {
              	$_SESSION['teach']=true;
              	echo "Вы вошли как преподаватель:<b>".$acces_s['name']."</b><hr>";
              	$_SESSION['map']['0']='<a href="index.php?teach='.$_SESSION['acces'].'">Выбор группы</a>';
              	echo $_SESSION['map']['0']." - ";
              	$file='index_teacher.php';
      }
      if ($_POST['guest']=='1' or $_GET['guest']=='1')
      {
      			$file='index_guest.php';
      			echo "Вы<b> Студент</b><br>";
      			$_SESSION['map']['1']='<a href="index.php?guest=1">Главная</a>';

      			$_SESSION['guest']=true;
      			echo $_SESSION['map']['1'];
      			echo "<hr>";
      }



      if ($_SESSION['acces']>0 or $_SESSION['guest'])
      {
			    if($_SESSION['acces']=='1')
              	{
              		echo '<hr>Операции с: ';
              		echo '<a href="index.php?act=class">Группами</a>'.' | ';
              		echo '<a href="index.php?act=teach">Преподавателями</a>'.' | ';
              		echo '<a href="index.php?act=list">Список студентов</a>'.' | ';
              		echo '<a href="index.php?act=rename">Редактировать заголовок сайта.</a>'.' | ';
              	}
   				echo "<a href='index.php?exit=1'>Выйти из кабинета</a>";

		    if($_GET['act']=='list' and $_SESSION['acces']=='1')
	  		{
		       		echo "<hr>";
		       		$pup=mysql_query('select * from `students` order by');
		            echo "<table width=40% border>";
		       		for($i=1;$i<=12;$i++)
					{
									$sql=mysql_query("select * from `sub_class` where `cl_id`='".$i."' order by `name`");
							  		while($s=mysql_fetch_array($sql))
							  		{
							  				echo "<tr><td COLSPAN=2 align='center'><b>".$s['cl_id']."-".$s['name']."</b></td></tr>";
							  				$pup=mysql_query('select `surname` from `students` where `class_id`="'.$s['id'].'" order by `surname`');
							  				//die('select `surname` from `students` where `class_id`="'.$s['id'].'" order by `surname`');
							  				$l='1';
							  				while($p=mysql_fetch_array($pup))
							  				{
							  					echo "<tr><td width=5%>".$l."</td><td>".$p['0']."</td></tr>";
							  					$l=$l+'1';
							  				}
							  		}

					}

		       		echo"</table>";
					include('base.php');
					die();
	  		}




			  if($_SESSION['acces']>1 or $_SESSION['guest'] or $_GET['act']=='class')
			  {



					  echo "<hr><form method='post' action='".$file."'><select name='id'>";

					  for($i=1;$i<=4;$i++)
					  {
							echo "<optgroup label='".$i." курс'>";
							$sql=mysql_query("select * from `sub_class` where `cl_id`='".$i."' order by `name`");
					  		while($s=mysql_fetch_array($sql))
					  		{
					  				echo "<option value='".$s['id']."'>".$s['cl_id']." ".$s['name']."</option>";
					  		}
					  		echo "
					  			<br>";
					  }

					  echo "</optgroup>
					  		</select>
					  		<input type='submit' name='action' value='Выбрать'>
					  		</form>";
					  include('base.php');
					  die();
			  }




              	   include('base.php');
                  die();
          }


				echo "<form method='post' action='index.php'><b><br><br>Заполните поля формы:</b><br><br>";
				echo '<table width=25%>
						<tr>
							<td>';
				echo "Логин:</td><td><input type='text' name='login'></td>
						</tr>
						<tr>
							<td>";
				echo "Пароль:</td><td><input type='password' name='pass'></td>
						</tr>
					</table><br>";
				echo "<input type='submit' name='action' value='Вход'>";
				echo "</form>";
				echo "<form method='POST' action='index.php'>
						<input type='hidden' name='guest' value='1'>
						<input type='submit' name='Guest_com' value='Я студент'>
						</form>";
   include('base.php');
?>
