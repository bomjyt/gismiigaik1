<?php
  include('db_connect.php');
  session_start();
  echo "<table width='20%'>
  		<tr>
  		<td>
  		<a href='javascript: window.history.back()'>Назад</a>
  		</td>
  		<td>
  		<a href='index.php'>Выйти</a>
  		</td></tr></table><hr>";


  if($_POST['add_user'])
    {
      echo "<form action='adminFunctions.php' method=POST>
            Заполните, пожалуйста, следующие поля:<br><br>
            ФИО<input type='text' name='fio'><br>
            Логин<input type='text' name='login'><br>
            Пароль<input type='text' name='pass'><br>
            <select name='user_type'>
            <option value='t'>Преподаватель</option>
            <option value='a'>Сотрудник деканата</option>
            </select><br>
            <input type='submit' name='add' value='Добавить'>
            </form>";

      if($_POST['add'])
        {
          print_r($_POST);
          $q = mysql_query("insert into `users` set `fullname`='".$_POST[fio]."', `login`='".$_POST[login]."', `password`='".$_POST[pass]."', `type`='".$_POST[user_type]."'") or die(mysql_error());
        }


    }


?>
