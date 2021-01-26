<?php
("new");
$_SESSION['new']='n';
$nama=$_POST['nama_claim'];
$nominal=$_POST['nominal'];
$submiter=$_SESSION[nama];
$select=mysql_query("select * from tbltranslain where keterangan='{$nama}'");

$pilih=mysql_fetch_array($select);
$keterangan=$pilih['keterangan'];

$kode=$_POST['kode'];
$tgl=date("Y-m-d");

$cari=mysql_query("select * from dtlclaim where nama_claim='{$keterangan}' and kode_claim='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-claim&error=sudah-ada'</script> 
	<?php
} else {
	
$sql=mysql_query("insert into dtlclaim (kode_claim,nama_claim,jml,tgl,submiter,status) values ('$kode','$nama','$nominal','$tgl','$submiter','N')");

	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-claim&message=berhasil'</script>
	<?php
}
?>