<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$sql=mysql_query("delete from dtlclaim where kode_claim='$kode' and nama_claim='$nama'");
?>
<script language="javascript">
	document.location='?page=inp-claim';
</script>