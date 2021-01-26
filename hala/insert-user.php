<?php

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$password = md5($password);
$fullname = $_POST['fullname'];
$level = $_POST['level'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$no_tlp = $_POST['no_hp'];

$query = mysql_query("insert into tab_user values('', '$fullname', '$username', '$password', '$level', '$email', '$no_tlp', '$alamat')") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=user-list\">");
}
?>