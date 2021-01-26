<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){

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
} else {
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
}
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                <form role="form" name="period" action="" method="post">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo date("Y")."-00-00";} else { echo $tgla; }?>">
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" class="btn btn-success btn-xs">OK</button>
                </form>
                </div>
<div class="col-md-12 col-md-offset-0 col-sm-12">
        <a href="<?php if (!empty($tgla)&&!empty($tglb)){?>print-laba-rugi.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>print-laba-rugi.php<?php } ?>" class="btn btn-success" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print / PDF</a>
                </div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Laporan Laba Rugi
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
<!--
                              <tr>
							      <th>PENJUALAN</th>
							      <th class="numeric">No.</th>
								  <th>Nama Barang</th>
                                  <th>Jumlah</th>
								  <th></th>
                              </tr>
                           
<?php	
		$no = 1;
		while ($data = mysql_fetch_array($qryjual)) {
	?>
			<tr>
        	<td></td>
			<td class="numeric"><?php echo $no; ?></td>
			<td><?php echo $data['nama_barang']; ?></td>
			<td><?php echo $data['jumlah']; ?> X Rp. <?php echo number_format($data['harga']-$data['ppn']); ?></td>
			<td>Rp. <?php echo number_format($data['jumlah']*($data['harga']-$data['ppn'])); ?></td>
			</tr>
    <?php 
		$no++;
	}
	?>
-->
							  <tr>
							      <th colspan="4">PENJUALAN</th>
								  <th>Rp. <?php echo number_format($penjualan); ?></th>
                              </tr>
							  <tr>
							      <th colspan="4">RETUR PENJUALAN</th>
								  <th>Rp. <?php echo number_format($retur); ?></th>
                              </tr>
							  <tr>
							      <th colspan="4">POTONGAN PENJUALAN</th>
								  <th>Rp. <?php echo number_format(0); ?></th>
                              </tr>
							  <tr>
							      <th colspan="4">TOTAL PENJUALAN BERSIH</th>
								  <th>Rp. <?php echo number_format($omzet); ?></th>
                              </tr>
<!-- 
                              <tr>
							      <th>HPP</th>
							      <th class="numeric">No.</th>
								  <th>Nama Barang</th>
                                  <th>Jumlah</th>
								  <th></th>
                              </tr>
                              
<?php	
		$no = 1;
		while ($dta = mysql_fetch_array($qryhpp)) {
	?>
			<tr>
        	<td></td>
			<td class="numeric"><?php echo $no; ?></td>
			<td><?php echo $dta['nama_barang']; ?></td>
			<td><?php echo $dta['jumlah']; ?> X Rp. <?php echo number_format($dta['hpp']); ?></td>
			<td>Rp. <?php echo number_format($dta['jumlah']*$dta['hpp']); ?></td>
			</tr>
    <?php 
		$no++;
	}
	?>
-->                   
                              
							                                <tr>
							      <th colspan="4">HPP</th>
								  <th>Rp. <?php echo number_format($totahp['totahp']); ?></th>
                              </tr>
							    
                              
							                                <tr>
							      <th colspan="4">LABA KOTOR</th>
								  <th>Rp. <?php echo number_format($omzet-$totahp['totahp']); ?></th>
                              </tr>
                              
                              <tr>
							      <th colspan="2">BIAYA-BIAYA</th>
								  <th>Jenis Biaya</th>
                                  <th>Jumlah</th>
								  <th></th>
                              </tr>
                              
<?php	
		while ($dt = mysql_fetch_array($qrtln)) {
	?>
			<tr>
        	<td colspan="2"></td>
			<td><?php echo $dt['nama_tran']; ?></td>
			<td>Rp. <?php echo number_format($dt['nominal']); ?></td>
			<td>Rp. <?php echo number_format($dt['nominal']); ?></td>
			</tr>
    <?php 
	}
	?>
	<?php	
		while ($dwt = mysql_fetch_array($qrncs)) {
	?>
			<tr>
        	<td colspan="2"></td>
			<td><?php echo $dwt['nama_ncs']; ?></td>
			<td>Rp. <?php echo number_format($dwt['debet']); ?></td>
			<td>Rp. <?php echo number_format($dwt['debet']); ?></td>
			</tr>
    <?php 
	}
	?>
<?php
		while ($dxt = mysql_fetch_array($qrtlnop)) {
	?>
			<tr>
        	<td colspan="2"></td>
			<td><?php echo $dxt['nama_claim']; ?></td>
			<td>Rp. <?php echo number_format($dxt['jnom']); ?></td>
			<td>Rp. <?php echo number_format($dxt['jnom']); ?></td>
			</tr>
    <?php 
	}
	?>
                         
							      <tr>
							      <th colspan="4">TOTAL PENGELUARAN</th>
								  <th>Rp. <?php 
								  $tpengl=$totln['nominal']+$totncs['debet']+$tclaim['jnom'];
								  echo number_format($tpengl); ?></th>
                              </tr>

							    
                              
							                                <tr>
							      <th colspan="4">LABA BERSIH SEBELUM PAJAK</th>
								  <th>Rp. <?php echo number_format(($omzet-$totahp['totahp'])-$tpengl); ?></th>
                              </tr>
							  <tr>
							      <th colspan="4">PPH Pasal 25 (1% dari pendapatan)</th>
								  <th>Rp. <?php echo number_format($pjk=($penjualan*1)/100); ?></th>
                              </tr>
							  							                                <tr>
							      <th colspan="4">LABA BERSIH SETELAH PAJAK</th>
								  <th>Rp. <?php 
								  $sbl_pjk=($omzet-$totahp['totahp'])-$tpengl;
								  echo number_format($sbl_pjk-$pjk); ?></th>
                              </tr>
                        
                          </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>