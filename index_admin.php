<?php
	session_start();
	if($_SESSION['admin'])
	{
		  include('db_connect.php');


		          echo '�������� �: ';
   		echo '<a href="index.php?act=class">��������</a>'.' | ';
   		echo '<a href="index.php?act=teach">���������������</a>'.' | ';
   		echo '<a href="index.php?act=rename">������������� ��������� �����.</a>'.' | ';
   		echo "<a href='index.php?exit=1'>����� �� ��������</a><hr>";
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
			  			echo '<a href="add_puple.php?id='.$_GET['id'].'&act=redact">�������� ������ ��� ��������������</a><br>';
			  	//		echo '<br><br><a href="index.php">�����</a><br>';
			  			include('base.php');
			  			die();
			  	}


				if (isset($_GET['act']) && $_GET['act']=='leson')
				{						echo '<br><a href="add_leson.php?id='.$_GET['id'].'">�������� � ���� ���������</a><br><br>';
			  			echo '<a href="add_leson.php?id='.$_GET['id'].'&act=redact">�������� ������ ���������� ��� ��������������</a><br>';
			  	//		echo '<br><br><a href="index.php">�����</a><br>';
			  			include('base.php');
			  			die();
				}


				echo '<br><br><a href="index_admin.php?act=class&id='.$_POST["id"].'">�������� � ��������</a><br><br>';

				echo '<br><br><a href="index_admin.php?act=leson&id='.$_POST["id"].'">�������� � �����������</a><br><br>';
		          include('base.php');
	}
	else header("Location: index.php");//echo "� ��� ��� ���� ��� ��������� ��������.";
?>
