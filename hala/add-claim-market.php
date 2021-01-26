<?php 
$today = date("Ymd");
$query = "SELECT max(kode_claim) AS last FROM tblclaim WHERE kode_claim LIKE 'CLM$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "CLM";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Claim Marketing</h4>
                  	  <form role="form" name="input-claim" action="?page=inp-claim" method="POST">
                    <div class="form-group">
                        <label for="Nomor Claim">Nomor Claim</label>
                        <input type="text" class="form-control" name="kode_claim" value="<?php echo $nou; ?>" readonly>
                    </div>
                    <a class="btn btn-danger" href="?page=clain-marketing"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->