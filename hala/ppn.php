<?php
$today= date("Y-m-d");
$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
$qjual=mysql_query("SELECT * FROM tblpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan WHERE tanggal BETWEEN '$tgla' AND '$tglb'");

$qry_tpm=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_tpm=mysql_fetch_array($qry_tpm);
$jumlah_tpm=$data_tpm[0];

$qry_tpk=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$data_tpk=mysql_fetch_array($qry_tpk);
$jumlah_tpk=$data_tpk[0];
} else {
$qjual=mysql_query("SELECT * FROM tblpenjualan");
$qbeli=mysql_query("SELECT * FROM tblpembelian_bahan");

$qry_tpm=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan");
$data_tpm=mysql_fetch_array($qry_tpm);
$jumlah_tpm=$data_tpm[0];

$qry_tpk=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan");
$data_tpk=mysql_fetch_array($qry_tpk);
$jumlah_tpk=$data_tpk[0];
}	
?>
	<section>
        <div class="container">
		<div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan PPn</b></h4>
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
        <a href="<?php if (!empty($tgla)&&!empty($tglb)){?>print-ppn.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>print-ppn.php<?php } ?>" class="btn btn-success pull-right" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
                </div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
								<thead>
                                        <tr>
                                            <th colspan="5">PPN KELUARAN</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
											<th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php

while ($jualan = mysql_fetch_array($qjual)) {
?>
                                      <tr>
        	                           <td></td>
                                       <td><?php echo $jualan['tgl'];?></td>
									   <td><?php echo $jualan['kode_penjualan'];?></td>
		                               <td><?php echo $jualan['tgl'];?></td>
                                       <td>Rp. <?php 
$kd=$jualan['kode_penjualan'];
$qry_ppn=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpenjualan WHERE kode_penjualan = '$kd'");
$data_ppn=mysql_fetch_array($qry_ppn);
$jumlah_ppn=$data_ppn[0];
									   echo number_format($jumlah_ppn);?></td>
        	                          </tr>
<?php 
} 
?> 
                                        <tr>
                                            <th colspan="4">TOTAL PPN KELUARAN</th>
											<th>Rp. <?php echo number_format($jumlah_tpm);?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5">PPN MASUKKAN</th>
                                        </tr>
										<tr>
                                            <th>No.</th>
											<th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                        </tr>
<?php

while ($pbeli = mysql_fetch_array($qbeli)) {
?>
                                      <tr>
        	                           <td></td>
                                       <td><?php echo $pbeli['tanggal'];?></td>
									   <td><?php echo $pbeli['kode_pembelian'];?></td>
		                               <td><?php echo $pbeli['tanggal'];?></td>
                                       <td>Rp. <?php 
$kt=$pbeli['kode_pembelian'];
$qy_ppn=mysql_query("SELECT SUM(jumlah*ppn) FROM dtlpembelian_bahan WHERE kode_pembelian = '$kt'");
$dt_ppn=mysql_fetch_array($qy_ppn);
$jml_ppn=$dt_ppn[0];
									   echo number_format($jml_ppn);?></td>
        	                          </tr>
<?php 
} 
?> 
                                        <tr>
                                            <th colspan="4">TOTAL PPN MASUKKAN</th>
											<th>Rp. <?php echo number_format($jumlah_tpk);?></th>
                                        </tr>
<tr>
                                            <th colspan="4">JUMLAH PPN YG DIBAYAR</th>
											<th>Rp. <?php echo number_format($jumlah_tpm-$jumlah_tpk);?></th>
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