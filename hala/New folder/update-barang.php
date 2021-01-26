<?php 

$id         = $_POST['idbahan'];
$nama_bahan = $_POST['namabahan'];
$satuan     = $_POST['satuan'];
//$expired     = $_POST['expired'];
$hargaj     = $_POST['hargaj'];
//$hargag1     = $_POST['hargag1'];
//$hargag2     = $_POST['hargag2'];


$query = mysql_query("update stok_bahan set nama_bahan='$nama_bahan', satuan='$satuan', hargaj='$hargaj' where id_bahan='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang\">"); }


?>