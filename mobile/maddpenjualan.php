<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah nilai yang dikirimkan android sudah terisi
if (isset($_POST['idtransaksi']) && isset($_POST['jenistransaksi']) && isset($_POST['nominal'])) {
	
$idtransaksi  = $_POST['idtransaksi'];

$jenistransaksi    = $_POST['jenistransaksi'];
$jenisharga = $_POST['jenisharga'];

$qry_jenis  = mysql_query("SELECT * FROM stok_bahan WHERE nama_bahan ='$jenistransaksi'");
$data_jenis = mysql_fetch_array($qry_jenis);

$hpp   = $data_jenis['harga_per'];

if ($jenisharga=='Harga Umum') {
	$harga   = $data_jenis['hargaj'];
} else if ($jenisharga=='Harga Grosir') {
	$harga   = $data_jenis['hargag1'];
} else if ($jenisharga=='Harga Bengkel') {
	$harga   = $data_jenis['hargag2'];
}

$nominal   = $_POST['nominal'];
$tgl=date("Y-m-d");

    $result = mysql_query("INSERT INTO dtlpenjualan (kode_penjualan,nama_barang,jumlah,hpp,harga,tgl) VALUES ('$idtransaksi','$jenistransaksi','$nominal','$hpp','$harga','$tgl')");
	$produk=mysql_query("SELECT * FROM stok_bahan WHERE nama_bahan='$jenistransaksi'");
	$isi=mysql_fetch_array($produk);
	$jumlah_baru=$isi['jumlah']-$nominal;
	$total=$isi['harga_per']*$jumlah_baru;
	$updet=mysql_query("UPDATE stok_bahan SET jumlah='$jumlah_baru',total='$total' where nama_bahan='$jenistransaksi'");
	 
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