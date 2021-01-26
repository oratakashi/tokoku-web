<?php
("new");
$_SESSION['new']='n';
$brcode=$_POST['nama_bahan'];
$lect=mysql_query("select nama_bahan from stok_bahan where brcode='".$brcode."'");
$lih=mysql_fetch_array($lect);
$nama=$lih[0];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("select * from stok_bahan where nama_bahan='".$nama."'");
$pilih=mysql_fetch_array($select);
$nama_bahan=$pilih['nama_bahan'];
$kode=$_POST['kode'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlpembelian_bahan where nama_bahan='{$nama_bahan}' and kode_pembelian='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-pembelian-bahan'</script> 
	<?php
}else{
if($jumlah==0) {
	
	?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-pembelian-bahan'</script>
	<?php
	
} else {
if (isset($_POST['ppn'])){
$jenisppn=$_POST['ppn'];
switch ($jenisppn){
case $jenisppn == 'ppn' :
	$persen=($harga*10)/100;
	if($sql=mysql_query("insert into dtlpembelian_bahan (kode_pembelian,nama_bahan,harga,jumlah,ppn,tgl) values ('$kode','$nama','$harga','$jumlah','$persen','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where nama_bahan='{$nama_bahan}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+$harga*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where nama_bahan='{$nama_bahan}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-pembelian-bahan'</script>
	<?php
	}
break;
case $jenisppn == 'inppn' :
$hrg=($harga/110)*100;
$persen=$harga-$hrg;
	if($sql=mysql_query("insert into dtlpembelian_bahan (kode_pembelian,nama_bahan,harga,jumlah,ppn,tgl) values ('$kode','$nama','$hrg','$jumlah','$persen','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where nama_bahan='{$nama_bahan}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+($hrg)*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where nama_bahan='{$nama_bahan}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-pembelian-bahan'</script>
	<?php
	}
break;
case $jenisppn == 'noppn' :
if($sql=mysql_query("insert into dtlpembelian_bahan (kode_pembelian,nama_bahan,harga,jumlah,tgl) values ('$kode','$nama','$harga','$jumlah','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where nama_bahan='{$nama_bahan}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+$harga*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where nama_bahan='{$nama_bahan}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-pembelian-bahan'</script>
	<?php
	}
}
} else {
if($sql=mysql_query("insert into dtlpembelian_bahan (kode_pembelian,nama_bahan,harga,jumlah,tgl) values ('$kode','$nama','$harga','$jumlah','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where nama_bahan='{$nama_bahan}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+$harga*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where nama_bahan='{$nama_bahan}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-pembelian-bahan'</script>
	<?php
	}
}
}
}
?>