<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];
$tgl   = date("Y-m-d");

$select=mysql_query("SELECT kurang FROM tblpembelian_bahan WHERE kode_pembelian='$kode'");
$pilih=mysql_fetch_array($select);
$kurang=$pilih[0];
$sisa=$kurang-$total;

if ($kurang == 0){

	$sql1 = mysql_query("update tblretur_beli set total='$total' where kode_rebeli='$kode'");

} else {
	
if ($kurang < $total) {
	
$turah=$total-$kurang;
	
	$sql1= mysql_query("update tblpembelian_bahan set kurang='0' where kode_pembelian='$kode'");

} else {
	
	$sql1= mysql_query("update tblpembelian_bahan set kurang='$sisa' where kode_pembelian='$kode'");
	$sql2= mysql_query("update tblretur_beli set total='$total' where kode_rebeli='$kode'");
}
}
?>
<script language="javascript">
	document.location='?page=rekap-pembelian';
</script>