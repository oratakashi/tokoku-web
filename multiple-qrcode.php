<?php
include('include/config.php');
$id = $_POST['qrcode'];
if ($id){
	 foreach ($id as $t){ 
	 //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    
    include "qrgen/qrlib.php";    
    include "config.php";

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

        if (trim($t) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'QR_'.md5($id.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        //QRcode::png($id, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

 echo $PNG_WEB_DIR.basename($filename);
	 }
	}
	
 
 ?>