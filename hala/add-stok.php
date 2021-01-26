<?php 
if(isset($_POST['cari'])) {
$id_barang=$_POST['brg'];
$slect=mysql_query("select * from stok_bahan where id_bahan='$id_barang'");
$plih=mysql_fetch_array($slect);
$namabarang = $plih['nama_bahan'];
}
$iduser     = $_SESSION['id'];
$kode = @$_POST['kode'];
$tanggal = @$_POST['tanggal'];
$ketmod  = @$_POST['ketmod'];
$ktg     = @$_POST['ktg'];
if (isset($_POST['kode'])){
	("kode");
	$_SESSION['kode']=$kode;
	$_SESSION['tanggal']=$tanggal;
	$_SESSION['ketmod']=$ketmod;
	$_SESSION['ktg']=$ktg;
$insert=mysql_query("insert into tbltambah_stok(kode_stok,iduser,ketmod,tanggal) values ('$kode','$iduser','$ketmod','$tanggal')");
}
?>
<section>
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Tambah Stok Barang
                        </div>
                        <div class="panel-body">
<form name="cari" method="POST" action="?page=add-stok">
<?php $selectj=mysql_query("select * from stok_bahan where iduser='{$_SESSION['id']}'"); ?>
							  <table><tr><td><select class="form-control chzn-select" tabindex="2" name="brg" data-rel="chosen" required="required">
							  <option value="0">-Pilih Barang-</option>
							  <?php while ($barj=mysql_fetch_array($selectj)) { ?>
							  <option value="<?php echo $barj['id_bahan'] ?>"><?php echo $barj['brcode'] ?> - <?php echo $barj['nama_bahan']; } ?></option>
							  </select></td><td>
<button type="submit" name="cari" value="cari" class="btn btn-success btn-xs">Tambahkan <i class="icon-plus-sign"></i></button></td></tr></table>
</form>
<br>
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
								  <th colspan="5">Tanggal</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td colspan="5"><?php echo $_SESSION['tanggal']; ?></td>

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
<form action="?page=inputing-tambah-stok" method="POST">
<?php
$kd=$_SESSION['kode'];
$s=mysql_query("select * from dtltambah_stok where kode_stok='$kd'");
while($sql=mysql_fetch_array($s)){
$subt=$sql['jumlah']*($sql['harga']+$sql['ppn']);
$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_bahan']; ?></td>
							  <td><?php echo $sql['jumlah']; ?></td>
							  <td>Rp. <?php echo number_format($sql['harga']+$sql['ppn']);?></td>
							  <td>Rp. <?php echo number_format($subt); ?></td>
							  <td><a class="btn btn-danger btn-xs" href="?page=del-tambah-stok&kode=<?php echo $sql['kode_stok']; ?>&id=<?php echo $sql['id_bahan']; ?>">Hapus <i class="fa fa-trash-o "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td><input type="text" class="form-control" name="nama_barang" value="<?php echo @$namabarang;?>" required="required">
							  <input type="hidden" name="id_barang" value="<?php echo @$id_barang; ?>">
							  
							  </td>
							  <td><input type="text" class="form-control" name="jumlah" required="required"></td><td><input type="text" class="form-control" name="harga">
							  <span>*Kosongkan jika harga beli sama</span>
							  </td><td><!--<b><input type="checkbox" id="ch1" name="ppn" value="ppn" /> PPN 10%</b>--></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<form action="?page=akhir-tambah-stok" method="POST">
							  <td colspan="3"><h2>TOTAL</h2></td><td <td colspan="2"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
							  </tbody>
				</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>">
<input type="hidden" name="total" value="<?php echo $total; ?>">
<input type="hidden" name="ketmod" value="<?php echo $_SESSION['ketmod']; ?>">
<input type="hidden" name="tanggal" value="<?php echo $_SESSION['tanggal']; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtltambah_stok where kode_stok='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-tambah-stok&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
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