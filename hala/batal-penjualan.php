<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblpenjualan where kode_penjualan='{$kode}' and iduser='{$_SESSION['id']}'");
$del  = mysql_query("delete from dtlpenjualan where kode_penjualan='{$kode}' and iduser='{$_SESSION['id']}'");

?>
<script language="javascript">
	document.location='?page=penjualan';
</script>