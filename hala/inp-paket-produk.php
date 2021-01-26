<?php 
$kode=@$_POST['paket'];
if (isset($_POST['paket'])){
	("kode");
	$_SESSION['kode']=$kode;
	$insert=mysql_query("insert into tblpaket_produk (paket_produk) values ('$kode')");
}
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-12 col-md-offset-0 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Paket</h4>
					  <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th colspan="4">Paket Produk</th> 
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td colspan="4"><?php echo $_SESSION['kode'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Produk</th>
                                  <th>Jumlah</th> 
								  <th>Harga</th> 
								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="?page=inputing-paket-produk" method="POST">
							  			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlpaket_produk where paket_produk='$kd'");
			while($sql=mysql_fetch_array($s)){?>
							  <tr>
							  <td><?php echo $sql['nama_produk']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-paket-produk&kode=<?php echo $sql['paket_produk']; ?>&nama=<?php echo $sql['nama_produk']; ?>">Hapus <i class="fa fa-trash-o "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from tblkomposisi_produk"); ?>
							  <select class="form-control" name="nama_produk" data-rel="chosen" required="required">
							  <option>-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_produk'] ?>"><?php echo $bar['nama_produk']; } ?></option>
							  </select>
							  </td>
							  <td colspan="2"><input type="text" class="form-control" name="jumlah"></td><td colspan="2"><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="glyphicon glyphicon-plus-sign"></i></button></form></td></tr>
							  <tr><td colspan="2"><h5><b>HPP :</b></h5></td><td colspan="2"><h5><b>Rp. <?php
        $qry_jumlah_a=mysql_query("SELECT SUM(harga) FROM dtlpaket_produk where paket_produk='$kd'");
        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
        echo number_format($jumlah_jumlahjual); 
        ?></b></h5></td></tr>
		<form action="?page=akhir-paket-produk" method="POST">
<input type="hidden" name="paket" value="<?php echo $kd; ?>">
<input type="hidden" name="hpp" value="<?php echo $jumlah_jumlahjual; ?>">
<tr><td colspan="2"><h5><b>Harga Jual :</b></h5></td><td colspan="2"><input type="text" class="form-control" name="hargaj"></td></tr>
							  </tbody>
				</table>

<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlpaket_produk where paket_produk='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-paket-produk&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
<?php }
?>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->