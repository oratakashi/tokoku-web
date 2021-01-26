<?php
$kode = $_POST['kode'];
$jml_jadi = $_POST['jml_jadi'];
$hargat = $_POST['hargat'];
$hargap = $hargat/$jml_jadi;
$sql=mysql_query("update tblkomposisi_produk set jml_jadi='{$jml_jadi}',hargap='{$hargap}',hargat='{$hargat}' where nama_produk='{$kode}'");
?>
<script language="javascript">
	document.location='?page=stok-product';
</script>