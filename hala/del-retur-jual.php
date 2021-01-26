<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];

$sql=mysql_query("delete from dtlretur_jual where kode_rejual='$kode' and nama_barang='$nama'");
?>
<script language="javascript">
	document.location='?page=retur-jual';
</script>