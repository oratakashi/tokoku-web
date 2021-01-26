<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah variabel idmem sudah terset / terisi
if (isset($_POST['brcode'])) {
    $brcode= $_POST['brcode'];

    // query ambil data member berdasarkan id
	$c=mysql_query("SELECT * FROM stok_bahan WHERE brcode = '$brcode'");
	$t=mysql_fetch_assoc($c);
	
	if ($t) {
		$result = mysql_query("SELECT * FROM stok_bahan WHERE brcode = '$brcode'");
	} else {
		$result = mysql_query("SELECT * FROM stok_bahan WHERE nama_bahan = '$brcode'");
	}
	
    //$result = mysql_query("SELECT * FROM stok_bahan WHERE brcode = '$brcode'");

    if (!empty($result)) {
        // jika data member ada (besar dari nol)
        if (mysql_num_rows($result) > 0) {
            $result = mysql_fetch_array($result);
			// temp member array
            $member = array();
            $member["barcode"] = $result["brcode"];
            $member["barang"] = $result["nama_bahan"];
            $member["hpokok"] = "Rp. ".number_format($result["harga_per"]);
			$member["hjual"] = "Rp. ".number_format($result["hargaj"]);
			$member["hjualgr"] = "Rp. ".number_format($result["hargag1"]);
			$member["hjualbg"] = "Rp. ".number_format($result["hargag2"]);
            $member["stok"] = $result["jumlah"];
            // sukses
            $respon["sukses"] = 1;

            // node member
            $respon["member"] = array();
			//tambahkan array $member pada array final $respon
            array_push($respon["member"], $member);

            // memprint/mencetak JSON respon
            echo json_encode($respon);
        } else {
            // tidak ada member (kecil dari nol)
            $respon["sukses"] = 0;
            $respon["pesan"] = "Tidak ada member";

            // memprint/mencetak JSON respon
            echo json_encode($respon);
        }
    } else {
        // jika query tidak tidak meghasilkan data (tidak ada member)
        $respon["sukses"] = 0;
        $respon["pesan"] = "tidak ada member";

        // memprint/mencetak JSON respon
        echo json_encode($respon);
    }
} else {
    // jika data tidak terisi/tidak terset
   $respon["sukses"] = 0;
   $respon["pesan"] = "data belum terisi";
    // memprint/mencetak JSON respon
   echo json_encode($respon);
}
?>