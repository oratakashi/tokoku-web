<?php
if(!empty($_GET['act']) && $_GET['act']=='add') {
    if(!empty($_POST['addsatuan'])) {
        $namasatuan = $_POST['namasatuan'];
        $query = mysql_query("INSERT INTO tblsatuan VALUES('', '{$_SESSION['id']}', '$namasatuan')") or die(mysql_error());
        if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=satuan-barang\">");}
    }
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

<div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Satuan</h4>
<form role="form" name="input-translain" action="" method="post">			
    <div class="form-group">
    <label for="translain">Nama Satuan</label>
        <input type="text" class="form-control" name="namasatuan" placeholder="Nama satuan" required="required">
    </div>
    <a class="btn btn-danger" href="?page=satuan-barang"><i class="icon-remove"></i> Batal</a>
    <button type="submit" name="addsatuan" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='edit') {
if(!empty($_POST['editsatuan'])) {
        $idsat = $_POST['idsat'];
        $namasatuan = $_POST['namasatuan'];
        $query = mysql_query("UPDATE tblsatuan SET namasatuan='$namasatuan' WHERE idsat='$idsat'") or die(mysql_error());
        if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=satuan-barang\">");}
    }
$query = mysql_query("SELECT * FROM tblsatuan WHERE idsat='{$_GET['id']}'");
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

<div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Satuan</h4>
<form role="form" name="input-translain" action="" method="post">
<input type="hidden" name="idsat" value="<?php echo $data['idsat'];?>" required="required">
    <div class="form-group">
    <label for="translain">Nama Satuan</label>
        <input type="text" class="form-control" name="namasatuan" value="<?php echo $data['namasatuan'];?>" placeholder="Nama satuan" required="required">
    </div>
    <a class="btn btn-danger" href="?page=satuan-barang"><i class="icon-remove"></i> Batal</a>
    <button type="submit" name="editsatuan" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='delete') { 
$idsat = $_GET['id'];
$query = mysql_query("DELETE FROM tblsatuan WHERE idsat='$idsat'") or die(mysql_error());
if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=satuan-barang\">");}
?>
<?php } else { ?>
<section>
        <div class="container">
		<div class="row">
			<div class="col-md-12">
			<a class="btn btn-success" href="?page=satuan-barang&act=add"><i class="icon-plus"></i> Tambah Satuan</a></div>
        </div>
            <div class="row">
				<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Data Satuan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM tblsatuan WHERE iduser='{$_SESSION['id']}' ORDER BY idsat ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['namasatuan']; ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=satuan-barang&act=edit&id=<?php echo $data['idsat']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=satuan-barang&act=delete&id=<?php echo $data['idsat']; ?>"><i class="icon-trash "></i></a>
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