<?php 
$kode=$_POST['produk'];
if (isset($_POST['produk'])){
	("kode");
	$_SESSION['kode']=$kode;
	$insert=mysql_query("insert into tblkomposisi_produk (nama_produk) values ('$kode')");
}
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-12 col-md-offset-0 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Produk</h4>
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th colspan="4">Nama Produk</th> 
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td colspan="4"><?php echo $_SESSION['kode'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Bahan</th>
                                  <th>Jumlah</th>
								  <th>Harga</th>
								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="?page=inputing-komposisi-produk" method="POST">
							  			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlkomposisi_produk where nama_produk='$kd'");
			while($sql=mysql_fetch_array($s)){?>
							  <tr>
							  <td><?php echo $sql['nama_bahan']; ?></td><td><?php echo $sql['jumlah']; ?><?php echo $sql['satuan']; ?></td><td>Rp. <?php echo number_format($sql['harga']); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-komposisi-produk&kode=<?php echo $sql['nama_produk']; ?>&nama=<?php echo $sql['nama_bahan']; ?>">Hapus <i class="fa fa-trash-o "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from stok_bahan"); ?>
							  <select class="form-control" name="nama_bahan" data-rel="chosen" required="required">
							  <option>-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_bahan'] ?>"><?php echo $bar['nama_bahan']; } ?></option>
							  </select>
							  </td>
							  <td colspan="2"><input type="text" class="form-control" name="jumlah"></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
							  <form action="?page=akhir-komposisi-produk" method="POST">
							  <?php
		$qry_jumlah_a=mysql_query("SELECT SUM(harga) FROM dtlkomposisi_produk where nama_produk='$kd'");
        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
?>
<input type="hidden" name="kode" value="<?php echo $kd; ?>">
<input type="hidden" name="hargat" value="<?php echo $jumlah_jumlahjual; ?>">
<tr><td><h5><b>Jumlah Jadi :</b></h5></td><td><input type="text" class="form-control" name="jml_jadi"></td><td><h5><b>Rp. <?php
        echo number_format($jumlah_jumlahjual); 
        ?></b></h5></td></tr>
							  </tbody>
				</table>
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlkomposisi_produk where nama_produk='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-komposisi-produk&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
<?php }
?>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->