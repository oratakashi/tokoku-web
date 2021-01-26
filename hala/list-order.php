<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];
$submiter=$_SESSION['nama'];
if (!empty($tgla)&&!empty($tglb)){
if ($_SESSION['level']=='sales') {
$query = mysql_query("SELECT * FROM tblpo WHERE submiter = '$submiter' AND tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_po ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpo WHERE submiter = '$submiter' AND tgl BETWEEN '$tgla' AND '$tglb' ");
} else {
$query = mysql_query("SELECT * FROM tblpo WHERE tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_po ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpo WHERE tgl BETWEEN '$tgla' AND '$tglb' ");
}
} else {
if ($_SESSION['level']=='sales') {
$query = mysql_query("SELECT * FROM tblpo WHERE submiter = '$submiter' ORDER BY kode_po ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpo WHERE submiter = '$submiter'");
} else {
$query = mysql_query("SELECT * FROM tblpo ORDER BY kode_po ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpo");
}
}
$kds=$_POST['kode'];
$pelanggan=$_POST['pelanggan'];
$ttal=$_POST['total'];
if (isset($kds)){
$tdy = date("Ymd");
$ery = "SELECT max(kode_penjualan) AS last FROM tblpenjualan WHERE kode_penjualan LIKE 'TRJ$tdy%'";
$hasil = mysql_query($ery);
$ata  = mysql_fetch_array($hasil);
$lastNosupplier = $ata['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRJ";
$nou  = $char.$tdy.sprintf("%04s", $b);
$kodejual=$nou;
$gkl=mysql_query("INSERT INTO tblpenjualan (kode_penjualan,pelanggan,total,kurang,tgl) values ('$kodejual','$pelanggan','$ttal','$ttal','$today')");
$qry_odr = mysql_query("SELECT * FROM dtlpo WHERE kode_po ='$kds'");
while ($data_odr = mysql_fetch_array($qry_odr)) {
$a = array($data_odr['nama_barang']);
foreach($a as $c){
$qry_dtl = mysql_query("SELECT * FROM dtlpo WHERE kode_po ='$kds' AND nama_barang='$c'");
$data_dtl = mysql_fetch_array($qry_dtl);
$jum_dtl=$data_dtl['jumlah'];
$hpp_dtl=$data_dtl['hpp'];
$hrg_dtl=$data_dtl['harga'];
$ppn_dtl=$data_dtl['ppn'];
$hargaf=$hrg_dtl+$ppn_dtl;
if($sql=mysql_query("INSERT INTO dtlpenjualan (kode_penjualan,nama_barang,harga,jumlah,ppn,hpp,tgl) values ('$kodejual','$c','$hargaf','$jum_dtl','$ppn_dtl','$hpp_dtl','$today')")){
	$produk=mysql_query("SELECT * FROM stok_bahan WHERE nama_bahan='$c'");
	$isi=mysql_fetch_array($produk);
	$stok=$isi['jumlah'];
	$jumlah_baru=$stok-$jum_dtl;
	$total=$isi['harga_per']*$jumlah_baru;
	$updet1=mysql_query("UPDATE tblpo SET status='Y' WHERE kode_po='$kds'");
	$updet2=mysql_query("UPDATE stok_bahan SET jumlah='$jumlah_baru',total='$total' WHERE nama_bahan='$c'");
	
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=list-order\">");
}
}
}
}
?>
<section>
        <div class="container">
						<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12">
			<a class="btn btn-success btn-xs" href="?page=add-po"><i class="icon-plus"></i>  Order</a></div>
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
                            <i class="icon-check-sign"></i> Order
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No.Order</th>
<th>Nama Sales</th>
                                            <th>Nama Prospek</th>
                                            <th>Total</th>
                                            <th>Detail</th>
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
        	<td><?php echo $data['kode_po']; ?></td>
<td><?php echo $data['submiter']; ?></td>
		<td><?php echo $data['pelanggan']; ?></td>
        	<td>Rp. <?php echo number_format($data['total']); ?></td>
        	<td><a class="btn btn-success btn-xs" href="?page=detail-order&kode=<?php echo $data['kode_po']; ?>"><i class="icon-search"></i> Detail</a>
  
			</td>
<td>
<?php if ($data['status']=='N'){
if ($_SESSION['level']=='sales') { ?>
<span class="btn btn-warning btn-xs"><i class="icon-spinner"></i>Waiting Approved</span >
<?php } else { ?>
<form action="?page=list-order" method="POST">
<input type="hidden" name="kode" value="<?php echo $data['kode_po'];?>">
<input type="hidden" name="pelanggan" value="<?php echo $data['pelanggan'];?>">
<input type="hidden" name="total" value="<?php echo $data['total'];?>">
<button type="submit" class="btn btn-warning btn-xs"><i class="icon-spinner"></i> Approve</button>
</form>
<?php } } else { ?>
<span class="btn btn-info btn-xs"><i class="icon-check"></i> Approved</span >
<?php } ?>
  
			</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<table class="table table-striped table-bordered table-hover">
<tr><td colspan="4"><b>Total Keseluruhan</b></td><td style="text-align:right"><b>Rp. <?php

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