<?php
include('include/config.php');

$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);

$today= date("Y-m-d");
$tgla = @$_GET['dari'];
$tglb = @$_GET['sampai'];

$tla=date_create($tgla);
$tlb=date_create($tglb);
$tld=date_create($today);

if (!empty($tgla)&&!empty($tglb)){

$heading="PERIODE ".date_format($tla,"d F Y")." Sampai ".date_format($tlb,"d F Y");

$qjual=mysql_query("SELECT * FROM tblpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan WHERE tanggal BETWEEN '$tgla' AND '$tglb'");

$qry_tpm=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_tpm=mysql_fetch_array($qry_tpm);
$jumlah_tpm=$data_tpm[0];

$qry_tpk=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_tpk=mysql_fetch_array($qry_tpk);
$jumlah_tpk=$data_tpk[0];
} else {

$heading="PERIODE Sampai ".date_format($tld,"d F Y");

$qjual=mysql_query("SELECT * FROM tblpenjualan");
$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan");

$qry_tpm=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan");
$data_tpm=mysql_fetch_array($qry_tpm);
$jumlah_tpm=$data_tpm[0];

$qry_tpk=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan");
$data_tpk=mysql_fetch_array($qry_tpk);
$jumlah_tpk=$data_tpk[0];
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>EXPORT PPN | <?php echo $heading;?></title>
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
#content table.list th style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" {
	font-size:12px;
	font-weight:bold;
	text-align:left;
	height:24px;
	/*background:url(images/bg-th style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;".jpg) repeat-y;*/
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
#content table.list  td style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" {
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
<table width="100%" align="center" cellspacing="5" cellpadding="5">
                                        <tr>
                                            <td style="text-align: left;" colspan="3"><h2><?php echo strtoupper($dta['perusahaan']); ?></h2>
<h1>LAPORAN PPN</h1>
<b><?php echo $heading;?></b></td>
<td style="text-align: right;" colspan="2"><img src="<?php echo $dta['logo']; ?>" height="75px" alt="LOGO" /></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align: left; border: 1px solid #CCCCCC;" colspan="5">PPN KELUARAN</th style="border: 1px solid #CCCCCC;">
                                        </tr>
                                        <tr>
                                            <th style="border: 1px solid #CCCCCC;">No.</th style="border: 1px solid #CCCCCC;">
											<th style="border: 1px solid #CCCCCC;">Tanggal</th style="border: 1px solid #CCCCCC;">
                                            <th style="border: 1px solid #CCCCCC;">Keterangan</th style="border: 1px solid #CCCCCC;">
                                            <th style="border: 1px solid #CCCCCC;">Tanggal</th style="border: 1px solid #CCCCCC;">
                                            <th style="border: 1px solid #CCCCCC;">Jumlah</th style="border: 1px solid #CCCCCC;">
                                        </tr>
<?php

while ($jualan = mysql_fetch_array($qjual)) {
?>
                                      <tr>
        	                           <td style="border: 1px solid #CCCCCC;"></td style="border: 1px solid #CCCCCC;">
                                       <td style="border: 1px solid #CCCCCC;"><?php echo $jualan['tgl'];?></td style="border: 1px solid #CCCCCC;">
									   <td style="border: 1px solid #CCCCCC;"><?php echo $jualan['kode_penjualan'];?></td style="border: 1px solid #CCCCCC;">
		                               <td style="border: 1px solid #CCCCCC;"><?php echo $jualan['tgl'];?></td style="border: 1px solid #CCCCCC;">
                                       <td style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php 
$kd=$jualan['kode_penjualan'];
$qry_ppn=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan WHERE kode_penjualan = '$kd'");
$data_ppn=mysql_fetch_array($qry_ppn);
$jumlah_ppn=$data_ppn[0];
									   echo number_format($jumlah_ppn);?></td style="border: 1px solid #CCCCCC;">
        	                          </tr>
<?php 
} 
?> 
                                        <tr>
                                            <th style="text-align: left; border: 1px solid #CCCCCC;" colspan="4">TOTAL PPN KELUARAN</th style="border: 1px solid #CCCCCC;">
											<th style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($jumlah_tpm);?></th style="border: 1px solid #CCCCCC;">
                                        </tr>
                                        <tr>
                                            <th style="text-align: left; border: 1px solid #CCCCCC;" colspan="5">PPN MASUKKAN</th style="border: 1px solid #CCCCCC;">
                                        </tr>
										<tr>
                                            <th style="border: 1px solid #CCCCCC;">No.</th style="border: 1px solid #CCCCCC;">
											<th style="border: 1px solid #CCCCCC;">Tanggal</th style="border: 1px solid #CCCCCC;">
                                            <th style="border: 1px solid #CCCCCC;">Keterangan</th style="border: 1px solid #CCCCCC;">
                                            <th style="border: 1px solid #CCCCCC;">Tanggal</th style="border: 1px solid #CCCCCC;">
                                            <th style="border: 1px solid #CCCCCC;">Jumlah</th style="border: 1px solid #CCCCCC;">
                                        </tr>
<?php

while ($pbeli = mysql_fetch_array($qbeli)) {
?>
                                      <tr>
        	                           <td style="border: 1px solid #CCCCCC;"></td style="border: 1px solid #CCCCCC;">
                                       <td style="border: 1px solid #CCCCCC;"><?php echo $pbeli['tanggal'];?></td style="border: 1px solid #CCCCCC;">
									   <td style="border: 1px solid #CCCCCC;"><?php echo $pbeli['kode_pembelian'];?></td style="border: 1px solid #CCCCCC;">
		                               <td style="border: 1px solid #CCCCCC;"><?php echo $pbeli['tanggal'];?></td style="border: 1px solid #CCCCCC;">
                                       <td style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php 
$kt=$pbeli['kode_pembelian'];
$qy_ppn=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan WHERE kode_pembelian = '$kt'");
$dt_ppn=mysql_fetch_array($qy_ppn);
$jml_ppn=$dt_ppn[0];
									   echo number_format($jml_ppn);?></td style="border: 1px solid #CCCCCC;">
        	                          </tr>
<?php 
} 
?> 
                                        <tr>
                                            <th style="text-align: left; border: 1px solid #CCCCCC;" colspan="4">TOTAL PPN MASUKKAN</th style="border: 1px solid #CCCCCC;">
											<th style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($jumlah_tpk);?></th style="border: 1px solid #CCCCCC;">
                                        </tr>
<tr>
                                            <th style="text-align: left; border: 1px solid #CCCCCC;" colspan="4">JUMLAH PPN YG DIBAYAR</th style="border: 1px solid #CCCCCC;">
											<th style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($jumlah_tpm-$jumlah_tpk);?></th style="border: 1px solid #CCCCCC;">
                                        </tr>										
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