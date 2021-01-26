<?php
("new");
$_SESSION['new']='n';
$nama=$_POST['nama_barang'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("select * from stok_bahan where nama_bahan='{$nama}'");
$pilih=mysql_fetch_array($select);
$nama_barang=$pilih['nama_bahan'];
$hargaj=$pilih['hargaj'];
$hpp=$pilih['harga_per'];
$stok=$pilih['jumlah'];
$kode=$_POST['kode'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlpo where nama_barang='{$nama_barang}' and kode_po='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-po&error=sudah-ada'</script> 
	<?php
} else {
	
 if($hargaj==0){
	?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-po&error=barang'</script> 
	<?php
} else {
	
if (isset($_POST['ppn'])){
	$persen=($hargaj*10)/100;
	$hargaf=$hargaj+$persen;
if($sql=mysql_query("insert into dtlpo (kode_po,nama_barang,harga,jumlah,ppn,hpp,tgl) values ('$kode','$nama','$hargaj','$jumlah','$persen','$hpp','$tgl')")){

	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-po&message=berhasil'</script>
	<?php
	}
	
} else {
if($sql=mysql_query("insert into dtlpo (kode_po,nama_barang,harga,jumlah,hpp,tgl) values ('$kode','$nama','$hargaj','$jumlah','$hpp','$tgl')")){

	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-po&message=berhasil'</script>
	<?php
	}
}
}
}
?>