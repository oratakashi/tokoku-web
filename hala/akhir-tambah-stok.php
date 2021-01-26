<?php
$kode  = $_POST['kode'];
$ketmod = $_POST['ketmod'];
$total = $_POST['total'];
$tgl   = $_POST['tanggal'];

$sql1= mysql_query("update tbltambah_stok set total='{$total}' where kode_stok='{$kode}'");
$sql2= mysql_query("insert into modal (ketmod,iduser,ktg,jmlmod,tglmod) values ('$ketmod','{$_SESSION['id']}','$kode','$total','$tgl')");

?>
<script language="javascript">
	document.location='?page=stok-barang';
</script>