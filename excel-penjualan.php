<?php
/*******EDIT LINES 3-8*******/
include('include/config.php');
@$tgla = $_GET['dari'];
@$tglb = $_GET['sampai'];
@$jenisrekap = $_GET['jenis'];
if (empty($jenisrekap)) {
if (!empty($tgla)&&!empty($tglb)) {
	$name = "Export-Excel-Penjualan-PerInvoice_";
	$filename = $name.$tgla."_s/d_".$tglb;
	
	$sql = "SELECT * FROM tblpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND AND iduser='{$_SESSION['id']}' ORDER BY kode_penjualan ASC";
} else {
	$name = "Export-Excel-Penjualan-PerInvoice";
	$filename = $name;
	
	$sql = "SELECT * FROM tblpenjualan WHERE iduser='{$_SESSION['id']}' ORDER BY kode_penjualan ASC";
}
} else if ($jenisrekap=='produk') {
	if (!empty($tgla)&&!empty($tglb)) {
	$name = "Export-Excel-Penjualan-PerProduk_";
	$filename = $name.$tgla."_s/d_".$tglb;
	
	$sql = "SELECT nama_barang AS Produk, SUM(jumlah)AS Jumlah FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$_SESSION['id']}' GROUP BY nama_barang";
} else {
	$name = "Export-Excel-Penjualan-PerProduk";
	$filename = $name;
	
	$sql = "SELECT nama_barang AS Produk, SUM(jumlah)AS Jumlah FROM dtlpenjualan WHERE iduser='{$_SESSION['id']}' GROUP BY nama_barang";
}
} else if ($jenisrekap=='pelanggan') {
	if (!empty($tgla)&&!empty($tglb)) {
	$name = "Export-Excel-Penjualan-PerPelanggan_";
	$filename = $name.$tgla."_s/d_".$tglb;
	
	$sql = "SELECT tblpenjualan.pelanggan AS Pelanggan, dtlpenjualan.nama_barang AS Produk, dtlpenjualan.jumlah AS Jumlah FROM dtlpenjualan INNER JOIN tblpenjualan ON dtlpenjualan.kode_penjualan=tblpenjualan.kode_penjualan AND dtlpenjualan.tgl BETWEEN '$tgla' AND '$tglb' AND tblpenjualan.tgl BETWEEN '$tgla' AND '$tglb' WHERE tblpenjualan.iduser='{$_SESSION['id']}' ORDER BY Pelanggan ASC";
} else {
	$name = "Export-Excel-Penjualan-PerPelanggan";
	$filename = $name;
	
	$sql = "SELECT tblpenjualan.pelanggan AS Pelanggan, dtlpenjualan.nama_barang AS Produk, dtlpenjualan.jumlah AS Jumlah FROM dtlpenjualan LEFT JOIN tblpenjualan ON dtlpenjualan.kode_penjualan=tblpenjualan.kode_penjualan WHERE tblpenjualan.iduser='{$_SESSION['id']}' ORDER BY Pelanggan ASC";
}
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