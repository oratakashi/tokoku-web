<?php
include('include/config.php');
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);
$jatem =$dta['jatuhtempo'];
$notr  = $_GET['kode'];
$query = mysql_query("SELECT * ,DATE_ADD(tgl, INTERVAL $jatem DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tgl, INTERVAL $jatem DAY), CURDATE()) as selisih FROM tblpo WHERE kode_po='$notr'");
$data  = mysql_fetch_array($query);
$pelanggan=$data['pelanggan'];
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
    <title>Purchase Order | <?php echo $notr; ?></title>
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
<table width="100%" align="center">
<tbody>
<tr>
<td rowspan="3"><img src="<?php echo $dta['logo']; ?>" alt="" /></td>
<td></td>
<td><h2><strong><?php echo $dta['perusahaan']; ?></strong></h2></td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td> <strong><?php echo $dta['alamat']; ?></strong></td>
</tr>
<tr>
<td></td>
<td> <strong>Phone. <?php echo $dta['tlp']; ?></strong></td>
</tr>
<tr>
<td style="text-align: right;" colspan="3">
<h1><strong>Purchase Order</strong></h1>
<hr /></td>
</tr>
<tr>
<td><table width="100%">
<tbody>
<tr>
<td> <strong>Kepada Yth.</strong><br> <?php echo $pelanggan; ?></td>
</tr>
<tr>
<td> <?php echo $dat['alamat_customers']; ?></td>
</tr>
<tr>
<td> <?php echo $dat['telp']; ?></td>
</tr>
</tbody>
</table></td>
<td></td>
<td><table width="100%">
<tbody>
<tr>
<td> <strong>NOMOR Purchase Order</strong></td><td style="text-align: right;"><strong><?php echo $notr; ?></strong></td>
</tr>
<tr>
<td> <strong>TANGGAL</strong></td><td style="text-align: right;"><strong><?php echo $data['tgl']; ?></strong></td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table></td>
</tr>
<tr>
<td colspan="3">
<br>
<br>
</td>
</tr>
<td colspan="3">
<table width="100%" cellspacing="5" cellpadding="5" align="center">
<tbody>
<tr>
<th style="border: 1px solid #CCCCCC;"><strong>Nama Barang</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Qty</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Harga</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Jumlah</strong></th>
</tr>
<?php
$s=mysql_query("select * from dtlpo where kode_po='$notr'");
while($sql=mysql_fetch_array($s)){
$subt=$sql['jumlah']*$sql['harga'];
$total=@$total+$subt;
$sppn=$sql['jumlah']*$sql['ppn'];
$ppn= @$ppn+$sppn;?>
<tr>
<td style="text-align: left; border: 1px solid  #CCCCCC;"><?php echo $sql['nama_barang']; ?></td>
<td style="text-align: center; border: 1px solid  #CCCCCC;"><?php echo $sql['jumlah']; ?></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;">Rp. <?php echo number_format($sql['harga']);?></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;">Rp. <?php echo number_format($subt); ?></td>
</tr>
<?php } ?>
<tr>
<td></td>
<td> </td>
<td style="text-align: right;"><strong>SUB TOTAL</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;">Rp. <?php echo number_format($total); ?></td>
</tr>
<tr>
<td></td>
<td> </td>
<td style="text-align: right;"><strong>PPN</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;">Rp. <?php echo number_format($ppn); ?></td>
</tr>
<tr>
<td></td>
<td> </td>
<td style="text-align: right;"><strong>TOTAL</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;">Rp. <?php echo number_format($data['total']); ?></td>
</tr>
<tr>
<td></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
<tr>
<td></td>
<td> </td>
<td> </td>
<td> </td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td> </td>
<td colspan="2">
</td>
</tr>
<tr>
<td colspan="3">
<br>
<br>
<br>
<br>
</td>
</tr>
<tr>
<td></td>
<td> </td>
<td style="text-align: center;"><p>Hormat kami</p>
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

?>