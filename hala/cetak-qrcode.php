<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Cetak QRcode Barang</h4>
<form role="form" name="created-barcode" action="../pratiwi/multiple-qrcode.php" method="POST" target="_blank">
					
<div class="form-group">
    <label for="Nama Barang">Nama Barang</label>
<?php
$option=mysql_query("select * from stok_bahan where brcode!=''");
?>
        <select data-placeholder="Nama Barang" name="qrcode[]" multiple class="form-control chzn-select" tabindex="8">
		
						<?php while ($bar1=mysql_fetch_array($option)) { ?>
						  <option value="<?php echo $bar1['brcode'] ?>"><?php echo $bar1['nama_bahan']; ?></option>
<?php } ?>
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