<?php
$kode  = $_GET['kode'];
$sql1=mysql_query("delete from tbltransaksi where kode_tran='{$kode}' and iduser='{$_SESSION['id']}'");
$sql2=mysql_query("delete from dtltransaksi where kode_tran='{$kode}' and iduser='{$_SESSION['id']}'");
?>
<script language="javascript">
	document.location='?page=rekap-pengeluaran';
</script>