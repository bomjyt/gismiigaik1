<?php
	session_start();
	if($_SESSION['teach'])
	{
		  include('db_connect.php');
		    foreach($_SESSION['map'] as $key=>$value)
  			{
			  		if ($key>'0' and $value>'0')
			  		{
			  			echo ' - '.$value;
			  		}
			  		elseif($value>'0')
			  		{
			  			echo $value;
			  		}

  			}

  			echo " - "."<a href='index.php?exit=1'>Выйти из кабинета</a>";
  			echo "<hr>";



		  echo "<script language='javascript'>
				function check()
				{
					var fld1=document.getElementById('fld_1'); //fld_1 - id первого поля в функции..
					var err_str='';
					if(fld1.value.length<=0)
						err_str+='Не заполнено поле тип проведения'+'\\n';
					if(err_str.length>0)
					{
						alert(err_str);
						return false;
					}
					return true;
				}
						function check1()
				{
					var fld1=document.getElementById('fld_11'); //fld_1 - id первого поля в функции..
					var err_str='';
					if(fld1.value.length<=0)
						err_str+='Не заполнено поле тип проведения'+'\\n';
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

		  		<table width='20%'>
		  		<tr>
		  		<td>
		  		<a href='javascript: window.history.back()'>Назад</a>
		  		</td>
		  		<td>
		  		<a href='index.php'>Выйти</a>
		  		</td></tr></table><hr>";

					if(isset($_POST['go']))
					{

						//die();

						$m=$_POST['month']+'1';
						$data=$_POST['year']."-".$m."-".$_POST['day'];

						$p='';
						foreach($_POST as $key=>$value)
						{
							if((int)$key>'0')
							{								$p.="`$key`='$value',";
							}
						}



						if($_POST['go']=='Редактировать')
						{
								IF($_POST['Theme']>'0')
								{
											$r="update `".$_POST['class']."`
											set `leson_id`='".$_POST['leson']."',`data`='".$data."',".$p."
											`name`='".$_POST['Theme']."' where `id`='".$_POST['id']."'";
											echo "Экзамен добавлен в Базу";

								}
								else echo "Не заполнено поле тип экзамена";

						}
						else
						{								IF($_POST['Theme']>'0')
								{
										$r="Insert into `".$_POST['class']."`
										set `leson_id`='".$_POST['leson']."',`data`='".$data."',".$p."
										`name`='".$_POST['Theme']."'";
										echo "Экзамен добавлен в Базу";

								}
								else echo "Не заполнено поле тип экзамена";
						}

		                $sql=mysql_query($r) or die(mysql_error().'<br />'.$r);



						//echo "<br><br><a href='index.php'>Назад</a>";
		                include('base.php');

						die();
					}

					if(isset($_POST['redact']))
					{

		                $le=mysql_query("select * from `".$_POST['cl']."` where `id`='".$_POST['id']."'");
		                $les=mysql_fetch_assoc($le);
		                $datan=explode('-',$les['data']);



						$day=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

							$year=array('2008','2009','2010','2011','2012','2013','2014','2015','2016','2017', '2018', '2019', '2020', '2021', '2022');

						    $month=array('Январь','Февраль','Март','Апрель','Мая','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');

							$type=array('-','Экзамен','Зачёт','Зачёт с оценкой');
							 $mark=array('-','5','4','3','2','1','Н');
							  $cl=mysql_query("select `cl_id`,`name` from `sub_class` where `id`='".$_POST['cl']."'");
							  $class=mysql_fetch_assoc($cl);
							  // Форма ввода оценок
							  echo "Группа:<b> ".$class['cl_id']."-".$class['name']."</b><br>";
							  $pup=mysql_query("select * from `students` where `class_id`='".$_POST['cl']."' order by `surname`");

									echo "<form method='POST' action='index_leson.php'>
										<input type='hidden' value='".$_POST['cl']."' name='class'>
										<input type='hidden' value='".$les['leson_id']."' name='leson'>Дата проведения экзамена:<br>
										<select name='day'>";
							foreach($day as $kee=>$d)
						    {
						    	if($d==$datan['2'])
						    	{
						    		echo '<option selected value="'.$d.'">'.$d.'</option>';
						    	}
						    	else
						    	echo '<option value="'.$d.'">'.$d.'</option>';
						    }
						   	echo "</select> <select name='month'>";

						   	foreach($month as $k=>$m)
						    {
						   		$r=$k+'1';
						   		if($r==$datan['1'])
						    	{
						   			echo '<option selected value="'.$k.'" name="'.$k.'">'.$m.'</option>';
								}
								else echo '<option value="'.$k.'" name="'.$k.'">'.$m.'</option>';
						    }
						   	echo "</select> <select name='year'>";
						   	foreach($year as $key=>$y)
						    {
						    	if($y==$datan['0'])
						    	{

						    		echo '<option selected value="'.$y.'">'.$y.'</option>';
								}
								else echo '<option value="'.$y.'">'.$y.'</option>';
						    }
							echo "</select><br><br>
						   			<input type='text' name='Theme' value='".$les['name']."' id='fld_1'>:Тип проведения <br><br>
						   			<table border='1'>";
						   	

							while(@$ac=mysql_fetch_assoc($pup))
							{
										$id=$ac['id'];
										echo"<tr>
											<td>
											".$ac['surname']."
											</td>
											<td>
					                        <select name='".$ac['id']."'>";

					                        foreach($mark as $key=>$marker)
					                        {
					                        	if($marker==$les[$id])
					                        	{
					                        		echo"<option selected value='".$marker."'>".$marker."</option>";
					           					}
					           					else	echo"<option value='".$marker."'>".$marker."</option>";
					                        }

					                        echo"</select>

					                        	</td>
												</tr>";


							}
							echo"
									</table>
									<input type='hidden' name='id' value='".$_POST['id']."'>
									<input type='submit' name='go' onclick='return check()' value='Редактировать'>
									</form>";



					}

					if(isset($_POST['delete']))
					{
		             	$delete=mysql_query("delete from `".$_POST['cl']."` where `id`='".$_POST['id']."'");
		             	echo "Запрос выполнен";
		   				//echo '<br><br><a href="index_admin.php?act=leson&id='.$_GET['id'].'">Назад</a><br>';
		   				include('base.php');
		             	die();
					}

					if(isset($_GET['act']) && $_GET['act']=='red')
					{
					    	$cl=mysql_query("select * from `sub_class` where `id`='".$_GET['cl']."'");
					    	@$class=mysql_fetch_assoc($cl);
					    	echo "Группа:<b> ".$class['cl_id']."-".$class['name']."</b><br>";

						$red=mysql_query("select * from `".$_GET['cl']."` where `leson_id`='".$_GET['id']."' order by `data`");
		                echo "<table border='1'>
		                		<tr>
								<td>
								Тип проведения
								</td>
								<td>
								Дата проведения
								</td>
								<td>
								Операция
								</td>
								<td>
								Операция
								</td>
								</tr>";
						while($redact=mysql_fetch_assoc($red))
						{							echo "<tr>
									<td>
		                            ".$redact['name']."
									</td>
									<td>
		                            ".$redact['data']."
									</td>
									<td>
									<form method='post' action='index_leson.php'>
									<input type='hidden' name='id' value='".$redact['id']."'>
									<input type='hidden' name='cl' value='".$_GET['cl']."'>
									<input type='submit' valign='middle' name='redact' value='Редактировать'>
									</td>
									<td valign='middle'>
									<input type='submit' name='delete' onclick='return question()' value='Удалить'>
									</form>
									</td>
									</tr>";
						}
						echo "</table>";
						include('base.php');
				      //  echo '<br><br><a href="index.php">Назад</a><br>';
						die();
					}

					if(isset($_GET['act']) && $_GET['act']=='add')
					{

							/*for($i==1;$i<=31;$i++)
						    {
						    	$day[]=$i;

						    }   */
						    $day=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

							$year=array('2008','2009','2010','2011','2012','2013','2014','2015','2016','2017', '2018', '2019', '2020', '2021', '2022' );

						    $month=array('Январь','Февраль','Март','Апрель','Мая','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');


							  $type=array('-','Экзамен','Зачёт','Зачёт с оценкой');
							  $mark=array('-','5','4','3','2','1','Н');
							  $les=mysql_query("select `name` from `leson_login` where `id`='".$_GET['id']."'");
							  $leson=mysql_fetch_assoc($les);
							  $cl=mysql_query("select `cl_id`,`name` from `sub_class` where `id`='".$_GET['cl']."'");
							  $class=mysql_fetch_assoc($cl);
							  // Форма ввода оценок

							  			  $pup=mysql_query("select * from `students` where `class_id`='".$_GET['cl']."' order by `surname`");

									echo "<form method='POST' action='index_leson.php'>
										<input type='hidden' value='".$_GET['cl']."' name='class'>
										<input type='hidden' value='".$_GET['id']."' name='leson'>";

							  echo '<table width=40%>
							  			<tr>';
							  echo "<td>Группа </td>
							  			<td><b>".$class['cl_id']."-".$class['name']."</b></td>
							  		</tr>
							  		<tr>
							  			<td>Предмет</td><td><b>".$leson['name']."</b></td>
							  		</tr>";

								echo "<tr>
										<td>Дата проведения</td>
										<td width='70%'><select name='day'>";
							foreach($day as $o=>$d)
						    {
						    	echo '<option value="'.$d.'">'.$d.'</option>';
						    }
						   	echo "</select> <select name='month'>";

						   	foreach($month as $k=>$m)
						    {
						    	echo '<option value="'.$k.'">'.$m.'</option>';
						    }
						   	echo "</select> <select name='year'>";
						   	foreach($year as $key=>$y)
						    {
						    	echo '<option value="'.$y.'">'.$y.'</option>';
						    }
							
							echo "</select></td>
						   			</tr>
						   			<tr>
						   				<td>
						   					Тип проведения
						   				</td>
						   				<td>
											<input type='text' id='fld_11' name='Theme'>
						   				</td>
						   			</tr></table>
						   			<table border='1'>";
						   	

							while(@$ac=mysql_fetch_assoc($pup))
							{
										echo"<tr>
											<td>
											".$ac['surname']."
											</td>
											<td>
					                        <select name='".$ac['id']."'>";

					                        foreach($mark as $key=>$marker)
					                        {
					                        	echo"<option value='".$marker."'>".$marker."</option>";
					                        }

					                        echo"</select>

					                        	</td>
												</tr>";


							}
							echo"
									</table>
									<BR /><input type='submit' onclick='return check1()' name='go' value='Подтвердить'>
									</form>";
							//echo "<a href='index.php'>Выйти</a>";
		  			}
		  			   include('base.php');
	}
	else header("Location: index.php");//echo "У Вас нет прав для просмотра страницы.";
?>
