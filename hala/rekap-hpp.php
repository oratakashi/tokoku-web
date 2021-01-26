<?php
$kas=mysql_fetch_array(mysql_query("SELECT * FROM modal WHERE ketmod = 'Kas'"));

$today= date("Y-m-d");
$tgla = $kas['tglmod'];
$tglb = @$_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
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
<section>
        <div class="container">
		<div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Harga Pokok Penjualan</b></h4>
<br>
        </div>
		<div class="col-md-2 col-sm-2">
<b>Periode Tanggal : </b>
        </div>
		<div class="col-md-3 col-sm-3">
<form role="form" name="period" action="" method="post">
<div class="form-group">
                <input class="form-control" type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
</div>
<div class="form-group">
                <button type="submit" class="btn btn-success"><i class="icon-search"></i> Cari</button>
</div>
                </form>
        </div>
		<div class="col-md-7 col-sm-7">
        <a href="<?php if (!empty($tgla)&&!empty($tglb)){?>print-hpp.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>print-hpp.php<?php } ?>" class="btn btn-success pull-right" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
                </div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
								<tbody>
<tr>
<td><strong>No.</strong></td>
<td><strong>Keterangan</strong></td>
<td><strong>Jumlah</strong></td>
</tr>
<tr>
<td style="padding-left: 30px;" colspan="3"><strong>Rincian HPP Keseluruhan</strong></td>
</tr>
<tr>
<td style="text-align: right;">1</td>
<td>Persediaan Awal</td>
<td style="text-align: right;">Rp. <?php echo number_format($jumlah_barang+$jumhppj-$jumpbeli);?></td>
</tr>
<tr>
<td style="text-align: right;">2</td>
<td>Pembelian Barang</td>
<td style="text-align: right;">Rp. <?php echo number_format($jumpbeli);?></td>
</tr>
<tr>
<td style="text-align: right;">3</td>
<td>Barang Siap Jual</td>
<td style="text-align: right;">Rp. <?php echo number_format($jumlah_barang+$jumhppj);?></td>
</tr>
<tr>
<td style="text-align: right;">4</td>
<td>Persediaan Akhir</td>
<td style="text-align: right;">Rp. <?php echo number_format($jumlah_barang);?></td>
</tr>
<tr>
<td> </td>
<td style="text-align: right;"><strong>Total HPP Keseluruhan</strong></td>
<td style="text-align: right;">Rp. <?php echo number_format($jumhppj); ?></td>
</tr>
<tr>
<td colspan="3">   </td>
</tr>
<tr>
<td style="padding-left: 30px;" colspan="3"><strong>Rincian HPP Per Transaksi</strong></td>
</tr>
<?php
$no = 1;
while ($jualan = mysql_fetch_array($qjual)) {
$totljual=@$totljual+$jualan['total'];
?>
<tr>
<td style="text-align: right;"><?php echo $no; ?></td>
<td><?php echo $jualan['kode_penjualan'];?></td>
<td style="text-align: right;">Rp. <?php 
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
<td style="text-align: right;"> </td>
<td style="text-align: right;"><strong>Total HPP Per Transaksi</strong> </td>
<td style="text-align: right;"> Rp. <?php echo number_format($jumhppj);?></td>
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