<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['barcode']) && isset($_POST['namabrg']) && isset($_POST['satuan'])) {
	
$barcode  = $_POST['barcode'];
$namabrg    = $_POST['namabrg'];
$satuan   = $_POST['satuan'];

$stok   = $_POST['stok'];
$hbel   = $_POST['hbel'];
$hajum   = $_POST['hajum'];
$hagro   = $_POST['hagro'];
$habeng   = $_POST['habeng'];

$total = $stok*$hbel;

$today = date("Ymd");
$query = "SELECT max(kode_stok) AS last FROM tbltambah_stok WHERE kode_stok LIKE 'STO$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "STO";
$nou  = $char.$today.sprintf("%04s", $b);

      // query menambah data member
    $result = mysql_query("INSERT INTO stok_bahan (brcode, nama_bahan, jumlah, satuan, harga_per, total, hargaj, hargag1, hargag2) VALUES('$barcode', '$namabrg', '$stok', '$satuan', '$hbel', '$total', '$hajum', '$hagro', '$habeng')");
	if (!empty($_POST['hbel'])) {
	$query2 = mysql_query("INSERT INTO tbltambah_stok (kode_stok, ketmod, tanggal, total) values('$nou','Persediaan', NOW(),'$total')") or die(mysql_error());

	$query3 = mysql_query("INSERT INTO dtltambah_stok (kode_stok, nama_bahan, harga, jumlah, tgl) values('$nou','$namabrg','$habel','$stok', NOW())") or die(mysql_error());
	} else {
	}


    // cek apakah query berhasil menambah data
    if ($result) {
        // jika berhasil menambah data ke mysql
        $respon["sukses"] = 1;
        $respon["pesan"] = "Berhasil menambah data member.";

        // memprint/mencetak JSON respon
        echo json_encode($respon);
    } else {
        // gagal menambah data member
        $respon["sukses"] = 0;
        $respon["pesan"] = "Gagal menambah data.";
        
        // memprint/mencetak JSON respon
        echo json_encode($respon);
    }
} else {
    // jika data tidak terisi/tidak terset
    $respon["sukses"] = 0;
    $respon["pesan"] = "data belum terisi";

    //  memprint/mencetak JSON respon
    echo json_encode($respon);
 }
?>