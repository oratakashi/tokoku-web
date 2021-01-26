<?php
if (!empty($_GET['act']) && $_GET['act']=="del") {
$kode = $_GET['kode'];
$usr = $_GET['usr'];
$hapus = mysql_query("delete from tblmultiqr where qrid='$kode' and iduser='$usr' ") or die(mysql_error());
if ($hapus) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=printqrmulti\">"); }
}
?>
<section>
        <div class="container">
        <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Cetak Label Harga
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
							  <thead>
							  <tr>
								  <th>No</th><th>Nama Barang</th>
                                  <th>Kode Barang</th>
								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="../ritel/insertmulti.php" method="POST">
<?php 
$s=mysql_query("SELECT * FROM tblmultiqr WHERE iduser='{$_SESSION['id']}'");
$no=1;
while($sql=mysql_fetch_array($s)){
?>
							  <tr>
							  <td><?php echo $no; ?></td><td><?php echo $sql['namabarang']; ?></td><td><?php echo $sql['qrid']; ?></td><td><a class="btn btn-danger btn-xs" href="?page=printqrmulti&act=del&kode=<?php echo $sql['qrid']; ?>&usr=<?php echo $_SESSION['id']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php $no++; } ?>
<?php
$k=mysql_query("SELECT COUNT(namabarang) FROM tblmultiqr WHERE iduser='{$_SESSION['id']}'");
$kql=mysql_fetch_array($k);
$batas=$kql[0];
if ($batas==30) {?>
<tr><td colspan="4"></td></tr>
<?php } else {
?>
							  <tr>
							  <td colspan="2">
							  <?php $select=mysql_query("select * from stok_bahan where brcode!='' and iduser='{$_SESSION['id']}'"); ?>
							  <select class="form-control chzn-select" tabindex="2" name="nama_barang" data-rel="chosen" required="required">
							  <option value="0">-Pilih Barang-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['id_bahan'] ?>"><?php echo $bar['brcode'] ?> - <?php echo $bar['nama_bahan']; } ?></option>
							  </select>
							  </td>
							  <td><input type="text" class="form-control" name="jml" placeholder="Enter jumlah" required="required"></td>
							  <td><button type="submit" name="addbarang" value="add" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<?php } ?>
</tbody>
</table>
<a class="btn btn-danger" href="index.php"><i class="icon-remove"></i> Close</a>
<a class="btn btn-info" href="multiqr.php" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-qrcode"></i> Print QRcode</a>
<a class="btn btn-primary" href="multibar.php" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-barcode"></i> Print Barcode</a>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>