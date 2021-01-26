<?php
("new");
$_SESSION['new']='n';
$nama=$_POST['nama_bahan'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("select * from stok_bahan where nama_bahan='".$nama."'");
$pilih=mysql_fetch_array($select);
$nama_bahan=$pilih['nama_bahan'];
$kode=$_POST['kode'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlkomposisi_produk where nama_bahan='{$nama_bahan}' and nama_produk='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-jenis-produk'</script> 
	<?php
}else{
	$produk=mysql_query("select * from stok_bahan where nama_bahan='{$nama_bahan}'");
	$isi=mysql_fetch_array($produk);
	$satuan=$isi['satuan'];
	$harga=$isi['harga_per']*$jumlah;
if($sql=mysql_query("insert into dtlkomposisi_produk (nama_produk,nama_bahan,jumlah,satuan,harga) values ('$kode','$nama','$jumlah','$satuan','$harga')")){
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-jenis-produk'</script>
	<?php
	}
}
?>