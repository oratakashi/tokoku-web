<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];
$submiter=$_SESSION['nama'];
if (!empty($tgla)&&!empty($tglb)){
if ($_SESSION['level']=='sales') {
$query = mysql_query("SELECT * FROM tblquotation WHERE submiter = '$submiter' AND tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_quotation ASC ");
} else {
$query = mysql_query("SELECT * FROM tblquotation WHERE tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_quotation ASC ");
}

} else {
if ($_SESSION['level']=='sales') {
$query = mysql_query("SELECT * FROM tblquotation WHERE submiter = '$submiter' ORDER BY kode_quotation ASC ");
} else {
$query = mysql_query("SELECT * FROM tblquotation ORDER BY kode_quotation ASC ");
}
}
?>
<section>
        <div class="container">
				<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success btn-xs" href="?page=add-quotation"><i class="icon-plus"></i> Quotation</a></div>
        </div>
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                <form role="form" name="period" action="" method="post">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo "0000-00-00";} else { echo $tgla; }?>">
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>">
                <button type="submit" class="btn btn-success btn-xs">OK</button>
                </form>
                </div>
            </div>
              <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> Data Quotation
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No.Transaksi</th>
<th>Nama Sales</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['tgl']; ?></td>
        	<td><?php echo $data['kode_quotation']; ?></td>
		<td><?php echo $data['submiter']; ?></td>
        	<td><?php echo $data['pelanggan']; ?></td>
        	<td><a class="btn btn-success btn-xs" href="quotation.php?kode=<?php echo $data['kode_quotation']; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-search"></i> Detail</a>
  
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