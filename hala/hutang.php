<?php
$ds    = mysql_query("SELECT * FROM setting");
$dt    = mysql_fetch_array($ds);
$jatem = $dt['jatuhtempo'];
$today = date("Y-m-d");
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
		<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Rekap Hutang</b></h4>
<br>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.Pembelian</th>
                                            <th>Nama Supplier</th>
                                            <th>Total Tagihan</th>
                                            <th>Total Terbayar</th>
                                            <th>Kurang Bayar</th>
                                            <th>Tanggal</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Selisih</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
        $query = mysql_query("SELECT *,DATE_ADD(tanggal, INTERVAL $jatem DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tanggal, INTERVAL $jatem DAY), CURDATE()) as selisih FROM tblpembelian_bahan WHERE kurang !='0' ORDER BY kode_pembelian ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['kode_pembelian']; ?></td>
		<td><?php echo $data['suplier']; ?></td>
        	<td>Rp. <?php echo number_format($data['total']); ?></td>
                <td>Rp. <?php echo number_format($data['bayar']); ?></td>
                <td>Rp. <?php echo number_format($data['kurang']); ?></td>
<td><?php echo $data['tanggal']; ?></td>
<td><?php echo $data['jatuh_tempo']; ?></td>
<td><?php $selisih=0-$data['selisih'];
if ($selisih<=0){ echo $selisih; } else { echo "+".$selisih; } ?> Hari</td>
        	<td><a class="btn btn-success btn-xs" href="?page=pelunasan-utang&kode=<?php echo $data['kode_pembelian']; ?>"><i class="icon-credit-card"></i> Pelunasan</a>
			</td>
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