<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$sql=mysql_query("delete from dtlnoncash where kode_ncs='$kode' and nama_ncs='$nama'");
?>
<script language="javascript">
	document.location='?page=inp-noncash';
</script>