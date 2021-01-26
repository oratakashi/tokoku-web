<?php
$tanggal = date("Y-m-d");
$kd = $_SESSION['kode'];
$kts = substr($kd,0,3);
 if ($kts == 'TRJ'){ 
 echo("<META HTTP-EQUIV=Refresh CONTENT=\"1;URL=index.php?page=bkhl\">");
 ?>
 <section>
        <div class="container">
            <div class="row">
	    <div class="col-lg-12">
		</div>
            </div>
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Penjualan Barang 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th colspan="2">No.Order</th> 
                                  <th colspan="2">Pelanggan</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $tanggal ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['kode'] ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['pelanggan'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Barang</th>
                                  <th>Jumlah</th>
<th>Harga</th> 
								  <th>Sub Total (Rp)</th>
                              </tr>
							  </thead>
							  <tbody>
			<?php $kd=$_SESSION['kode'];
			$jnspelanggan=$_SESSION['pelanggan'];
			if($jnspelanggan=='Eceran') {
				$jnsharga=1;
			} else if ($jnspelanggan=='Distributor') {
				$jnsharga=2;
			} else if ($jnspelanggan=='Grosir') {
				$jnsharga=3;
			}
			$s=mysql_query("select * from dtlpenjualan where kode_penjualan='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*$sql['harga'];
			$te=$sql['jumlah']*1;
			$total=@$total+$subt;
$item=@$item+$te;			?>
							  <tr>
							  <td><?php echo $sql['nama_barang']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']);?></td><td>Rp. <?php echo number_format($subt); ?></td>
							  </tr>
							  <?php } ?>
							  <tr>
<?php 

	$gt=mysql_fetch_array(mysql_query("select * from tblpenjualan where kode_penjualan='$kd'")); 
?>
<tr><td></td><td colspan="2"><b>ITEM</b></td><td colspan="2"><b><?php echo @$item; ?></b></td></tr>
<td></td><td colspan="2"><h2>TOTAL</h2></td><td colspan="2"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
<?php 
$tm=mysql_fetch_assoc(mysql_query("select * from tblpenjualan where kode_penjualan='$kd' and total!=0")); 
if ($tm){
	$gt=mysql_fetch_array(mysql_query("select * from tblpenjualan where kode_penjualan='$kd'")); 
?>
<tr><td></td><td colspan="2"><b>BAYAR</b></td><td colspan="2"><b>Rp. <?php echo number_format($gt['bayar']+$gt['kembalian']); ?></b></td></tr>
<?php if ($gt['kurang']==0) {?>
<tr><td></td><td colspan="2"><b>KEMBALIAN</b></td><td colspan="2"><b>Rp. <?php echo number_format($gt['kembalian']); ?></b></td></tr>
<?php } else {?>
<tr><td></td><td colspan="2"><b>KURANG BAYAR</b></td><td colspan="2"><b>Rp. <?php echo number_format($gt['kurang']); ?></b></td></tr>
<?php } }?>
</tbody>
</table>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
 <?php
 } else {
?>
<section id="error" class="container">
        <h4>Selamat Datang, Pelanggan</h4>
<h4>Di <?php echo $dta['perusahaan'];?></h4>
        
</section><!--/#error-->
<?php
 }
?>