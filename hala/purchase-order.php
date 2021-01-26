<?php
$today= date("Y-m-d");
$tgla = $_POST['dari'];
$tglb = $_POST['sampai'];
if (!empty($tgla)&&!empty($tglb)){
$query = mysql_query("SELECT * FROM tblpo WHERE status='Y' AND tgl BETWEEN '$tgla' AND '$tglb' ORDER BY kode_po ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpo WHERE status='Y' AND tgl BETWEEN '$tgla' AND '$tglb' ");
$qry_jumlah_b=mysql_query("SELECT SUM((harga-ppn)*jumlah) FROM dtlpo WHERE tgl BETWEEN '$tgla' AND '$tglb'");
$qry_jumlah_c=mysql_query("SELECT SUM(ppn*jumlah) FROM dtlpo WHERE tgl BETWEEN '$tgla' AND '$tglb'");
} else {
$query = mysql_query("SELECT * FROM tblpo WHERE status='Y' ORDER BY kode_po ASC ");
$qry_jumlah_a=mysql_query("SELECT SUM(total) FROM tblpo WHERE status='Y'");
$qry_jumlah_b=mysql_query("SELECT SUM((harga-ppn)*jumlah) FROM dtlpo");
$qry_jumlah_c=mysql_query("SELECT SUM(ppn*jumlah) FROM dtlpo");
}
?>
<section>
        <div class="container">
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
                            <i class="icon-check-sign"></i> Purchase Order
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No.Purchase Order</th>
<th>Nama Sales</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <th>PPN</th>
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
        	<td><?php echo $data['kode_po']; ?></td>
<td><?php echo $data['submiter']; ?></td>
		<td><?php echo $data['pelanggan']; ?></td>
        	<td>Rp. <?php 
			$kd=$data['kode_po'];
			$qry_jml=mysql_query("SELECT SUM(harga*jumlah) FROM dtlpo WHERE kode_po='$kd'");
			$dta=mysql_fetch_array($qry_jml);
            $jum=$dta[0];
			echo number_format($jum); ?></td>
        	<td>Rp. <?php 
            $qry_ppn=mysql_query("SELECT SUM(ppn*jumlah) FROM dtlpo WHERE kode_po='$kd'");
			$dta_ppn=mysql_fetch_array($qry_ppn);
            $jum_ppn=$dta_ppn[0];
            echo number_format($jum_ppn); ?></td>
        	<td>Rp. <?php echo number_format($data['total']); ?></td>
        	<td><a class="btn btn-success btn-xs" href="purchase-odr.php?kode=<?php echo $data['kode_po']; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-search"></i> Detail</a>
  
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