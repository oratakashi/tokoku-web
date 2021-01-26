<?php
$barang=$_POST['barang'];

$quer = mysql_query("SELECT * FROM dtlpembelian_bahan WHERE nama_bahan='$barang'");
$dt=mysql_fetch_array($quer);

$today= date("Y-m-d");
$tgla = $dt['tgl'];
$tglb = $_POST['sampai'];

$query1 = mysql_query("SELECT * FROM dtlpembelian_bahan WHERE nama_bahan='$barang' AND tgl BETWEEN '$tgla' AND '$tglb'");
$query2 = mysql_query("SELECT * FROM dtlpenjualan WHERE nama_barang='$barang' AND tgl BETWEEN '$tgla' AND '$tglb'");

?>


<section>
        <div class="container">
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> <b>MUTASI <?php echo $barang; ?> PER <?php echo $tglb; ?></b>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No.Transaksi</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php	
while ($data1 = mysql_fetch_array($query1)) {
?>
    	<tr>
        <td><?php echo $data1['tgl']; ?></td>
        <td><?php echo $data1['kode_pembelian']; ?></td>
		<td>+<?php echo $data1['jumlah']; ?></td>
        </tr>
<?php 
} 
?>
<?php	
while ($data2 = mysql_fetch_array($query2)) {
?>
    	<tr>
        <td><?php echo $data2['tgl']; ?></td>
        <td><?php echo $data2['kode_penjualan']; ?></td>
		<td>-<?php echo $data2['jumlah']; ?></td>
        </tr>
<?php 
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