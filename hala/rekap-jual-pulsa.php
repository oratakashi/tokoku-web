<?php
$today= date("Y-m-d");
$yesterdate=date_create($today);
date_add($yesterdate,date_interval_create_from_date_string("-1 months"));
$yesterday = date_format($yesterdate,"Y-m-d");

$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
$jenisrekap = @$_GET['jenis'];
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Rekap Penjualan Pulsa</b></h4>
<br>
</div>
		<div class="col-md-12 col-sm-12">
		<a class="btn btn-success" href="?page=rekap-jual-pulsa"><i class="icon-plus"></i> Invoice</a>
		<a class="btn btn-primary" href="?page=rekap-jual-pulsa&jenis=produk"><i class="icon-plus"></i> Produk</a>
		<a class="btn btn-warning" href="?page=rekap-jual-pulsa&jenis=pelanggan"><i class="icon-plus"></i> Pelanggan</a>
		</div>
		<div class="col-md-2 col-sm-2">
		<b>Periode Tanggal : </b>
		</div>
				
		<div class="col-md-8 col-sm-8">
<form role="form" name="period" action="" method="post">
<div class="form-group">
                <input type="text" name="dari" id="dp4" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal" value="<?php if ($tgla=='') { echo $yesterday;} else { echo $tgla; }?>"> <b>s/d</b>
                <input type="text" name="sampai" id="dp3" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal" value="<?php if ($tglb=='') { echo $today;} else { echo $tglb; }?>"></div>
<div class="form-group">
                <button type="submit" class="btn btn-success"><i class="icon-search"></i> Cari</button>
</div>
</form>
        </div>
<div class="col-md-2 col-sm-2">
<a class="btn btn-success pull-right" href="
<?php if (empty($jenisrekap)) { ?>
<?php if (!empty($tgla)&&!empty($tglb)){ ?>excel-penjualan-pulsa.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?>
<?php } else {?>excel-penjualan-pulsa.php<?php } ?>
<?php } else if ($jenisrekap=='produk') { ?>
<?php if (!empty($tgla)&&!empty($tglb)){ ?>excel-penjualan-pulsa.php?jenis=produk&dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?>
<?php } else {?>excel-penjualan-pulsa.php?jenis=produk<?php } ?>
<?php } else if ($jenisrekap=='pelanggan') {?>
<?php if (!empty($tgla)&&!empty($tglb)){ ?>excel-penjualan-pulsa.php?jenis=pelanggan&dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?>
<?php } else {?>excel-penjualan-pulsa.php?jenis=pelanggan<?php } ?>
<?php } ?>
">
<i class="icon-print"></i> Export Excel</a>
</div>
            </div>
              <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
