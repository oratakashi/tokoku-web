<?php 
$today = date("Ymd");
$query = "SELECT max(kode_quotation) AS last FROM tblquotation WHERE kode_quotation LIKE 'QTS$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNoquotation = $data['last'];
$lastNoUrut = substr($lastNoquotation, 11, 15);
$b    = $lastNoUrut + 1;
$char = "QTS";
$nou  = $char.$today.sprintf("%04s", $b);
$submiter=$_SESSION['nama'];
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Quotation</h4>
                  	  <form role="form" name="input-quotation" action="?page=inp-quotation" method="POST">
<input type="hidden" name="submiter" value="<?php echo $submiter; ?>">
                    <div class="form-group">
                        <label for="Usahaname">Nomor Quotation</label>
                        <input type="text" class="form-control" name="kode_quotation" value="<?php echo $nou; ?>" readonly>
                    </div>
					<div class="form-group">
                        <label for="pelanggan">Pelanggan Prospek</label>
<?php 
if($_SESSION['level']=='sales') {
$select=mysql_query("select * from tblcustomers where jenis = 'prospek' and submiter = '$submiter'"); 
}
else {
$select=mysql_query("select * from tblcustomers where jenis = 'prospek'"); 
}
?>
<select class="form-control" name="pelanggan" data-rel="chosen" required="required">
<?php while ($bar=mysql_fetch_array($select)) { ?>
<option value="<?php echo $bar['nama_customers'] ?>"><?php echo $bar['nama_customers'];?> - <?php echo $bar['persh']; } ?></option>
</select>
</div>
<br>
<br>
<br>
<br>
                    <a class="btn btn-danger" href="?page=quotation"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->