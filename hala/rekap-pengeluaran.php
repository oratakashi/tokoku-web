<?php if(!empty($_GET['act']) && $_GET['act'] == 'select') {
if(!empty($_POST['idmember'])) {
    $idmember = $_POST['idmember'];
    $_SESSION['idmember'] = $idmember;
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-pengeluaran\">");
}
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">
                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Pilih Member</h4>
				<form role="form" name="input-barang" action="" method="POST">
					<div class="form-group">
                        <label for="Harga Bengkel">Member</label>
                        <select class="form-control" name="idmember" data-rel="chosen" required="required">
							<?php $select=mysql_query("SELECT *, regencies.name AS kotab, provinces.name AS provi FROM dtl_memven LEFT JOIN tab_user ON dtl_memven.idmember=tab_user.id LEFT JOIN regencies ON tab_user.kotab=regencies.id LEFT JOIN provinces ON tab_user.provi=provinces.id LEFT JOIN setting ON tab_user.id=setting.iduser WHERE dtl_memven.idvendor='{$_SESSION['id']}' AND tab_user.level ='admin' ORDER BY tab_user.tgl_reg DESC");
							while ($bar=mysql_fetch_array($select)) { ?>
							<option value="<?php echo $bar['idmember']; ?>"><?php echo $bar['fullname']; ?></option>
							<?php } ?>
							  </select>
                    </div>
                    <a class="btn btn-danger" href="?page=rekap-pengeluaran"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php
} else if(!empty($_GET['act']) && $_GET['act'] == 'clear') {
unset($_SESSION['idmember']);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-pengeluaran\">");
} else {
$idmember='';
if($_SESSION['level'] == 'admin') {
	$idmember = $_SESSION['id'];
} if($_SESSION['level'] == 'vendor') {
	if(!empty($_SESSION['idmember'])) {
	$idmember = $_SESSION['idmember'];
	} else {
		echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=rekap-pengeluaran&act=select\">");
	}
	
}
$today= date("Y-m-d");
$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
$query = mysql_query("SELECT * FROM dtltransaksi WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}' ORDER BY kode_tran ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(nominal) FROM dtltransaksi WHERE tgl BETWEEN '$tgla' AND '$tglb' AND iduser='{$idmember}'");
} else {
$query = mysql_query("SELECT * FROM dtltransaksi WHERE iduser='{$idmember}' ORDER BY kode_tran ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(nominal) FROM dtltransaksi");
}
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Transaksi Cash</b></h4>
<br>
</div>
		<div class="col-md-2 col-sm-2">
		<b>Periode Tanggal : </b>
		</div>
		<div class="col-md-8 col-sm-8">
<form role="form" name="period" action="" method="post">
<div class="form-group">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo date("Y")."-00-00";} else { echo $tgla; }?>"> <b>s/d</b>
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>"></div>
<div class="form-group">
                <button type="submit" class="btn btn-success"><i class="icon-search"></i> Cari</button>
                <a class="btn btn-danger" href="?page=rekap-pengeluaran&act=clear"><i class="icon-remove"></i> Kembali</a>
</div>
</form>
        </div>
<div class="col-md-2 col-sm-2">
<a class="btn btn-success pull-right" href="<?php if (!empty($tgla)&&!empty($tglb)){?>excel-trans-cash.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>excel-trans-cash.php<?php } ?>"><i class="icon-print"></i> Export Excel</a>
</div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Transaksi</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
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
<table class="table table-striped table-bordered">
<tr><td><b>Kas</b></td><td style="text-align:right"><b>Rp. <?php
        
        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
        echo number_format($jumlah_jumlahjual); 
        ?></b></td>
		</tr></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php } ?>