<?php
if(isset($_POST['cari'])) {
	
$id_barang=$_POST['brg'];
$slect=mysql_query("select * from stok_bahan where id_bahan='$id_barang'");
$plih=mysql_fetch_array($slect);
$namabarang = $plih['nama_bahan'];
	
}
$iduser     = $_SESSION['id'];
$kode    = @$_POST['kode_penjualan'];
$pelanggan= @$_POST['pelanggan'];
$tanggal = date("Y-m-d");

if (isset($_POST['kode_penjualan'])){
	("kode");
	$_SESSION['kode']=$kode;
	$_SESSION['pelanggan']=$pelanggan;
	$insert=mysql_query("insert into tblpenjualan (kode_penjualan,iduser,idpel,pelanggan,tgl) values ('$kode','$iduser','{$_POST['idpel']}','$pelanggan','$tanggal')");
}
?>
<section>
        <div class="container">
            <div class="row">
	    <div class="col-lg-12">
<?php 
if (!empty($_GET['error']) && $_GET['error'] == 'tidak-cukup') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Persediaan barang tidak mencukupi</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'habis') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Persediaan barang habis</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'barang') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Harga jual atau barang belum ada</strong>	
			</div>
</div>
<?php
;
}
?>
            </div>
            </div>
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Penjualan Barang 
                        </div>
                        <div class="panel-body">
<div class="col-md-6">
						<!--<a class="btn btn-success btn-xs pull-right" href="?page=price-list" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,width=800px,resizable=yes');return false;"><i class="icon-dollar"></i> Lihat Harga</a>-->
<!--<a class="btn btn-success btn-xs pull-right" href="?page=price-list" target="_blank"><i class="icon-dollar"></i> Lihat Harga</a>-->
<table class="table-condensed">
<form name="cari" method="POST" action="?page=inp-penjualan">
<input type="hidden" name="cari" value="cari">
<?php $select=mysql_query("SELECT * FROM stok_bahan WHERE iduser='{$_SESSION['id']}'"); ?>
<tr><td>
<select class="form-control chzn-select" tabindex="2" name="brg" data-rel="chosen" onchange="return document.forms.cari.submit();" required="required">
<option selected disabled>-Pilih Barang-</option>
<?php while ($bar=mysql_fetch_array($select)) { ?>
<option value="<?php echo $bar['id_bahan'] ?>"><?php echo $bar['brcode'] ?> - <?php echo $bar['nama_bahan']; } ?></option>
</select></td><td></td><!--<td>
<button type="submit" name="gole" value="cari" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></td>-->
</tr>
</form>
<?php
$kd=$_SESSION['kode'];
			$jnspelanggan=$_SESSION['pelanggan'];
			if($jnspelanggan=='Eceran') {
				$jnsharga=1;
			} else if ($jnspelanggan=='Distributor') {
				$jnsharga=2;
			} else if ($jnspelanggan=='Grosir') {
				$jnsharga=3;
			}
?>
<form name="filter-formf" action="?page=inputing-penjualan" method="POST">
<tr>
<td><input type="text" class="form-control" name="nama_barang" value="<?php echo @$namabarang;?>" required="required" autofocus>
<input type="hidden" name="id_barang" value="<?php echo @$id_barang; ?>">
</td><td></td>
</tr>
<tr>
<td><input type="number" class="form-control" name="jumlah" value="1" required="required"></td><td></td>
</tr>
<tr>
<td><input type="hidden" name="jenis_harga" value="<?php echo $jnsharga; ?>"><!--<input type="hidden" name="ppn" value="ppn" />-->
<input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></td><td></td>
</tr>
</table>
</form>
</div>
<div class="col-md-6">
<table width="100%" class="table-condensed">
<tr>
<td>Tanggal</td><td>: <?php echo $tanggal ; ?></td>
</tr>
<tr>
<td>No.Order</td><td>: <?php echo $_SESSION['kode'] ; ?></td>
</tr>
<tr>
<td>Pelanggan</td><td>: <?php echo $_SESSION['pelanggan'] ; ?></td>
</tr>
</table>
</div>

                            <div class="table-responsive">
							
