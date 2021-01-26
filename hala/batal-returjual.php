<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblretur_jual where kode_rejual='{$kode}'");
$del  = mysql_query("delete from tblretur_jual where kode_rejual='{$kode}'");

if ($sql&&$del) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pelunasan&kode=$kode\">"); }
?>