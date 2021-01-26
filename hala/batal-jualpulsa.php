<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tbljualpulsa where kode_jualpulsa='{$kode}'");
$del  = mysql_query("delete from tbljualpulsa where kode_jualpulsa='{$kode}'");

?>
<script language="javascript">
	document.location='?page=penjualan-pulsa';
</script>