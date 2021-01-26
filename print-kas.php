<?php
include('include/config.php');
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);

$tas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));

$today= date("Y-m-d");
$tgla = @$_GET['dari'];
$tglb = @$_GET['sampai'];
$tglc = $tas['tglmod'];

$tla=date_create($tgla);
$tlb=date_create($tglb);
$tld=date_create($today);

if (!empty($tgla)&&!empty($tglb)){

$heading="PERIODE ".date_format($tla,"d F Y")." s/d ".date_format($tlb,"d F Y");

$kas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas' AND tglmod BETWEEN '$tgla' AND '$tglb'"));

$qjual=mysql_query("SELECT * FROM tblpenjualan WHERE kurang = '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$qpiutang=mysql_query("SELECT * FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$tglb'");

$qry_tbhkas=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'tks' AND tglmod BETWEEN '$tgla' AND '$tglb'");
$data_tbhkas=mysql_fetch_array($qry_tbhkas);
$jumlah_tbhkas=$data_tbhkas[0];

$qry_jumlah_a=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang = '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$jumlah_tunai=$data_a[0];

$qry_jumlah_b=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_b=mysql_fetch_array($qry_jumlah_b);
$jumlah_piutang=$data_b[0];

$qry_tbhkas_b=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'tks' AND tglmod BETWEEN '$tglc' AND '$tglb'");
$data_tbhkas_b=mysql_fetch_array($qry_tbhkas_b);
$jumlah_tbhkas_b=$data_tbhkas_b[0];

$qry_jumlah_aa=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang = '0' AND tgl BETWEEN '$tglc' AND '$tglb'");
$data_aa=mysql_fetch_array($qry_jumlah_aa);
$jumlah_tunai_a=$data_aa[0];

$qry_jumlah_bb=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tglc' AND '$tglb'");
$data_bb=mysql_fetch_array($qry_jumlah_bb);
$jumlah_piutang_b=$data_bb[0];

$total_k1=$tas['jmlmod']+$jumlah_tbhkas_b+$jumlah_tunai_a+$jumlah_piutang_b;

$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$qhutang=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$qlain=mysql_query("SELECT * FROM dtltransaksi WHERE ctg NOT IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");

$qry_jumlah_c=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_c=mysql_fetch_array($qry_jumlah_c);
$jumlah_beli=$data_c[0];

$qry_jumlah_d=mysql_query("SELECT SUM(bayar) FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_d=mysql_fetch_array($qry_jumlah_d);
$jumlah_utang=$data_d[0];

$retcs=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$totrecs=mysql_fetch_array($retcs);
$returcs=$totrecs[0];

$retcs_a=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('rtr') AND tgl BETWEEN '$tglc' AND '$tglb'");
$totrecs_a=mysql_fetch_array($retcs_a);
$returcs_a=$totrecs_a[0];

$retncs=mysql_query("SELECT SUM(debet) FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totretncs=mysql_fetch_array($retncs);
$returncs=$totretncs[0];

$retur=$returcs+$returncs;

$qry_jumlah_e=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg NOT IN ('kt1','rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_e=mysql_fetch_array($qry_jumlah_e);
$jumlah_trlain=$data_e[0];

$qry_jumlah_cc=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tglc' AND '$tglb'");
$data_cc=mysql_fetch_array($qry_jumlah_cc);
$jumlah_beli_c=$data_cc[0];

$qry_jumlah_ee=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg NOT IN ('kt1','rtr') AND tgl BETWEEN '$tglc' AND '$tglb'");
$data_ee=mysql_fetch_array($qry_jumlah_ee);
$jumlah_trlain_e=$data_ee[0];

$qry_invent=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('kt1') AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_invent=mysql_fetch_array($qry_invent);
$jumlah_invent=$data_invent[0];

$qry_ivnt=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('kt1') AND tgl BETWEEN '$tglc' AND '$tglb'");
$data_ivnt=mysql_fetch_array($qry_ivnt);
$jumlah_ivnt=$data_ivnt[0];

$total_k2=$jumlah_beli_c+$jumlah_trlain_e+$jumlah_ivnt;

$jmlkas=$total_k1-$total_k2-$returcs_a;
}else{
$heading="PERIODE s/d ".date_format($tlb,"d F Y");
	
$kas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));
$qjual=mysql_query("SELECT * FROM tblpenjualan WHERE kurang = '0'");
$qpiutang=mysql_query("SELECT * FROM tblpenjualan WHERE kurang != '0'");

$qry_tbhkas=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'tks'");
$data_tbhkas=mysql_fetch_array($qry_tbhkas);
$jumlah_tbhkas=$data_tbhkas[0];

$qry_jumlah_a=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang = '0'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$jumlah_tunai=$data_a[0];

$qry_jumlah_b=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0'");
$data_b=mysql_fetch_array($qry_jumlah_b);
$jumlah_piutang=$data_b[0];

$total_k1=$kas['jmlmod']+$jumlah_tbhkas+$jumlah_tunai+$jumlah_piutang;

$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang = '0'");
$qhutang=mysql_query("SELECT * FROM tblpembelian_bahan WHERE kurang != '0'");
$qlain=mysql_query("SELECT * FROM dtltransaksi WHERE ctg NOT IN ('rtr')");

$qry_jumlah_c=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE kurang = '0'");
$data_c=mysql_fetch_array($qry_jumlah_c);
$jumlah_beli=$data_c[0];

$qry_jumlah_d=mysql_query("SELECT SUM(bayar) FROM tblpembelian_bahan WHERE kurang != '0'");
$data_d=mysql_fetch_array($qry_jumlah_d);
$jumlah_utang=$data_d[0];

$retcs=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('rtr')");
$totrecs=mysql_fetch_array($retcs);
$returcs=$totrecs[0];

$retncs=mysql_query("SELECT SUM(debet) FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan'");
$totretncs=mysql_fetch_array($retncs);
$returncs=$totretncs[0];

$retur=$returcs+$returncs;

$qry_jumlah_e=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg NOT IN ('kt1','rtr')");
$data_e=mysql_fetch_array($qry_jumlah_e);
$jumlah_trlain=$data_e[0];

$qry_invent=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('kt1')");
$data_invent=mysql_fetch_array($qry_invent);
$jumlah_invent=$data_invent[0];

$total_k2=$jumlah_trlain+$jumlah_beli+$jumlah_invent;

$jmlkas=$total_k1-$total_k2-$returcs;
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>EXPORT ARUS KAS | <?php echo $heading;?></title>
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
<h1>LAPORAN ARUS KAS</h1>
<b><?php echo $heading;?></b></td>
<td style="text-align: right;" colspan="2"><img src="<?php echo $dta['logo']; ?>" height="75px" alt="LOGO" /></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="5"><b>Aktifitas Operasional</b></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="5"><b>Penerimaan Kas dari</b></td>
                                      <tr>
        	                           <td style="border: 1px solid #CCCCCC;"></td>
                                       <td style="border: 1px solid #CCCCCC;" colspan="2">Penjualan Bersih</td>
		                               <td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_tunai-$returcs);?></td>
                                       <td style="border: 1px solid #CCCCCC;"></td>
        	                          </tr>
                                      <tr>
        	                           <td style="border: 1px solid #CCCCCC;"></td>
                                       <td style="border: 1px solid #CCCCCC;" colspan="2">Pembayaran Piutang </td>
		                               <td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_piutang);?></td>
                                       <td style="border: 1px solid #CCCCCC;"></td>
        	                          </tr>
                                        <tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="4"><b>Total Kas Masuk</b></td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jumlah_tunai-$returcs+$jumlah_piutang);?></b></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="5"><b>Pengeluaran Kas dari</b></td>
                                        </tr>
                                      <tr>
        	                           <td style="border: 1px solid #CCCCCC;"></td>
                                       <td style="border: 1px solid #CCCCCC;" colspan="2">Pembelian Tunai </td>
		                               <td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_beli);?></td>
                                       <td style="border: 1px solid #CCCCCC;"></td>
        	                          </tr>
                                      <tr>
        	                           <td style="border: 1px solid #CCCCCC;"></td>
                                       <td style="border: 1px solid #CCCCCC;" colspan="2">Total Biaya dan Beban </td>
		                               <td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($jumlah_trlain);?></td>
                                       <td style="border: 1px solid #CCCCCC;"></td>
        	                          </tr>

                                        <tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="4"><b>Total Kas Keluar </b></td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jumlah_trlain+$jumlah_beli);?></b></td>
                                        </tr>
										<tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="4"><b>Total Aktifitas Operasional</b> </td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jumlah_tunai-$returcs+$jumlah_piutang-($jumlah_trlain+$jumlah_beli));?></b></td>
                                        </tr>
										<tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="4"><b>Aktifitas Investasi</b></td>
											<td style="border: 1px solid #CCCCCC;"></td>
                                        </tr>
										<tr>
											<td style="border: 1px solid #CCCCCC;"></td>
                                            <td style="border: 1px solid #CCCCCC;" colspan="3">Pembelian Inventaris </td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jumlah_invent);?></b></td>
                                        </tr><tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="4"><b>Aktifitas Pendanaan</b></td>
											<td style="border: 1px solid #CCCCCC;"></td>
                                        </tr><tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="5"><b>Penerimaan Kas dari</b></td>
                                        </tr><tr>
											<td style="border: 1px solid #CCCCCC;"></td>
                                            <td style="border: 1px solid #CCCCCC;" colspan="2">Penambahan Modal</td>
											<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format($kas['jmlmod']+$jumlah_tbhkas);?></td>
											<td style="border: 1px solid #CCCCCC;"></td>
                                        </tr><tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="5"><b>Pengeluaran Kas dari</b></td>
                                        </tr><tr>
											<td style="border: 1px solid #CCCCCC;"></td>
                                            <td style="border: 1px solid #CCCCCC;" colspan="2">Pengembalian Hutang</td>
											<td style="border: 1px solid #CCCCCC;text-align: right;">Rp. <?php echo number_format(@$hutang['bayar']);?></td>
											<td style="border: 1px solid #CCCCCC;"></td>
                                        </tr><tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="4"><b>Total Kas Untuk Aktifitas Pendanaan</b></td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format(($kas['jmlmod']+$jumlah_tbhkas)-@$hutang['bayar']);?></b></td>
                                        </tr>
										<tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="3"></td>
											<td style="border: 1px solid #CCCCCC;"><b>Selisih Kas </b></td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format(($jumlah_tunai-$returcs+$jumlah_piutang-($jumlah_trlain+$jumlah_beli))-$jumlah_invent+(($kas['jmlmod']+$jumlah_tbhkas)-@$hutang['bayar']));?></b></td>
                                        </tr><tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="3"></td>
											<td style="border: 1px solid #CCCCCC;"><b>Saldo Awal </b></td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jmlkas-(($jumlah_tunai-$returcs+$jumlah_piutang-($jumlah_trlain+$jumlah_beli))-$jumlah_invent+(($kas['jmlmod']+$jumlah_tbhkas)-@$hutang['bayar'])));?></b></td>
                                        </tr><tr>
                                            <td style="border: 1px solid #CCCCCC;" colspan="3"></td>
											<td style="border: 1px solid #CCCCCC;"><b>Posisi Kas Akhir</b></td>
											<td style="border: 1px solid #CCCCCC;text-align: right;"><b>Rp. <?php echo number_format($jmlkas);?></b></td>
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