<?php
("new");
$_SESSION['new']='n';
$nama=$_POST['nama_produk'];
$jumlah=$_POST['jumlah'];
$select=mysql_query("select * from tblkomposisi_produk where nama_produk='".$nama."'");
$pilih=mysql_fetch_array($select);
$nama_produk=$pilih['nama_produk'];
$kode=$_POST['kode'];
$tgl=date("Y-m-d");
$cari=mysql_query("select * from dtlpaket_produk where nama_produk='{$nama_produk}' and paket_produk='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=edit-paket&kode=<?php echo $kode;?>'</script>
	<?php
}else{	
	$produk=mysql_query("select * from tblkomposisi_produk where nama_produk='{$nama_produk}'");
	$isi=mysql_fetch_array($produk);
	$harga=$jumlah*$isi['hargap'];
if($sql=mysql_query("insert into dtlpaket_produk (paket_produk,nama_produk,jumlah,harga) values ('$kode','$nama','$jumlah','$harga')")){
	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=edit-paket&kode=<?php echo $kode;?>'</script>
	<?php
	}
}
?>