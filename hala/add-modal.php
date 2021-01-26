<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

<div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Modal</h4>
<form role="form" name="input-modal" action="?page=insert-modal" method="post">
<?php $select=mysql_query("SELECT * FROM tbltranslain WHERE kategori IN('kt1','kt2') AND keterangan NOT LIKE 'Depresiasi%'"); ?>
	<div class="form-group">
    <label for="jenis">Jenis Modal</label>
        <select class="form-control" name="jenis" data-rel="chosen" required="required">
<?php
$temu=mysql_fetch_assoc(mysql_query("SELECT * FROM modal where ktg='kas'"));
if ($temu){
?>
			<option value="Tambah Kas">Tambah Kas</option>
			<?php while ($bar=mysql_fetch_array($select)) { ?>
<option value="<?php echo $bar['keterangan'] ?>"><?php echo $bar['keterangan']; } ?></option>
<?php
} else {
?>
			<option value="Kas">Kas Modal</option>
<?php
}
?>
		</select>
    </div>
    <div class="form-group">
    <label for="jumlah">Jumlah</label>
        <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Modal" required="required">
    </div>
		
    <a class="btn btn-danger" href="?page=modal-awal"><i class="icon-remove"></i> Batal</a>
    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
</section><!--/#blog-->