<?php
("new");
$_SESSION['new']='n';
if (empty($_POST['harga'])) {
$idbar=$_POST['id_barang'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("select * from stok_bahan where id_bahan='$idbar'");
$pilih=mysql_fetch_array($select);
$nama=$pilih['nama_bahan'];
$harga=$pilih['harga_per'];
} else if (!empty($_POST['harga'])){
$harga=$_POST['harga'];
$idbar=$_POST['id_barang'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("select * from stok_bahan where id_bahan='$idbar'");
$pilih=mysql_fetch_array($select);
$nama=$pilih['nama_bahan'];
}

$kode=$_POST['kode'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtltambah_stok where id_bahan='{$idbar}' and kode_stok='{$kode}' and iduser='{$_SESSION['id']}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=add-stok'</script> 
	<?php
}else{
if($jumlah==0) {
	
	?> 
	<script language="JavaScript"> 
	  document.location='?page=add-stok'</script>
	<?php
	
} else {
if (isset($_POST['ppn'])){
	$persen=($harga*10)/100;
	if($sql=mysql_query("insert into dtltambah_stok (kode_stok,id_bahan,iduser,nama_bahan,harga,jumlah,ppn,tgl) values ('$kode','$idbar','{$_SESSION['id']}','$nama','$harga','$jumlah','$persen','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where id_bahan='{$idbar}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+$harga*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where id_bahan='{$idbar}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=add-stok'</script>
	<?php
	}
} else {
if($sql=mysql_query("insert into dtltambah_stok (kode_stok,id_bahan,iduser,nama_bahan,harga,jumlah,tgl) values ('$kode','$idbar','{$_SESSION['id']}','$nama','$harga','$jumlah','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where id_bahan='{$idbar}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+$harga*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set harga_per='{$harga_baru}',jumlah='{$jumlah_baru}',total='{$total}' where id_bahan='{$idbar}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=add-stok'</script>
	<?php
	}
	
}
}
}
?>