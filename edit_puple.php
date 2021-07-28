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

		  echo "<script language='javascript'>
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
					 	err_str+='Не заполнено поле Доп информация'+'\\n';
					if(fld5.value.length<=0)
					 	err_str+='Не заполнено поле Доп информация'+'\\n';
					if(err_str.length>0)
					{
						alert(err_str);
						return false;
					}
					return true;
				}


				</script>
		  		<table width='20%'>
		  		<tr>
		  		<td>
		  		<a href='javascript: window.history.back()'>Назад</a>
		  		</td>
		  		<td>
		  		<a href='index.php'>Выйти</a>
		  		</td></tr></table><hr>";


			if($_POST['action']=='Редактировать')
			{					$surname=$_POST['surname'];
					$id_s=$_POST['id_s'];
					$name=$_POST['name'];
					$fam_n=$_POST['fam_n'];
					$d_m_y=$_POST['day'].' '.$_POST['month'].' '.$_POST['year'];
					$a_fam=$_POST['a_fam'];
					$description=$_POST['description'];
					$class=$_POST['class'];

					$add=mysql_query("update `students`
								 		set `class_id`='$class',`surname`='$surname',`name`='$name',`fam_name`='$fam_n',`day_r`='$d_m_y',`family`='$a_fam',`description`='$description'
								 	    where `id`='".$id_s."'");


				    echo 'Запрос выполнен<br>';
				    //<br><a href="add_puple.php?id='.$_POST['class'].'&act=redact">Обратно</a><br>';
				 	include('base.php');
				 	die();

			}



			if(isset($_POST['delete']))
			{
				$sur=mysql_query('Select `surname` from `students` where `id`="'.$_POST['id'].'"');
				$fam=mysql_fetch_assoc($sur);
				$delete=mysql_query("delete from `students` where `id`='".$_POST['id']."'");

				//die("ALTER TABLE `".$_POST['class']."` delete `".$_POST['id']."`;");
				$delete_from_journal=mysql_query("ALTER TABLE `".$_POST['class']."` delete `".$_POST['id']."`");
				 //echo 'Запрос выполнен<br><br><a href="add_puple.php?id='.$_POST['class'].'&act=redact">Обратно</a><br>';
				if ($delete)
				{

					echo 'Студент <b>'.$fam['surname'].'</b> успешно удален.';
				}
				include('base.php');
				die();
			}
			if(isset($_POST['redact']))
			{

				 $all=mysql_query("select * from `students` where `id`='".$_POST['id']."'");
				// die("sselect * from `students` where `id`='".$_POST['id']);
				  while (@$all_s=mysql_fetch_assoc($all))
				  {				  		$ar=explode(' ',$all_s['day_r']);

					    $day=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

						$year=array('1990','1991','1992','1993','1994','1995','1996','1997','1998','1999','2000','2001','2002','2003','2004','2005','2006','2007');

					    $month=array('Январь','Февраль','Март','Апрель','Мая','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');



				  		 echo "<form action='edit_puple.php' method='POST'>
					    		<br><br><input type='text' name='surname' id='fld_2' value='".$all_s['surname']."'>:Фамилия<br><br>
					    		<input type='text' name='name' id='fld_1' value='".$all_s['name']."'>:Имя<br><br>
					    		<input type='text' name='fam_n' id='fld_3' value='".$all_s['fam_name']."'>:Отчество<br><br>
					    		<select name='day'>";
					    foreach($day as $k=>$d)
					    {
					    	if ($d==$ar['0'])
					    	{					    			echo '<option selected value="'.$d.'">'.$d.'</option>';
					    	}
					    	else
					    	    echo '<option value="'.$d.'">'.$d.'</option>';
					    }
					   	echo "</select> <select name='month'>";

					   	foreach($month as $k=>$m)
					    {
					    	if ($m==$ar['1'])
					    	{
					    			echo '<option selected value="'.$m.'">'.$m.'</option>';
					    	}
					    	else
					    	echo '<option value="'.$m.'">'.$m.'</option>';
					    }
					   	echo "</select> <select name='year'>";
					   	foreach($year as $k=>$y)
					    {
					    	if ($y==$ar['2'])
					    	{
					    			echo '<option selected value="'.$y.'">'.$y.'</option>';
					    	}
					    	else
					    	echo '<option value="'.$y.'">'.$y.'</option>';
					    }
					   	echo "</select><br><br>";
					    echo "<textarea id='fld_4' name='a_fam' >".$all_s['family']."</textarea>:Доп информация<br><br>
					    		<textarea id='fld_5' name='description'>".$all_s['description']."</textarea>:Доп информация<br><br>
					    		<input type='hidden' name='class' value='".$all_s['class_id']."'>
					    		<input type='hidden' name='id_s' value='".$all_s['id']."'>
					    		<input type='submit' onclick='return check()' name='action' value='Редактировать'>";
					    echo "</form>";
						// echo '<br><br><a href="index.php">Выйти</a><br>';
				  }
			}
			   include('base.php');
	}
	else header("Location: index.php");//echo "У Вас нет прав для просмотра страницы.";
?>
