<?php
$idbarang = $_POST['idbarang'];
$namabaru = $_POST['namabaru'];
$jmla = $_POST['jmla'];
$jmlb = $_POST['jmlb'];
$hpp = $_POST['hpp'];
$hjual = $_POST['hjual'];
$satbaru = $_POST['satbaru'];
$se = mysql_query("select * from stok_bahan where id_bahan='{$idbarang}'");
$pi = mysql_fetch_array($se);
$jumlama = $pi['jumlah'];
$hperl = $pi['harga_per'];
$jumbaru = $jumlama-$jmla;
$totl = $jmlb*$hpp;
$totbr = $jumbaru*$hperl;

$query1 = mysql_query("update stok_bahan set jumlah='$jumbaru', total='$totbr' where id_bahan='$idbarang'") or die(mysql_error());
$query2 = mysql_query("insert into stok_bahan values('', '', '$namabaru', '$jmlb', '$satbaru', '$hpp', '$totl', '$hjual')") or die(mysql_error());

if ($query1 && $query2) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang\">");
}
?>

