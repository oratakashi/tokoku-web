<?php
session_start();
include('../config.php');

//buat array untuk menampung respon dari JSON
$respon = array();

// cek apakah variabel idmem sudah terset / terisi
if (isset($_POST['user'])) {
    $user= $_POST['user'];
    $pass= $_POST['password'];

    // query ambil data member berdasarkan id
    $result = mysql_query("SELECT * FROM tab_user WHERE username = '$user' AND password = md5('$pass')");

    if (!empty($result)) {

        // jika data member ada (besar dari nol)
        if (mysql_num_rows($result) > 0) {
            $result = mysql_fetch_array($result);

            $member = array();

            $member["username"] = $result["username"];
            $member["fullname"] = $result["fullname"];

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