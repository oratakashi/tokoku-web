<?php 

$id = $_POST['id'];
$fullname = $_POST['fullname'];
$password = mysql_real_escape_string($_POST['password']);
$password = md5($password);
$level = $_POST['level'];
$email = $_POST['email'];
$no_tlp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

if ($_POST['password']=='') {
$query = mysql_query("update tab_user set fullname='$fullname', level='$level', email='$email', no_tlp='$no_tlp', alamat='$alamat' where id='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php\">"); }

} else {

$query = mysql_query("update tab_user set fullname='$fullname', password = '$password', level='$level', email='$email', no_tlp='$no_tlp', alamat='$alamat' where id='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php\">"); }

}

?>