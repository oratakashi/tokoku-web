<?php
$id         = $_POST['idbahan'];
$nama_bahan = $_POST['namabahan'];
$satuan     = $_POST['satuan'];
$suplier    = $_POST['suplier'];
$haper      = @$_POST['haper'];
$hargaj     = $_POST['hargaj'];
$hargag1    = $_POST['hargag1'];
$hargag2    = $_POST['hargag2'];

if (!empty($_POST['haper'])) {

$today = date("Ymd");
$query = "SELECT max(kode_stok) AS last FROM tbltambah_stok WHERE kode_stok LIKE 'STO$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "STO";
$nou  = $char.$today.sprintf("%04s", $b);

$asd = mysql_query("SELECT * FROM stok_bahan WHERE id_bahan='$id'");
$dasd = mysql_fetch_array($asd);

$jumlah = $dasd['jumlah'];
$total = $jumlah * $haper;

$query1 = mysql_query("UPDATE stok_bahan SET nama_bahan='$nama_bahan', satuan='$satuan', harga_per='$haper', total='$total', hargaj='$hargaj', hargag1='$hargag1', hargag2='$hargag2' WHERE id_bahan='$id'") or die(mysql_error());

$query2 = mysql_query("INSERT INTO tbltambah_stok (kode_stok, ketmod, tanggal, total) values('$nou','Persediaan', NOW(),'$total')") or die(mysql_error());

$query3 = mysql_query("INSERT INTO dtltambah_stok (kode_stok, nama_bahan, harga, jumlah, tgl) values('$nou','$nama_bahan','$haper','$jumlah', NOW())") or die(mysql_error());

if (!empty($_POST['suplier'])) {

$cari=mysql_query("SELECT * FROM dtlsuplier WHERE idbarang='$id'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	$query4 = mysql_query("UPDATE dtlsuplier SET idsuplier='$suplier' WHERE idbarang='$id'") or die(mysql_error());
} else {
	$query4 = mysql_query("INSERT INTO dtlsuplier (idsuplier, idbarang) VALUES('$suplier','$id')") or die(mysql_error());
}
} else {}
if ($query1) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang\">"); }

} else {
$query = mysql_query("UPDATE stok_bahan SET nama_bahan='$nama_bahan', satuan='$satuan', hargaj='$hargaj', hargag1='$hargag1', hargag2='$hargag2' WHERE id_bahan='$id'") or die(mysql_error());
if (!empty($_POST['suplier'])) {

$cari=mysql_query("SELECT * FROM dtlsuplier WHERE idbarang='$id'");
$temu=mysql_fetch_assoc($cari);
if ($temu){
	$query4 = mysql_query("UPDATE dtlsuplier SET idsuplier='$suplier' WHERE idbarang='$id'") or die(mysql_error());
} else {
	$query4 = mysql_query("INSERT INTO dtlsuplier (idsuplier, idbarang) VALUES('$suplier','$id')") or die(mysql_error());
}
} else {}

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang\">"); }
}
?>