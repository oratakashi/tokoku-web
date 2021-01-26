<?php
include('../config.php');

$response = array();
$response["sukses"] = 1;
$today = date("Ymd");
$query = "SELECT max(kode_tran) AS last FROM tbltransaksi WHERE kode_tran LIKE 'TRL$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRL";
$nou  = $char.$today.sprintf("%04s", $b);

$kodetrans = array();
$response["kodetrans"] = $nou;

$response["categories"] = array();

    // Mysql select query
    $result = mysql_query("SELECT * FROM stok_bahan ORDER BY id_bahan ASC");
    
    while($row = mysql_fetch_array($result)){
        // temporary array to create single category
        $tmp = array();
        $tmp["id"] = $row["id_bahan"];
        $tmp["name"] = $row["nama_bahan"];
        
        // push category to final json array
        array_push($response["categories"], $tmp);
    }

    // keeping response header to json
    //header('Content-Type: application/json');
    
    // echoing json result
    echo json_encode($response);
?>