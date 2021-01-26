<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$sql=mysql_query("delete from dtltransaksi where kode_tran='$kode' and idtran='$nama' and iduser='{$_SESSION['id']}'");
?>
<script language="javascript">
	document.location='?page=inp-transaksi';
</script>