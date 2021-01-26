<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$sql=mysql_query("delete from dtlkomposisi_produk where nama_produk='{$kode}' and nama_bahan='{$nama}'");
?>
<script language="javascript">
	document.location='?page=inp-jenis-produk';
</script>