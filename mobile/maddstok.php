<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['barcode']) && isset($_POST['harga']) && isset($_POST['jumlah'])) {
	
$barcode  = $_POST['barcode'];
$harga    = $_POST['harga'];
$jumlah   = $_POST['jumlah'];

$lect=mysql_query("SELECT nama_bahan FROM stok_bahan WHERE brcode ='$barcode'");
$lih=mysql_fetch_array($lect);
$nama=$lih[0];

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
	$insert=mysql_query("INSERT INTO tbltambah_stok(kode_stok,ketmod,tanggal) values ('$nou','Persediaan',NOW())");
    // $result = mysql_query("INSERT INTO stok_bahan (brcode, nama_bahan, satuan) VALUES('$barcode', '$namabrg', '$satuan')");
	$result=mysql_query("INSERT INTO dtltambah_stok (kode_stok,nama_bahan,harga,jumlah,tgl) values ('$nou','$nama','$harga','$jumlah',NOW())");
	
	$produk=mysql_query("SELECT * FROM stok_bahan WHERE brcode = '$barcode'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']+$jumlah;
	$harga_baru=($isi['harga_per']*$isi['jumlah']+$harga*$jumlah)/$jumlah_baru;
	$total=$harga_baru*$jumlah_baru;
	
	$updet=mysql_query("UPDATE stok_bahan SET harga_per='$harga_baru', jumlah='$jumlah_baru', total='$total' WHERE brcode = '$barcode'");

    // cek apakah query berhasil menambah data
    if ($result && $insert && $updet) {
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