<?php 
if (empty($jenisrekap)){
if (!empty($tgla)&&!empty($tglb)){
$query = mysql_query("SELECT * FROM tbljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_jualpulsa ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tbljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb' ");
$qry_jumlah_b=mysql_query("SELECT SUM((harga-ppn)*jumlah) FROM dtljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$qry_jumlah_c=mysql_query("SELECT SUM(ppn*jumlah) FROM dtljualpulsa WHERE tgl BETWEEN '$tgla' AND '$tglb'");
} else {
$query = mysql_query("SELECT * FROM tbljualpulsa ORDER BY kode_jualpulsa ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tbljualpulsa");
$qry_jumlah_b=mysql_query("SELECT SUM((harga-ppn)*jumlah) FROM dtljualpulsa");
$qry_jumlah_c=mysql_query("SELECT SUM(ppn*jumlah) FROM dtljualpulsa");
}
?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No.Transaksi</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <!--<th>PPN</th>
                                            <th>Retur Penjualan</th>-->
											<th>Total</th>
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
        	<td><?php echo $data['kode_jualpulsa']; ?></td>
		<td><?php echo $data['pelanggan']; ?></td>
        	<td>Rp. <?php 
			$kd=$data['kode_jualpulsa'];
			$qry_jml=mysql_query("SELECT SUM((harga-ppn)*jumlah) FROM dtljualpulsa WHERE kode_jualpulsa='$kd'");
			$dta=mysql_fetch_array($qry_jml);
            $jum=$dta[0];
			echo number_format($jum); ?></td>
        	<!--<td>Rp. <?php 
            $qry_ppn=mysql_query("SELECT SUM(ppn*jumlah) FROM dtljualpulsa WHERE kode_jualpulsa='$kd'");
			$dta_ppn=mysql_fetch_array($qry_ppn);
            $jum_ppn=$dta_ppn[0];
            echo number_format($jum_ppn); ?></td>
			<td>Rp. <?php 
			$qry_rtj=mysql_query("SELECT total FROM tblretur_jual WHERE kode_rejual='$kd'");
			$rtj=mysql_fetch_array($qry_rtj);
            $rejual=$rtj[0];
			echo number_format($rejual); ?></td>-->
        	<td>Rp. <?php echo number_format($data['total']); ?></td>
        	<td><a class="btn btn-success btn-xs" href="?page=detail-jualpulsa&kode=<?php echo $data['kode_jualpulsa']; ?>"><i class="icon-search"></i> Detail</a>
  
			</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<table class="table table-striped table-bordered table-hover">
<tr><td colspan="4"><b>Total Penjualan</b></td><td style="text-align:right"><b>Rp. <?php

        $data_b=mysql_fetch_array($qry_jumlah_b);
        $jumlah_b=$data_b[0];
        echo number_format($jumlah_b); 
        ?></b></td>
		</tr>
<tr><td colspan="4"><b>Total PPN Keluaran</b></td><td style="text-align:right"><b>Rp. <?php

        $data_c=mysql_fetch_array($qry_jumlah_c);
        $jumlah_c=$data_c[0];
        echo number_format($jumlah_c); 
        ?></b></td>
		</tr>
<tr><td colspan="4"><b>Total Keseluruhan</b></td><td style="text-align:right"><b>Rp. <?php

        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
        echo number_format($jumlah_jumlahjual); 
        ?></b></td>
		</tr></table>
                            </div>
<?php } else if ($jenisrekap=='produk') {
$query = mysql_query("SELECT * FROM dtljualpulsa GROUP BY provide");

	?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data['provide']; ?></td>
        	<td><?php 
			$kd=$data['provide'];
			if (!empty($tgla)&&!empty($tglb)){
			$qry_jml=mysql_query("SELECT SUM(jumlah) FROM dtljualpulsa WHERE provide='$kd' AND tgl BETWEEN '$tgla' AND '$tglb'");
			} else {
			$qry_jml=mysql_query("SELECT SUM(jumlah) FROM dtljualpulsa WHERE provide='$kd'");
			}
			$dta=mysql_fetch_array($qry_jml);
            $jum=$dta[0];
			echo number_format($jum); ?></td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
                            </div>
<?php } else if ($jenisrekap=='pelanggan') {
if (!empty($tgla)&&!empty($tglb)){
	$query = mysql_query("SELECT * FROM dtljualpulsa INNER JOIN tbljualpulsa ON dtljualpulsa.kode_jualpulsa=tbljualpulsa.kode_jualpulsa AND dtljualpulsa.tgl BETWEEN '$tgla' AND '$tglb' AND tbljualpulsa.tgl BETWEEN '$tgla' AND '$tglb'");
} else {
	$query = mysql_query("SELECT * FROM dtljualpulsa LEFT JOIN tbljualpulsa ON dtljualpulsa.kode_jualpulsa=tbljualpulsa.kode_jualpulsa ");
}

	?>
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nama Produk</th>
											<th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data['pelanggan']; ?></td>
        	<td><?php echo $data['provide']; ?></td>
			<td><?php echo $data['jumlah']; ?></td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
                            </div>
<?php }
 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>