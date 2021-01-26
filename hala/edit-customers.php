<?php 
$id = $_GET['id'];
$query = mysql_query("select * from tblcustomers where id_customers='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Pelanggan</h4>
<form role="form" name="edit-customers" action="?page=update-customers" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="idcustomers" value="<?php echo $id;?>" readonly>
                    </div>
                        <div class="form-group">
                        <label for="namabahan">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="namacustomers" value="<?php echo $data['nama_customers'];?>" required="required">
                    </div>
                        <div class="form-group">
                        <label for="Nama Perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="namaperh" value="<?php echo $data['persh'];?>" required="required">
                    </div>
                        <div class="form-group">
                        <label for="Project">Project</label>
                        <input type="text" class="form-control" name="project" value="<?php echo $data['proyek'];?>" required="required">
                    </div>
		   <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat_customers'];?>" required="required">
                    </div>
<div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input type="text" class="form-control" name="telp" value="<?php echo $data['telp'];?>" required="required">
                    </div>
<div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $data['surel'];?>">
                    </div>	
<div class="form-group">
					<label for="Status">Status</label>
					<select class="form-control" name="status">
						<option value="">-</option>
						<option value="prospek"<?php if ($data['jenis']=='prospek'){echo 'selected';} ?>>Prospek</option>
						<option value="pelanggan"<?php if ($data['jenis']=='pelanggan'){echo 'selected';} ?>>Pelanggan</option>
						</select>
						
</div>
                    <div class="form-group">
                    <a class="btn btn-danger" href="?page=list-customers"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->