<?php
$today= date("Y-m-d");

$kas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));

$tgla = $kas['tglmod'];
$tglb = $_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
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
<section>
        <div class="container">
<div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                <form role="form" name="period" action="" method="post">
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" class="btn btn-success btn-xs">OK</button>
                </form>
                </div>
<div class="col-md-12 col-md-offset-0 col-sm-12">
        <a href="<?php if (!empty($tgla)&&!empty($tglb)){?>print-neraca.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>print-neraca.php<?php } ?>" class="btn btn-success" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print / PDF</a>
                </div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-anchor"></i> <b>Neraca</b>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
				<tr>
				<td colspan="4"><b>Asset Lancar</b></td>
				</tr>
<tr>
				<td></td>
				<td>Kas</td>
				<td style="text-align:right">Rp. <?php echo number_format($jmlkas);?></td>
				<td></td>
				</tr>
<tr>
				<td></td>
				<td>Piutang usaha</td>
				<td style="text-align:right">Rp. <?php echo number_format($jumlah_piut);?></td>
				<td></td>
				</tr>
<tr>
				<td></td>
				<td>Persediaan barang</td>
				<td style="text-align:right">Rp. <?php echo number_format($jumlah_barang);?></td>
				<td></td>
				</tr>
<tr>
				<td></td>
				<td>PPN Masukan</td>
				<td style="text-align:right">Rp. <?php echo number_format($jumlah_ppn_masuk);?></td>
				<td></td>
				</tr>
<?php	
	while ($dt = mysql_fetch_array($qry_biaya)) {
?>
				<tr>
				<td></td>
				<td><?php echo $dt['ketmod'];?></td>
				<td style="text-align:right">Rp. <?php echo number_format($dt['jmlmod']);?></td>
				<td></td>
				</tr>
<?php 
	}
?>
<tr>
				<td></td>
				<td>Perlengkapan</td>
				<td style="text-align:right">-</td>
				<td></td>
				</tr>
				<tr>
				<td colspan="4"><b>Asset Tetap</b></td>
				</tr>
<?php	
while ($dq = mysql_fetch_array($qryttp)) {
?>
				<tr>
				<td></td>
				<td><?php echo $dq['nama_tran'];?></td>
				<td style="text-align:right">Rp. <?php echo number_format($dq['nominal']);?></td></td>
				<td></td>
				</tr>
<?php 
	}
?>
<?php	
while ($do = mysql_fetch_array($qryaset)) {
?>
<tr>
				<td></td>
				<td><?php echo $do['ketmod'];?></td>
				<td style="text-align:right">Rp. <?php echo number_format($do['jmlmod']);?></td>
				<td></td>
				</tr>
<?php 
	}
?>
<?php	
while ($de = mysql_fetch_array($qryncs)) {
?>
<tr>
				<td></td>
				<td><?php echo $de['nama_ncs'];?></td>
				<td></td>
				<td style="text-align:right">Rp. <?php echo number_format($de['kredit']);?></td>
				</tr>
<?php 
	}
?>
				<tr>
				<td colspan="4"><b>Kewajiban</b></td>
				</tr>
<tr>
				<td></td>
				<td>Hutang Usaha</td>
				<td></td>
				<td style="text-align:right">Rp. <?php echo number_format($jumlah_htg);?></td>
				</tr>
<tr>
				<td></td>
				<td>PPN Keluaran</td>
				<td></td>
				<td style="text-align:right">Rp. <?php echo number_format($jumlah_ppn_keluar);?></td>
				</tr>
<tr>
				<td></td>
				<td>PPH Pasal 25</td>
				<td></td>
				<td style="text-align:right">Rp. <?php 
				echo number_format($pjk); ?></td>
				</tr>
<tr>
				<td></td>
				<td>Modal Awal</td>
				<td></td>
				<td style="text-align:right">Rp. <?php echo number_format($jumlah_modal);?></td>
				</tr>
				<tr>
				<td colspan="4"><b>Laba</b></td>
				</tr>
<tr>
				<td></td>
				<td>Laba Berjalan</td>
				<td></td>
				<td style="text-align:right">Rp. <?php echo number_format($laba); ?></td>
				</tr>
				<tr>
				<td colspan="2"></td>
				<td style="text-align:right"><b>Rp. <?php echo number_format($jmlkas+$jumlah_piut+$jumlah_barang+$jumlah_ppn_masuk+$jumlah_bdm+$jumlah_ast+$jumlah_ttp); ?></b></td>
				<td style="text-align:right"><b>Rp. <?php echo number_format($jumlah_htg+$jumlah_ppn_keluar+$pjk+$jumlah_modal+$laba+$jumlah_ncs); ?></b></td>
				</tr>				
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>