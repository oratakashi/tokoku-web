<?php
$id = $_GET['id'];
$query = mysql_query("delete from tbltranslain where id_trnlain='$id'") or die(mysql_error());
if ($query) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">"); }
?>