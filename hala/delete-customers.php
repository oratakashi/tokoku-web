<?php
$id = $_GET['id'];
$query = mysql_query("delete from tblcustomers where id_customers='$id'") or die(mysql_error());
if ($query) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=list-customers\">"); }
?>