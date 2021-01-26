<?php
("new");
$_SESSION['new']='n';
$nama=$_POST['nama_tran'];
$nominal=$_POST['nominal'];

$select=mysql_query("select * from tbltranslain where id_trnlain='{$nama}'");
$pilih=mysql_fetch_array($select);
$kategori = $pilih['kategori'];
$keterangan = $pilih['keterangan'];

$kode=$_POST['kode'];
$tgl=date("Y-m-d");

$cari=mysql_query("select * from dtltransaksi where id_tran='{$nama}' and kode_tran='{$kode}' and iduser='{$_SESSION['id']}'");
@$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-transaksi&error=sudah-ada'</script> 
	<?php
} else {
	
$sql=mysql_query("insert into dtltransaksi (kode_tran,iduser,idtran,nama_tran,ctg,nominal,tgl) values ('$kode','{$_SESSION['id']}','$nama','$keterangan','$kategori','$nominal','$tgl')");

	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-transaksi&message=berhasil'</script>
	<?php
}
?>