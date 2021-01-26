<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];

$sql= mysql_query("update tbltransaksi set total='{$total}' where kode_tran='{$kode}'");
?>
<script language="javascript">
	document.location='?page=trans-lain';
</script>