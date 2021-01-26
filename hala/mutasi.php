<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Mutasi Barang</h4>
                  	  <form role="form" name="input-pembelian-bahan" action="?page=detail-mutasi" method="POST">
					<div class="form-group">
                        <label for="suplier">Barang</label>
<?php 
$today= date("Y-m-d");
$select=mysql_query("select * from stok_bahan"); ?>
                        <select class="form-control" name="barang" data-rel="chosen" required="required">
<?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_bahan'] ?>"><?php echo $bar['nama_bahan']; } ?></option>
							  </select>
                    </div>
                    <div class="form-group">
                        <label for="Usahaname">Periode sampai tanggal</label>
                        <input type="text" name="sampai" class="form-control" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php echo $today;?>">
                
                    </div>
<br>
<br>
<br>
<br>
                    <a class="btn btn-danger" href="?page=stok-barang"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->