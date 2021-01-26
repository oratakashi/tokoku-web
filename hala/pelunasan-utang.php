<?php 
$kode    = $_GET['kode'];
$tanggal = date("Y-m-d");
$qrr=mysql_query("select * from tblpembelian_bahan where kode_pembelian='$kode'");
$de=mysql_fetch_array($qrr);
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Pelunasan Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th>No.Transaksi</th>
								  <th>No.Faktur</th>
                                  <th>Supplier</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $de['tanggal']; ?></td>
								  <td><?php echo $kode ; ?></td>
								  <td><?php echo $de['faktur'] ; ?></td>
								  <td><?php echo $de['suplier'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Barang</th>
                                  <th>Qty</th>
<th>Harga</th> 
								  <th>Jumlah</th>
                              </tr>
							  </thead>
							  <tbody>
			<?php $kd=$kode;
			$s=mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*($sql['harga']+$sql['ppn']);
			$total=@$total+$subt; 
			$ppn=$sql['jumlah']*$sql['ppn'];
			$totalppn=@$totalppn+$ppn;
			?>
							  <tr>
							  <td><?php echo $sql['nama_bahan']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']+$sql['ppn']);?></td><td>Rp. <?php echo number_format($subt); ?></td>
							  </tr>
							  <?php } ?>

<td colspan="3"><b>Sub TOTAL</b></td><td colspan="2"><b>Rp. <?php echo number_format(@$total); ?></b></td>
<tr><td colspan="3"><b> Harga Sebelum PPN</b></td><td colspan="2"><b>Rp. <?php echo number_format(@$total-@$totalppn); ?></b></td></tr>
<tr><td colspan="3"><b>PPN</b></td><td colspan="2"><b>Rp. <?php echo number_format(@$totalppn); ?></b></td></tr>
<?php 
$returbeli = mysql_query("select * from dtlretur_beli where kode_rebeli='$kd'");
$ada = mysql_fetch_assoc($returbeli); 
if ($ada) {
?>
<tr>
								<th>Retur Pembelian</th>
                                <th>Qty</th>
								<th>Harga</th> 
								<th>Jumlah</th>
</tr>
<?php 		$j=mysql_query("select * from dtlretur_beli where kode_rebeli='$kd'");
			while($fl=mysql_fetch_array($j)){
			$sb=$fl['jumlah']*$fl['harga'];
			$tol=@$tol+$sb;
?>
<tr>
<td><?php echo $fl['nama_barang']; ?></td><td><?php echo $fl['jumlah']; ?></td><td>Rp. <?php echo number_format($fl['harga']);?></td><td>Rp. <?php echo number_format($sb); ?></td></tr>
<?php
 }
?>
<td colspan="3"><b>TOTAL Retur Pembelian</b></td><td colspan="2"><b>Rp. <?php echo number_format(@$tol); ?></b></td>
<?php
} else {
?>

<?php
}
?>
<tr>
<td colspan="2"><b>Terbayar</b></td><td><b>Tanggal</b></td><td colspan="2"><b>Jumlah</b></td></tr>
<?php 		$j=mysql_query("select * from dtlhutang where kode_pembelian='$kd'");
			while($fl=mysql_fetch_array($j)){
			$no=@$no+1;
?>
<tr>
<td></td><td># <?php echo $no; ?></td><td><?php echo $fl['tgl']; ?></td><td colspan="2">Rp. <?php echo number_format($fl['bayar']); ?></td></tr>
<?php }

$total=$de['total'];
$bayar=$de['bayar'];
if ($total<=$bayar){
	
?>
<tr><td colspan="3"><b>TOTAL BAYAR</b></td><td colspan="2">Rp. <?php echo number_format($de['bayar']); ?></td></tr>
<tr><td colspan="3"><b>STATUS</b></td><td colspan="2"><b>LUNAS</b></td></tr>
</tbody>
</table>
<?php 
$returbeli = mysql_query("select * from dtlretur_beli where kode_rebeli='$kd'");
$ada = mysql_fetch_assoc($returbeli); 
if ($ada) {
?>
<a class="btn btn-danger" href="?page=rekap-pembelian"><i class="icon-times"></i> Keluar</a>
<a class="btn btn-default" href="invoice-beli.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
<?php
} else {
?>
<form action="?page=retur-beli" method="POST">
<input type="hidden" value="<?php echo $kd;?>" name="kode_rebeli">
<input type="hidden" value="<?php echo $de['suplier'];?>" name="supplier">
<button type="submit" class="btn btn-warning">Retur</button>
<a class="btn btn-danger" href="?page=rekap-pembelian"><i class="icon-times"></i> Keluar</a>
<a class="btn btn-default" href="invoice.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
</form>
<?php
}
?>
<?php
} else {
?>
<tr>
<td colspan="3"><b>Kurang Bayar</b></td><td colspan="2"><b>Rp. <?php echo number_format($de['kurang']); ?></b></td></tr>
<form action="?page=input-pelunasan-utang" method="POST">
<tr><td colspan="3"><b>BAYAR</b></td><td colspan="2"><input type="text" name="bayar" class="form-control"></td></tr>
</tbody>
</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlpembelian_bahan where kode_pembelian='$kd'")); 
if ($temu){
?>
<a class="btn btn-danger" href="?page=hutang">Keluar</a>
<button type="submit" class="btn btn-primary">Bayar</button>
<a class="btn btn-default" href="invoice-beli.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
<?php } else {
?>
<a class="btn btn-danger" href="?page=hutang">Keluar</a>
<a class="btn btn-default" href="invoice-beli.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
<?php }
?>
</form>
<?php 
$returbeli = mysql_query("select * from dtlretur_beli where kode_rebeli='$kd'");
$ada = mysql_fetch_assoc($returbeli); 
if ($ada) {
?>
<?php
} else {
?>
<form action="?page=retur-beli" method="POST">
<input type="hidden" value="<?php echo $kd;?>" name="kode_rebeli">
<input type="hidden" value="<?php echo $de['suplier'];?>" name="supplier">
<button type="submit" class="btn btn-warning">Retur</button>
</form>
<?php
}
}
?>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>