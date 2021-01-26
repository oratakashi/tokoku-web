<?php
$id = $_GET['id'];
$query = mysql_query("delete from tab_user where id='$id'") or die(mysql_error());
if ($query) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=user-list\">"); }
?>