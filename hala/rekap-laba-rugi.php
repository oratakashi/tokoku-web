<?php if(!empty($_GET['act']) && $_GET['act'] == 'select') {
if(!empty($_POST['idmember'])) {
    $idmember = $_POST['idmember'];
    $_SESSION['idmember'] = $idmember;
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-laba-rugi\">");
}
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">
                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Pilih Member</h4>
				<form role="form" name="input-barang" action="" method="POST">
					<div class="form-group">
                        <label for="Harga Bengkel">Member</label>
                        <select class="form-control" name="idmember" data-rel="chosen" required="required">
							<?php $select=mysql_query("SELECT *, regencies.name AS kotab, provinces.name AS provi FROM dtl_memven LEFT JOIN tab_user ON dtl_memven.idmember=tab_user.id LEFT JOIN regencies ON tab_user.kotab=regencies.id LEFT JOIN provinces ON tab_user.provi=provinces.id LEFT JOIN setting ON tab_user.id=setting.iduser WHERE dtl_memven.idvendor='{$_SESSION['id']}' AND tab_user.level ='admin' ORDER BY tab_user.tgl_reg DESC");
							while ($bar=mysql_fetch_array($select)) { ?>
							<option value="<?php echo $bar['idmember']; ?>"><?php echo $bar['fullname']; ?></option>
							<?php } ?>
							  </select>
                    </div>
                    <a class="btn btn-danger" href="?page=rekap-laba-rugi"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php
} else if(!empty($_GET['act']) && $_GET['act'] == 'clear') {
unset($_SESSION['idmember']);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-laba-rugi\">");
} else {
$idmember='';
if($_SESSION['level'] == 'admin') {
	$idmember = $_SESSION['id'];
} if($_SESSION['level'] == 'vendor') {
	if(!empty($_SESSION['idmember'])) {
	$idmember = $_SESSION['idmember'];
	} else {
		echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-laba-rugi&act=select\">");
	}
	
}
$today= date("Y-m-d");
$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){

$qryjual=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}' GROUP BY nama_barang");

$qryhpp=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}' GROUP BY nama_barang");

$qrtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}' GROUP BY nama_tran");

$qrtlnop=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y' AND tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_claim");

$qrncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%' AND tgl BETWEEN '$tgla' AND '$tglb' GROUP BY nama_ncs");

$qtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}'");
$totln=mysql_fetch_array($qtln);

$retcs=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg IN ('rtr') AND tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}'");
$totrecs=mysql_fetch_array($retcs);

$qtclm=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y' AND tgl BETWEEN '$tgla' AND '$tglb'");
$tclaim=mysql_fetch_array($qtclm);

$qtncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totncs=mysql_fetch_array($qtncs);

$retncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan' AND tgl BETWEEN '$tgla' AND '$tglb'");
$totretncs=mysql_fetch_array($retncs);

$retur=$totrecs['nominal']+$totretncs['debet'];

