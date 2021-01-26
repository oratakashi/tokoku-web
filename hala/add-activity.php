<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Add Activity</h4>
                    <form role="form"name="input-activity" action="?page=insert-activity" enctype="multipart/form-data" method="post">
<div class="form-group">
                        <label for="pelanggan">Pelanggan</label>
<?php 
$submiter = $_SESSION['nama'];
if ($_SESSION['level']=='sales') {
$select=mysql_query("select * from tblquotation where act = 'N' and submiter='$submiter'"); 
} else {
$select=mysql_query("select * from tblquotation where act = 'N'"); 
}
?>
                        <select class="form-control" name="kode" data-rel="chosen" required="required">
<?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['kode_quotation'] ?>"><?php echo $bar['kode_quotation']; } ?></option>
							  </select>
                    </div>
<div class="form-group">
                    <label for="menu1">Keterangan</label>
                        <textarea id="autosize" name="ket" class="form-control"></textarea>
            </div>
                    
                    <a class="btn btn-danger" href="?page=daily-report"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->