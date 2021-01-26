<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];
$submiter=$_SESSION['nama'];
if (!empty($tgla)&&!empty($tglb)){
if ($_SESSION['level']=='sales') {
$query = mysql_query("SELECT * FROM tblclaim WHERE submiter = '$submiter' AND tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_claim ASC ");
} else {
$query = mysql_query("SELECT * FROM tblclaim WHERE tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_claim ASC ");
}

} else {
if ($_SESSION['level']=='sales') {
$query = mysql_query("SELECT * FROM tblclaim WHERE submiter = '$submiter' ORDER BY kode_claim ASC ");
} else {
$query = mysql_query("SELECT * FROM tblclaim ORDER BY kode_claim ASC ");
}
}
?>
<section>
        <div class="container">
				<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success btn-xs" href="?page=add-claim-market"><i class="icon-plus"></i> Claim Operational</a></div>
        </div>
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                <form role="form" name="period" action="" method="post">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo date("Y")."-00-00";} else { echo $tgla; }?>">
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" class="btn btn-success btn-xs">OK</button>
                </form>
                </div>
            </div>
              <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Data Claim Operational Marketing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No.Claim</th>
                                            <th>Total</th>
                                            <th>Nama Sales</th>
                                            <th>Aksi</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['tgl']; ?></td>
        	<td><?php echo $data['kode_claim']; ?></td>
		<td>Rp. <?php echo number_format($data['total']); ?></td>
         	<td><?php echo $data['submiter']; ?></td>       	
        	<td><a class="btn btn-success btn-xs" href="?page=dtl-claim&kode=<?php echo $data['kode_claim']; ?>"><i class="icon-search"></i> Detail</a>
  </td>
                <td><?php if ($data['status']=='N'){
if ($_SESSION['level']=='sales') { ?>
<span class="btn btn-warning btn-xs"><i class="icon-spinner"></i>Waiting Approved</span >
<?php } else { ?>
<a class="btn btn-warning btn-xs" href="?page=update-claim&status=Y&kode=<?php echo $data['kode_claim']; ?>"><i class="icon-spinner"></i> Approve</a>
<?php } } else { ?>
<span class="btn btn-info btn-xs"><i class="icon-check"></i> Approved</span >
<?php } ?></td>
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