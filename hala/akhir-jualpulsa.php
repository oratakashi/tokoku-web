<?php
$kode  		= $_POST['kode'];
$total 		= $_POST['total'];
$bayar 		= $_POST['bayar'];

if ($bayar < $total){
	$kurang=$total-$bayar;
	$sql1= mysql_query("UPDATE tbljualpulsa SET total='$total',  bayar='$bayar', kurang='$kurang' WHERE kode_jualpulsa='$kode'") or die(mysql_error());
} else if ($bayar > $total) {
	$kembalian=$bayar-$total;
	$sql1= mysql_query("UPDATE tbljualpulsa SET total='$total',  bayar='$bayar', kembalian='$kembalian' WHERE kode_jualpulsa='$kode'") or die(mysql_error());
} else {
	$sql1= mysql_query("UPDATE tbljualpulsa SET total='$total',  bayar='$bayar' WHERE kode_jualpulsa='$kode'") or die(mysql_error());
}
if($sql1) {
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=inp-penjualan-pulsa\">");
}
?>