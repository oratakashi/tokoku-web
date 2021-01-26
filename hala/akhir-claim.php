<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];

$sql= mysql_query("update tblclaim set total='{$total}' where kode_claim='{$kode}'");
?>
<script language="javascript">
	document.location='?page=clain-marketing';
</script>