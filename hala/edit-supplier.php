<?php 
$id = $_GET['id'];
$query = mysql_query("select * from tblsupplier where id_supplier='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Supplier</h4>
<form role="form" name="edit-supplier" action="?page=update-supplier" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="idsupplier" value="<?php echo $id;?>" readonly>
                    </div>
                        <div class="form-group">
                        <label for="namabahan">Nama Supplier</label>
                        <input type="text" class="form-control" name="namasupplier" value="<?php echo $data['nama_supplier'];?>" required="required">
                    </div>				
		   <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat_supplier'];?>" required="required">
                    </div>
<div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input type="text" class="form-control" name="telp" value="<?php echo $data['telp'];?>" required="required">
                    </div>			
                    <a class="btn btn-danger" href="?page=list-supplier"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->