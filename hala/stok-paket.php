<section>
        <div class="container">
		<div class="row">
			<div class="col-sm-12">
			<a class="btn btn-success" href="?page=add-paket"><i class="icon-plus"></i> Tambah Paket</a></div>
        </div>
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Paket Produk
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Paket</th>
                                            <th>HPP</th>
                                            <th>Harga Jual</th>
                                            <th>Laba</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM tblpaket_produk ORDER BY paket_produk ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['paket_produk']; ?></td>
        	<td>Rp. <?php echo number_format($data['hpp']); ?></td>
		<td>Rp. <?php echo number_format($data['hargaj']); ?></td>
		<td>Rp. <?php echo number_format($data['laba']); ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=edit-paket&kode=<?php echo $data['paket_produk']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=delete-paket&kode=<?php echo $data['paket_produk']; ?>"><i class="icon-trash "></i></a>
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
