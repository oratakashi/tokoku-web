<?php 
$id = $_GET['id'];
$query = mysql_query("select * from modal where idmod='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

<div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Modal</h4>
<form role="form" name="update-modal" action="?page=update-modal" method="post">
<input type="hidden" name="id" value="<?php echo $data['idmod'];?>">
<?php $select=mysql_query("SELECT * FROM tbltranslain WHERE kategori IN('kt1','kt2') AND keterangan NOT LIKE 'Depresiasi%'"); ?>
	<div class="form-group">
    <label for="jenis">Jenis Modal</label>
<input type="text" class="form-control" name="jenis" value="<?php echo $data['ketmod'];?>" readonly>
    </div>
    <div class="form-group">
    <label for="jumlah">Jumlah</label>
        <input type="text" class="form-control" name="jumlah" value="<?php echo $data['jmlmod'];?>" required="required">
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