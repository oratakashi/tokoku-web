<?php
("new");
$_SESSION['new']='n';
$kode=$_POST['kode'];
$nama=$_POST['nama_barang'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("SELECT * FROM dtlpembelian_bahan WHERE kode_pembelian='$kode' AND nama_bahan='$nama'");
$pilih=mysql_fetch_array($select);
$nama_barang=$pilih['nama_bahan'];
$harga=$pilih['harga'];
$stok=$pilih['jumlah'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlretur_beli where nama_barang='{$nama_barang}' and kode_rebeli='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=retur-beli&error=sudah-ada'</script> 
	<?php
} else {
	
if ($jumlah > $stok) {
	?> 
	<script language="JavaScript"> 
	  document.location='?page=retur-beli&error=tidak-cukup'</script> 
	<?php
} else {
	
if($sql=mysql_query("insert into dtlretur_beli (kode_rebeli,nama_barang,harga,jumlah,tgl) values ('$kode','$nama','$harga','$jumlah','$tgl')")){

?> 
	<script language="JavaScript"> 
	  document.location='?page=retur-beli&message=berhasil'</script>
	<?php
	}
}
}

?>