<?php
if(!empty($_GET['act']) && $_GET['act']=='add') {
if(!empty($_POST['inplistp'])) {
    
$idpulsa = $_POST['idpulsa']; 
$cari=mysql_query("SELECT * FROM tbl_listpulsa WHERE codepul='{$idpulsa}'");
$temu=mysql_fetch_assoc($cari);

if ($temu){
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=pulsa-list&act=add&error=id\">"); 
} else {
    $idpulsa = $_POST['idpulsa']; 
    $provide = $_POST['provide'];
    $nominal = $_POST['nominal'];
    $hbp = $_POST['hbp'];
    $hjp = $_POST['hjp'];
   
   $insert = mysql_query("INSERT INTO tbl_listpulsa(codepul, provide, nomp, hbelip, hjualp) VALUE('$idpulsa', '$provide', '$nominal', '$hbp', '$hjp')") or die(mysql_error());
	if ($insert){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=pulsa-list&messages=success\">"); 
	} 
}
    
}
?>
<section id="blog" class="container">
        <div class="row">
<?php
if (!empty($_GET['error']) && $_GET['error'] == 'id') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>ID Pulsa Tidak Boleh Sama</strong>	
			</div>
</div>
<?php } ?>
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Add Data Pulsa</h4>
                  	  <form role="form" name="deposit-pulsa" action="" method="POST">
                    <div class="form-group">
                        <label for="jmlsaldo">ID Pulsa</label>
                        <input type="text" class="form-control" name="idpulsa" placeholder="ID Pulsa">
                    </div>
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
                        <!--<input type="text" class="form-control" name="provide" placeholder="Provider">-->
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Nominal</label>
                        <input type="text" class="form-control" name="nominal" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Harga Beli</label>
                        <input type="text" class="form-control" name="hbp" placeholder="Harga Beli">
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Harga Jual</label>
                        <input type="text" class="form-control" name="hjp" placeholder="Harga Jual">
                    </div>
                    <a class="btn btn-danger" href="?page=pulsa-list"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="inplistp" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='edit') {
if(!empty($_POST['updlistp'])) {
    
   $idpulsa = $_POST['idpulsa']; 
   $provide = $_POST['provide'];
   $nominal = $_POST['nominal'];
   $hbp = $_POST['hbp'];
   $hjp = $_POST['hjp'];
   
   $insert = mysql_query("UPDATE tbl_listpulsa SET provide='$provide', nomp='$nominal', hbelip='$hbp', hjualp='$hjp' WHERE codepul='$idpulsa' ") or die(mysql_error());
	if ($insert){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=pulsa-list&messages=success\">"); 
	}
}
$id = $_GET['id'];   
$query = mysql_query("SELECT * FROM tbl_listpulsa WHERE codepul='$id' ");
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Edit Data Pulsa</h4>
                  	  <form role="form" name="deposit-pulsa" action="" method="POST">
                    <div class="form-group">
                        <label for="jmlsaldo">ID Pulsa</label>
                        <input type="text" class="form-control" name="idpulsa" value="<?php echo $data['codepul']?>" readonly>
                    </div>
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
                        <!--<input type="text" class="form-control" name="provide" value="<?php echo $data['provide']?>" placeholder="Provider">-->
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Nominal</label>
                        <input type="text" class="form-control" name="nominal" value="<?php echo $data['nomp']?>" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Harga Beli</label>
                        <input type="text" class="form-control" name="hbp" value="<?php echo $data['hbelip']?>" placeholder="Harga Beli">
                    </div>
                    <div class="form-group">
                        <label for="jmlsaldo">Harga Jual</label>
                        <input type="text" class="form-control" name="hjp" value="<?php echo $data['hjualp']?>" placeholder="Harga Jual">
                    </div>
                    <a class="btn btn-danger" href="?page=pulsa-list"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="updlistp" value="OK" class="btn btn-primary">Edit <i class="icon-pencil"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='delete') {
$id = $_GET['id'];
$del = mysql_query("DELETE FROM tbl_listpulsa WHERE codepul='$id' ");
if ($del){	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=pulsa-list\">"); }
} else { ?>
<section>
        <div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success" href="?page=pulsa-list&act=add"><i class="icon-plus"></i> Data Pulsa</a>
			<a class="btn btn-info" href="?page=saldo-pulsa"><i class="icon-list"></i> Saldo Pulsa</a>
			</div>
        </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> History Deposit
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Pulsa</th>
                                            <th>Provider</th>
                                            <th>Nominal</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$query = mysql_query("SELECT * FROM tbl_listpulsa");
$no = 1;
while ($data = mysql_fetch_array($query)) {
?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
        	<td><?php echo $data['codepul'];?></td>
        	<td><?php echo $data['provide'];?></td>
            <td>Rp. <?php echo number_format($data['nomp']); ?></td>
        	<td>Rp. <?php echo number_format($data['hbelip']); ?></td>
        	<td>Rp. <?php echo number_format($data['hjualp']); ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=pulsa-list&act=edit&id=<?php echo $data['codepul']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=pulsa-list&act=delete&id=<?php echo $data['codepul']; ?>"><i class="icon-trash "></i></a>
			</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php } ?>