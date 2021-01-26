<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">
                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Barang</h4>
				<form role="form" name="input-barang" action="?page=insert-barang" method="post">
					<div class="form-group">
                        <label for="Barcode">Kode</label>
                        <input type="text" class="form-control" name="brcode" placeholder="Enter Barcode">
                    </div>
					<!--<div class="form-group">
					<label for="Dicount">Dicount</label>
                                <input class="form-control" type="text" name="discount" data-mask="99%" />
                            </div>
					<div class="form-group">
						<label for="Expired Date">Expired Dicount</label>
						<input type="text" class="form-control" name="expired" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Expired Dicount" value="<?php echo date("Y-m-d");?>"></div>-->
                    <div class="form-group">
                        <label for="Nama Barang">Nama Barang</label>
                        <input type="text" class="form-control" name="namabahan" placeholder="Enter Nama Barang" required="required">
                    </div>
					<!--<div class="form-group">
                        <label for="Satuan">Satuan</label>
                        <input type="text" class="form-control" name="satuan" placeholder="Enter Satuan" required="required">
                    </div>-->
					<div class="form-group">
                        <label for="suplier">Satuan</label>
<?php $select=mysql_query("SELECT * FROM tblsatuan WHERE iduser='{$_SESSION['id']}'"); ?>
                        <select class="form-control" name="satuan" data-rel="chosen" required="required">
						<option>-Pilih satuan-</option>
<?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['namasatuan'] ?>"><?php echo $bar['namasatuan'];?></option>
							  <?php } ?>
							  </select>
                    </div>
					<div class="form-group">
                        <label for="Jumlah">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" required="required">
                    </div>
					<div class="form-group">
                        <label for="Harga Per">Harga Beli</label>
                        <input type="text" class="form-control" name="hargaper" value="0" placeholder="Harga Beli" >
                    </div>
					<div class="form-group">
                        <label for="Harga Umum">Harga Jual Umum</label>
                        <input type="text" class="form-control" name="hargaumum" placeholder="Harga Jual Umum" required="required">
                    </div>
					<div class="form-group">
                        <label for="Harga Grosir">Harga Jual Grosir</label>
                        <input type="text" class="form-control" name="hargagrosir" value="0" placeholder="Harga Jual Grosir">
                    </div>
					<!--<div class="form-group">
                        <label for="Harga Bengkel">Harga Jual Bengkel</label>
                        <input type="text" class="form-control" name="hargabengkel" placeholder="Harga Jual Bengkel" required="required">
                    </div>-->
                    <a class="btn btn-danger" href="?page=stok-barang"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="klikbtn" value="1" class="btn btn-primary">Simpan & Tambahkan</button>
                    <button type="submit" name="klikbtn" value="2" class="btn btn-success">Simpan &  Selesai</button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->