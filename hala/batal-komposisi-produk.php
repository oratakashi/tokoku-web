<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblkomposisi_produk where nama_produk='{$kode}'");
$del  = mysql_query("delete from dtlkomposisi_produk where nama_produk='{$kode}'");

?>
<script language="javascript">
	document.location='?page=add-jenis-produk';
</script>