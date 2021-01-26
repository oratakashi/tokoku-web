<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
$query = mysql_query("SELECT * FROM tblpenjualan WHERE bayar != '0' AND tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_penjualan ASC ");
} else {
$query = mysql_query("SELECT * FROM tblpenjualan WHERE bayar != '0' ORDER BY kode_penjualan ASC ");
}
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                <form role="form" name="period" action="" method="post">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo "0000-00-00";} else { echo $tgla; }?>">
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" class="btn btn-success btn-xs">OK</button>
                </form>
                </div>
            </div>
              <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Kwitansi
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.Transaksi</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['kode_penjualan']; ?></td>
        	<td><?php echo $data['pelanggan']; ?></td>
        	<td><table width="100%">
<?php	
$kd=$data['kode_penjualan'];
$wer=mysql_query("SELECT * FROM dtlpelunasan WHERE kode_penjualan='$kd' ");
while ($dx = mysql_fetch_array($wer)) {
?>
<tr><td><?php echo $dx['tgl']; ?></td><td>Rp. <?php echo number_format($dx['bayar']); ?></td><td><a class="btn btn-info btn-xs" href="kwitansi.php?kode=<?php echo $data['kode_penjualan']; ?>&tgl=<?php echo $dx['tgl']; ?>&nom=<?php echo $dx['bayar']; ?>&pelanggan=<?php echo $data['pelanggan']; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
  
			</td></tr>
<?php } ?></table></td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                  </tbody>
                               </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>