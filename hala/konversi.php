<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">
                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Konversi Barang</h4>
<form role="form" name="konvert2" action="?page=konvert-step2" method="post">
    <div class="form-group">
<?php $select=mysql_query("select * from stok_bahan"); ?>
							  <select class="form-control chzn-select" tabindex="2"  name="id_barang" data-rel="chosen" required="required">
							  <option value="0">-Pilih Barang-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['id_bahan'] ?>"><?php echo $bar['nama_bahan']; } ?></option>
							  </select>
    </div>
        <a class="btn btn-danger" href="?page=stok-barang"><i class="icon-remove"></i> Batal</a>
        <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
</form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
</section><!--/#blog-->