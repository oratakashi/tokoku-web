<?php 
$today = date("Ymd");
$query = "SELECT max(kode_penjualan) AS last FROM tblpenjualan WHERE kode_penjualan LIKE 'TRJ$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRJ";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Penjualan</h4>
                  	  <form role="form" name="input-penjualan" action="?page=inp-penjualan" method="POST">
                    <div class="form-group">
                        <label for="Usahaname">Nomor Penjualan</label>
                        <input type="text" class="form-control" name="kode_penjualan" value="<?php echo $nou; ?>" readonly>
                    </div>
<?php if ($_SESSION['level']=='minimart') { ?>
<input type="hidden" name="pelanggan" value="Eceran">
<?php } else { ?>
<!--<input type="hidden" name="pelanggan" value="Eceran">-->
<div class="form-group">
                        <label for="Jenis Pelanggan">Jenis Pelanggan</label>
                        <select class="form-control" name="pelanggan" data-rel="chosen" required="required">
							<option value="Eceran">Harga Umum</option>
							<option value="Distributor">Harga Grosir</option>
							<!--<option value="Grosir">Harga Bengkel</option>-->
							  </select>
                    </div>
<div class="form-group">
                        <label for="Jenis Pelanggan">Nama Pelanggan</label>
                        <select class="form-control" name="idpel" data-rel="chosen" required="required">
							<option value="1">Umum</option>
							<?php $select=mysql_query("SELECT * FROM tblcustomers WHERE submiter='{$_SESSION['id']}'");
							while ($bar=mysql_fetch_array($select)) { ?>
							<option value="<?php echo $bar['id_customers']; ?>"><?php echo $bar['nama_customers']; ?></option>
							<?php } ?>
							  </select>
                    </div>
<?php } ?>
					
                    <a class="btn btn-danger" href="index.php"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->