$qwer=mysql_query("SELECT SUM(total) AS topus FROM tbljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$cvgh=mysql_fetch_array($qwer);
$totalpls=$cvgh['topus'];

$qrytj=mysql_query("SELECT * ,SUM(jumlah*(harga-ppn))totalj FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}'");
$totalj=mysql_fetch_array($qrytj);
$penjualan=$totalj['totalj'];

$omzet=($penjualan+$totalpls)-$retur;

$qrhp=mysql_query("SELECT * ,SUM(jumlah*hpp)totahp FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}'");
$totahp=mysql_fetch_array($qrhp);

$qrhpl=mysql_query("SELECT * ,SUM(jumlah*hpp)totahpl FROM dtljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$totahpl=mysql_fetch_array($qrhpl);

//$qrydtlj=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
//$data_dtlj=mysql_fetch_array($qrydtlj);
$jumhppj=$totahp['totahp']+$totahpl['totahpl'];

$tbeli = mysql_query("SELECT SUM(dtlpembelian_bahan.jumlah*stok_bahan.harga_per) FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan AND tgl BETWEEN '$tgla' AND '$tglb' ");
$data_tbeli=mysql_fetch_array($tbeli);
$jumlah_tbeli=$data_tbeli[0];

$qry_persediaan=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod = 'Persediaan' AND iduser='{$idmember}' ");
$data_persediaan=mysql_fetch_array($qry_persediaan);
$jumlah_persediaan=$data_persediaan[0];

$tjal=mysql_query("SELECT SUM(jumlah*hpp) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}'");
$data_tjal=mysql_fetch_array($tjal);
$jumlah_tjal=$data_tjal[0];

$jumlah_barang=$jumlah_tbeli+$jumlah_persediaan-$jumlah_tjal;

$qrypbeli=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$datapbeli=mysql_fetch_array($qrypbeli);
$jumpbeli=$datapbeli[0];

$qwer=mysql_query("SELECT SUM(total) AS topus FROM tbljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$cvgh=mysql_fetch_array($qwer);
$totalpls=$cvgh['topus'];

} else {
$qryjual=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan WHERE iduser='{$idmember}' GROUP BY nama_barang");

$qryhpp=mysql_query("SELECT * ,SUM(jumlah)jumlah FROM dtlpenjualan WHERE iduser='{$idmember}' GROUP BY nama_barang");

$qrtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND iduser='{$idmember}' GROUP BY nama_tran");

$qrtlnop=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y' GROUP BY nama_claim");

$qrncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%' GROUP BY nama_ncs");

$qtln=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg NOT IN ('kt1', 'kt2' , 'kt4', 'rtr') AND iduser='{$idmember}'");
$totln=mysql_fetch_array($qtln);

$retcs=mysql_query("SELECT * ,SUM(nominal)nominal FROM dtltransaksi WHERE ctg IN ('rtr') AND iduser='{$idmember}'");
$totrecs=mysql_fetch_array($retcs);

$qtclm=mysql_query("SELECT * ,SUM(jml)jnom FROM dtlclaim WHERE status = 'Y'");
$tclaim=mysql_fetch_array($qtclm);

$qtncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Beban%'");
$totncs=mysql_fetch_array($qtncs);

$retncs=mysql_query("SELECT * ,SUM(debet)debet FROM dtlnoncash WHERE nama_ncs LIKE 'Retur Penjualan'");
$totretncs=mysql_fetch_array($retncs);

$retur=$totrecs['nominal']+$totretncs['debet'];

$qrytj=mysql_query("SELECT * ,SUM(jumlah*(harga-ppn))totalj FROM dtlpenjualan WHERE iduser='{$idmember}'");
$totalj=mysql_fetch_array($qrytj);

$qwer=mysql_query("SELECT SUM(total) AS topus FROM tbljualpulsa");
$cvgh=mysql_fetch_array($qwer);
$totalpls=$cvgh['topus'];

$penjualan=$totalj['totalj'];

$omzet=($penjualan+$totalpls)-$retur;

$qrhp=mysql_query("SELECT * ,SUM(jumlah*hpp)totahp FROM dtlpenjualan WHERE iduser='{$idmember}'");
$totahp=mysql_fetch_array($qrhp);

$qrhpl=mysql_query("SELECT * ,SUM(jumlah*hpp)totahpl FROM dtljualpulsa");
$totahpl=mysql_fetch_array($qrhpl);

//$qrydtlj=mysql_query("SELECT SUM(hpp*jumlah) FROM dtlpenjualan");
//$data_dtlj=mysql_fetch_array($qrydtlj);
$jumhppj=$totahp['totahp']+$totahpl['totahpl'];

$tbeli = mysql_query("SELECT SUM(dtlpembelian_bahan.jumlah*stok_bahan.harga_per) FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan");
$data_tbeli=mysql_fetch_array($tbeli);
$jumlah_tbeli=$data_tbeli[0];

$qry_persediaan=mysql_query("SELECT SUM(jmlmod) FROM modal WHERE ketmod = 'Persediaan' AND iduser='{$idmember}'");
$data_persediaan=mysql_fetch_array($qry_persediaan);
$jumlah_persediaan=$data_persediaan[0];

$tjal=mysql_query("SELECT SUM(jumlah*hpp) FROM dtlpenjualan WHERE iduser='{$idmember}'");
$data_tjal=mysql_fetch_array($tjal);
$jumlah_tjal=$data_tjal[0];

$jumlah_barang=$jumlah_tbeli+$jumlah_persediaan-$jumlah_tjal;

$qrypbeli=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan");
$datapbeli=mysql_fetch_array($qrypbeli);
$jumpbeli=$datapbeli[0];
}
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Laba Rugi</b></h4>
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
                <a class="btn btn-danger" href="?page=rekap-laba-rugi&act=clear"><i class="icon-remove"></i> Kembali</a>
</div>
</form>
        </div>
<div class="col-md-2 col-sm-2">
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
<td colspan="2"><strong>PENJUALAN</strong></td>
</tr>
<tr>
<td>Penjualan Barang</td>
<td style="text-align: right;">Rp. <?php echo number_format($penjualan); ?></td>
</tr>
<!--<tr>
<td>Penjualan Pulsa</td>
<td style="text-align: right;">Rp. <?php echo number_format($totalpls); ?></td>
</tr>
<tr>
<td>Retur Penjualan</td>
<td style="text-align: right;">Rp. <?php echo number_format($retur); ?></td>
</tr>
<tr>
<td>Potongan Penjualan</td>
<td style="text-align: right;">Rp. <?php echo number_format(0); ?></td>
</tr>
<tr>
<td>Ongkos Kirim Penjualan</td>
<td style="text-align: right;">Rp. <?php echo number_format(0); ?></td>
</tr>-->
<tr>
<td style="text-align: right;"><strong>Total Penjualan Bersih</strong></td>
<td style="text-align: right;">Rp. <?php echo number_format($omzet); ?></td>
</tr>
<tr>
<td colspan="2"><strong>HARGA POKOK PENJUALAN</strong></td>
</tr>
<tr>
<td>HPP</td>
<td style="text-align: right;">Rp. <?php echo number_format($jumhppj); ?></td>
</tr>
<tr>
<td style="text-align: right;"><strong>Laba Kotor</strong></td>
<td style="text-align: right;">Rp. <?php echo number_format($omzet-$jumhppj); ?></td>
</tr>
<tr>
<!--<td colspan="2"><strong>BIAYA OPERASIONAlL </strong></td>
</tr>
<?php
		while ($dt = mysql_fetch_array($qrtln)) {
?>
<tr>
<td><?php echo $dt['nama_tran']; ?></td>
<td style="text-align: right;">Rp. <?php echo number_format($dt['nominal']); ?></td>
</tr>
<?php 
	}
		while ($dwt = mysql_fetch_array($qrncs)) {
?>
<tr>
<td><?php echo $dwt['nama_ncs']; ?></td>
<td style="text-align: right;">Rp. <?php echo number_format($dwt['debet']); ?></td>
</tr>
<?php 
	}
		while ($dxt = mysql_fetch_array($qrtlnop)) {
?>
<tr>
<td><?php echo $dxt['nama_claim']; ?></td>
<td style="text-align: right;">Rp. <?php echo number_format($dxt['jnom']); ?></td>
</tr>
<?php 
	}
?>
<tr>
<td style="text-align: right;"><strong>Total Biaya Operasional</strong></td>
<td style="text-align: right;">Rp. <?php 
								  $tpengl=$totln['nominal']+$totncs['debet']+$tclaim['jnom'];
								  echo number_format($tpengl); ?></td>
</tr>-->
<tr>
<td style="text-align: right;"><strong>LABA USAHA</strong></td>
<td style="text-align: right;">Rp. <?php echo number_format(($omzet-$jumhppj)-$tpengl); ?></td>
</tr>
<!--<tr>
<td colspan="2"><strong>PENDAPATAN DAN BIAYA NON OPERASIONAL</strong> </td>
</tr>
<tr>
<td>Pendapatan Non Operasional</td>
<td style="text-align: right;"> </td>
</tr>
<tr>
<td>Biaya Non Operasional</td>
<td style="text-align: right;"> </td>
</tr>-->
<tr>
<td style="text-align: right;"><strong>Laba Sebelum Pajak</strong></td>
<td style="text-align: right;">Rp. <?php echo number_format(($omzet-$jumhppj)-$tpengl); ?></td>
</tr>
<tr>
<td style="text-align: right;"><strong>Taksiran PPh (o,5%)</strong></td>
<td style="text-align: right;">Rp. <?php echo number_format($pjk=($penjualan*1)/200); ?></td>
</tr>
<tr>
<td style="text-align: right;"><strong>LABA BERSIH SETELAH PAJAK</strong></td>
<td style="text-align: right;">Rp. <?php 
								  $sbl_pjk=($omzet-$jumhppj)-$tpengl;
								  echo number_format($sbl_pjk-$pjk); ?></td>
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
<?php } ?>