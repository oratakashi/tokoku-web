<?php 
$kode    = @$_POST['kode_pembelian'];
$suplier = @$_POST['suplier'];
$tanggal = @$_POST['tanggal'];
//$faktur	 = @$_POST['faktur'];
$tempo	 = @$_POST['tempo'];

if (isset($_POST['kode_pembelian'])){
	("kode");
	$_SESSION['kode']=$kode;
	$_SESSION['suplier']=$suplier;
$_SESSION['tglbeli']=$tanggal;
	$insert=mysql_query("insert into tblpembelian_bahan (kode_pembelian,suplier,tanggal,tempo) values ('$kode','$suplier','$tanggal','$tempo')");
}
?>
<section>
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Pembelian Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
								  <th>Tanggal</th>
                                  <th colspan="2">No.Order</th> 
                                  <th colspan="2">Suplier</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $_SESSION['tglbeli'] ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['kode'] ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['suplier'] ; ?></td>
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
							  <form action="?page=inputing-pembelian-bahan" method="POST">
							  			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*($sql['harga']+$sql['ppn']);
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_bahan']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']+$sql['ppn']);?></td><td>Rp. <?php echo number_format($subt); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-pembelian-bahan&kode=<?php echo $sql['kode_pembelian']; ?>&nama=<?php echo $sql['nama_bahan']; ?>">Hapus <i class="fa fa-trash-o "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <input type="text" class="form-control" name="nama_bahan" required="required">
							  <!--<?php $select=mysql_query("select * from stok_bahan"); ?>
							  <select class="form-control chzn-select" tabindex="2" name="nama_bahan" data-rel="chosen" required="required">
							  <option>-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_bahan'] ?>"><?php echo $bar['brcode'] ?> - <?php echo $bar['nama_bahan']; } ?></option>
							  </select>-->
							  </td>
							  <td><input type="text" class="form-control" name="jumlah"></td><td><input type="text" class="form-control" name="harga"></td>
<!--<td>
<b><input type="radio" name="ppn" value="noppn" /> No PPN</b><br>
<b><input type="radio" name="ppn" value="ppn" /> + PPN</b><br>
<b><input type="radio" name="ppn" value="inppn" /> Inc PPN</b>
</td>-->						  <td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<form action="?page=akhir-pembelian-bahan" method="POST">
							  <td colspan="3"><b>TOTAL</b></td><td <td colspan="2"><b>Rp. <?php echo number_format(@$total); ?></b></td>
<!--<tr><td colspan="3"><b>DISCOUNT</b></td><td colspan="2"><b><input type="text" name="discount" class="form-control"></b></td></tr>-->
<tr><td colspan="3"><b>BAYAR</b></td><td colspan="2"><b><input type="text" name="bayar" class="form-control"></b></td></tr>
							  </tbody>
				</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-pembelian-bahan&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
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