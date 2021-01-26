<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$s=mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$kode' and nama_bahan='$nama'");
$dt=mysql_fetch_array($s);
$jumlah=$dt['jumlah'];
$harga=$dt['harga'];
if($sql=mysql_query("delete from dtlpembelian_bahan where kode_pembelian='{$kode}' and nama_bahan='{$nama}'")){
	$produk=mysql_query("select * from stok_bahan where nama_bahan='{$nama}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']-$jumlah;
	$harga_baru=($jumlah_baru!=0)?(($isi['harga_per']*$isi['jumlah']-$harga*$jumlah)/$jumlah_baru):0;
        $total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where nama_bahan='{$nama}'");
?>
<script language="javascript">
	document.location='?page=inp-pembelian-bahan';
</script>
<?php
}
?>