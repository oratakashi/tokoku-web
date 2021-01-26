<?php
("new");
$_SESSION['new']='n';
$nama=$_POST['nama_ncs'];
$debet=$_POST['debet'];
$kredit=$_POST['kredit'];

$select=mysql_query("select * from tbltranslain where keterangan='{$nama}'");

$pilih=mysql_fetch_array($select);
$keterangan=$pilih['keterangan'];

$kode=$_POST['kode'];
$tgl=date("Y-m-d");

$cari=mysql_query("select * from dtlnoncash where nama_ncs='{$keterangan}' and kode_ncs='{$kode}'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	("produk_ada");
	$_SESSION['produk_ada']='y';
	?> 
		<script language="JavaScript"> 
	  document.location='?page=inp-noncash&error=sudah-ada'</script> 
	<?php
} else {
	
$sql=mysql_query("insert into dtlnoncash (kode_ncs,nama_ncs,debet,kredit,tgl) values ('$kode','$nama','$debet','$kredit','$tgl')");

	("produk_ada");
	$_SESSION['produk_ada']='n';
?> 
	<script language="JavaScript"> 
	  document.location='?page=inp-noncash&message=berhasil'</script>
	<?php
}
?>