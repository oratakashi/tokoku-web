<?php
$today= date("Y-m-d");
$yesterdate=date_create($today);
date_add($yesterdate,date_interval_create_from_date_string("-1 months"));
$yesterday = date_format($yesterdate,"Y-m-d");

if(!empty($_POST['period'])) {
$tgla = $_POST['dari'];
$tglb = $_POST['sampai']; 
$query = mysql_query("SELECT * FROM tbljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb' ORDER BY tgl DESC ");
} else {
$query = mysql_query("SELECT * FROM tbljualpulsa ORDER BY tgl DESC ");    
}

?>
<section>
        <div class="container">
		<div class="row">
		    <div class="col-md-12 col-md-offset-0 col-sm-12">
			<form role="form" name="period" action="" method="post">
<div class="form-group">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo $yesterday;} else { echo $tgla; }?>"> <b>s/d</b>
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" name="period" value="Cari" class="btn btn-xs btn-success"><i class="icon-search"></i> Cari</button>
</div>
</form>
		</div>	
			</div>
        </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Rekap Penjualan Pulsa
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Kode Transaksi</th>
                                            <th>Jumlah</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
<?php					
$no = 1;
while ($data = mysql_fetch_array($query)) {
?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
            <td><?php echo date_format(date_create($data['datep']),"d/F/Y"); ?></td>
        	<td><?php echo $data['kode_jualpulsa']; ?> WIB</td>
        	<td>Rp. <?php echo number_format($data['total']); ?></td>
        	
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