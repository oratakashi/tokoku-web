<?php 
$today = date("Ymd");
$query = "SELECT max(kode_pembelian) AS last FROM tblpembelian_bahan WHERE kode_pembelian LIKE 'TRB$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRB";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Pembelian Barang</h4>
                  	  <form role="form" name="input-pembelian-bahan" action="?page=inp-pembelian-bahan" method="POST">
                    <div class="form-group">
                        <label for="Usahaname">Nomor Faktur Pembelian</label>
                        <input type="text" class="form-control" name="kode_pembelian" placeholder="Nomor Pembelian" required="required">
                    </div>
					<!--<div class="form-group">
                        <label for="Faktur">Faktur Pajak</label>
                        <input type="text" class="form-control" name="faktur" placeholder="Nomor Faktur">
                    </div>-->
				<div class="form-group">
				<label for="Tanggal Pembelian">Tanggal Pembelian</label>
                <input type="text" class="form-control" name="tanggal" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Tanggal Pembelian" value="<?php  echo date("Y")."-00-00";?>">
				</div>
				<div class="form-group">
				<label for="Tanggal Jatuh Tempo">Tanggal Jatuh Tempo</label>
                <input type="text" class="form-control" name="tempo" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Tanggal Jatuh Tempo" value="<?php  echo date("Y")."-00-00";?>">
				</div>
<div class="form-group">
					<div class="form-group">
                        <label for="suplier">Suplier</label>
<?php $select=mysql_query("select * from tblsupplier"); ?>
                        <select class="form-control" name="suplier" data-rel="chosen" required="required">
<?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nama_supplier'] ?>"><?php echo $bar['nama_supplier']; } ?></option>
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