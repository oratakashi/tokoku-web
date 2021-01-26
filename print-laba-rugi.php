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

$heading="PERIODE ".date_format($tla,"d F Y")." s/d ".date_format($tlb,"d F Y");

$qryjual=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_barang");

$qryhpp=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_barang");

$qrtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_tran");

$qrtlnop=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y' AND tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_claim");

$qrncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%' AND tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_ncs");

$qtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$totln=mysql_fetch_array($qtln);

$retcs=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$totrecs=mysql_fetch_array($retcs);

$qtclm=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y' AND tgl BETWEEN '$tgla' AND '$tglb'");
$tclaim=mysql_fetch_array($qtclm);

$qtncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totncs=mysql_fetch_array($qtncs);

$retncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totretncs=mysql_fetch_array($retncs);

$retur=$totrecs['nominal']+$totretncs['debet'];

$qrytj=mysql_query("SELECT * ,SUM(jumlah*(harga-ppn))totalj FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$totalj=mysql_fetch_array($qrytj);
$penjualan=$totalj['totalj'];

$omzet=$penjualan-$retur;

$qrhp=mysql_query("SELECT * ,SUM(jumlah*hpp)totahp FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$totahp=mysql_fetch_array($qrhp);

$qrydtlj=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_dtlj=mysql_fetch_array($qrydtlj);
$jumhppj=$data_dtlj[0];

$tbeli = mysql_query("SELECT SUM(dtlpembelian_bahan.jumlah*stok_bahan.harga_per) FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_tbeli=mysql_fetch_array($tbeli);
$jumlah_tbeli=$data_tbeli[0];

$qry_persediaan=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod = 'Persediaan'");
$data_persediaan=mysql_fetch_array($qry_persediaan);
$jumlah_persediaan=$data_persediaan[0];

$tjal=mysql_query("SELECT SUM(jumlah*hpp) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_tjal=mysql_fetch_array($tjal);
$jumlah_tjal=$data_tjal[0];

$jumlah_barang=$jumlah_tbeli+$jumlah_persediaan-$jumlah_tjal;

$qrypbeli=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$datapbeli=mysql_fetch_array($qrypbeli);
$jumpbeli=$datapbeli[0];
} else {

$heading="PERIODE s/d ".date_format($tlb,"d F Y");

$qryjual=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan GROUP BY nama_barang");

$qryhpp=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan GROUP BY nama_barang");

$qrtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') GROUP BY nama_tran");

$qrtlnop=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y' GROUP BY nama_claim");

$qrncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%' GROUP BY nama_ncs");

$qtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr')");
$totln=mysql_fetch_array($qtln);

$retcs=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg IN ('rtr')");
$totrecs=mysql_fetch_array($retcs);

$qtclm=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y'");
$tclaim=mysql_fetch_array($qtclm);

$qtncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%'");
$totncs=mysql_fetch_array($qtncs);

$retncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan'");
$totretncs=mysql_fetch_array($retncs);

$retur=$totrecs['nominal']+$totretncs['debet'];

$qrytj=mysql_query("SELECT * ,SUM(jumlah*(harga-ppn))totalj FROM dtlpenjualan");
$totalj=mysql_fetch_array($qrytj);

$penjualan=$totalj['totalj'];

$omzet=$penjualan-$retur;

$qrhp=mysql_query("SELECT * ,SUM(jumlah*hpp)totahp FROM dtlpenjualan");
$totahp=mysql_fetch_array($qrhp);

$qrydtlj=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan");
$data_dtlj=mysql_fetch_array($qrydtlj);
$jumhppj=$data_dtlj[0];

$tbeli = mysql_query("SELECT SUM(dtlpembelian_bahan.jumlah*stok_bahan.harga_per) FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan");
$data_tbeli=mysql_fetch_array($tbeli);
$jumlah_tbeli=$data_tbeli[0];

$qry_persediaan=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod = 'Persediaan'");
$data_persediaan=mysql_fetch_array($qry_persediaan);
$jumlah_persediaan=$data_persediaan[0];

$tjal=mysql_query("SELECT SUM(jumlah*hpp) FROM dtlpenjualan");
$data_tjal=mysql_fetch_array($tjal);
$jumlah_tjal=$data_tjal[0];

$jumlah_barang=$jumlah_tbeli+$jumlah_persediaan-$jumlah_tjal;

$qrypbeli=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan");
$datapbeli=mysql_fetch_array($qrypbeli);
$jumpbeli=$datapbeli[0];
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>EXPORT LABA RUGI | <?php echo $heading;?></title>
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
#content table.list th style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" {
	font-size:12px;
	font-weight:bold;
	text-align:left;
	height:24px;
	/*background:url(images/bg-th style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;".jpg) repeat-y;*/
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
#content table.list  td style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" {
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
<h1>LAPORAN LABA RUGI</h1>
<b><?php echo $heading;?><b></td>
<td style="text-align: right;" colspan="2"><img src="<?php echo $dta['logo']; ?>" height="75px" alt="LOGO" /></td>
                                        </tr>
<tr>
<td colspan="4" style="border: 1px solid #CCCCCC;"><strong>PENJUALAN</strong></td>
</tr>
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">Penjualan Kotor</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($penjualan); ?></td>
</tr>
<!--<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">Retur Penjualan</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($retur); ?></td>
</tr>-->
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">Potongan Penjualan</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format(0); ?></td>
</tr>
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">Ongkos Kirim Penjualan</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format(0); ?></td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>Total Penjualan Bersih</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($omzet); ?></td>
</tr>
<tr>
<td colspan="4" style="border: 1px solid #CCCCCC;"><strong>HARGA POKOK PENJUALAN</strong></td>
</tr>
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">HPP</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($jumhppj); ?></td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>Laba Kotor</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($omzet-$totahp['totahp']); ?></td>
</tr>
<tr>
<td colspan="4" style="border: 1px solid #CCCCCC;"><strong>BIAYA OPERASIONAlL </strong></td>
</tr>
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">biaya-biaya</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php 
								  $tpengl=$totln['nominal']+$totncs['debet']+$tclaim['jnom'];
								  echo number_format($tpengl); ?></td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>Total Biaya Operasional</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"> </td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>LABA USAHA</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"> </td>
</tr>
<tr>
<td colspan="4" style="border: 1px solid #CCCCCC;"><strong>PENDAPATAN DAN BIAYA NON OPERASIONAL</strong> </td>
</tr>
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">Pendapatan Non Operasional</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"> </td>
</tr>
<tr>
<td  colspan="3" style="border: 1px solid #CCCCCC;">Biaya Non Operasional</td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"> </td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>Laba Sebelum Pajak</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format(($omzet-$totahp['totahp'])-$tpengl); ?></td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>Taksiran Pajak Penghasilan</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php echo number_format($pjk=($penjualan*1)/100); ?></td>
</tr>
<tr>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;"><strong>LABA BERSIH SETELAH PAJAK</strong></td>
<td  colspan="3" style="text-align: right; border: 1px solid #CCCCCC;">Rp. <?php 
								  $sbl_pjk=($omzet-$totahp['totahp'])-$tpengl;
								  echo number_format($sbl_pjk-$pjk); ?></td>
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