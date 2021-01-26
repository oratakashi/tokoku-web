<?php
$ds    = mysql_query("SELECT * FROM setting WHERE iduser='{$_SESSION['id']}'");
$dt    = mysql_fetch_array($ds);
$jatem = $dt['jatuhtempo'];
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Rekap Piutang</b></h4>
<br>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.Transaksi</th>
                                            <th>Nama Pelanggan</th>
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
        $query = mysql_query("SELECT *,DATE_ADD(tgl, INTERVAL $jatem DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tgl, INTERVAL $jatem DAY), CURDATE()) as selisih FROM tblpenjualan WHERE kurang !='0' AND iduser='{$_SESSION['id']}' ORDER BY kode_penjualan ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['kode_penjualan']; ?></td>
		<td><?php echo $data['pelanggan']; ?></td>
        	<td>Rp. <?php echo number_format($data['total']); ?></td>
                <td>Rp. <?php echo number_format($data['bayar']); ?></td>
                <td>Rp. <?php echo number_format($data['kurang']); ?></td>
<td><?php echo $data['tgl']; ?></td>
<td><?php echo $data['jatuh_tempo']; ?></td>
<td><?php $selisih=0-$data['selisih'];
if ($selisih<=0){ echo $selisih; } else { echo "+".$selisih; } ?> Hari</td>
        	<td><a class="btn btn-success btn-xs" href="?page=pelunasan&kode=<?php echo $data['kode_penjualan']; ?>"><i class="icon-credit-card"></i> Pelunasan</a>
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
