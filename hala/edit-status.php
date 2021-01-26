<?php 

$id           = $_GET['id'];
$jenis        = $_GET['jenis'];


$query = mysql_query("update tblcustomers set jenis='$jenis' where id_customers='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=list-customers\">"); }


?>