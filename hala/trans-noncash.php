<?php 
$today = date("Ymd");
$query = "SELECT max(kode_ncs) AS last FROM tblnoncash WHERE kode_ncs LIKE 'TRN$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRN";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Transaksi Non-Cash</h4>
                  	  <form role="form" name="input-noncash" action="?page=inp-noncash" method="POST">
                    <div class="form-group">
                        <label for="Transaksi">Nomor Transaksi</label>
                        <input type="text" class="form-control" name="kode_ncs" value="<?php echo $nou; ?>" readonly>
                    </div>

                    <a class="btn btn-danger" href="?page=rekap-noncash"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->