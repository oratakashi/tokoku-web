<section>
        <div class="container">
<!--<div class="row">
			<div class="col-lg-12">
			<a class="btn btn-success pull-right" href="exp-pdf.php?rd=<?php echo date("His");?>"><i class="icon-print"></i> Export PDF</a><br><br></div>
        </div>-->
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Barang Yang Hampir Habis
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID BARCODE</th>
                                            <th>NAMA BARANG</th>
                                            <th>QTY</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM stok_bahan WHERE jumlah < '5' ORDER BY nama_bahan ASC ");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        <td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['brcode']; ?></td>
        <td><?php echo $data['nama_bahan']; ?></td>
        <td><?php echo $data['jumlah']; ?> <?php echo $data['satuan']; ?></td>
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
