<?php
$id = $_GET['kode'];
$file = $_GET['img'];
$query1 = mysql_query("DELETE FROM dtlimgclaim WHERE kode_claim='$id' AND img_claim='$file'") or die(mysql_error());
$query2 = unlink($file);
if ($query1&&$query2) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=inp-claim\">"); }
?>