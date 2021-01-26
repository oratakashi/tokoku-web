<section>
        <div class="container">
		<div class="row">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success" href="?page=add-translain"><i class="icon-plus"></i> Jenis Transaksi</a>
			</div>
        </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Jenis Transaksi Lainnya
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Keterangan</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM tbltranslain JOIN kategoritrans ON tbltranslain.kategori=kategoritrans.kode AND tbltranslain.iduser='{$_SESSION['id']}' ") or die(mysql_error());
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['keterangan']; ?></td>
		<td><?php echo $data['nama_kategori']; ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=edit-translain&id=<?php echo $data['id_trnlain']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=delete-translain&id=<?php echo $data['id_trnlain']; ?>"><i class="icon-trash "></i></a></td>
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