<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['idtransaksi']) && isset($_POST['jenistransaksi']) && isset($_POST['nominal'])) {
	
$idtransaksi  = $_POST['idtransaksi'];

$jenistransaksi    = $_POST['jenistransaksi'];

$qry_jenis  = mysql_query("SELECT kategori FROM tbltranslain WHERE keterangan ='$jenistransaksi'");
$data_jenis = mysql_fetch_array($qry_jenis);

$kategori   = $data_jenis[0];

$nominal   = $_POST['nominal'];
$tgl=date("Y-m-d");

      // query menambah data member
	 $insert=mysql_query("INSERT INTO tbltransaksi (kode_tran,total,tgl) VALUES ('$idtransaksi','$nominal','$tgl')");
     $result = mysql_query("INSERT INTO dtltransaksi (kode_tran,nama_tran,ctg,nominal,tgl) VALUES ('$idtransaksi','$jenistransaksi','$kategori','$nominal','$tgl')");


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