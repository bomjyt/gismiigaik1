<?php
	session_start();
	if($_SESSION['admin'])
	{
			include('db_connect.php');
			//Форма для заполнения инфы студента
		           echo 'Операции с: ';
   		echo '<a href="index.php?act=class">Группами</a>'.' | ';
   		echo '<a href="index.php?act=teach">Преподавателями</a>'.' | ';
   		echo '<a href="index.php?act=rename">Редактировать заголовок сайта.</a>'.' | ';
   		echo "<a href='index.php?exit=1'>Выйти из кабинета</a><hr>";




		   echo "<html>
		   		<head>
				<style>
					span.help, abbr, acronym
					{
						border-bottom: dashed #090 1px;
					}
				</style>
				<script language='javascript'>
				function check()
				{
					var fld1=document.getElementById('fld_1'); //fld_1 - id первого поля в функции..
					var fld2=document.getElementById('fld_2');
					var fld3=document.getElementById('fld_3');
					var fld4=document.getElementById('fld_4');
					var fld5=document.getElementById('fld_5');
					var err_str='';
					if(fld1.value.length<=0)
						err_str+='Не заполнено поле Имя'+'\\n';
					if(fld2.value.length<=0)
						err_str+='Не заполнено поле Фамилия'+'\\n';
					if(fld3.value.length<=0)
					 	err_str+='Не заполнено поле Отчество'+'\\n';
					if(fld4.value.length<=0)
					 	err_str+='Не заполнено поле Дополнительная Информация'+'\\n';
					if(fld5.value.length<=0)
					 	err_str+='Не заполнено поле Дополнительная Информация'+'\\n';
					if(err_str.length>0)
					{
						alert(err_str);
						return false;
					}
					return true;
				}
				function question()
				{
					if (confirm('Данные будут безвозвратно удалены.Продолжить?'))
					{
			 	   		return true;
			    	}
					else
					{
				    	return false;
					}
				}


				</script>
		   		</head>
		        <body>
		   		<table width='20%'>
		  		<tr>
		  		<td>
		  		<a href='javascript: window.history.back()'>Назад</a>
		  		</td>
		  		<td>
		  		<a href='index.php'>Выйти</a>
		  		</td></tr></table><hr>";



		   if (isset($_GET['act']) && $_GET['act']=='redact')
		   {		   		$class=mysql_query("select * from `sub_class` where `id`='".$_GET['id']."'");
		   		$all=mysql_query("select * from `students` where `class_id`='".$_GET['id']."'order by `surname`");
		        echo "<table width=100% border='1'>
		        		<tr>
			        		<td>№
			        		</td>
			        		<td>Фамилия
			        		</td>
			        		<td>Имя
			        		</td>
			        		<td>Отчество
			        		</td>
			        		<td>День рождения
			        		</td>
			        		<td>Доп информация
			        		</td>
			        		<td>Доп информация
			        		</td>
			        		<td>Операция
			        		</td>
			        		<td>Операция
			        		</td>
		        		</tr>";
		   		while (@$class=mysql_fetch_assoc($class))
		   		{		   			echo"<div style='align:centr;'><b>".$class['cl_id']."-".$class['name']."</b></div>";
		   		}
		   		$l='1';
		   		while (@$all_s=mysql_fetch_assoc($all))
		   		{
		   			echo"<tr width=100%>
		   					<td>".$l."</td>
		   					<td>".$all_s['surname']."</td>
		   					<td>".$all_s['name']."</td>
		   					<td>".$all_s['fam_name']."</td>
		   					<td>".$all_s['day_r']."</td>
		   					<td>".$all_s['family']."</td>
		   					<td>".$all_s['description']."</td>
		   					<form action='edit_puple.php' method='post'>
		   					<td>
		   					<input type='submit' name='redact' value='Редактировать'>
		   					<input type='hidden' name='id' value='".$all_s['id']."'>
		   					</td>
		   					</form>

		   					<form action='edit_puple.php' method='post'>
		   					<td>
		   					<input type='submit' name='delete' onclick='return question()' value='Удалить'>
		   					<input type='hidden' name='id' value='".$all_s['id']."'>
		   					<input type='hidden' name='class' value='".$all_s['class_id']."'>
		   					</td>
		   					</form>
		   				</tr>";
		 			$l=$l+'1';
		   		}
		        echo"</table>";
		       //  echo '<br><br><a href="index.php">Выйти</a><br>';
		   }
		   else
		   {
			    if (isset($_POST['action']))
			    {
					$surname=$_POST['surname'];
					$id=$_GET['id'];
					$name=$_POST['name'];
					$fam_n=$_POST['fam_n'];
					$d_m_y=$_POST['day'].' '.$_POST['month'].' '.$_POST['year'];
					$a_fam=$_POST['a_fam'];
					$description=$_POST['description'];
					if($_POST['class']>0){$class=$_POST['class'];}
					if($_POST['class_sec']>0){$class=$_POST['class_sec'];}
			        $description_error ='';
					if (mb_strlen($surname,"UTF-8") > 30 or mb_strlen($surname,"UTF-8") < 1)
				 	{
						$description_error.= "Фамилия не может включать более 30 символов и меньше 1";
						$error_post = true;
					}

					if (mb_strlen($name,"UTF-8") > '30' or mb_strlen($name,"UTF-8") < '1')
				 	{
						$description_error.= "<br>Имя не может включать более 30 символов и меньше 1";
						$error_post = true;
					}


					if (mb_strlen($fam_n,"UTF-8") > '30' or strlen($fam_n) < 1)
				 	{
						$description_error.= "<br>Отчество не может включать более 30 символов и меньше 1";
						$error_post = true;
					}

					if (mb_strlen($description,"UTF-8") > 30 or mb_strlen($description,"UTF-8") < 1)
				 	{
						$description_error.= "<br>Доп информация не может включать более 30 символов и меньше 1";
						$error_post = true;
					}

					if (mb_strlen($a_fam,"UTF-8") > 30 or mb_strlen($a_fam,"UTF-8") < 1)
				 	{
						$description_error.= "<br>Доп информация не может включать более 30 символов и меньше 1";
						$error_post = true;
					}

					if (!$error_post){
						$add=mysql_query("insert into `students`
								 values
								 	    (null,'".$class."','$name','$surname','$fam_n','$d_m_y','$a_fam','$description')");

						$id_p=mysql_query("select `id` from `students` where `class_id`='$class' and `name`='$name' and `surname`='$surname' and `fam_name`='$fam_n' and `description`='$description'");
						@$id_pup=mysql_fetch_assoc($id_p);
						//die("select `id` from `students` where `class_id`='".$class."' and `name`='$name' and `surname`='$surname' and `fam_name`='$fam_n' and `description`='$description'");
						$add_jornal=mysql_query("ALTER TABLE `".$class."` ADD `".$id_pup['id']."` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'связь с id студента'");
						//die("ALTER TABLE `".$class."` ADD `".$id_pup['id']."` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'связь с id студента'");
						echo "Студент:<b>".$surname."</b> yспешно добавлен в базу.";
						   include('base.php');
						die();

					}
					else
					{						echo $description_error;
						include('base.php');
						die();
					}
				}





				$day=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

				$year=array('1990','1991','1992','1993','1994','1995','1996','1997','1998','1999','2000','2001','2002','2003','2004','2005','2006','2007');

			    $month=array('Январь','Февраль','Март','Апрель','Мая','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');



			    echo "<form action='add_puple.php' method='POST'>
			    		<br><input type='text' name='surname' id='fld_2'>:Фамилия<br><br>
			    		<input type='text' name='name' id='fld_1'>:Имя<br><br>
			    		<input type='text' name='fam_n' id='fld_3'>:Отчество<br><br>
			    		<select name='day' size='1'>";
			    foreach($day as $k=>$d)
			    {			    	echo '<option name="'.$d.'">'.$d.'</option>';
			    }
			   	echo "</select> <select name='month'>";

			   	foreach($month as $k=>$m)
			    {
			    	echo '<option name="'.$m.'">'.$m.'</option>';
			    }
			   	echo "</select> <select name='year'>";
			   	foreach($year as $k=>$y)
			    {
			    	echo '<option name="'.$y.'">'.$y.'</option>';
			    }
			   	echo "</select><br><br>";
			    echo "<textarea name='a_fam' id='fld_4'></textarea>:Доп информация<br><br>
			    		<textarea name='description' id='fld_5'></textarea>:Доп информация<br><br>
			    		<input type='hidden' name='class' value='".$_GET['id']."'>
			    		<input type='hidden' name='class_sec' value='".@$class."'>
			    		<input type='submit' onclick='return check()' name='action' value='Добавить' >";
			    echo "</form>";

		    }
		       include('base.php');
	}
	else header("Location: index.php");//echo "У Вас нет прав для просмотра страницы.";
?>