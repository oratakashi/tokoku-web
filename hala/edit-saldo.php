<?php
if(!empty($_POST['editsaldo'])) {
    $idxp = $_POST['idxp'];
    $provide = $_POST['provide'];
	$saldo = $_POST['saldo'];
	$tgldep = $_POST['tgldep'];
	$jamdep = $_POST['jamdep'];
	
	$uptdeposit = mysql_query("UPDATE tbl_depopulsa SET datep='$tgldep', timep='$jamdep', jmlp='$saldo', provide='$provide'  WHERE idxp='$idxp'") or die(mysql_error());
	if ($uptdeposit){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=saldo-pulsa&messages=success\">"); 
	}
}
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM tbl_depopulsa WHERE idxp='$id'");  
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Edit Deposit Pulsa</h4>
                  	  <form role="form" name="deposit-pulsa" action="" method="POST">
					  <input type="hidden" class="form-control" name="idxp" value="<?php echo $id; ?>">
					  <div class="form-group">
                        <label for="jmlsaldo">Provider</label>
                        <select class="form-control" tabindex="2" name="provide" data-rel="chosen" required="required">
							  <option disabled>-Pilih Provider-</option>
							  <?php 
							  $select=mysql_query("SELECT * FROM tbl_provide");
							  while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['nameprovide'] ?>" <?php if($bar['nameprovide']==$data['provide']) { echo 'selected';}?>><?php echo $bar['nameprovide']; ?></option>
							  <?php } ?>
							  </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Nominal Saldo</label>
                        <input type="text" class="form-control" name="saldo" value="<?php echo $data['jmlp'];?>" placeholder="Saldo Deposit">
                    </div>
					<div class="form-group">
                        <label for="tanggal">Tanggal</label>
					<input type="text" name="tgldep" id="dp3" class="form-control" data-date-format="yyyy-mm-dd" placeholder="Tanggal Deposit" value="<?php echo $data['datep'];?>">
					</div>
					<div class="form-group">
                        <label for="jam">Jam</label>
						<div class="input-group bootstrap-timepicker">
                                <input class="timepicker-24 form-control" name="jamdep" type="text" value="<?php echo $data['timep'];?>" />
                                <span class="input-group-addon add-on"><i class="icon-time"></i></span>
                            </div>
						</div>
                    <a class="btn btn-danger" href="?page=saldo-pulsa"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="editsaldo" value="Edit" class="btn btn-primary">Edit <i class="icon-pencil"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->