<?php 
$tanggal = date("Y-m-d");
if (isset($_POST['kode_tran'])){
	$kode    = $_POST['kode_tran'];
	$_SESSION['kode']=$kode;
	$insert=mysql_query("insert into tbltransaksi (kode_tran,iduser,tgl) values ('$kode','{$_SESSION['id']}','$tanggal')");
}
?>
<section>
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Transaksi Lainnya
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
								  <th>Tanggal</th>
                                  <th colspan="2">No.Transaksi</th> 
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $tanggal ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['kode'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Transaksi</th>
                                  <th>Nominal</th>
								  								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="?page=inputing-transaksi" method="POST">
			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtltransaksi where kode_tran='$kd' and iduser='{$_SESSION['id']}'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['nominal'];
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_tran']; ?></td>
							  <td>Rp. <?php echo number_format($subt); ?></td>
							  <td><a class="btn btn-danger btn-xs" href="?page=del-input-transaksi&kode=<?php echo $sql['kode_tran']; ?>&nama=<?php echo $sql['idtran']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from tbltranslain where iduser='{$_SESSION['id']}'"); ?>
							  <select class="form-control" name="nama_tran" data-rel="chosen" required="required">
							  <option value="0">-Pilih Transaksi-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['id_trnlain'] ?>"><?php echo $bar['keterangan']; } ?></option>
							  </select>
							  </td>
							  <td><input type="text" class="form-control" name="nominal" Placeholder="Masukkan Nominal" required></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<form action="?page=akhir-transaksi" method="POST">
<td><h2>TOTAL</h2></td><td colspan="2"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
							  </tbody>
				</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<a class="btn btn-danger" href="?page=batal-transaksi&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
</form>				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>