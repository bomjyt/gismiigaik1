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
      		echo "<a href='index.php'>�����</a><hr>";
      		if($_POST['re']>'0')
      		{
      				$ins=mysql_query('update `Name` set `name`="'.$_POST['re'].'" where `id`="1"');
      		}
      		else {echo "��������� ���� �����.";}
      		include('base.php');
			die();
      }

	  if($_GET['act']=='rename')
	  {
	  		echo "<a href='index.php'>������</a><hr>";

	  		echo"<form method='POST' >
	  			<input type='text' name='re'>:���������
	  			<br><br>
	  			<input type='submit' value='�������������'>
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
              		echo '�������� �: ';
              		echo '<a href="index.php?act=class">��������</a>'.' | ';
              		echo '<a href="index.php?act=teach">���������������</a>'.' | ';
              		echo '<a href="index.php?act=rename">������������� ��������� �����.</a>'.' | ';
              	}
   				echo "<a href='index.php?exit=1'>����� �� ��������</a><hr>";



			echo '<br><a href="add_teach.php">�������� � ���� �������������</a><br><br>';
			echo '<a href="add_teach.php?act=redact">�������� ������ �������������� ��� ��������������</a><br>';

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
              		echo "�������� ���� ������ ��� ������.<br><br>";
              		unset($_SESSION);
              		echo "<a href='index.php'>�����</a>";
              		  // include('base.php');
              		die();
      }
      if($_SESSION['acces']=='1')
      {
              	$_SESSION['admin']=true;
              	echo "�� ����� ��� <b>��������� ��������</b>";
              	$file='index_admin.php';



      }
      elseif($_SESSION['acces']>'1')
      {
              	$_SESSION['teach']=true;
              	echo "�� ����� ��� �������������:<b>".$acces_s['name']."</b><hr>";
              	$_SESSION['map']['0']='<a href="index.php?teach='.$_SESSION['acces'].'">����� ������</a>';
              	echo $_SESSION['map']['0']." - ";
              	$file='index_teacher.php';
      }
      if ($_POST['guest']=='1' or $_GET['guest']=='1')
      {
      			$file='index_guest.php';
      			echo "��<b> �������</b><br>";
      			$_SESSION['map']['1']='<a href="index.php?guest=1">�������</a>';

      			$_SESSION['guest']=true;
      			echo $_SESSION['map']['1'];
      			echo "<hr>";
      }



      if ($_SESSION['acces']>0 or $_SESSION['guest'])
      {
			    if($_SESSION['acces']=='1')
              	{
              		echo '<hr>�������� �: ';
              		echo '<a href="index.php?act=class">��������</a>'.' | ';
              		echo '<a href="index.php?act=teach">���������������</a>'.' | ';
              		echo '<a href="index.php?act=list">������ ���������</a>'.' | ';
              		echo '<a href="index.php?act=rename">������������� ��������� �����.</a>'.' | ';
              	}
   				echo "<a href='index.php?exit=1'>����� �� ��������</a>";

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
							echo "<optgroup label='".$i." ����'>";
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
					  		<input type='submit' name='action' value='�������'>
					  		</form>";
					  include('base.php');
					  die();
			  }




              	   include('base.php');
                  die();
          }


				echo "<form method='post' action='index.php'><b><br><br>��������� ���� �����:</b><br><br>";
				echo '<table width=25%>
						<tr>
							<td>';
				echo "�����:</td><td><input type='text' name='login'></td>
						</tr>
						<tr>
							<td>";
				echo "������:</td><td><input type='password' name='pass'></td>
						</tr>
					</table><br>";
				echo "<input type='submit' name='action' value='����'>";
				echo "</form>";
				echo "<form method='POST' action='index.php'>
						<input type='hidden' name='guest' value='1'>
						<input type='submit' name='Guest_com' value='� �������'>
						</form>";
   include('base.php');
?>
