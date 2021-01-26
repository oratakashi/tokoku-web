<?php
$iduser     = $_SESSION['id'];
$brcode     = $_POST['brcode'];
@$expired     = $_POST['expired'];
@$discount     = $_POST['discount'];
@$nama_bahan = $_POST['namabahan'];
$satuan     = $_POST['satuan'];

$jumlah     = $_POST['jumlah'];
$haper     = $_POST['hargaper'];

$total = $jumlah * $haper;

$haum     = $_POST['hargaumum'];
$hagro     = $_POST['hargagrosir'];
@$habeng     = $_POST['hargabengkel'];
$klikbtn     = $_POST['klikbtn'];

$today = date("Ymd");
$query = "SELECT max(kode_stok) AS last FROM tbltambah_stok WHERE kode_stok LIKE 'STO$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "STO";
$nou  = $char.$today.sprintf("%04s", $b);

$query1 = mysql_query("INSERT INTO stok_bahan (iduser,brcode, nama_bahan, jumlah, satuan, harga_per, total, hargaj, hargag1, hargag2, discount, expired) values('$iduser','$brcode','$nama_bahan','$jumlah','$satuan','$haper','$total','$haum','$hagro','$habeng','$discount','$expired')") or die(mysql_error());

if (!empty($_POST['hargaper'])) {
$qrlast = mysql_query("SELECT * FROM stok_bahan WHERE iduser='$iduser' AND brcode='$brcode' AND nama_bahan='$nama_bahan'") or die(mysql_error());
$datalast  = mysql_fetch_array($qrlast);
$id_bahan = $datalast['id_bahan'];

$query2 = mysql_query("INSERT INTO tbltambah_stok (kode_stok, iduser, ketmod, tanggal, total) values('$nou','$iduser','Persediaan', NOW(),'$total')") or die(mysql_error());
$query3 = mysql_query("INSERT INTO dtltambah_stok (kode_stok, id_bahan, iduser, nama_bahan, harga, jumlah, tgl) values('$nou','$id_bahan','$iduser','$nama_bahan','$haper','$jumlah', NOW())") or die(mysql_error());
} else {
}
if (!empty($_POST['suplier'])) {
	
$query4 = mysql_query("INSERT INTO dtlsuplier (idsuplier, iduser, idbarang) VALUES('$suplier','$iduser','$id')") or die(mysql_error());
} else {
}
if ($query1) { 
if($klikbtn == 1) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-barang\">");
} else if($klikbtn == 2) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang\">");
}}
?>