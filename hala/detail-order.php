<?php 
$kode    = $_GET['kode'];
$tanggal = date("Y-m-d");
$qrr=mysql_query("select * from tblpo where kode_po='$kode'");
$de=mysql_fetch_array($qrr);
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Detail Order
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th colspan="2">No.Order</th> 
                                  <th>Nama Prospek</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $de['tgl']; ?></td>
								  <td colspan="2"><?php echo $kode ; ?></td>
								  <td><?php echo $de['pelanggan'] ; ?></td>
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
			$s=mysql_query("select * from dtlpo where kode_po='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*($sql['harga']+$sql['ppn']);
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_barang']; ?></td><td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']+$sql['ppn']);?></td><td>Rp. <?php echo number_format($subt); ?></td>
							  </tr>
							  <?php } ?>

<td colspan="3"><b>Sub TOTAL</b></td><td colspan="2"><b>Rp. <?php echo number_format(@$total); ?></b></td>

</tbody>
</table>
<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<a class="btn btn-danger" href="?page=list-order">Keluar</a>
</form>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>