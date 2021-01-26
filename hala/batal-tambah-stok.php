<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tbltambah_stok where kode_stok='{$kode}' and iduser='{$_SESSION['id']}'");
$del  = mysql_query("delete from dtltambah_stok where kode_stok='{$kode}' and iduser='{$_SESSION['id']}'");

?>
<script language="javascript">
	document.location='?page=stok-barang';
</script>