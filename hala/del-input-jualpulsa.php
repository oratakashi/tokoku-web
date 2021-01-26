<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];

$del=mysql_query("DELETE FROM dtljualpulsa WHERE kode_jualpulsa='$kode' AND idpulsa='$nama'")  or die(mysql_error());
if($del) {
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=inp-penjualan-pulsa\">");
}

?>