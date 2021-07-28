<?php
  	session_start();
  	include('db_connect.php');

   	/*if(!isset($_SESSION['map']['2']))
   	{*/
   		$sql=mysql_query("select * from `sub_class` where `id`='".$_POST['id']."'");
	 	while($s=mysql_fetch_assoc($sql))
		{
			$_SESSION['map']['2']='<a href="index_guest.php?id='.$_POST["id"].'">Группа'.$s["cl_id"].'-'.$s["name"].'</a>';
    	}

	/*}
	else
	{
		$_SESSION['map']['2']=0;
	}*/
 	if(isset($_GET['leson_id']))
    {
			//die("select * from `leson_login` where `id`='".$_GET['leson_id']."'");
			$sel=mysql_query("select * from `leson_login` where `id`='".$_GET['leson_id']."'");
			@$ex=mysql_fetch_assoc($sel);
			$_SESSION['map']['3']="<a href='index_guest.php?leson_id=".$ex['id']."&cl=".$ex['cl_id']."'>".$ex['name']."</a>";
	}
	elseif(!isset($_GET['p']) and !isset($_POST['dif']))
	{
		$_SESSION['map']['3']=0;
	}

 	if(isset($_GET['p']) or $_POST['dif'])
    {    	$p=date("Y-m-j");

    	$cl=$_GET['cl'];
    	$leson_id=$_GET['leson_id'];
    	if(isset($_POST['dif']))
    	{

    		$month=$_POST['month']+1;
    		$month_c=$_POST['month_c']+1;
    		$date=$_POST['year']."-".$month."-".$_POST['day'];
    		$date_c=$_POST['year_c']."-".$month_c."-".$_POST['day_c'];
    		$sel="`data`>='".$date."' and `data`<='".$date_c."'";
    		$cl=$_POST['class'];
    		$leson_id=$_POST['leson'];
    	}
    	$_SESSION['map']['4']="<b>c ".$_POST['day']."-".$month."-".$_POST['year']." по ".$_POST['day_c']."-".$month_c."-".$_POST['year_c']."</b>";
    }
    else
    {   		$_SESSION['map']['4']=0;
    }


  	foreach($_SESSION['map'] as $key=>$value)
  	{

  		if ($key>'1' and $value>'0')
  		{  			echo ' - '.$value;
  		}
  		elseif($value>'0')
  		{
  			echo $value;
  		}

  	}
    echo "<hr>";
  	echo '
  		<html>
		<head>
		<style>
			span.help, abbr, acronym
			{
				border-bottom: dashed #090 1px;
			}
		</style>
		<script>
			function addOnclickHelp()
			{
				addOnclick( document.getElementsByTagName(
		"input" ) );
				addOnclick( document.getElementsByTagName(
		"abbr" ) );
				addOnclick( document.getElementsByTagName(
		"acronym" ) );
			}

			function addOnclick( elts )
			{
				for ( i = 0; i < elts.length; i++ )
				{
					elts[i].onclick = showOnclickHelp;
				}
			}

			function showOnclickHelp()
			{
				alert( window.event.srcElement.title )
			}
		</script>
	</head>


  		';



  /*echo "<body onload='addOnclickHelp();'>
  		<table width='20%'>
  		<tr>
  		<td>
  		<a href='javascript: window.history.back()'>Назад</a>
  		</td>
  		<td>
  		<a href='index.php'>Выйти</a>
  		</td></tr></table><hr>";*/

    if(isset($_GET['p']) or $_POST['dif'])
    {
    	$p=date("Y-m-j");

    	$cl=$_GET['cl'];
    	$leson_id=$_GET['leson_id'];

    	/*if($_GET['p']=='l')
    	{    		$sel="`data`='".$p."'";
    	}
    	elseif($_GET['p']=='w')
    	{
    		$p=explode("-",$p);
    		$w=$p['2']-7;
    		if($w<1) $w=1;
    		$date=$p['0']."-".$p['1']."-".$w;
    		$sel="`data`>='".$date."'";
    	}
    	elseif($_GET['p']=='m')
    	{
    		$p=explode("-",$p);
    		$w=$p['1'];
    		$y=$p['0'];
    		if($w==0)
    		{    			 $y=$y-1;
    			 $w=12;
    		}
    		$date=$y."-".$w."-".$p['2'];
    		$sel="`data`>='".$date."'";
    	} */
    	if(isset($_POST['dif']))
    	{
    		$month=$_POST['month']+1;
    		$month_c=$_POST['month_c']+1;
    		$date=$_POST['year']."-".$month."-".$_POST['day'];
    		$date_c=$_POST['year_c']."-".$month_c."-".$_POST['day_c'];
    		//$sel="`data`>='".$date."' and `data`<='".$date_c."'";
    		$sel="`data` between '".$date."' and '".$date_c."'";
    		$cl=$_POST['class'];
    		$leson_id=$_POST['leson'];
    	}

        $pup=mysql_query("select * from `students` where `class_id`='".$cl."' order by `surname`");
		$query="select * from `".$cl."` where `leson_id`='".$leson_id."' and ".$sel." order by `data`";
    	$sql=mysql_query($query);

		$Ru='0';
		$error='1';

		    	while(@$q=mysql_fetch_assoc($sql))
		    	{		            if(is_array($q))
		            {
                        if($Ru=='0')
                        {                        	echo "<table border='1'>";
		    				echo "<tr>
		    				<td>
		    				<b>Фамилия</b>
		    				</td>";
		  					$Ru++;
		  				}

			            $name="Тип проведения:";
			            $mont=array('Янв','Фев','Март','Апр','Мая','Июнь','Июль','Авг','Сент','Октб','Нояб','Дек');
			            $dat=explode("-",$q["data"]);
			            foreach($mont as $key=>$value)
			            {			            	$fer=$dat['1']-1;
			            	if ($fer==$key)
			            	{			            		$pro=$value;
			            	}
			            }

			            echo '<td title="'.$name.$q["name"].'"><b>'.$dat['2']." ".$pro.'</b>
			        			</td>';
			  			$error='0';
			  		}
			  		else $error=1;

		    	}

		    	if($Ru=='0')
       			{       				echo"</tr>";
       			}

			    if($error!=1)
			    {
			    	while(@$p=mysql_fetch_array($pup))
			        {
				        	echo"<tr>
				        		<td>
				        		".$p['surname']."
				        		</td>";
			           		$query="select * from `".$cl."` where `leson_id`='".$leson_id."' and ".$sel;
			    			$sql=mysql_query($query);
				       		while(@$q=mysql_fetch_array($sql))
			    			{
			            		$e=$p['id'];
			            		$mark=mysql_query("select `".$e."` from `".$cl."`
			            					where `id`='".$q['0']."'");
			               		$marker=@mysql_fetch_array($mark);
			               		if(empty($marker['0']))
			               		{			               			echo"<td>&nbsp;</td>" ;
			               		}
			               		else
			               		{
			               			echo"<td>".$marker['0']."</td>" ;
			               		}

			    			}


				    }



	    			echo"</tr></table><br><br>";
	    		}
	    		else echo "Не найдено экзаменов за выбранный период.";
        //}
        //else echo "Не найдено экзаменов за выбранный период.";

        include('base.php');
    	die();
    }


    if(isset($_GET['leson_id']))
    {    	echo "Выберите период для просмотрa:<br>";

    	$day=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

		$year=array('2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2020', '2021', '2022');

	    $month=array('Январь','Февраль','Март','Апрель','Мая','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');

		echo "<form method='POST' action='index_guest.php'>
				<input type='hidden' value='".$_GET['cl']."' name='class'>
				<input type='hidden' value='".$_GET['leson_id']."' name='leson'>
				 C :<select name='day'>";
        foreach($day as $kee=>$d)
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
		echo "</select><br><br>";

		echo "До:<select name='day_c'>";

		foreach($day as $kee=>$d)
		{
				    	echo '<option value="'.$d.'">'.$d.'</option>';
		}
		echo "</select> <select name='month_c'>";

		foreach($month as $k=>$m)
		{
		 		echo '<option value="'.$k.'">'.$m.'</option>';
		}
		echo "</select> <select name='year_c'>";
		foreach($year as $key=>$y)
		{
		    	echo '<option value="'.$y.'">'.$y.'</option>';
		}
		echo "</select>";



		echo"<br><br><input type='submit' name='dif' value='Выбрать'>
				   	</form>";




    	/*echo "<a href='index_guest.php?p=l&leson_id=".$_GET['leson_id']."&cl=".$_GET['cl']."'>День</a><br>";
    	echo "<a href='index_guest.php?p=w&leson_id=".$_GET['leson_id']."&cl=".$_GET['cl']."'>Неделя</a><br>";
    	echo "<a href='index_guest.php?p=m&leson_id=".$_GET['leson_id']."&cl=".$_GET['cl']."'>Месяц</a><br>";
    	//echo "<br><a href='index.php?guest=1'>Выйти</a>";  */
    	include('base.php');
    	die();
    }
    echo "Выберите предмет для просмотра:<br><br>";

    if ($_GET['id']>'0')
    {    	$id=$_GET['id'];
    }
    else
    {    	$id=$_POST['id'];
    }
    $sel=mysql_query("select * from `leson_login` where `cl_id`='".$id."'");



    while(@$select=mysql_fetch_assoc($sel))
    {    	echo "<a href='index_guest.php?leson_id=".$select['id']."&cl=".$_POST['id']."'>".$select['name']."</a><br><br>";
    }

    // echo "<br><br><a href='index.php?guest=1'>Выйти</a>";
    echo "</body>
    		</HTML>";
       include('base.php');
?>
