<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];
$tgl   = date("Y-m-d");
	$sql= mysql_query("update tblpo set total='{$total}' where kode_po='{$kode}'");
?>
<script language="javascript">
	document.location='?page=list-order';
</script>