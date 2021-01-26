<?php 
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM stok_bahan WHERE id_bahan='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-pencil"></i> Edit Barang</h4>
<form role="form" name="edit-barang" action="?page=update-barang" enctype="multipart/form-data" method="post">
<input type="hidden" name="idbahan" value="<?php echo $id;?>">
                    <div class="form-group">
                        <label for="namabahan">Nama Barang</label>
                        <input type="text" class="form-control" name="namabahan" value="<?php echo $data['nama_bahan'];?>" required="required">
                    </div>
                    <!--<div class="form-group">
                        <label for="namabahan">Discount</label>
                        <input type="text" class="form-control" name="discount" value="<?php echo $data['discount'];?>" data-mask="99%" required="required">
                    </div>-->
					<!--<div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" name="satuan" value="<?php echo $data['satuan'];?>" required="required">
                    </div>
					<div class="form-group">-->
					<div class="form-group">
                        <label for="suplier">Suplier</label>
<?php $select=mysql_query("SELECT * FROM tblsatuan WHERE iduser='{$_SESSION['id']}'"); ?>
                        <select class="form-control" name="satuan" data-rel="chosen" required="required">
						<option>-Pilih Satuan-</option>
<?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['namasatuan'] ?>" <?php if ($bar['namasatuan']==$data['satuan']) { echo 'selected';}?>><?php echo $bar['namasatuan'];?></option>
							  <?php } ?>
							  </select>
                    </div>
<!--<div class="form-group">
<label for="Expired Date">Expired Diskon</label>
                <input type="text" class="form-control" name="expired" id="dp4" data-date-format="yyyy-mm-dd" value="<?php echo $data['expired'];?>"></div>	-->
                    
<div class="form-group">
                        <label for="hargab">Harga Beli</label>
                        <input type="text" class="form-control" value="<?php echo $data['harga_per'];?>" <?php if ($data['harga_per']==0) { echo 'name="haper"'; } else { echo 'readonly';}?>>
                    </div>
<div class="form-group">
                        <label for="hargaj">Harga Jual Umum</label>
                        <input type="text" class="form-control" name="hargaj" value="<?php echo $data['hargaj'];?>" required="required">
                    </div>
<div class="form-group">
                        <label for="hargag1">Harga Jual Grosir</label>
                        <input type="text" class="form-control" name="hargag1" value="<?php echo $data['hargag1'];?>" required="required">
                    </div>
<!--<div class="form-group">
                        <label for="hargag2">Harga Jual Distributor</label>
                        <input type="text" class="form-control" name="hargag2" value="<?php echo $data['hargag2'];?>" required="required">
                    </div>-->
                    <a class="btn btn-danger" href="?page=stok-barang"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->