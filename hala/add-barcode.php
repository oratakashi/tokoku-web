<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Barcode Barang</h4>
<form role="form" name="created-barcode" action="?page=created-barcode" method="post">
					<div class="form-group">
                        <label for="Barcode">Barcode</label>
                        <input type="text" class="form-control" name="brcode" placeholder="Enter Barcode">
                    </div>
                    <div class="form-group">
                        <label for="Nama Barang">Nama Barang</label>
                        <?php $select=mysql_query("select * from stok_bahan where brcode=''"); ?>
							  <select class="form-control chzn-select" tabindex="2" name="id_barang" data-rel="chosen" required="required">
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