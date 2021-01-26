<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];
//$diskon = $_POST['discount'];
$bayar = $_POST['bayar'];
//$jumakhir = $total-$diskon;

$jumakhir = $total;

$tgl   = date("Y-m-d");
if ($bayar < $jumakhir){
	$kurang=$jumakhir-$bayar;
	$sql1= mysql_query("update tblpembelian_bahan set total='{$jumakhir}', bayar='{$bayar}', kurang='{$kurang}' where kode_pembelian='{$kode}'");
	$sql2= mysql_query("insert into dtlhutang (kode_pembelian,bayar,tgl) values ('$kode','$bayar','$tgl')");
} else {
	$sql1= mysql_query("update tblpembelian_bahan set total='{$jumakhir}', bayar='{$bayar}' where kode_pembelian='{$kode}'");
	$sql2= mysql_query("insert into dtlhutang (kode_pembelian,bayar,tgl) values ('$kode','$bayar','$tgl')");
}
?>
<script language="javascript">
	document.location='?page=stok-barang';
</script>