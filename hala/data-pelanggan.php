<?php if(!empty($_GET['act']) && $_GET['act']=='add') {
if(!empty($_POST['addcust'])) {
$today = date("Ymd");
$query = "SELECT max(id_customers) AS last FROM tblcustomers WHERE id_customers LIKE 'CSM$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "CSM";
$nou  = $char.$today.sprintf("%04s", $b);

    $submiter = $_POST['submiter'];
    $idcustomers = $nou;
    $namacustomers = $_POST['namacustomers'];
    $alamat = $_POST['alamat'];
    $hep = $_POST['telp'];
    $tla = substr($hep,0, 2);
    
    if($tla == "08") {
        $telp = "8".substr($hep,2);
    } else if($tla == "02") {
        echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=data-pelanggan&act=add&error=telp\">");
    } else {
        $telp = $_POST['telp'];
    }
    
    $insertcus = mysql_query("INSERT INTO tblcustomers(id_customers, nama_customers, alamat_customers, telp, submiter) VALUES('$idcustomers','$namacustomers','$alamat','$telp','$submiter')") or die(mysql_error());
    if($insertcus == true) {
        echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=data-pelanggan\">");
    }
    
}

?>
<section id="blog" class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            <div class="blog">
                <div class="blog-item">
                    <div class="blog-content">
                        <h4 class="mb"><i class="icon-plus-sign"></i> Tambah Pelanggan</h4>
                            <form role="form" name="input-customers" action="" method="post">
                                <input type="hidden" name="submiter" value="<?php echo $_SESSION['id'];?>" readonly>
                                        <input type="hidden" class="form-control" name="idcustomers" value="<?php echo $nou;?>" readonly>
                                    <div class="form-group">
                                        <label for="namabahan">Nama Pelanggan</label>
                                        <input type="text" class="form-control" name="namacustomers" placeholder="Enter Nama Pelanggan" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" placeholder="Enter Alamat" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">No. Telp</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                +62
                                            </span>
                                        <input type="text" class="form-control" name="telp" placeholder="Enter No. Telp" required="required">
                                        </div>
                                    </div>

                                        <a class="btn btn-danger" href="?page=data-pelanggan"><i class="icon-remove"></i> Batal</a>
                                        <button type="submit" name="addcust" value="Ok" class="btn btn-primary">OK</button>
                            </form>
                    </div>
                </div><!--/.blog-item-->
            </div>
        </div><!--/.col-md-8-->
    </div><!--/.row-->
</section><!--/#blog-->

<?php } else if(!empty($_GET['act']) && $_GET['act']=='edit') {
$query = mysql_query("SELECT * FROM tblcustomers WHERE id_customers='{$_GET['id']}'");
$data = mysql_fetch_array($query);

if(!empty($_POST['editcust'])) {
    $id_customers = $_POST['id_customers'];
    $nama_customers = $_POST['namacustomers'];
    $alamat_customers = $_POST['alamat_customers'];
    $telp = $_POST['telp'];
    
    $insertcus = mysql_query("UPDATE tblcustomers SET nama_customers='$namacustomers', alamat_customers='$alamat', telp='$telp' WHERE id_customers='$id_customers')") or die(mysql_error());
    if($insertcus == true) {
        echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=data-pelanggan\">");
    }
    
}


?>
<section id="blog" class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            <div class="blog">
                <div class="blog-item">
                    <div class="blog-content">
                        <h4 class="mb"><i class="icon-plus-sign"></i> Edit Pelanggan</h4>
                            <form role="form" name="input-customers" action="" method="post">
                                        <input type="hidden" class="form-control" name="id_customers" value="<?php echo $data['id_customers'];?>" readonly>
                                    <div class="form-group">
                                        <label for="namabahan">Nama Pelanggan</label>
                                        <input type="text" class="form-control" name="namacustomers" value="<?php echo $data['nama_customers'];?>" placeholder="Enter Nama Pelanggan" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat_customers" value="<?php echo $data['alamat_customers'];?>" placeholder="Enter Alamat" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">No. Telp</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                +62
                                            </span>
                                        <input type="text" class="form-control" name="telp" value="<?php echo $data['telp'];?>" placeholder="Enter No. Telp" required="required">
                                        </div>
                                    </div>
                                        <a class="btn btn-danger" href="?page=data-pelanggan"><i class="icon-remove"></i> Batal</a>
                                        <button type="submit" name="editcust" value="Update" class="btn btn-primary">Update</button>
                            </form>
                    </div>
                </div><!--/.blog-item-->
            </div>
        </div><!--/.col-md-8-->
    </div><!--/.row-->
</section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='delete') {
$idco = $_GET['id'];
$delcus = mysql_query("DELETE FROM tblcustomers WHERE id_customers='$idco'") or die(mysql_error());
if($delcus == true) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=data-pelanggan\">");
}
} else { ?>
<section>
<div class="container">
<div class="row">
<div class="col-md-12 col-md-offset-0 col-sm-12">
<a class="btn btn-success" href="?page=data-pelanggan&act=add"><i class="icon-plus"></i> Tambah Pelanggan</a></div>
</div>
<div class="row">
<div class="col-md-12 col-md-offset-0 col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">
<i class="icon-check-sign"></i> Daftar Pelanggan
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
<th>No.</th>
<th>Nama</th>
<th>Alamat</th>
<th>No. Telp</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$query = mysql_query("SELECT * FROM tblcustomers WHERE submiter='{$_SESSION['id']}' ORDER BY id_customers ASC ");
$no = 1;
while ($data = mysql_fetch_array($query)) { ?>
<tr>
<td class="numeric"><?php echo $no; ?></td>
<td><?php echo $data['nama_customers']; ?></td>
<td><?php echo $data['alamat_customers']; ?></td>
<td>+62<?php echo $data['telp']; ?></td>
<td>
    <a class="btn btn-primary btn-xs" href="?page=data-pelanggan&act=edit&id=<?php echo $data['id_customers']; ?>"><i class="icon-pencil"></i></a>
    <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $data['id_customers']; ?>"><i class="icon-remove"></i></a>
<div class="modal fade" id="delete_<?php echo $data['id_customers']; ?>" tabindex="-1" role="dialog" aria-labelledby="Delete Pelanggan" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-group">
				<label>Anda Yakin Ingin Menghapus <?php echo $data['nama_customers']; ?>?</label><br>
				<small>*data yang dihapus tidak dapat dikembalikan lagi</small>
				</div>
				<br><br><br>
				<div class="form-group">
				<a href="?page=data-pelanggan&act=delete&id=<?php echo $data['id_customers']; ?>" style="margin-left: 0px;" class="btn btn-danger">Hapus</a>
				<button type="submit" style="margin-left: 0px;" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
</td>
</tr>
<?php $no++; } ?>    
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