<?php
include('include/config.php');
$today= date("Y-m-d");
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);
$kas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));

$tgla = $kas['tglmod'];
$tglb = @$_GET['sampai'];

$tlb=date_create($tglb);
$tld=date_create($today);

if (!empty($tglb)){

$heading="PER TANGGAL ".strtoupper(date_format($tlb,"d F Y"));

$qry_jumlah_a=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang = '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$jumlah_tunai=$data_a[0];

$qry_tbhkas=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'tks' AND tglmod BETWEEN '$tgla' AND '$tglb'");
$data_tbhkas=mysql_fetch_array($qry_tbhkas);
$jumlah_tbhkas=$data_tbhkas[0];

$qry_jumlah_b=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_b=mysql_fetch_array($qry_jumlah_b);
$jumlah_piutang=$data_b[0];

$qry_jumret=mysql_query("SELECT SUM(total) FROM tblretur_jual WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_jumret=mysql_fetch_array($qry_jumret);
$jumretur=$data_jumret[0];

$total_k1=$kas['jmlmod']+$jumlah_tbhkas+$jumlah_tunai+$jumlah_piutang;

$qry_jumlah_c=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE kurang = '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_c=mysql_fetch_array($qry_jumlah_c);
$jumlah_beli=$data_c[0];

$qry_jumlah_d=mysql_query("SELECT SUM(bayar) FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_d=mysql_fetch_array($qry_jumlah_d);
$jumlah_utang=$data_d[0];

$retcs=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$totrecs=mysql_fetch_array($retcs);
$returcs=$totrecs[0];

$retncs=mysql_query("SELECT SUM(debet) FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totretncs=mysql_fetch_array($retncs);
$returncs=$totretncs[0];

$retur=$returcs+$returncs;

$qry_jumlah_e=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg NOT IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_e=mysql_fetch_array($qry_jumlah_e);
$jumlah_trlain=$data_e[0];

$total_k2=$jumlah_trlain+$jumlah_beli+$jumlah_utang;

$jmlkas=$total_k1-$total_k2-$returcs;
?>
<?php
$qry_piut=mysql_query("SELECT SUM(kurang) FROM tblpenjualan WHERE kurang != '0' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_piut=mysql_fetch_array($qry_piut);
$jumlah_piut=$data_piut[0];
?>
<?php
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
?>
<?php 
$ppn_masuk=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_ppn_masuk=mysql_fetch_array($ppn_masuk);
$jumlah_ppn_masuk=$data_ppn_masuk[0];
?>
<?php
$qryncs=mysql_query("SELECT * FROM dtlnoncash WHERE nama_ncs LIKE 'Depresiasi%' AND tgl BETWEEN '$tgla' AND '$tglb'");
$qry_ncs=mysql_query("SELECT SUM(kredit) FROM dtlnoncash WHERE nama_ncs LIKE 'Depresiasi%' AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_ncs=mysql_fetch_array($qry_ncs);
$jumlah_ncs=$data_ncs[0];

$qry_biaya=mysql_query("SELECT * FROM modal WHERE ketmod LIKE '%dibayar dimuka'");
$qry_bdm=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod LIKE '%dibayar dimuka'");
$data_bdm=mysql_fetch_array($qry_bdm);
$jumlah_bdm=$data_bdm[0];
?>
<?php
$qryttp=mysql_query("SELECT * FROM dtltransaksi WHERE ctg IN ('kt1', 'kt2' ,'kt4') AND tgl BETWEEN '$tgla' AND '$tglb'");
$qry_ttp=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('kt1', 'kt2' ,'kt4') AND tgl BETWEEN '$tgla' AND '$tglb'");
$data_ttp=mysql_fetch_array($qry_ttp);
$jumlah_ttp=$data_ttp[0];

$qryaset=mysql_query("SELECT * FROM modal WHERE ktg = 'kt1'");
$qry_ast=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'kt1'");
$data_ast=mysql_fetch_array($qry_ast);
$jumlah_ast=$data_ast[0];
?>
<?php
$qry_htg=mysql_query("SELECT SUM(kurang) FROM tblpembelian_bahan WHERE kurang != '0' AND tanggal BETWEEN '$tgla' AND '$tglb'");
$data_htg=mysql_fetch_array($qry_htg);
$jumlah_htg=$data_htg[0];
?>
<?php 
$ppn_keluar=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_ppn_keluar=mysql_fetch_array($ppn_keluar);
$jumlah_ppn_keluar=$data_ppn_keluar[0];
?>
<?php 
$retcs=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$totrecs=mysql_fetch_array($retcs);

$retncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totretncs=mysql_fetch_array($retncs);

$retur=$totrecs['nominal']+$totretncs['debet'];

$qrytj=mysql_query("SELECT * ,SUM(jumlah*(harga-ppn))totalj FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$totalj=mysql_fetch_array($qrytj);
$penjualan=$totalj['totalj'];

$omzet=$penjualan-$retur;
?>
<?php
$qry_modal=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg NOT IN ('tks')");
$data_modal=mysql_fetch_array($qry_modal);
$jummod=$data_modal[0];

$qry_tks=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg IN ('tks') AND tglmod BETWEEN '$tgla' AND '$tglb'");
$data_tks=mysql_fetch_array($qry_tks);
$jumtks=$data_tks[0];

$jumlah_modal=$jummod+$jumtks
?>
<?php
$qrhp=mysql_query("SELECT * ,SUM(jumlah*hpp)totahp FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$totahp=mysql_fetch_array($qrhp);
$jumlah_hpp=$totahp['totahp'];

$qtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND tgl BETWEEN '$tgla' AND '$tglb'");
$totln=mysql_fetch_array($qtln);
$jumlah_ln=$totln['nominal'];

$pjk=($penjualan*1)/100;
$laba=$omzet-$jumlah_hpp-$jumlah_ln-$pjk-$jumlah_ncs;

} else {

$heading="PER TANGGAL ".strtoupper(date_format($tld,"d F Y"));

$qry_jumlah_a=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang = '0'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$jumlah_tunai=$data_a[0];

$qry_tbhkas=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'tks'");
$data_tbhkas=mysql_fetch_array($qry_tbhkas);
$jumlah_tbhkas=$data_tbhkas[0];

$qry_jumlah_b=mysql_query("SELECT SUM(bayar) FROM tblpenjualan WHERE kurang != '0'");
$data_b=mysql_fetch_array($qry_jumlah_b);
$jumlah_piutang=$data_b[0];

$qry_jumret=mysql_query("SELECT SUM(total) FROM tblretur_jual");
$data_jumret=mysql_fetch_array($qry_jumret);
$jumretur=$data_jumret[0];

$total_k1=$kas['jmlmod']+$jumlah_tbhkas+$jumlah_tunai+$jumlah_piutang;

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

$qry_jumlah_e=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg NOT IN ('rtr')");
$data_e=mysql_fetch_array($qry_jumlah_e);
$jumlah_trlain=$data_e[0];

$total_k2=$jumlah_trlain+$jumlah_beli+$jumlah_utang;

$jmlkas=$total_k1-$total_k2-$returcs;
?>
<?php
$qry_piut=mysql_query("SELECT SUM(kurang) FROM tblpenjualan WHERE kurang != '0'");
$data_piut=mysql_fetch_array($qry_piut);
$jumlah_piut=$data_piut[0];
?>
<?php
$qry_barang=mysql_query("SELECT SUM(jumlah*harga_per) FROM stok_bahan");
$data_barang=mysql_fetch_array($qry_barang);
$jumlah_barang=$data_barang[0];
?>
<?php 
$ppn_masuk=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan");
$data_ppn_masuk=mysql_fetch_array($ppn_masuk);
$jumlah_ppn_masuk=$data_ppn_masuk[0];
?>
<?php
$qryncs=mysql_query("SELECT * FROM dtlnoncash WHERE nama_ncs LIKE 'Depresiasi%'");
$qry_ncs=mysql_query("SELECT SUM(kredit) FROM dtlnoncash WHERE nama_ncs LIKE 'Depresiasi%'");
$data_ncs=mysql_fetch_array($qry_ncs);
$jumlah_ncs=$data_ncs[0];

$qry_biaya=mysql_query("SELECT * FROM modal WHERE ketmod LIKE '%dibayar dimuka'");
$qry_bdm=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod LIKE '%dibayar dimuka'");
$data_bdm=mysql_fetch_array($qry_bdm);
$jumlah_bdm=$data_bdm[0];
?>
<?php
$qryttp=mysql_query("SELECT * FROM dtltransaksi WHERE ctg IN ('kt1', 'kt2' ,'kt4')");
$qry_ttp=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE ctg IN ('kt1', 'kt2' ,'kt4')");
$data_ttp=mysql_fetch_array($qry_ttp);
$jumlah_ttp=$data_ttp[0];

$qryaset=mysql_query("SELECT * FROM modal WHERE ktg = 'kt1'");
$qry_ast=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ktg = 'kt1'");
$data_ast=mysql_fetch_array($qry_ast);
$jumlah_ast=$data_ast[0];
?>
<?php
$qry_htg=mysql_query("SELECT SUM(kurang) FROM tblpembelian_bahan WHERE kurang != '0'");
$data_htg=mysql_fetch_array($qry_htg);
$jumlah_htg=$data_htg[0];
?>
<?php 
$ppn_keluar=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan");
$data_ppn_keluar=mysql_fetch_array($ppn_keluar);
$jumlah_ppn_keluar=$data_ppn_keluar[0];
?>
<?php 
$retcs=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg IN ('rtr')");
$totrecs=mysql_fetch_array($retcs);

$retncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan'");
$totretncs=mysql_fetch_array($retncs);

$retur=$totrecs['nominal']+$totretncs['debet'];

$qrytj=mysql_query("SELECT * ,SUM(jumlah*(harga-ppn))totalj FROM dtlpenjualan");
$totalj=mysql_fetch_array($qrytj);
$penjualan=$totalj['totalj'];

$omzet=$penjualan-$retur;
?>
<?php
$qry_modal=mysql_query("SELECT SUM(jmlmod) FROM modal");
$data_modal=mysql_fetch_array($qry_modal);
$jumlah_modal=$data_modal[0];
?>
<?php
$qrhp=mysql_query("SELECT * ,SUM(jumlah*hpp)totahp FROM dtlpenjualan");
$totahp=mysql_fetch_array($qrhp);
$jumlah_hpp=$totahp['totahp'];

$qtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') ");
$totln=mysql_fetch_array($qtln);
$jumlah_ln=$totln['nominal'];

$pjk=($penjualan*1)/100;
$laba=$omzet-$jumlah_hpp-$jumlah_ln-$pjk-$jumlah_ncs;
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title><?php echo $heading;?></title>
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
#content table.list th style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" {
	font-size:12px;
	font-weight:bold;
	text-align:left;
	height:24px;
	/*background:url(images/bg-th style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;".jpg) repeat-y;*/
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
#content table.list  td style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" style="border: 1px solid #CCCCCC;" {
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
<h1>LAPORAN NERACA</h1>
<b><?php echo $heading;?></b>
<td style="text-align: right;" colspan="2"><img src="<?php echo $dta['logo']; ?>" height="75px" alt="LOGO" /></td>
                                        </tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>ASSET</strong></td>
</tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>Asset lancar</strong></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Kas</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jmlkas);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Persediaan Barang Dagangan</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_barang);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Piutang Usaha</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_piut);?></td>
</tr>
<?php	
	while ($dt = mysql_fetch_array($qry_biaya)) {
?>
<tr>
<td><?php echo $dt['ketmod'];?></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($dt['jmlmod']);?></td>
</tr>
<?php 
	}
?>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">PPN Masukan</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_ppn_masuk); ?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>Total Asset Lancar</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jmlkas+$jumlah_piut+$jumlah_barang+$jumlah_ppn_masuk); ?></td>
</tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>Asset Tetap</strong></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Inventaris</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_ast+$jumlah_ttp);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Depresiasi Inventaris</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_ncs);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>Total Asset Tetap</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format(($jumlah_bdm+$jumlah_ast+$jumlah_ttp)-$jumlah_ncs);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>TOTAL ASSET</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jmlkas+$jumlah_piut+$jumlah_barang+$jumlah_ppn_masuk+($jumlah_bdm+$jumlah_ast+$jumlah_ttp)-$jumlah_ncs); ?></td>
</tr>
<tr>
<td colspan="4"><hr></td>
</tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>KEWAJIBAN DAN MODAL</strong></td>
</tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>Hutang Lancar</strong></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Hutang Usaha</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_htg);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">PPn Keluaran</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_ppn_keluar); ?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">PPh Pasal 25</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($pjk); ?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>Jumlah Hutang Lancar</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_htg+$jumlah_ppn_keluar+$pjk);?></td>
</tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>Hutang jangka Panjang</strong></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Hutang Jangka Panjang</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">-</td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Lainnya</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">-</td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>Jumlah Hutang Jangka Panjang</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">-</td>
</tr>
<tr>
<td  style=" border: 1px solid #CCCCCC;" colspan="4"><strong>Modal Pemilik</strong></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Modal  Usaha</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_modal);?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC;">Laba</td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($laba); ?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>Jumlah Modal Pemilik</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_htg+$jumlah_ppn_keluar+$pjk+$jumlah_modal+$laba); ?></td>
</tr>
<tr>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;"><strong>TOTAL ASSET</strong></td>
<td colspan="3" style="border: 1px solid #CCCCCC; text-align: right;">Rp. <?php echo number_format($jumlah_htg+$jumlah_ppn_keluar+$pjk+$jumlah_modal+$laba); ?></td>
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