<?php 
$kode    = $_GET['kode'];
$qrr=mysql_query("select * from tbltransaksi where kode_tran='$kode'");
$de=mysql_fetch_array($qrr);
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-6 col-md-offset-3 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Detail Pengeluaran
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				              <th>Tanggal</th>
                              <th>No.Transaksi</th> 
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $de['tgl']; ?></td>
								  <td><?php echo $kode ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Transaksi</th>
								  <th>Nominal</th>
                              </tr>
							  </thead>
							  <tbody>
			<?php $kd=$kode;
			$s=mysql_query("select * from dtltransaksi where kode_tran='$kd'");
			while($sql=mysql_fetch_array($s)){
?>
							  <tr>
							  <td><?php echo $sql['nama_tran']; ?></td>
							  <td>Rp. <?php echo number_format($sql['nominal']); ?></td>
							  </tr>
							  <?php } ?>

<td><b>Sub TOTAL</b></td><td><b>Rp. <?php 
$qry_jumlah_a=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE kode_tran='$kd'");
$data_a=mysql_fetch_array($qry_jumlah_a);
$total=$data_a[0];
echo number_format($total); ?></b></td>
</tbody>
</table>
<a class="btn btn-danger" href="?page=rekap-pengeluaran"><i class="icon-times"></i> Keluar</a>
</tbody>
</table>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>