<?php
("new");
$_SESSION['new']='n';
$iduser     = $_SESSION['id'];
$id_barang = $_POST['id_barang'];
$nama=$_POST['nama_barang'];
$jumlah=$_POST['jumlah'];
$jenis_harga=$_POST['jenis_harga'];
$select=mysql_query("select * from stok_bahan where id_bahan='$id_barang'");
$pilih=mysql_fetch_array($select);
if ($jenis_harga==1){
	$hargaj=$pilih['hargaj'];
} else if ($jenis_harga==2){
	$hargaj=$pilih['hargag1'];
} else if ($jenis_harga==3){
	$hargaj=$pilih['hargag2'];
}
$hpp=$pilih['harga_per'];
$stok=$pilih['jumlah'];
$kode=$_POST['kode'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlpenjualan where idbarang='$id_barang' and kode_penjualan='$kode' and iduser='$iduser'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-penjualan&error=sudah-ada'</script> 
	<?php
} else {
	
 if($hargaj==0){
	?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-penjualan&error=barang'</script> 
	<?php
} else if($stok==0){
	?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-penjualan&error=habis'</script> 
	<?php
} else if ($jumlah > $stok) {
	?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-penjualan&error=tidak-cukup'</script> 
	<?php
} else {
	
if (isset($_POST['ppn'])){
	$persen=($hargaj)/11;
	$hargaf=$hargaj+$persen;
if($sql=mysql_query("insert into dtlpenjualan (kode_penjualan,idbarang,iduser,nama_barang,harga,jumlah,ppn,hpp,tgl) values ('$kode','$id_barang','$iduser','$nama','$hargaj','$jumlah','$persen','$hpp','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where id_bahan='{$id_barang}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']-$jumlah;
	$total=$isi['harga_per']*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set jumlah='{$jumlah_baru}',total='{$total}' where id_bahan='{$id_barang}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-penjualan&message=berhasil'</script>
	<?php
	}
	
} else {
if($sql=mysql_query("insert into dtlpenjualan (kode_penjualan,idbarang,iduser,nama_barang,harga,jumlah,hpp,tgl) values ('$kode','$id_barang','$iduser','$nama','$hargaj','$jumlah','$hpp','$tgl')")){
	$produk=mysql_query("select * from stok_bahan where id_bahan='{$id_barang}'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']-$jumlah;
	$total=$isi['harga_per']*$jumlah_baru;
	$updet=mysql_query("update stok_bahan set jumlah='{$jumlah_baru}',total='{$total}' where id_bahan='{$id_barang}'");
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-penjualan&message=berhasil'</script>
	<?php
	}
}
}
}
?>