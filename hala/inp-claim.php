<?php
$kode    = $_POST['kode_claim'];
$tanggal = date("Y-m-d");
$submiter = $_SESSION[nama];
if (isset($_POST['kode_claim'])){
	("kode");
	$_SESSION['kode']=$kode;
	$insert=mysql_query("insert into tblclaim (kode_claim,tgl,submiter,status) values ('$kode','$tanggal','$submiter','N')");
}
?>
<section>
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Claim Operational Marketing
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
								  <th>Tanggal</th>
                                  <th colspan="2">No.Claim</th> 
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $tanggal ; ?></td>
								  <td colspan="2"><?php echo $_SESSION['kode'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Claim</th>
                                  <th>Nominal</th>
								  								  <th>Aksi</th>
                              </tr>
							  </thead>
							  <tbody>
							  <form action="?page=inputing-claim" method="POST">
			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlclaim where kode_claim='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jml'];
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_claim']; ?></td><td>Rp. <?php echo number_format($subt); ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-claim&kode=<?php echo $sql['kode_claim']; ?>&nama=<?php echo $sql['nama_claim']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td>
							  <?php $select=mysql_query("select * from tbltranslain where kategori IN ('kt8')"); ?>
							  <select class="form-control" name="nama_claim" data-rel="chosen" required="required">
							  <option value="0">-Pilih Claim-</option>
							  <?php while ($bar=mysql_fetch_array($select)) { ?>
							  <option value="<?php echo $bar['keterangan'] ?>"><?php echo $bar['keterangan']; } ?></option>
							  </select>
							  </td>
							  <td><input type="text" class="form-control" name="nominal" Placeholder="Masukkan Nominal" required></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<tr>
<td colspan="2"><b>Lampiran Claim</b></td>
<td><b>Aksi</b></td>
</tr>
							  <form enctype="multipart/form-data" action="?page=inputing-img-claim" method="POST">
			<?php $kd=$_SESSION['kode'];
			$s=mysql_query("select * from dtlimgclaim where kode_claim='$kd'");
			while($sql=mysql_fetch_array($s)){ ?>
							  <tr>
							  <td colspan="2"><?php echo $sql['img_claim']; ?></td><td><a class="btn btn-danger btn-xs" href="?page=del-input-img-claim&kode=<?php echo $sql['kode_claim']; ?>&img=<?php echo $sql['img_claim']; ?>">Hapus <i class="icon-trash "></i></a></td>
							  </tr>
							  <?php } ?>
							  <tr>
							  <td colspan="2"><input type="file" name="lampiran"></td><td><input type="hidden" name="kode" value="<?php echo $kd; ?>"><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></form></td></tr>
<form action="?page=akhir-claim" method="POST">
<td><h2>TOTAL</h2></td><td colspan="2"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
</tbody>
</table>
<input type="hidden" name="kode" value="<?php echo $kd; ?>"><input type="hidden" name="total" value="<?php echo $total; ?>">
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<a class="btn btn-danger" href="?page=batal-claim&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
</form>				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>