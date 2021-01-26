<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblpo where kode_po='{$kode}'");
$del  = mysql_query("delete from dtlpo where kode_po='{$kode}'");

?>
<script language="javascript">
	document.location='?page=purchase-order';
</script>