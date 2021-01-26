<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];

if (!empty($_GET['status']) && $_GET['status']=='Y'){
$kod=$_GET['kode'];
$kuer = mysql_query("update tblquotation set act='Y' where kode_quotation='$kod'") or die(mysql_error());
}
$submiter = $_SESSION['nama'];
if ($_SESSION['level']=='sales') { 
$query = mysql_query("SELECT * FROM tblquotation INNER JOIN dtlactivity ON tblquotation.kode_quotation=dtlactivity.kode_quot AND submiter = '$submiter' GROUP BY kode_quotation");
} else {
$query = mysql_query("SELECT * FROM tblquotation INNER JOIN dtlactivity ON tblquotation.kode_quotation=dtlactivity.kode_quot GROUP BY kode_quotation");
}

?>
<section>
        <div class="container">
				<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success btn-xs" href="?page=add-activity"><i class="icon-plus"></i> Activity</a></div>
        </div>
              <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Daily Activity Report
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>No.Order</th>
<th>Sales</th>
                                            <th>Nama Pelanggan</th>
<th>Progress</th>
<th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['kode_quotation']; ?></td>
<td><?php echo $data['submiter']; ?></td>
        	<td><?php echo $data['pelanggan']; ?></td>
		<td><table width="100%">
<?php	
$kd=$data['kode_quotation'];
$wer=mysql_query("SELECT * FROM dtlactivity WHERE kode_quot='$kd' ");
while ($dx = mysql_fetch_array($wer)) {
?>
<tr><td><?php echo $dx['tanggal']; ?></td><td><?php echo $dx['keterangan']; ?></td></tr>
<?php } ?></table></td>
                <td><?php 
				if ($data['act']=='N') { ?>
				<a href="?page=daily-report&status=Y&kode=<?php echo $data['kode_quotation']; ?>" class="label label-warning label-mini">Menunggu</a>
				<?php	
				} else {
				?>
				<span class="label label-info label-mini">Selesai</span>
				<?php	
				}
				?></td>
  
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