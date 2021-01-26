<section>
        <div class="container">
		<div class="row">
            <div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Persediaan Produk
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Persediaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM tblkomposisi_produk ORDER BY nama_produk ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['nama_produk']; ?></td>
        	<td><?php echo $data['jml_jadi']; ?></td>
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
