<?php
	session_start();
	if($_SESSION['admin'])
	{
	 		  include('db_connect.php');
			  echo "<html>
			        <head>
			        <meta http-equiv='Content-Language' content='ru'>
		    		<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
			  				<script language='javascript'>
					function check()
					{
						var fld1=document.getElementById('fld_1'); //fld_1 - id ������� ���� � �������..
						var fld2=document.getElementById('fld_2');
						var fld3=document.getElementById('fld_3');
						var err_str='';
						if(fld1.value.length<=0)
							err_str+='�� ��������� ���� �.�.�.'+'\\n';
						if(fld2.value.length<=0)
							err_str+='�� ��������� ���� �����'+'\\n';
						if(fld3.value.length<=0)
						 	err_str+='�� ��������� ���� ������'+'\\n';
						if(err_str.length>0)
						{
							alert(err_str);
							return false;
						}
						return true;
					}
								function check1()
					{
						var fld1=document.getElementById('fld_11'); //fld_1 - id ������� ���� � �������..
						var fld2=document.getElementById('fld_21');
						var fld3=document.getElementById('fld_31');
						var fld3=document.getElementById('fld_41');
						var err_str='';
						if(fld1.value.length<=0)
							err_str+='�� ��������� ���� �.�.�.'+'\\n';
						if(fld2.value.length<=0)
							err_str+='�� ��������� ���� �����'+'\\n';
						if(fld3.value.length<=0)
						 	err_str+='�� ��������� ���� ������ ������'+'\\n';
						if(fld4.value.length<=0)
						 	err_str+='�� ��������� ���� ����� ������'+'\\n';
						if(err_str.length>0)
						{
							alert(err_str);
							return false;
						}
						return true;
					}

				function question()
				{
					if (confirm('������ ����� ������������ �������.����������?'))
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
		   		<body>";
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



			  if(isset($_POST['redact']))
			  {
			  		$sql=mysql_query("select `pass` from `users` where `id`='".$_POST['id']."'");
			  		$pass=mysql_fetch_assoc($sql);

			  		if($_POST['pass']==$pass['pass'])
			  		{


				  		$q=mysql_query("update `users`
				  				 set `name`='".$_POST['name']."',`login`='".$_POST['login']."',`pass`='".$_POST['new_pass1']."'
				  				 where `id`='".$_POST['id']."'");
				  		echo "������������� <b>".$_POST['name']."</b> ������� ��������������.<br><br><a href='add_teach.php?act=redact'>�����</a>";
				  		include('base.php');
				  		die();
			  		}
			  		else
			  		{
			  			echo "����� �������� ������ ������ ������������� ��� ��������������.<br><br>";
		              //	  					<a href='index.php?act=teach'>�����</a>";
			  			include('base.php');
			  			die();
			  		}
			  }

			  if(isset($_POST['del']))
			  {
			  		$del=mysql_query("select `name` from `users`
				  				 where `id`='".$_POST['id']."'");
				 	@$name=mysql_fetch_assoc($del);
				 	echo "�������������� <b>".$name['name']."</b> ������� ������.";
				 	$q=mysql_query("delete from `users` where `id`='".$_POST['id']."'");
			  		//echo "������������� ������� ������.<br><br><a href='add_teach.php?act=redact'>�����</a>";
			  		include('base.php');
			  		die();
			  }
			  if(isset($_POST['red']))
			  {
                     $te=mysql_query("select * from `users` where `id`='".$_POST['id']."'");
                     $t=mysql_fetch_assoc($te);
			  		 echo "<form method='post' action='add_teach.php'>
			  		 	�������������� ����� �������������:<br><br>
		      			<input type='text' name='name' id='fld_11' value='".$t['name']."'>:�.�.�.<br><br>
		      			<input type='text' name='login' id='fld_21' value='".$t['login']."'>:�����<br><br>
		      			<input type='text' name='pass' id='fld_31'>:������ ������<br><br>
		      			<input type='text' name='new_pass1' id='fld_41'>:����� ������<br><br>
		      			<input type='hidden' name='id' value='".$_POST['id']."'>
		      			<input type='submit' onclick='return check1()' name='redact' value='�������������'><br><br>
		      			</form>";
					//echo "<a href='index.php?act=teach'>�����</a>";
			  		include('base.php');
			  		die();
			  }

			  if(isset($_GET['act']) && $_GET['act']=='redact')
			  {			  		$query=mysql_query("select * from `users` where `id`>'0' order by `name`");
			  		echo "<div style='align:centr;'>������ ��������������</div>
			  				<table width='100%' border='1'>";
			  		while($teach=mysql_fetch_assoc($query))
			  		{						echo "<tr>
								<td>
								<form method='post' action='add_teach.php'>
								".$teach['name']."
								</td>
								<td>
								".$teach['login']."
								</td>
								<td>
								".$teach['pass']."
								</td>
								<td>
								<input type='submit' name='red' value='�������������'>
								</td>
								<td>
								<input type='hidden' name='id' value='".$teach['id']."'>
								<input type='submit' name='del' onclick='return question()' value='�������'>
								</form>
								</td>
								</tr>";
			  		}

			  		echo "</table>
			  				<br>";
		//	  				<a href='index.php?act=teach'>�����</a>";
			  		include('base.php');
			  		die();
			  }

		      if (isset($_POST['add']))
		      {		      	$sql=mysql_query("Insert into `users` values (null,'".$_POST['name']."','".$_POST['login']."','".$_POST['pass']."')") or die(mysql_error());
		      	echo "�������������:<b>".$_POST['name']."</b> �������� �������.<hr>";
		      }
		      echo "<form method='post' action='add_teach.php'>
		      		��������� ���� ����� ��� �������������:<br><br>
		      		<input type='text' name='name' id='fld_1'>:�.�.�.<br><br>
		      		<input type='text' name='login' id='fld_2'>:�����<br><br>
		      		<input type='pass' name='pass' id='fld_3'>:������<br><br>
		      		<input type='submit' name='add' onclick='return check()' value='���������'><br><br>";
				//	<a href='index.php?act=teach'>�����</a>
		      ECHO"</form>
		      	</body>
		      	</html>";
		        include('base.php');
	}
	else header("Location: index.php");//echo "� ��� ��� ���� ��� ��������� ��������.";
?>
