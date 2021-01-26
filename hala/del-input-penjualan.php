<?php
$kode=$_GET['kode'];
$nama=$_GET['id'];

$s=mysql_query("select * from dtlpenjualan where kode_penjualan='$kode' and idbarang='$nama'");
$dt=mysql_fetch_array($s);
$jumlah=$dt['jumlah'];

if ($sql=mysql_query("delete from dtlpenjualan where kode_penjualan='$kode' and idbarang='$nama'")) {
	$produk=mysql_query("select * from stok_bahan where id_bahan='$nama'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$total=$isi['harga_per']*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set jumlah='$jumlah_baru',total='$total' where idbarang='$nama'");
}
?>
<script language="javascript">
	document.location='?page=inp-penjualan';
</script>