<table class="table table-bordered table-striped table-condensed">
                              
							  <thead>
							  <tr>
								  <th>Barcode</th>
								  <th>Nama Barang</th>
								  
                                  <th>Jumlah</th>
<th>Harga</th> 
								  <th>Sub Total (Rp)</th>
								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  
			<?php 
			$s=mysql_query("select *, dtlpenjualan.jumlah AS juju from dtlpenjualan join stok_bahan ON dtlpenjualan.idbarang=stok_bahan.id_bahan where dtlpenjualan.kode_penjualan='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['juju']*$sql['harga'];
			$te=$sql['juju']*1;
			$total=@$total+$subt;
$item=@$item+$te;

			?>
							  <tr>
							  <td><?php echo $sql['brcode']; ?></td>
							  <td><?php echo $sql['nama_barang']; ?></td>
							  
							  <td><?php echo $sql['juju']; ?></td>
							  <td>Rp. <?php echo number_format($sql['harga']);?></td>
							  <td>Rp. <?php echo number_format($subt); ?></td>
							  <td><a class="btn btn-danger btn-xs" href="?page=del-input-penjualan&kode=<?php echo $sql['kode_penjualan']; ?>&id=<?php echo $sql['idbarang']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  

<?php 
$tm=mysql_fetch_assoc(mysql_query("select * from tblpenjualan where kode_penjualan='$kd' and total!=0")); 
if ($tm){
	$gt=mysql_fetch_array(mysql_query("select * from tblpenjualan where kode_penjualan='$kd'")); 
?>
<tr><td></td><td colspan="2"><b>ITEM</b></td><td colspan="2"><b><?php echo @$item; ?></b></td></tr>
<td></td><td colspan="2"><h2>TOTAL</h2></td><td colspan="4"><h2>Rp. <?php echo number_format($gt['total']-$gt['ongkos']+$gt['potongan']); ?></h2></td>

<tr><td></td><td colspan="2"><b>BAYAR</b></td><td colspan="4"><b>Rp. <?php echo number_format($gt['bayar']+$gt['kembalian']); ?></b></td></tr>
<?php if ($gt['kurang']==0) {?>
<tr><td></td><td colspan="2"><b>KEMBALIAN</b></td><td colspan="4"><b>Rp. <?php echo number_format($gt['kembalian']); ?></b></td></tr>
<?php } else {?>
<tr><td></td><td colspan="2"><b>KURANG BAYAR</b></td><td colspan="4"><b>Rp. <?php echo number_format($gt['kurang']); ?></b></td></tr>
<?php } ?>
</tbody>
</table>
<a class="btn btn-danger" href="?page=penjualan"><i class="icon-times"></i> Close</a>
<a class="btn btn-default" href="invoice.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
<?php
} else {
?>
<tr><td></td><td colspan="2"><b>ITEM</b></td><td colspan="4"><b><?php echo @$item; ?></b></td></tr>
<td></td><td colspan="2"><h2>TOTAL</h2></td><td colspan="4"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
<form action="?page=akhir-penjualan" method="POST">
<!--<tr><td colspan="3"><b>DISCOUNT</b></td><td colspan="2"><b><input type="text" name="potongan" class="form-control"></b></td></tr>
<tr><td colspan="3"><b>BIAYA KIRIM</b></td><td colspan="2"><b><input type="text" name="ongkos" class="form-control"></b></td></tr>-->
<tr><td></td><td colspan="2"><b>BAYAR</b></td><td colspan="4"><b><input type="text" name="bayar" class="form-control"></b></td></tr>
</tbody>
</table>

<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo @$total; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("select * from dtlpenjualan where kode_penjualan='$kd'")); 
if ($temu){
?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else {
?>
<a class="btn btn-danger" href="?page=batal-penjualan&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
<?php }
?>
</form>
<?php
}
?>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>