<section>
        <div class="container">
            <div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Daftar Inventaris
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Inventaris</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
		$query = mysql_query("SELECT * FROM dtltransaksi WHERE ctg = 'kt1' ORDER BY kode_tran ASC");
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['tgl']; ?></td>
		<td><?php echo $data['nama_tran']; ?></td>
        	<td>Rp. <?php echo number_format($data['nominal']); ?></td>
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