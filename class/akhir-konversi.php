<?php
$idbarang = $_POST['idbarang'];
$namabaru = $_POST['namabaru'];
$brcode = $_POST['barcode'];
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

$cari=mysql_query("SELECT * FROM stok_bahan WHERE brcode='$brcode'");
$temu=mysql_fetch_assoc($cari);

if ($temu) {
$ste = mysql_query("select * from stok_bahan where brcode='$brcode'");
$pti = mysql_fetch_array($ste);
$jumtbaru = $pti['jumlah']+$jmlb;
$hrgbr=$hpp;
$totalbrr=$hrgbr*$jumtbaru;
$query2 = mysql_query("UPDATE stok_bahan SET jumlah='$jumtbaru', total='$totalbrr' where brcode='$brcode'") or die(mysql_error());
} else {
$query2 = mysql_query("insert into stok_bahan values('', '$brcode', '$namabaru', '$jmlb', '$satbaru', '$hpp', '$totl', '$hjual', '', '', '')") or die(mysql_error());
}
if ($query1 && $query2) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang\">");
}
?>

