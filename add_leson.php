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




		echo "
				<script language='javascript'>

				function check()
				{
					var fld1=document.getElementById('fld_1'); //fld_1 - id ������� ���� � �������..
					var err_str='';
					if(fld1.value.length<=0)
						err_str+='�� ��������� ���� �������� ��������'+'\\n';
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
					var err_str='';
					if(fld1.value.length<=0)
						err_str+='�� ��������� ���� �������� ��������'+'\\n';
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
			<table width='20%'>
	  		<tr>
	  		<td>
	  		<a href='javascript: window.history.back()'>�����</a>
	  		</td>
	  		<td>
	  		<a href='index.php'>�����</a>
	  		</td></tr></table><hr>";

				if(isset($_POST['act']))
				{
			    	$add=mysql_query("insert into `leson_login` values (null,'".$_POST['id']."','".$_POST['name']."','".$_POST['id_teach']."')");
			    	echo "������ �������� �������";
			    	//echo '<br><a href="add_leson.php?id='.$_POST['id'].'">�������</a><br><br>';
			    	include('base.php');
			    	die();
				}

				if(isset($_POST['del']))
				{
			    	$na=mysql_query('select * from `leson_login` where  `id`="'.$_POST['id'].'"');
			    	$name=mysql_fetch_assoc($na);
			    	echo "��������� <b>".$name['name']."</b> �������";
			    	$add=mysql_query("delete from `leson_login` where `id`='".$_POST['id']."' ");

			    	//echo '<br><a href="add_leson.php?id='.$_POST['id'].'">�������</a><br><br>';
			    	include('base.php');
			    	die();
				}

			    if($_GET['act']=='redact')
			    {			    	$sql=mysql_query("select * from `leson_login` where `cl_id`='".$_GET['id']."' order by `name`");
			    	$cl=mysql_query("select * from `sub_class` where `id`='".$_GET['id']."'");
			    	@$class=mysql_fetch_assoc($cl);
			    	echo "������:<b> ".$class['cl_id']."-".$class['name']."</b><br>";
			    	echo "<table border='1'>
			    			<tr>
			    			<td>
			    			������������ ��������
			    			</td>
			     			<td>
			    			�������������
			    			</td>
			     			<td>
			    			��������
			    			</td>
			    			<td>
			    			��������
			    			</td>
			    			</tr>";
			    	while($les=mysql_fetch_assoc($sql))
			    	{			    		echo "<form method='POST' action='add_leson.php'>
			    				<input type='hidden' name='cl_id' value='".$_GET['id']."'>";
			    		$teach=mysql_query("select `name` from `users` where `id`='".$les['id_teach']."'");
			    		$t=mysql_fetch_assoc($teach);
			    	   	echo"<tr width=100%>
			   					<td>".$les['name']."</td>
			   					<td>".$t['name']."</td>

			   					<td>
			   					<INPUT TYPE='SUBMIT' name='red'  value='�������������'>
			   					<input type='hidden' name='id' value='".$les['id']."'>

			   					</td>
			   					<td>
			   					<input type='hidden' name='id' value='".$les['id']."'>
			   					<input type='submit' name='del' onclick='return question()' value='�������'>
			   					</td>

			   					</tr></form>";
			   		}
			        echo"</table>";
			        //echo '<br><br><a href="index_admin.php?act=leson&id='.$_GET['id'].'">�����</a><br>';
			        include('base.php');
			        die();

			    }

				if(isset($_POST['redact']))
			    {
			    	//die("update `leson_login` set `name`='".$_POST['name']."',`id_teach`='".$_POST['id_teach']."',`cl_id`='".$_POST['cl_id']."' where `id`='".$_POST['id']."'");
			    	@$redact=mysql_query("update `leson_login`
			    						set `name`='".$_POST['name']."',`id_teach`='".$_POST['id_teach']."',`cl_id`='".$_POST['cl_id']."'
			    						 where `id`='".$_POST['id']."'");

			        echo "������ �������� �������.";
			        //echo '<br><br><a href="index_admin.php?act=leson&id='.$_POST['cl_id'].'">�����</a><br>';
			      	include('base.php');
			      	die();
			    }

			    if(isset($_POST['red']))
			    {
			    	$qu=mysql_query("select * from `leson_login` where `id`='".$_POST['id']."'");
			    	$q=mysql_fetch_assoc($qu);
			    	echo "<form action='add_leson.php' method='POST'><br>
						<input type='text' id='fld_11' name='name' value='".$q['name']."'>:�������� ��������
						<br><br>
						<select name='id_teach' style='width:140px;'>";
				 	$sql=mysql_query("select * from `users` where `id`>'1' order by `name`");
					while($t=mysql_fetch_array($sql))
					{
                        if($t['id']==$q['id_teach'])
                        {
							echo "<option selected name='id_teach' value='".$t['id']."'>".$t['name']."</option>";
						}
						else echo "<option name='id_teach' value='".$t['id']."'>".$t['name']."</option>";
					}

					echo "  </select>:�������������
						<input type='hidden' name='id' value='".$_POST['id']."'>
						<input type='hidden' name='cl_id' value='".$_POST['cl_id']."'>
						<br><br>
						<input type='submit' name='redact' onclick='return check1()' value='�������������'>
						</form>";
					//echo '<br><br><a href="index_admin.php?act=leson&id='.$_POST['cl_id'].'">�����</a><br>';

					include('base.php');
					die();
			    }

				echo "<form action='add_leson.php' method='POST'><br>
						<input type='text' id='fld_1' name='name'>:�������� ��������
						<br><br>
						<select name='id_teach' style='width:140px;'>";
				 $sql=mysql_query("select * from `users` where `id`>'1'");
				while($t=mysql_fetch_array($sql))
				{

						echo "<option name='id_teach' value='".$t['id']."'>".$t['name']."</option>";
				}

				echo "  </select>:�������������
						<input type='hidden' name='id' value='".$_GET['id']."'>
						<br><br>
						<input type='submit' onclick='return check()' name='act' value='��������'>
						</form>";
				//echo '<br><br><a href="index_admin.php?act=leson&id='.$_GET['id'].'">�����</a><br>';
		  		include('base.php');
	}
	else header("Location: index.php");//echo "� ��� ��� ���� ��� ��������� ��������.";
?>