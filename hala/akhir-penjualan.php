<?php
$kode  		= $_POST['kode'];
$total 		= $_POST['total'];
//$potongan 	= $_POST['potongan'];
//$ongkos  	= $_POST['ongkos'];

$bayar 		= $_POST['bayar'];


//$fix=$total-$potongan+$ongkos;
$fix=$total;

$tgl   		= date("Y-m-d");
if ($bayar < $fix){
	$kurang=$fix-$bayar;
	$sql1= mysql_query("UPDATE tblpenjualan SET total='{$fix}',  bayar='{$bayar}', kurang='{$kurang}' WHERE kode_penjualan='{$kode}'");
	$sql2= mysql_query("INSERT INTO dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$bayar','$tgl')");
} else if ($bayar > $fix) {
	$kembalian=$bayar-$fix;
	$sql1= mysql_query("UPDATE tblpenjualan SET total='{$fix}',  bayar='{$fix}', kembalian='{$kembalian}' WHERE kode_penjualan='{$kode}'");
	$sql2= mysql_query("INSERT INTO dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$bayar','$tgl')");
} else {
	$sql1= mysql_query("UPDATE tblpenjualan SET total='{$fix}',  bayar='{$bayar}' WHERE kode_penjualan='{$kode}'");
	$sql2= mysql_query("INSERT INTO dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$bayar','$tgl')");
}
?>
<script language="javascript">
	document.location='?page=inp-penjualan';
</script>