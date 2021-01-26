<html>
<?php
include('include/config.php');
$id = $_GET['barcode'];
$it = $_GET['id'];
$query = mysql_query("select * from stok_bahan where brcode='$it'") or die(mysql_error());
$data = mysql_fetch_array($query);

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
    $id = $_GET['id'];
	//$que = mysql_query("SELECT * FROM tblregister WHERE idreg='$id'");
	//$dat  = mysql_fetch_array($que);
        //it's very important!
        if (trim($_GET['id']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'QR_'.md5($id.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($id, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>CODE <?php echo $id;?> </title>
<style>
body {
	font-family:Calibri, Helvetica, sans-serif;
}
</style>
</head>
<body bgcolor="white">
<center>
<table cellspacing="5" cellpadding="0" style="border: 1px solid #808080;"><tr style="text-align: center; border: 1px solid #D1D1D1;"><td><img src="<?php echo $PNG_WEB_DIR.basename($filename);?>" /></td>
</tr>
<tr><td style="text-align: center;"><span style="font-size: 12;"><?php echo $id;?></span></td></tr>
<tr><td style="text-align: center;"><span style="font-size: 12;"><?php echo $data['nama_bahan'];?></span></td></tr>
</table>
</center>
</body>
</html>
<script>
window.print();
</script>