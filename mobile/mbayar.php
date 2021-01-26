<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['idtransaksi']) && isset($_POST['bayar'])) {
	
$idpjl  = $_POST['idtransaksi'];
$bayar    = $_POST['bayar'];

$qry_jenis  = mysql_query("SELECT * FROM dtlpenjualan WHERE kode_penjualan = '$idpjl'");
$data_jenis = mysql_fetch_array($qry_jenis);

$harga   = $data_jenis['harga'];
$jumlah   = $data_jenis['jumlah'];

$total = $jumlah*$harga;
$bayar   = $_POST['bayar'];


$kurang = $total-$bayar;
$kembalian = $bayar-$total;

$tgl=date("Y-m-d");

      // query menambah data member
if ($total > $bayar) {
	 $result=mysql_query("INSERT INTO tblpenjualan (kode_penjualan,pelanggan,total,bayar,kurang,tgl) VALUES ('$idpjl','Umum','$total','$bayar','$kurang','$tgl')");
	 } else {
	 $result=mysql_query("INSERT INTO tblpenjualan (kode_penjualan,pelanggan,total,bayar,kembalian,tgl) VALUES ('$idpjl','Umum','$total','$bayar','$kembalian','$tgl')");
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