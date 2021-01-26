<?php
$kode  = $_GET['kode'];

$sql1=mysql_query("delete from tblnoncash where kode_ncs='{$kode}'");
$sql2=mysql_query("delete from dtlnoncash where kode_ncs='{$kode}'");
?>
<script language="javascript">
	document.location='?page=rekap-noncash';
</script>