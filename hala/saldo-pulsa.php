<?php
if(!empty($_GET['act']) && $_GET['act']=='delete') {
$id = $_GET['id'];
$del = mysql_query("DELETE FROM tbl_depopulsa WHERE idxp='$id' ");
if ($del){
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=saldo-pulsa\">"); 
	}
} else {
$today= date("Y-m-d");
$yesterdate=date_create($today);
date_add($yesterdate,date_interval_create_from_date_string("-1 months"));
$yesterday = date_format($yesterdate,"Y-m-d");

if(!empty($_POST['period'])) {
$tgla = $_POST['dari'];
$tglb = $_POST['sampai']; 
$query = mysql_query("SELECT * FROM tbl_depopulsa WHERE datep BETWEEN '$tgla' AND '$tglb' ORDER BY datep DESC ");
$mklo = mysql_query("SELECT *, SUM(jmlp)AS totsaldo  FROM tbl_depopulsa WHERE datep BETWEEN '$tgla' AND '$tglb' GROUP BY provide ORDER BY datep DESC ");
} else {
$query = mysql_query("SELECT * FROM tbl_depopulsa ORDER BY datep DESC "); 
$mklo = mysql_query("SELECT *, SUM(jmlp)AS totsaldo  FROM tbl_depopulsa GROUP BY provide ORDER BY datep DESC ");
}
$qrypul=mysql_query("SELECT SUM(jmlp) AS topulsa FROM tbl_depopulsa");
$datadepo=mysql_fetch_array($qrypul);
$totalpa=$datadepo['topulsa'];

$qryjul=mysql_query("SELECT SUM(hpp) AS tojul FROM dtljualpulsa");
$datajul=mysql_fetch_array($qryjul);
$totajul=$datajul['tojul'];
?>
<section>
        <div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success" href="?page=deposit-pulsa"><i class="icon-plus"></i> Tambah Deposit</a>
			<a class="btn btn-info" href="?page=pulsa-list"><i class="icon-list"></i> List Pulsa</a>
			<a class="btn btn-warning" href="?page=history-saldo"><i class="icon-list"></i> History Saldo</a>
			<hr>
			<form role="form" name="period" action="" method="post">
<div class="form-group">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo $yesterday;} else { echo $tgla; }?>"> <b>s/d</b>
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" name="period" value="Cari" class="btn btn-xs btn-success"><i class="icon-search"></i> Cari</button>
</div>
</form>
			
			</div>
        </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Saldo Pulsa
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Provider</th>
                                            <th>Saldo Pulsa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$nob = 1;
while ($bqyu = mysql_fetch_array($mklo)) {
?>
    	<tr>
        	<td class="numeric"><?php echo $nob; ?></td>
			<td><?php echo $bqyu['provide']; ?></td>
        	<td>Rp. <?php 
if(!empty($_POST['period'])) {
$bjkml = mysql_query("SELECT *, SUM(hpp)AS totmin  FROM dtljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb' AND  provide='{$bqyu['provide']}' ");	
} else {
$bjkml = mysql_query("SELECT *, SUM(hpp)AS totmin  FROM dtljualpulsa WHERE provide='{$bqyu['provide']}' ");
}
$lopj = mysql_fetch_array($bjkml);
        	echo number_format($bqyu['jmlp']-$lopj['totmin']); ?></td>
        </tr>
    <?php 
		$nob++;
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
<?php }	?> 