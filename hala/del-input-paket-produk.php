<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$sql=mysql_query("delete from dtlpaket_produk where paket_produk='{$kode}' and nama_produk='{$nama}'");
?>
<script language="javascript">
	document.location='?page=inp-paket-produk';
</script>