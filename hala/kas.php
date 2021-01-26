<?php
$tas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));
$today= date("Y-m-d");
$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
$tglc = $tas['tglmod'];
if (!empty($tgla)&&!empty($tglb)){
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
<section>
        <div class="container">
		<div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Arus Kas</b></h4>
<br>
</div>
		<div class="col-md-2 col-sm-2">
		<b>Periode Tanggal : </b>
		</div>
		<div class="col-md-8 col-sm-8">
<form role="form" name="period" action="" method="post">
<div class="form-group">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo date("Y")."-00-00";} else { echo $tgla; }?>"> <b>s/d</b>
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>"></div>
<div class="form-group">
                <button type="submit" class="btn btn-success"><i class="icon-search"></i> Cari</button>
</div>
</form>
        </div>
<div class="col-md-2 col-sm-2">
        <a href="<?php if (!empty($tgla)&&!empty($tglb)){?>print-kas.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>print-kas.php<?php } ?>" class="btn btn-success pull-right" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
                </div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Kas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
								<thead>
                                        <tr>
                                            <th colspan="5">Aktifitas Operasional</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4">Penerimaan Kas dari</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
        	                           <td></td>
                                       <td colspan="2">Penjualan Bersih</td>
		                               <td style="text-align: right;">Rp. <?php echo number_format($jumlah_tunai-$returcs);?></td>
                                       <td></td>
        	                          </tr>
                                      <tr>
        	                           <td></td>
                                       <td colspan="2">Pembayaran Piutang </td>
		                               <td style="text-align: right;">Rp. <?php echo number_format($jumlah_piutang);?></td>
                                       <td></td>
        	                          </tr>
                                        <tr>
                                            <th colspan="4">Total Kas Masuk</th>
											<th style="text-align: right;">Rp. <?php echo number_format($jumlah_tunai-$returcs+$jumlah_piutang);?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5">Pengeluaran Kas dari</th>
                                        </tr>
                                      <tr>
        	                           <td></td>
                                       <td colspan="2">Pembelian Tunai </td>
		                               <td style="text-align: right;">Rp. <?php echo number_format($jumlah_beli);?></td>
                                       <td></td>
        	                          </tr>
                                      <tr>
        	                           <td></td>
                                       <td colspan="2">Total Biaya dan Beban </td>
		                               <td style="text-align: right;">Rp. <?php echo number_format($jumlah_trlain);?></td>
                                       <td></td>
        	                          </tr>

                                        <tr>
                                            <th colspan="4">Total Kas Keluar </th>
											<th style="text-align: right;">Rp. <?php echo number_format($jumlah_trlain+$jumlah_beli);?></th>
                                        </tr>
										<tr>
                                            <th colspan="4">Total Aktifitas Operasional </th>
											<th style="text-align: right;">Rp. <?php echo number_format($jumlah_tunai-$returcs+$jumlah_piutang-($jumlah_trlain+$jumlah_beli));?></th>
                                        </tr>
										<tr>
                                            <th colspan="4">Aktifitas Investasi</th>
											<th></th>
                                        </tr>
										<tr>
											<td></td>
                                            <td colspan="3">Pembelian Inventaris </td>
											<th style="text-align: right;">Rp. <?php echo number_format($jumlah_invent);?></th>
                                        </tr><tr>
                                            <th colspan="4">Aktifitas Pendanaan</th>
											<th></th>
                                        </tr><tr>
                                            <th colspan="4">Penerimaan Kas dari</th>
											<th></th>
                                        </tr><tr>
											<td></td>
                                            <td colspan="2">Penambahan Modal</td>
											<td style="text-align: right;">Rp. <?php echo number_format($kas['jmlmod']+$jumlah_tbhkas);?></td>
                                        </tr><tr>
                                            <th colspan="4">Pengeluaran Kas dari</th>
											<th></th>
                                        </tr><tr>
											<td></td>
                                            <td colspan="2">Pengembalian Hutang</td>
											<td style="text-align: right;">Rp. <?php echo number_format(@$hutang['bayar']);?></td>
                                        </tr><tr>
                                            <th colspan="4">Total Kas Untuk Aktifitas Pendanaan</th>
											<th style="text-align: right;">Rp. <?php echo number_format(($kas['jmlmod']+$jumlah_tbhkas)-@$hutang['bayar']);?></th>
                                        </tr>
										<tr>
                                            <th colspan="3"></th>
											<th>Selisih Kas </th>
											<th style="text-align: right;">Rp. <?php echo number_format(($jumlah_tunai-$returcs+$jumlah_piutang-($jumlah_trlain+$jumlah_beli))-$jumlah_invent+(($kas['jmlmod']+$jumlah_tbhkas)-@$hutang['bayar']));?></th>
                                        </tr><tr>
                                            <th colspan="3"></th>
											<th>Saldo Awal </th>
											<th style="text-align: right;">Rp. <?php echo number_format($jmlkas-(($jumlah_tunai-$returcs+$jumlah_piutang-($jumlah_trlain+$jumlah_beli))-$jumlah_invent+(($kas['jmlmod']+$jumlah_tbhkas)-@$hutang['bayar'])));?></th>
                                        </tr><tr>
                                            <th colspan="3"></th>
											<th>Posisi Kas Akhir</th>
											<th style="text-align: right;">Rp. <?php echo number_format($jmlkas);?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>