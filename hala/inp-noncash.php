<?php 
$kode    = @$_POST['kode_ncs'];

$tanggal = date("Y-m-d");

if (isset($_POST['kode_ncs'])){
	("kode");
	$_SESSION['kode']=$kode;

	$insert=mysql_query("insert into tblnoncash (kode_ncs,tgl) values ('$kode','$tanggal')");
}
?>
<section>
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Transaksi Non-Cash
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
								  <td colspan="3"><?php echo $_SESSION['kode'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Transaksi</th>
                                  <th>Debet</th>
								  <th>Kredit</th>
								  								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="?page=inputing-noncash" method="POST">
			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlnoncash where kode_ncs='$kd'");
			while($sql=mysql_fetch_array($s)){
			$deb=$sql['debet'];
			$cred=$sql['kredit'];
			$total_d=@$total_d+$deb;
           $total_c=@$total_c+$cred;
			?>
							  <tr>
							  <td><?php echo $sql['nama_ncs']; ?></td><td>Rp. <?php echo number_format($deb); ?></td><td>Rp. <?php echo number_format($cred); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-noncash&kode=<?php echo $sql['kode_ncs']; ?>&nama=<?php echo $sql['nama_ncs']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from tbltranslain where kategori IN ('kt1', 'kt2', 'kt3')"); ?>
							  <select class="form-control" name="nama_ncs" data-rel="chosen" required="required">
							  <option value="0">-Pilih Transaksi-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['keterangan'] ?>"><?php echo $bar['keterangan']; } ?></option>
							  </select>
							  </td>
							  <td><input type="text" class="form-control" name="debet" Placeholder="Masukkan Debet" required></td><td><input type="text" class="form-control" name="kredit" Placeholder="Masukkan Kredit" required></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<form action="?page=akhir-noncash" method="POST">
<td><h2>TOTAL</h2></td><td><h2>Rp. <?php echo number_format(@$total_d); ?></h2></td><td colspan="2"><h2>Rp. <?php echo number_format(@$total_c); ?></h2></td>
							  </tbody>
				</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>">
<input type="hidden" name="debet" value="<?php echo $total_d; ?>">
<input type="hidden" name="kredit" value="<?php echo $total_c; ?>">
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<a class="btn btn-danger" href="?page=batal-noncash&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
</form>				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>