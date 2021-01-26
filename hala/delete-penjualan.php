<?php
$kode = $_GET['kode'];
$delt1 = mysql_query("DELETE FROM tblpenjualan WHERE kode_penjualan='$kode'") or die(mysql_error());
$delt2 = mysql_query("DELETE FROM dtlpenjualan WHERE kode_penjualan='$kode'") or die(mysql_error());
if ($delt1 && $delt2) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-penjualan\">");}
?>