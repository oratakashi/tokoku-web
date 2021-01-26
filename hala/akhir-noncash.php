<?php
$kode  = $_POST['kode'];
$debet = $_POST['debet'];
$kredit = $_POST['kredit'];

$sql= mysql_query("update tblnoncash set totaldeb='{$debet}', totalcrd='{$kredit}' where kode_ncs='{$kode}'");
?>
<script language="javascript">
	document.location='?';
</script>