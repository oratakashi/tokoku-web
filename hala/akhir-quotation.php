<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];
$tgl   = date("Y-m-d");
	$sql= mysql_query("update tblquotation set total='{$total}' where kode_quotation='{$kode}'");
?>
<script language="javascript">
	document.location='?page=quotation';
</script>