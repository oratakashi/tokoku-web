<?php
$paket = $_POST['paket'];
$harga = $_POST['hargaj'];
$hpp = $_POST['hpp'];
$laba = $harga-$hpp;
$sql=mysql_query("update tblpaket_produk set hargaj='{$harga}', hpp='{$hpp}', laba='{$laba}' where paket_produk='{$paket}'");
?>
<script language="javascript">
	document.location='?page=stok-paket';
</script>