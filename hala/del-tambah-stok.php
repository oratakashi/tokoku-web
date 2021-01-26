<?php
$kode=$_GET['kode'];
$nama=$_GET['id'];
$s=mysql_query("select * from dtltambah_stok where kode_stok='$kode' and id_bahan='$nama'");
$dt=mysql_fetch_array($s);
$jumlah=$dt['jumlah'];
$harga=$dt['harga'];
if($sql=mysql_query("delete from dtltambah_stok where kode_stok='{$kode}' and id_bahan='{$nama}'")){
	$produk=mysql_query("select * from stok_bahan where id_bahan='{$nama}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']-$jumlah;
	$harga_baru=($jumlah_baru!=0)?(($isi['harga_per']*$isi['jumlah']-$harga*$jumlah)/$jumlah_baru):0;
        $total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where id_bahan='{$nama}'");
?>
<script language="javascript">
	document.location='?page=add-stok';
</script>
<?php
}
?>