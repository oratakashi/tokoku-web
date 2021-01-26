<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];

$sql=mysql_query("delete from dtlretur_beli where kode_rebeli='$kode' and nama_barang='$nama'");
?>
<script language="javascript">
	document.location='?page=retur-beli';
</script>