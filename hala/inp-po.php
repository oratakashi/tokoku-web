<?php 
$kode    = $_POST['kode_po'];
$pelanggan= $_POST['pelanggan'];
$tanggal = date("Y-m-d");
$submiter= $_POST['submiter'];

if (isset($_POST['kode_po'])){
	("kode");
	$_SESSION['kode']=$kode;
	$_SESSION['pelanggan']=$pelanggan;
	$insert=mysql_query("insert into tblpo (kode_po,pelanggan,tgl,status,submiter) values ('$kode','$pelanggan','$tanggal','N','$submiter')");
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
				<i class="icon-warning-sign"></i> <strong>Persediaan barang tidak mencukupi</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'habis') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Persediaan barang habis</strong>	
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
                            <i class="icon-user"></i> Order
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th colspan="2">No.Order</th> 
                                  <th colspan="2">Pelanggan</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $tanggal ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['kode'] ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['pelanggan'] ; ?></td>
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
							  <form action="?page=inputing-po" method="POST">
			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlpo where kode_po='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*($sql['harga']+$sql['ppn']);
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_barang']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']+$sql['ppn']);?></td><td>Rp. <?php echo number_format($subt); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-po&kode=<?php echo $sql['kode_po']; ?>&nama=<?php echo $sql['nama_barang']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from stok_bahan"); ?>
							  <select class="form-control" name="nama_barang" data-rel="chosen" required="required">
							  <option value="0">-Pilih Barang-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_bahan'] ?>"><?php echo $bar['nama_bahan']; } ?></option>
							  </select>
							  </td>
							  <td colspan="2"><input type="text" class="form-control" name="jumlah" Placeholder="Masukkan Jumlah Barang" required></td><td><input type="hidden" name="ppn" value="ppn" /></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>

<?php 
$tm=mysql_fetch_assoc(mysql_query("select * from tblpo where kode_po='$kd' and total!=0")); 
if ($tm){
	$gt=mysql_fetch_array(mysql_query("select * from tblpo where kode_po='$kd'")); 
?>
<td colspan="3"><b>TOTAL</b></td><td colspan="2"><b>Rp. <?php echo number_format(@$total); ?></b></td>
</tbody>
</table>
<a class="btn btn-danger" href="index.php"><i class="icon-times"></i> Close</a>
<a class="btn btn-default" href="invoice.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
<?php
} else {
?>

<td colspan="3"><h2>TOTAL</h2></td><td colspan="2"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
<form action="?page=akhir-po" method="POST">
</tbody>
</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlpo where kode_po='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-po&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
<?php }
?>
</form>
<?php
}
?>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>