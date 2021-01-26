<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblretur_beli where kode_rebeli='{$kode}'");
$del  = mysql_query("delete from tblretur_beli where kode_rebeli='{$kode}'");

if ($sql&&$del) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pelunasan-utang&kode=$kode\">"); }
?>