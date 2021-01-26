<section>
        <div class="container">
		<div class="row">
			<div class="col-md-12">
			<a class="btn btn-success" href="?page=add-supplier"><i class="icon-plus"></i> Tambah Supplier</a></div>
        </div>
            <div class="row">
				<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Daftar Supplier
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>No. Telp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM tblsupplier WHERE iduser='{$_SESSION['id']}' ORDER BY id_supplier ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['nama_supplier']; ?></td>
        	<td><?php echo $data['alamat_supplier']; ?></td>
        	<td><?php echo $data['telp']; ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=edit-supplier&id=<?php echo $data['id_supplier']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=delete-supplier&id=<?php echo $data['id_supplier']; ?>"><i class="icon-trash "></i></a>
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

