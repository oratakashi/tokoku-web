<?php 
session_start();
include('include/config.php');
if (!empty($_POST['addbarang'])) {
$iduser = $_SESSION['id'];
$idbarang = $_POST['nama_barang'];
$jml = $_POST['jml'];

$kal=mysql_query("select * from stok_bahan where id_bahan='$idbarang'");
$el=mysql_fetch_array($kal);
$qrbarang = $el['brcode'];

//set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    
    include "qrgen/qrlib.php";    
    include('include/config.php');

    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
 
    $filename = $PNG_TEMP_DIR.'QR_code.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 6;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 6);    

        //it's very important!
        if (trim($_POST['nama_barang']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'QR_'.md5($qrbarang.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($qrbarang, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		
		$linkgambar = $PNG_WEB_DIR.basename($filename);
		
for ($x = 1; $x <= $jml; $x++) {
  $insert = mysql_query("insert into tblmultiqr (qrid,iduser,namabarang,imgqr) values ('$qrbarang','$iduser','{$el['nama_bahan']}','$linkgambar')");
}


	echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=printqrmulti\">");

}
?>