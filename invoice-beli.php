<?php
include('include/config.php');
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);
$jatem =$dta['jatuhtempo'];
$notr  = $_GET['kode'];
$query = mysql_query("SELECT * ,DATE_ADD(tanggal, INTERVAL $jatem DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tanggal, INTERVAL $jatem DAY), CURDATE()) as selisih FROM tblpembelian_bahan WHERE kode_pembelian='$notr'");
$data  = mysql_fetch_array($query);
$pelanggan=$data['suplier'];
$que = mysql_query("SELECT * FROM tblsupplier WHERE nama_supplier='$pelanggan'");
$dat  = mysql_fetch_array($que);

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>INVOICE PEMBELIAN | <?php echo $notr; ?></title>
     <style>
body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
}
h1 {
	margin-bottom:10px;
	font-size:14px;
}

table {
	/*padding:1px;*/
}
a, a img {
	border:none;
}

#content {
	padding:2px;
	width:1280px;
	/*height:100%;*/
	position:relative;
	overflow:hidden;
}
#content h1 {
	padding:2px;
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
	padding:0 3px;
}
#content table.list  td {
	height:24px;
	/*border-right:1px solid #ededed;*/
	padding:0 2px;
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
<td style="text-align: center;" colspan="2">
<h1><strong>FAKTUR</strong></h1></td>
</tr>
<tr>
<td><table style="float: left" width="100%">
<tbody>
<tr>
<td rowspan="4"><img src="<?php echo $dta['logo']; ?>" height="40px" alt="LOGO" /></td>
<td><?php echo $dta['perusahaan']; ?></td>
</tr>
<tr>
<td><?php echo $dta['alamat']; ?></td>
</tr>
<tr>
<td>Phone. <?php echo $dta['tlp']; ?></td>
</tr>
<tr>
<td> </td>
</tr>
</tbody>
</table></td>
<td><table style="float: right" width="100%">
<tbody>
<tr>
<td>Dari</td>
<td>:</td>
<td colspan="6"><?php echo $pelanggan; ?></td>
</tr>
<tr>
<td> </td>
<td> </td>
<td colspan="6"><?php echo $dat['alamat_supplier']; ?></td>
</tr>
<tr>
<td> </td>
<td> </td>
<td>No.faktur</td>
<td>:</td>
<td colspan="4"><?php echo $notr; ?></td>
</tr>
<tr>
<td> </td>
<td> </td>
<td>Tanggal</td>
<td>:</td>
<td><?php 
$ttgl=$data['tgl'];
$tltgl=date_create($ttgl);
echo date_format($tltgl,"d/m/Y"); ?></td>
<td>Tempo</td>
<td>:</td>
<td><?php 
$jttem=$data['jatuh_tempo'];
$tljtem=date_create($jttem);
echo date_format($tljtem,"d/m/Y"); ?></td>
</tr>
</tbody>
</table></td>
</tr>
<tr>
<td colspan="2">
<table width="100%" cellspacing="5" cellpadding="5" align="center">
<tbody>
<tr>
<th style="border: 1px solid #CCCCCC;"><strong>No</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Nama Barang</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>No. Batch</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Expired</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Qty</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Harga</strong></th>
<th style="border: 1px solid #CCCCCC;"><strong>Jumlah</strong></th>
</tr>
<?php
$s=mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$notr'");
$no=1;
while($sql=mysql_fetch_array($s)){
$subt=$sql['jumlah']*($sql['harga']);
$total=@$total+$subt;
$sppn=$sql['jumlah']*$sql['ppn'];
$ppn= @$ppn+$sppn;

$nmbrg=$sql['nama_bahan'];

$quad=mysql_query("select * from stok_bahan where nama_bahan='$nmbrg'");
$zql=mysql_fetch_array($quad);

$batch=$zql['brcode'];
$exp=date_create($zql['expired']);
$satuan=$zql['satuan'];
?>
<tr>
<td style="text-align: center; border: 1px solid  #CCCCCC;"><?php echo $no; ?></td>
<td style="text-align: left; border: 1px solid  #CCCCCC;"><?php echo $sql['nama_bahan']; ?></td>
<td style="text-align: left; border: 1px solid  #CCCCCC;"><?php echo $batch; ?></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo date_format($exp,"d/m/Y"); ?></td>
<td style="text-align: center; border: 1px solid  #CCCCCC;"><?php echo $sql['jumlah']." ".$satuan; ?></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo number_format($sql['harga']);?></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo number_format($subt); ?></td>
</tr>
<?php 
$no++;
} ?>
<tr>
<td colspan="2" style="text-align: center;">Penerima</td>
<td></td>
<td colspan="2" style="text-align: center;"></td>
<td style="text-align: right;"><strong>Harga Jual</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo number_format($total); ?></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td style="text-align: right;"><strong>Harga Sblm Ppn</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo number_format($total-$ppn); ?></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td style="text-align: right;"><strong>Ppn 10%</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo number_format($ppn); ?></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan="2" style="text-align: center;">(<?php echo $dta['namap']; ?>)</td>
<td></td>
<td colspan="2" style="text-align: center;"></td>
<td style="text-align: right;"><strong>Yg Harus dibayar</strong></td>
<td style="text-align: right; border: 1px solid  #CCCCCC;"><?php echo number_format($total); ?></td>
</tr>
</tbody>
</table>
</td>
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