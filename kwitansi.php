<?php
if(!empty($_GET['kode']) && !empty($_GET['tgl']) && !empty($_GET['nom'])) {
include('include/config.php');
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);
$jatem =$dta['jatuhtempo'];
$notr  = $_GET['kode'];
$tgl  = $_GET['tgl'];
$nom = $_GET['nom'];
$pelanggan  = $_GET['pelanggan'];
$query = mysql_query("SELECT * FROM dtlpelunasan WHERE kode_penjualan='$notr' AND bayar='$nom' AND tgl ='$tgl'");
$data  = mysql_fetch_array($query);

$que = mysql_query("SELECT * FROM tblcustomers WHERE nama_customers='$pelanggan'");
$dat  = mysql_fetch_array($que);

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>KWITANSI | KWT-<?php echo $notr; ?></title>
     <style>
body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
h1 {
	margin-bottom:10px;
	font-size:16px;
}

table {
	/*padding:3px;*/
}
a, a img {
	border:none;
}

#content {
	padding:5px;
	width:1280px;
	/*height:100%;*/
	position:relative;
	overflow:hidden;
}
#content h1 {
	padding:5px;
	font-size:14px;
}

/* Table style */
#content table.list {
	width:100%;
	border:1px solid #000000;
	/*
	border-left:1px solid #ededed;
	border-bottom:1px solid #ededed;
	*/
	margin-bottom:12px;
	margin:0 auto;
}
#content table.list th {
	font-size:12px;
	font-weight:bold;
	text-align:left;
	height:24px;
	/*background:url(images/bg-th.jpg) repeat-y;*/
	/*background-color:#666666;*/
	/*border:1px solid #000000;*/
	border-bottom:1px solid #000000;
	/*
	border-left:1px solid #ededed;
	border-width:1px 1px 1px 0;
	*/
	color:#000000;
	padding:0 6px;
}
#content table.list  td {
	height:24px;
	/*border-right:1px solid #ededed;*/
	padding:0 4px;
	font-size:12px;
	color:#666666;
}
#content table.list tr.row0 {
	background:#F5F5F5;
}
#content table.list tr.row1 {
	background:#fff;
}

</style>

</head>
     <!-- END HEAD -->
     <!-- BEGIN BODY -->
<body onload="javascript:self.print()">
<table width="100%" align="center" style="border: 1px solid #CCCCCC;" cellspacing="5" cellpadding="5" >
<tbody>
<tr>
<td style="text-align: center; border: 1px solid #CCCCCC;" rowspan="2"><img src="<?php echo $dta['logo']; ?>" height="75px" alt="LOGO"  /></td>
<td style="border: 1px solid #CCCCCC; text-align: center;">
<b><font size="6">KWITANSI</font></b>
</td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;"> No Kwitansi : SJ-<?php echo $notr; ?></td>
</tr>
<tr>
<td colspan="2"> 
<table width="100%" align="center" cellspacing="5" cellpadding="5" >
<tbody>
<tr>
<td style="border: 1px solid #CCCCCC;"><b>TELAH TERIMA DARI </b></td>
<td style="border: 1px solid #CCCCCC;">:</td>
<td style="border: 1px solid #CCCCCC;"><?php echo strtoupper($pelanggan); ?></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;"><b>UANG SEJUMLAH</b></td>
<td style="border: 1px solid #CCCCCC;">:</td>
<td style="border: 1px solid #CCCCCC;"><?php echo strtoupper(Terbilang($data['bayar'])); 
 ?> RUPIAH</td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;"><b>GUNA PEMBAYARAN</b> </td>
<td style="border: 1px solid #CCCCCC;">:</td>
<td style="border: 1px solid #CCCCCC;">TAGIHAN ATAS INVOICE NOMOR <?php echo $notr; ?> </td>
</tr>
<tr>
<td></td>
<td></td>
<td style="border: 1px solid #CCCCCC; background-color:#CCCCCC"><font size="4"><b>Rp. <?php echo number_format($data['bayar']); ?></b></font></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td> </td>
<td style="text-align: center;"><p><?php $tla=date_create($data['tgl']); echo ucwords(date_format($tla,"d F Y")); ?></p>
<br>
<br>
<br>
<p><?php echo $dta['namap']; ?></p></td>
</tr>
</tbody>
</table>
     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/js/login.js"></script>
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
     <!-- END PAGE LEVEL SCRIPTS -->
</body>
     <!-- END BODY -->
</html>
<?php

function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
} else {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../\">");
}
?>