<?php 
if(!empty($_POST['inpsaldo'])) {
	$idxp = $_POST['idxp'];
	$provide = $_POST['provide'];
	$saldo = $_POST['saldo'];
	$tgldep = $_POST['tgldep'];
	$jamdep = $_POST['jamdep'];
	
	$insdeposit = mysql_query("INSERT INTO tbl_depopulsa(idxp,datep,timep,jmlp, provide) VALUE('$idxp', '$tgldep', '$jamdep', '$saldo', '$provide')") or die(mysql_error());
	if ($insdeposit){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=saldo-pulsa&messages=success\">"); 
	}
}
$today = date("Ymd");
$query = "SELECT max(idxp) AS last FROM tbl_depopulsa WHERE idxp LIKE 'DEP$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "DEP";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Deposit Pulsa</h4>
                  	  <form role="form" name="deposit-pulsa" action="" method="POST">
					  <input type="hidden" class="form-control" name="idxp" value="<?php echo $nou; ?>">
					  <div class="form-group">
                        <label for="jmlsaldo">Provider</label>
                        <select class="form-control" tabindex="2" name="provide" data-rel="chosen" required="required">
							  <option disabled selected>-Pilih Provider-</option>
							  <?php 
							  $select=mysql_query("SELECT * FROM tbl_provide");
							  while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nameprovide'] ?>"><?php echo $bar['nameprovide']; ?></option>
							  <?php } ?>
							  </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Nominal Saldo</label>
                        <input type="text" class="form-control" name="saldo" placeholder="Saldo Deposit">
                    </div>
					<div class="form-group">
                        <label for="tanggal">Tanggal</label>
					<input type="text" name="tgldep" id="dp3" class="form-control" data-date-format="yyyy-mm-dd" placeholder="Tanggal Deposit" value="<?php echo date("Y-m-d");?>">
					</div>
					<div class="form-group">
                        <label for="jam">Jam</label>
						<div class="input-group bootstrap-timepicker">
                                <input class="timepicker-24 form-control" name="jamdep" type="text" />
                                <span class="input-group-addon add-on"><i class="icon-time"></i></span>
                            </div>
						</div>
                    <a class="btn btn-danger" href="?page=saldo-pulsa"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="inpsaldo" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->