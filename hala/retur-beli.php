<?php 
$kode    = $_POST['kode_rebeli'];
$supplier= $_POST['supplier'];
$tanggal = date("Y-m-d");

if (isset($_POST['kode_rebeli'])){
	("kode");
	$_SESSION['kode']=$kode;
	$_SESSION['supplier']=$supplier;
	$insert=mysql_query("insert into tblretur_beli (kode_rebeli,supplier,tgl) values ('$kode','$supplier','$tanggal')");
}
?>
<section>
        <div class="container">
            <div class="row">
	    <div class="col-lg-12">
<?php 
if (!empty($_GET['error']) && $_GET['error'] == 'tidak-cukup') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Jumlah barang yang diretur tidak sesuaai</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'habis') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Jumlah barang yang diretur tidak ada</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'barang') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Harga jual atau barang belum ada</strong>	
			</div>
</div>
<?php
;
}
?>
            </div>
            </div>
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Retur Pembelian Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th colspan="2">No.Retur</th> 
                                  <th colspan="2">Pelanggan</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $tanggal ; ?></td>
								  <td colspan="2">R-<?php echo $_SESSION['kode'] ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['supplier'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Barang</th>
                                  <th>Jumlah</th>
<th>Harga</th> 
								  <th>Sub Total (Rp)</th>
								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="?page=inputing-retur-beli" method="POST">
			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlretur_beli where kode_rebeli='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*$sql['harga'];
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_barang']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']);?></td><td>Rp. <?php echo number_format($subt); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-retur-beli&kode=<?php echo $sql['kode_rebeli']; ?>&nama=<?php echo $sql['nama_barang']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$kd'"); ?>
							  <select class="form-control" name="nama_barang" data-rel="chosen" required="required">
							  <option value="0">-Pilih Barang-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_bahan'] ?>"><?php echo $bar['nama_bahan']; } ?></option>
							  </select>
							  </td>
							  <td colspan="3"><input type="text" class="form-control" name="jumlah" Placeholder="Masukkan Jumlah Barang" required></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<form action="?page=akhir-returbeli" method="POST">
</tbody>
</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlretur_beli where kode_rebeli='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-returbeli&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
<?php }
?>
</form>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

