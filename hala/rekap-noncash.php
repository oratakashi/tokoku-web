<?php
$today= date("Y-m-d");
$tgla = @$_POST['dari'];
$tglb = @$_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
$query = mysql_query("SELECT * FROM dtlnoncash WHERE tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_ncs ASC ");
$qry_jumlah_debet=mysql_query("SELECT SUM(debet) FROM dtlnoncash WHERE tgl BETWEEN '$tgla' AND '$tglb' ");
$qry_jumlah_kredit=mysql_query("SELECT SUM(kredit) FROM dtlnoncash WHERE tgl BETWEEN '$tgla' AND '$tglb' ");
} else {
$query = mysql_query("SELECT * FROM dtlnoncash ORDER BY kode_ncs ASC ");
$qry_jumlah_debet=mysql_query("SELECT SUM(debet) FROM dtlnoncash");
$qry_jumlah_kredit=mysql_query("SELECT SUM(kredit) FROM dtlnoncash");
}
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-md-12 col-md-offset-0 col-sm-12">
<h4 class="mb"><i class="icon-plus-sign"></i> <b>Laporan Transaksi Non-Cash</b></h4>
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
<a class="btn btn-success pull-right" href="<?php if (!empty($tgla)&&!empty($tglb)){?>excel-non-cash.php?dari=<?php echo $tgla; ?>&sampai=<?php echo $tglb;?><?php } else { ?>excel-non-cash.php<?php } ?>"><i class="icon-print"></i> Export Excel</a>
</div>
            </div>
            <div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-check-sign"></i> 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Transaksi</th>
                                            <th>Debet</th>
											<th>Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td><?php echo $data['tgl']; ?></td>
		<td><?php echo $data['nama_ncs']; ?></td>
        	<td>Rp. <?php echo number_format($data['debet']); ?></td>
			<td>Rp. <?php echo number_format($data['kredit']); ?></td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<tr><td colspan="4"><b>Total Debet</b></td><td style="text-align:right"><b>Rp. <?php
        
        $data_debet=mysql_fetch_array($qry_jumlah_debet);
        $jumlah_debet=$data_debet[0];
        echo number_format($jumlah_debet); 
        ?></b></td>
		</tr>
<tr><td colspan="4"><b>Total Kredit</b></td><td style="text-align:right"><b>Rp. <?php
        
        $data_kredit=mysql_fetch_array($qry_jumlah_kredit);
        $jumlah_kredit=$data_kredit[0];
        echo number_format($jumlah_kredit); 
        ?></b></td>
		</tr></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>