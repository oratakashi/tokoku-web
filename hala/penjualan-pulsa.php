<?php 
$today = date("Ymd");
$query = "SELECT max(kode_jualpulsa) AS last FROM tbljualpulsa WHERE kode_jualpulsa LIKE 'TJP$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TJP";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            <div class="blog">
                <div class="blog-item">
                    <div class="blog-content">
                        <h4 class="mb"><i class="icon-plus-sign"></i> Penjualan Pulsa</h4>
                        <form role="form" name="input-penjualan" action="?page=inp-penjualan-pulsa" method="POST">
                            <div class="form-group">
                                <label for="Usahaname">Nomor Penjualan Pulsa</label>
                                <input type="text" class="form-control" name="kode_jualpulsa" value="<?php echo $nou; ?>" readonly>
                            </div>
                                <input type="hidden" name="pelanggan" value="Umum">
                                <a class="btn btn-danger" href=""><i class="icon-remove"></i> Batal</a>
                                <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                        </form>
                    </div>
                </div><!--/.blog-item-->
            </div>
        </div><!--/.col-md-8-->
    </div><!--/.row-->
</section><!--/#blog-->