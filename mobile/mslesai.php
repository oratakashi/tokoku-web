<?php
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah variabel idmem sudah terset / terisi
if (isset($_POST['idpjl'])) {
    $idpjl= $_POST['idpjl'];

    // query ambil data member berdasarkan id
    $result = mysql_query("SELECT * FROM tblpenjualan WHERE kode_penjualan = '$idpjl'");

    if (!empty($result)) {
        // jika data member ada (besar dari nol)
        if (mysql_num_rows($result) > 0) {
            $result = mysql_fetch_array($result);
			// temp member array
            $member = array();
			$total = $result["total"];
			$bayar = $result["bayar"];
			
			if ($total > $bayar) {
				$selisih = "Kurang";
				$jumlah = $result["kurang"];
			} else {
				$selisih = "Kembalian";
				$jumlah = $result["kembalian"];
			}
			
            $member["selisih"] = $selisih;
            $member["jumlah"] = "Rp. ".number_format($jumlah);
            
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