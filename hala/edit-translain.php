<?php 
$id = $_GET['id'];
$query = mysql_query("select * from tbltranslain where id_trnlain='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

<div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Jenis Transaksi Lainnya</h4>
<form role="form" name="input-translain" action="?page=update-translain" method="post">
<input type="hidden" name="id" value="<?php echo $data['id_trnlain'];?>">			
	<div class="form-group">
    <label for="kategori">Kategori Jenis Transaksi</label>
        <select class="form-control" name="kategori" data-rel="chosen" required="required">
			<option value="kt1"<?php if ($data['kategori']=='kt1'){echo 'selected';} ?>>Inventaris</option>
			<option value="kt2"<?php if ($data['kategori']=='kt2'){echo 'selected';} ?>>Biaya dibayar dimuka</option>
			<option value="kt3"<?php if ($data['kategori']=='kt3'){echo 'selected';} ?>>Biaya-biaya</option>
			<option value="kt4"<?php if ($data['kategori']=='kt4'){echo 'selected';} ?>>Hutang</option>
			<option value="kt5"<?php if ($data['kategori']=='kt5'){echo 'selected';} ?>>Biaya atas pendapatan</option>
			<option value="kt6"<?php if ($data['kategori']=='kt6'){echo 'selected';} ?>>Pendapatan lainnya</option>
			<option value="kt7"<?php if ($data['kategori']=='kt7'){echo 'selected';} ?>>Biaya atas pendapatan lainnya</option>
			<option value="kt8"<?php if ($data['kategori']=='kt8'){echo 'selected';} ?>>Biaya Operasional Sales</option>
		</select>
    </div>
    <div class="form-group">
    <label for="translain">Keterangan</label>
        <input type="text" class="form-control" name="keterangan" value="<?php echo $data['keterangan'];?>" required="required">
    </div>
		
    <a class="btn btn-danger" href="?page=add-trans-lain"><i class="icon-remove"></i> Batal</a>
    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->