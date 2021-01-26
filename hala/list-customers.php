<section>
        <div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success" href="?page=add-customers"><i class="icon-plus"></i> Tambah Pelanggan</a></div>
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
<th>Perusahaan</th>
<th>Status</th>
                                            <th>Alamat</th>
                                            <th>No. Telp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$level = $_SESSION['level'];
$submiter = $_SESSION['nama'];
if 	($level=='sales'){
	$query = mysql_query("SELECT * FROM tblcustomers WHERE submiter = '$submiter' ORDER BY id_customers ASC ");
}	else {
	$query = mysql_query("SELECT * FROM tblcustomers ORDER BY id_customers ASC ");
}							
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['nama_customers']; ?></td>
<td><?php echo $data['persh']; ?></td>
<td><?php $status= $data['jenis'];
			switch ($status){
			case $status== 'prospek' : 
if ($_SESSION['level']=='sales') { ?>
<span class="label label-warning label-mini">Prospek</span>
<?php } else { ?>
<a href="?page=edit-status&jenis=pelanggan&id=<?php echo $data['id_customers'];?>" class="label label-warning label-mini">Prospek</a>
<?php }
			break;
			case $status== 'pelanggan' : echo '<span class="label label-success label-mini">Pelanggan</span>';
			}?></td>
        	<td><?php echo $data['alamat_customers']; ?></td>
        	<td><?php echo $data['telp']; ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=edit-customers&id=<?php echo $data['id_customers']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=delete-customers&id=<?php echo $data['id_customers']; ?>"><i class="icon-trash "></i></a>
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