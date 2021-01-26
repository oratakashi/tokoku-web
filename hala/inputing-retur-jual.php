<?php
("new");
$_SESSION['new']='n';
$kode=$_POST['kode'];
$nama=$_POST['nama_barang'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("SELECT * FROM dtlpenjualan WHERE kode_penjualan='$kode' AND nama_barang='$nama'");
$pilih=mysql_fetch_array($select);
$nama_barang=$pilih['nama_barang'];
$harga=$pilih['harga'];
$stok=$pilih['jumlah'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlretur_jual where nama_barang='{$nama_barang}' and kode_rejual='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=retur-jual&error=sudah-ada'</script> 
	<?php
} else {
	
if ($jumlah > $stok) {
	?> 
	<script language="JavaScript"> 
	  document.location='?page=retur-jual&error=tidak-cukup'</script> 
	<?php
} else {
	
if($sql=mysql_query("insert into dtlretur_jual (kode_rejual,nama_barang,harga,jumlah,tgl) values ('$kode','$nama','$harga','$jumlah','$tgl')")){

?> 
	<script language="JavaScript"> 
	  document.location='?page=retur-jual&message=berhasil'</script>
	<?php
	}
}
}

?>