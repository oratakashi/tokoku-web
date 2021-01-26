<?php 
$kode    = $_GET['id'];
$tanggal = date("Y-m-d");
$qrr=mysql_query("select * from modal where idmod='$kode'");
$de=mysql_fetch_array($qrr);
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Rincian Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th colspan="2">Persediaan</th> 
                                  <th>Jumlah</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $de['tglmod']; ?></td>
								  <td colspan="2"><?php echo $de['ktg']; ?></td>
								  <td>Rp. <?php echo number_format($de['jmlmod']); ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Barang</th>
                                  <th>Qty</th>
<th>Harga</th> 
								  <th>Jumlah</th>
                              </tr>
							  </thead>
							  <tbody>
			<?php $kd=$de['ktg'];
			$s=mysql_query("select * from dtltambah_stok WHERE kode_stok = '$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*$sql['harga'];
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_bahan']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']);?></td><td>Rp. <?php echo number_format($subt); ?></td>
							  </tr>
							  <?php } ?>
</tbody>
</table>
<a class="btn btn-danger" href="?page=modal-awal">Keluar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>