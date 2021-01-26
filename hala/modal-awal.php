<section>
        <div class="container">
		<div class="row">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success" href="?page=add-modal"><i class="icon-plus"></i>  Modal</a>
			</div>
        </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Modal Awal
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan Modal</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT * FROM modal ORDER BY tglmod ASC");

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
<tr>
        <td class="numeric"><?php echo $no; ?></td>
        <td><?php echo $data['tglmod']; ?></td>
		<td><?php echo $data['ketmod']; ?></td>
        <td>Rp. <?php echo number_format($data['jmlmod']); ?></td>
		<td>
		<?php if ($data['ketmod']=="Persediaan"){?>
		<a class="btn btn-success btn-xs" href="?page=view-modal&id=<?php echo $data['idmod']; ?>"><i class="icon-search"></i></a>
			<a class="btn btn-danger btn-xs" href="?page=delete-modal&id=<?php echo $data['idmod']; ?>"><i class="icon-trash "></i></a>
		<?php } else { ?>
			<a class="btn btn-primary btn-xs" href="?page=edit-modal&id=<?php echo $data['idmod']; ?>"><i class="icon-pencil"></i></a>
			<a class="btn btn-danger btn-xs" href="?page=delete-modal&id=<?php echo $data['idmod']; ?>"><i class="icon-trash "></i></a>
		<?php } ?>
			</td>
</tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<tr><td colspan="4"><h3><b>Total</b></h3></td><td style="text-align:right"><h3><b>Rp. <?php
        $qry_jumlah_a=mysql_query("SELECT SUM(jmlmod) FROM modal");
        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
        echo number_format($jumlah_jumlahjual); 
        ?></b></h3></td>
		</tr></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>