<?php
$kode=$_POST['kode'];
$brcode=$_POST['nama_barang'];
$jumlah=$_POST['jumlah'];

$lect=mysql_query("SELECT * FROM tbl_listpulsa WHERE codepul='{$brcode}'");
$lih=mysql_fetch_array($lect);
$provide=$lih['provide'];
$nominal=$lih['nomp'];
$hbeli=$lih['hbelip'];
$hjual=$lih['hjualp'];


$tgl=date("Y-m-d");
$select=mysql_query("SELECT SUM(jmlp) AS totdep FROM tbl_depopulsa");
$pilih=mysql_fetch_array($select);
$stok=$pilih['totdep'];
	
$sql=mysql_query("INSERT INTO dtljualpulsa(kode_jualpulsa, idpulsa, provide, nomin, jumlah, hpp, harga, tgl) VALUES ('$kode','$brcode','$provide','$nominal','$jumlah','$hbeli','$hjual','$tgl')") or die(mysql_error());
if($sql) {
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=inp-penjualan-pulsa\">");
}
?>