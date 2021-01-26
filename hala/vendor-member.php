<?php
if(!empty($_POST['addmem'])) {
    $idvendor = $_SESSION['id'];
    $idmember = $_POST['idmem'];
    
    $insertcus = mysql_query("INSERT INTO dtl_memven(idvendor,idmember) VALUES('$idvendor','$idmember')") or die(mysql_error());
    if($insertcus == true) {
        echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=vendor-member\">");
    }
}

?>

<section>
        <div class="container">
		<div class="row">
			<div class="col-lg-12">
			<a class="btn btn-success" data-toggle="modal" data-target="#addmem"><i class="icon-plus"></i> Add Member</a>
<div class="modal fade" id="addmem" tabindex="-1" role="dialog" aria-labelledby="Delete Pelanggan" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		     <form name="input-customers" action="" method="POST">
			<div class="modal-header">
				<h4>Tambah ID Member</h4>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control" style="width:100%;" name="idmem" placeholder="ID Member" required="required">
                                    
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button type="submit" name="addmem" value="Submit" class="btn btn-primary">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div>
			</div>
        </div>
            <div class="row">
				<div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Member List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Nama Usaha</th>
                                            <th>Username</th>
                                            <th>Telp</th>
                                            <th>Kota</th>
                                            <th>Provinsi</th>
                                            <th>Status</th>
                                            <th>Last Login</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php	
$query = mysql_query("SELECT *, regencies.name AS kotab, provinces.name AS provi FROM dtl_memven LEFT JOIN tab_user ON dtl_memven.idmember=tab_user.id LEFT JOIN regencies ON tab_user.kotab=regencies.id LEFT JOIN provinces ON tab_user.provi=provinces.id LEFT JOIN setting ON tab_user.id=setting.iduser WHERE dtl_memven.idvendor='{$_SESSION['id']}' AND tab_user.level ='admin' ORDER BY tab_user.tgl_reg DESC ") or die(mysql_error());
$no = 1;
while ($data = mysql_fetch_array($query)) {
?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		    <td><?php echo $data['fullname']; ?></td>
		    <td><?php echo $data['perusahaan']; ?></td>
        	<td><?php echo $data['username']; ?></td>
        	<td><?php echo $data['no_tlp']; ?></td>
			<td><?php echo $data['kotab']; ?></td>
			<td><?php echo $data['provi']; ?></td>
        	<td><?php if($data['status']=='0') { ?>
        	<a class="btn btn-default btn-xs" href="#">Inactive</a>
        	<?php } else if($data['status']=='1') { ?>
        	<a class="btn btn-success btn-xs" href="#">Actived</a>
        	<?php } else if($data['status']=='2') { ?>
        	<a class="btn btn-warning btn-xs" href="#">Suspended</a>
        	<?php } else { } ?></td>
        	<td><?php if($data['lastlogin']=='0000-00-00 00:00:00') { echo "-";} else {
        	echo date_format(date_create($data['lastlogin']),"d M Y H:i:s");
        	} ?></td>

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