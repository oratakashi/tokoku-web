<?php
$today= date("Y-m-d");
$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
$query = mysql_query("SELECT * FROM tblpembelian_bahan WHERE tanggal BETWEEN '$tgla' AND '$tglb' ORDER BY kode_pembelian ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan WHERE tanggal BETWEEN '$tgla' AND '$tglb' ");
$qry_jumlah_b=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$qry_jumlah_c=mysql_query("SELECT SUM(ppn*jumlah) FROM dtlpembelian_bahan WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$qry_jumlah_d=mysql_query("SELECT SUM(jumlah*harga) FROM dtlretur_beli WHERE tgl BETWEEN '$tgla' AND '$tglb'");
} else {
$query = mysql_query("SELECT * FROM tblpembelian_bahan ORDER BY kode_pembelian ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpembelian_bahan");
$qry_jumlah_b=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan");
$qry_jumlah_c=mysql_query("SELECT SUM(ppn*jumlah) FROM dtlpembelian_bahan");
$qry_jumlah_d=mysql_query("SELECT SUM(jumlah*harga) FROM dtlretur_beli");
}
?>


<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Rekap Pembelian</b></h4>
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
</div>
</form>
        </div>
<div class="col-md-2 col-sm-2">
<a class="btn btn-success pull-right" href="<?php if (!empty($tgla)&&!empty($tglb)){?>excel-pembelian.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>excel-pembelian.php<?php } ?>"><i class="icon-print"></i> Export Excel</a>
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
                                            <th>No.Transaksi</th>
											<th>No.Faktur</th>
                                            <th>Nama Supplier</th>
                                            <th>Jumlah</th>
											<th>PPN</th>
											<th>Retur Pembelian</th>
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
        	<td><?php echo $data['tanggal']; ?></td>
        	<td><?php echo $data['kode_pembelian']; ?></td>
			<td><?php echo $data['faktur']; ?></td>
		<td><?php echo $data['suplier']; ?></td>
        	<td>Rp. <?php 
			$kd=$data['kode_pembelian'];
			$qry_jml=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpembelian_bahan WHERE kode_pembelian='$kd'");
			$dta=mysql_fetch_array($qry_jml);
            $jum=$dta[0];
			echo number_format($jum); ?></td>
			<td>Rp. <?php 
			$qry_ppn=mysql_query("SELECT SUM(ppn*jumlah) FROM dtlpembelian_bahan WHERE kode_pembelian='$kd'");
			$dta_ppn=mysql_fetch_array($qry_ppn);
            $jum_ppn=$dta_ppn[0];
			echo number_format($jum_ppn); ?></td>
			<td>Rp. <?php 
			$qry_rtb=mysql_query("SELECT total FROM tblretur_beli WHERE kode_rebeli='$kd'");
			$rtb=mysql_fetch_array($qry_rtb);
            $rebeli=$rtb[0];
			echo number_format($rebeli); ?></td>
			<td>Rp. <?php echo number_format($data['total']-$rebeli); ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=pelunasan-utang&kode=<?php echo $data['kode_pembelian']; ?>"><i class="icon-search"></i> Detail</a>
			</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<tr><td colspan="4"><b>Total Pembelian</b></h3></td><td style="text-align:right"><b>Rp. <?php
        
        $data_b=mysql_fetch_array($qry_jumlah_b);
        $jumlah_b=$data_b[0];
		$data_d=mysql_fetch_array($qry_jumlah_d);
        $jumlah_d=$data_d[0];
        echo number_format($jumlah_b-$jumlah_d); 
        ?></b></h3></td>
		</tr>
<tr><td colspan="4"><b>Total PPN Keluaran</b></h3></td><td style="text-align:right"><b>Rp. <?php
        
        $data_c=mysql_fetch_array($qry_jumlah_c);
        $jumlah_c=$data_c[0];
        echo number_format($jumlah_c); 
        ?></b></h3></td>
		</tr>
<tr><td colspan="4"><b>Total Keseluruhan</b></h3></td><td style="text-align:right"><b>Rp. <?php
        
        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
        echo number_format($jumlah_jumlahjual-$jumlah_d); 
        ?></b></h3></td>
		</tr></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>