<?php
$kode=$_GET['kode'];
$sql=mysql_query("delete from tblpaket_produk where paket_produk='{$kode}'");
$del=mysql_query("delete from dtlpaket_produk where paket_produk='{$kode}'");
?>
<script language="javascript">
	document.location='?page=stok-paket';
</script>