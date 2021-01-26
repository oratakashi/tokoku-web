<?php
/*******EDIT LINES 3-8*******/
include('include/config.php');
$tgla = $_GET['dari'];
$tglb = $_GET['sampai'];
if (!empty($tgla)&&!empty($tglb)) {
	$name = "Export-Excel-Transaksi-Cash-";
	$filename = $name.$tgla."s/d".$tglb;
	
	$sql = "SELECT * FROM dtltransaksi WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$_SESSION['id']}' ORDER BY kode_tran ASC";
} else {
	$name = "Export-Excel-Transaksi-Cash";
	$filename = $name;
	
	$sql = "SELECT * FROM dtltransaksi WHERE iduser='{$_SESSION['id']}' ORDER BY kode_tran ASC";
}
$Connect = @mysql_connect($mysql_host, $mysql_user, $mysql_password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
$Db = @mysql_select_db($mysql_database, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = ".xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>