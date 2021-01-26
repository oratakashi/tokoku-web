<?php
if(!empty($_GET['act']) && $_GET['act']=='add') {
if(!empty($_POST['inprv'])) {
    $provide = $_POST['provide'];
    $insert = mysql_query("INSERT INTO tbl_provide(nameprovide) VALUE('$provide')") or die(mysql_error());
	if ($insert){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=provide-mgr&messages=success\">"); 
	} 
}
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Add Data Provider</h4>
                  	  <form role="form" name="data-provider" action="" method="POST">
					<div class="form-group">
                        <label for="Provider">Provider</label>
                        <input type="text" class="form-control" name="provide" placeholder="Provider">
                    </div>
                    <a class="btn btn-danger" href="?page=provide-mgr"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="inprv" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='edit') {
$id= $_GET['id'];
$query = mysql_query("SELECT * FROM tbl_provide WHERE idprovide='$id'");
$data = mysql_fetch_array($query);
if(!empty($_POST['updprv'])) {
    $idprovide = $_POST['idprovide'];
    $provide = $_POST['provide'];
    $update = mysql_query("UPDATE tbl_provide SET nameprovide='$provide' WHERE idprovide = '$idprovide'") or die(mysql_error());
	if ($update){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=provide-mgr&messages=success\">"); 
	} 
}
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Edit Data Provider</h4>
                  	  <form role="form" name="data-provider" action="" method="POST">
                  	      <input type="hidden" name="idprovide" value="<?php echo $id;?>">
					<div class="form-group">
                        <label for="Provider">Provider</label>
                        <input type="text" class="form-control" name="provide" value="<?php echo $data['nameprovide'];?>" placeholder="Provider">
                    </div>
                    <a class="btn btn-danger" href="?page=provide-mgr"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="updprv" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                    </form>
                    </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='delete') {
$id= $_GET['id'];
$delete = mysql_query("DELETE FROM tbl_provide WHERE idprovide = '$idprovide'") or die(mysql_error());
	if ($delete){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=provide-mgr&messages=success\">"); 
	} 
} else { ?>
<section>
        <div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success" href="?page=provide-mgr&act=add"><i class="icon-plus"></i> Data Provider</a>
			<a class="btn btn-info" href="?page=saldo-pulsa"><i class="icon-list"></i> Saldo Pulsa</a>
			</div>
        </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Data Provider
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Provider</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$query = mysql_query("SELECT * FROM tbl_provide");
$no = 1;
while ($data = mysql_fetch_array($query)) {
?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
        	<td><?php echo $data['nameprovide'];?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=provide-mgr&act=edit&id=<?php echo $data['idprovide']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=provide-mgr&act=delete&id=<?php echo $data['idprovide']; ?>"><i class="icon-trash "></i></a>
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