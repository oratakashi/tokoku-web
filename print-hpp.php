<?php
include('include/config.php');
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);

$kas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));

$today= date("Y-m-d");
$tgla = @$_GET['dari'];
$tglb = @$_GET['sampai'];

$tlb=date_create($tglb);
$tld=date_create($today);

if (!empty($tgla)&&!empty($tglb)){

$heading="TANGGAL ".strtoupper(date_format($tlb,"d F Y"));

$qjual=mysql_query("SELECT * FROM tblpenjualan WHERE tgl='$tglb'");
$qrydtlj=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan WHERE tgl='$tglb'");
$data_dtlj=mysql_fetch_array($qrydtlj);
$jumhppj=$data_dtlj[0];

$tbeli = mysql_query("SELECT SUM(dtlpembelian_bahan.jumlah*stok_bahan.harga_per) FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_tbeli=mysql_fetch_array($tbeli);
$jumlah_tbeli=$data_tbeli[0];

//$tbeli=mysql_query("SELECT SUM(jumlah*harga) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");

$qry_persediaan=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod = 'Persediaan'");
$data_persediaan=mysql_fetch_array($qry_persediaan);
$jumlah_persediaan=$data_persediaan[0];

$tjal=mysql_query("SELECT SUM(jumlah*hpp) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_tjal=mysql_fetch_array($tjal);
$jumlah_tjal=$data_tjal[0];

$jumlah_barang=$jumlah_tbeli+$jumlah_persediaan-$jumlah_tjal;

$qpiutang=mysql_query("SELECT * FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$tglb'");

$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpenjualan WHERE kurang = '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$jumlah_tunai=$data_a[0];

$qry_jumlah_b=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_b=mysql_fetch_array($qry_jumlah_b);
$jumlah_piutang=$data_b[0];

$total_k1=$kas['jmlmod']+$jumlah_tunai+$jumlah_piutang;

$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$qhutang=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$qlain=mysql_query("SELECT * FROM dtltransaksi WHERE tgl BETWEEN '$tgla' AND '$tglb'");

$qry_jumlah_c=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_c=mysql_fetch_array($qry_jumlah_c);
$jumlah_beli=$data_c[0];

$qrypbeli=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan WHERE tgl='$tglb'");
$datapbeli=mysql_fetch_array($qrypbeli);
$jumpbeli=$datapbeli[0];

$qry_jumlah_d=mysql_query("SELECT SUM(bayar) FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_d=mysql_fetch_array($qry_jumlah_d);
$jumlah_utang=$data_d[0];

$qry_jumlah_e=mysql_query("SELECT SUM(total) FROM tbltransaksi WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_e=mysql_fetch_array($qry_jumlah_e);
$jumlah_trlain=$data_e[0];

$total_k2=$jumlah_trlain+$jumlah_beli+$jumlah_utang;

$jmlkas=$total_k1-$total_k2;
}else{
$heading="TANGGAL ".strtoupper(date_format($tld,"d F Y"));
	
$qjual=mysql_query("SELECT * FROM tblpenjualan WHERE tgl='$today'");
$qrydtlj=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan WHERE tgl='$today'");
$data_dtlj=mysql_fetch_array($qrydtlj);
$jumhppj=$data_dtlj[0];

$tbeli = mysql_query("SELECT SUM(dtlpembelian_bahan.jumlah*stok_bahan.harga_per) FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan AND tgl BETWEEN '$tgla' AND '$today'");
$data_tbeli=mysql_fetch_array($tbeli);
$jumlah_tbeli=$data_tbeli[0];

//$tbeli=mysql_query("SELECT SUM(jumlah*harga) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");

$qry_persediaan=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod = 'Persediaan'");
$data_persediaan=mysql_fetch_array($qry_persediaan);
$jumlah_persediaan=$data_persediaan[0];

$tjal=mysql_query("SELECT SUM(jumlah*hpp) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$today'");
$data_tjal=mysql_fetch_array($tjal);
$jumlah_tjal=$data_tjal[0];

$jumlah_barang=$jumlah_tbeli+$jumlah_persediaan-$jumlah_tjal;

$qpiutang=mysql_query("SELECT * FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$today'");

$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpenjualan WHERE kurang = '0' AND tgl BETWEEN '$tgla' AND '$today'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$jumlah_tunai=$data_a[0];

$qry_jumlah_b=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$today'");
$data_b=mysql_fetch_array($qry_jumlah_b);
$jumlah_piutang=$data_b[0];

$total_k1=$kas['jmlmod']+$jumlah_tunai+$jumlah_piutang;

$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$today'");
$qhutang=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$today'");
$qlain=mysql_query("SELECT * FROM dtltransaksi WHERE tgl BETWEEN '$tgla' AND '$today'");

$qry_jumlah_c=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$today'");
$data_c=mysql_fetch_array($qry_jumlah_c);
$jumlah_beli=$data_c[0];

$qrypbeli=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan WHERE tgl='$today'");
$datapbeli=mysql_fetch_array($qrypbeli);
$jumpbeli=$datapbeli[0];

$qry_jumlah_d=mysql_query("SELECT SUM(bayar) FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$today'");
$data_d=mysql_fetch_array($qry_jumlah_d);
$jumlah_utang=$data_d[0];

$qry_jumlah_e=mysql_query("SELECT SUM(total) FROM tbltransaksi WHERE tgl BETWEEN '$tgla' AND '$today'");
$data_e=mysql_fetch_array($qry_jumlah_e);
$jumlah_trlain=$data_e[0];

$total_k2=$jumlah_trlain+$jumlah_beli+$jumlah_utang;

$jmlkas=$total_k1-$total_k2;
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>EXPORT LAPORAN HPP | <?php echo $heading;?></title>
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
#content table.list td style="border: 1px solid #CCCCCC;" {
	font-size:12px;
	font-weight:bold;
	text-align:left;
	height:24px;
	/*background:url(images/bg-td style="border: 1px solid #CCCCCC;".jpg) repeat-y;*/
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
#content table.list  td style="border: 1px solid #CCCCCC;" {
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
<h1>LAPORAN HARGA POKOK PENJUALAN</h1>
<b><?php echo $heading;?></b></td>
<td style="text-align: right;" colspan="2"><img src="<?php echo $dta['logo']; ?>" height="75px" alt="LOGO" /></td>
                                        </tr>
                                        <tr>
<td style="border: 1px solid #CCCCCC;"><strong>No.</strong></td>
<td style="border: 1px solid #CCCCCC;" colspan="2"><strong>Keterangan</strong></td>
<td style="border: 1px solid #CCCCCC;"><strong>Jumlah</strong></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;padding-left: 30px;" colspan="5"><strong>Rincian HPP Keseluruhan</strong></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;text-align: right;">1</td>
<td style="border: 1px solid #CCCCCC;" colspan="2">Persediaan Awal</td>
<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_barang+$jumhppj-$jumpbeli);?></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;text-align: right;">2</td>
<td style="border: 1px solid #CCCCCC;" colspan="2">Pembelian Barang</td>
<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumpbeli);?></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;text-align: right;">3</td>
<td style="border: 1px solid #CCCCCC;" colspan="2">Barang Siap Jual</td>
<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_barang+$jumhppj);?></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;text-align: right;">4</td>
<td style="border: 1px solid #CCCCCC;" colspan="2">Persediaan Akhir</td>
<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_barang);?></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;"> </td>
<td style="border: 1px solid #CCCCCC;text-align: right;" colspan="2"><strong>Total HPP Keseluruhan</strong></td>
<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jumhppj); ?></b></td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;" colspan="5">   </td>
</tr>
<tr>
<td style="border: 1px solid #CCCCCC;padding-left: 30px;" colspan="5"><strong>Rincian HPP Per Transaksi</strong></td>
</tr>
<?php
$no = 1;
while ($jualan = mysql_fetch_array($qjual)) {
$totljual=$totljual+$jualan['total'];
?>
<tr>
<td style="border: 1px solid #CCCCCC;text-align: right;"><?php echo $no; ?></td>
<td style="border: 1px solid #CCCCCC;" colspan="2"><?php echo $jualan['kode_penjualan'];?></td>
<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php 
			$kd=$jualan['kode_penjualan'];
			$qry_jml=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan WHERE kode_penjualan='$kd'");
			$dta=mysql_fetch_array($qry_jml);
            $jum=$dta[0];
			echo number_format($jum); ?></td>
</tr>
<?php 
	$no++;
	}
?>
<tr>
<td style="border: 1px solid #CCCCCC;text-align: right;"> </td>
<td style="border: 1px solid #CCCCCC;text-align: right;" colspan="2"><strong>Total HPP Per Transaksi</strong> </td>
<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jumhppj);?></b></td>
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