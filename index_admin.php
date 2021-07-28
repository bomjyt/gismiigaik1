<?php
	session_start();
	if($_SESSION['admin'])
	{
		  include('db_connect.php');


		          echo 'Операции с: ';
   		echo '<a href="index.php?act=class">Группами</a>'.' | ';
   		echo '<a href="index.php?act=teach">Преподавателями</a>'.' | ';
   		echo '<a href="index.php?act=rename">Редактировать заголовок сайта.</a>'.' | ';
   		echo "<a href='index.php?exit=1'>Выйти из кабинета</a><hr>";
		  echo "<table width='20%'>
		  		<tr>
		  		<td>
		  		<a href='javascript: window.history.back()'>Назад</a>
		  		</td>
		  		<td>
		  		<a href='index.php'>Выйти</a>
		  		</td></tr></table><hr>";

			  	if (isset($_GET['act']) && $_GET['act']=='class')
			  	{
			  			echo '<br><a href="add_puple.php?id='.$_GET['id'].'">Добавить в базу студента</a><br><br>';
			  			echo '<a href="add_puple.php?id='.$_GET['id'].'&act=redact">Показать список для редактирования</a><br>';
			  	//		echo '<br><br><a href="index.php">Выйти</a><br>';
			  			include('base.php');
			  			die();
			  	}


				if (isset($_GET['act']) && $_GET['act']=='leson')
				{						echo '<br><a href="add_leson.php?id='.$_GET['id'].'">Добавить в базу ведомость</a><br><br>';
			  			echo '<a href="add_leson.php?id='.$_GET['id'].'&act=redact">Показать список ведомостей для редактирования</a><br>';
			  	//		echo '<br><br><a href="index.php">Выйти</a><br>';
			  			include('base.php');
			  			die();
				}


				echo '<br><br><a href="index_admin.php?act=class&id='.$_POST["id"].'">Операции с группами</a><br><br>';

				echo '<br><br><a href="index_admin.php?act=leson&id='.$_POST["id"].'">Операции с ведомостями</a><br><br>';
		          include('base.php');
	}
	else header("Location: index.php");//echo "У Вас нет прав для просмотра страницы.";
?>
