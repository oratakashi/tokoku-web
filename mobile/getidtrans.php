<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah variabel idmem sudah terset / terisi
if (isset($_POST['getcode'])) {


$today = date("Ymd");
$query = "SELECT max(kode_tran) AS last FROM tbltransaksi WHERE kode_tran LIKE 'TRL$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRL";
$nou  = $char.$today.sprintf("%04s", $b);

        // jika query tidak tidak meghasilkan data (tidak ada member)
        $respon["sukses"] = 1;
        $member["kodetrans"] = $nou;
        $respon["member"] = array();
        array_push($respon["member"], $member);
        echo json_encode($respon);

} else {
    // jika data tidak terisi/tidak terset
  $respon["sukses"] = 0;
  $respon["pesan"] = "data belum terisi";
    // memprint/mencetak JSON respon
  echo json_encode($respon);
}
?>