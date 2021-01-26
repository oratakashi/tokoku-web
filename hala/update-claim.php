<?php 

$kod=$_GET['kode'];
$kuer1 = mysql_query("update tblclaim set status='Y' where kode_claim='$kod'") or die(mysql_error());
$kuer2 = mysql_query("update dtlclaim set status='Y' where kode_claim='$kod'") or die(mysql_error());

if ($kuer1 && $kuer2) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=clain-marketing\">"); }


?>
