<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblpembelian_bahan where kode_pembelian='{$kode}'");
$del  = mysql_query("delete from dtlpembelian_bahan where kode_pembelian='{$kode}'");

?>
<script language="javascript">
	document.location='?page=stok-barang';
</script>