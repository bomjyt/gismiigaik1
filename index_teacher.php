<?php
	session_start();
	if($_SESSION['teach'])
	{
	      include('db_connect.php');

          if(isset($_POST['id']))
          {
          		$_SESSION['map']['1']="<a href='index_teacher.php?cl_id=".$_POST['id']."'>����� ���������</a>";

          }

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

  			echo " - "."<a href='index.php?exit=1'>����� �� ��������</a>";
  			echo "<hr>";
  			  echo "<table width='20%'>
		  		<tr>
		  		<td>
		  		<a href='javascript: window.history.back()'>�����</a>
		  		</td>
		  		<td>
		  		<a href='index.php'>�����</a>
		  		</td></tr></table><hr>";

			  	if (isset($_GET['act']) && $_GET['act']=='class')
			  	{
			  			echo '<br><a href="add_puple.php?id='.$_GET['id'].'">�������� � ���� ��������</a><br><br>';
			  			//echo '<a href="add_puple.php?id='.$_GET['id'].'&act=redact">�������� ������ ��� ��������������</a><br>';
			  			include('base.php');
			  			die();
			  	}


				if (isset($_GET['act']) && $_GET['act']=='leson')
				{						echo '<br><a href="add_leson.php?id='.$_GET['id'].'">�������� � ���� ���������</a><br><br>';
			  			//echo '<a href="add_leson.php?id='.$_GET['id'].'&act=redact">�������� ������ ���������� ��� ��������������</a><br>';
			  			include('base.php');
			  			die();
				}

				if(isset($_GET['cl_id']))
				{                	$cl_id=$_GET['cl_id'];
				}
				elseif(isset($_POST['id']))
				{
					$cl_id=$_POST['id'];
				}


				$sql=mysql_query("select * from `leson_login`
								 where `cl_id`='".$cl_id."' and `id_teach`='".$_SESSION['acces']."'");
				//die("select * from `leson_login` where `cl_id`='".$_POST['id']."' and `id_teach`='".$_SESSION['acces']."'");
				echo "<table border='1'>";
				while($ac=mysql_fetch_assoc($sql))
				{
							echo"<tr>
								<td>
								".$ac['name']."
								</td>
								<td>
								<a href='index_leson.php?act=add&id=".$ac['id']."&cl=".$cl_id."'>�������� �������</a><br><br>
								</td>
								<td>
								<a href='index_leson.php?act=red&id=".$ac['id']."&cl=".$cl_id."'>������������� �������</a><br><br>
								</td>
								</tr>";

				}
				echo"</table>";
				   include('base.php');

				//echo '<br><br><a href="index.php">�����</a><br>';


				//echo '<br><br><a href="index_leson.php?act=redact&id='.$_POST["id"].'">������������� �������</a><br><br>';
	}
	else header("Location: index.php");//echo "� ��� ��� ���� ��� ��������� ��������.";
?>
