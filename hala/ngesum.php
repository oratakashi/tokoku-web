<?php
$query = mysql_query("SELECT * ,SUM(dtlpembelian_bahan.jml*stok_bahan.harga_per)  FROM dtlpembelian_bahan LEFT JOIN stok_bahan ON dtlpembelian_bahan.nama_bahan=stok_bahan.nama_bahan GROUP BY dtlpembelian_bahan.nama_bahan, tgl");
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
<th>Nama Barang</th>
<th>Harga</th>
<th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php	
while ($data = mysql_fetch_array($query)) {
?>
    	<tr>
        <td><?php echo $data['tgl']; ?></td>
        <td><?php echo $data['kode_pembelian']; ?></td>
		<td><?php echo $data['jml']; ?></td>
<td><?php echo $data['nama_bahan']; ?></td>
<td><?php echo $data['harga_per']; ?></td>
<td><?php echo $data['harga_per']*$data['jml']; ?></td>
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