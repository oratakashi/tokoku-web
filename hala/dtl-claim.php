<?php 
$kode    = $_GET['kode'];
$tanggal = date("Y-m-d");
$qrr=mysql_query("SELECT * FROM tblclaim WHERE kode_claim='$kode'");
$de=mysql_fetch_array($qrr);
?>
<section>
        <div class="container">
            <div class="row">
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Detail Claim
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
				  <th>Tanggal</th>
                                  <th>No.Claim</th> 
                                  <th>Sales</th>
                              </tr>
                              </thead>
                              <tbody>				  
							  <tr>
								  <td><?php echo $de['tgl']; ?></td>
								  <td><?php echo $kode ; ?></td>
								  <td><?php echo $de['submiter'] ; ?></td>
							  </tr>
							  </tbody>
							  <thead>
							  <tr>
								  <th>Nama Claim</th>
								  <th>Jumlah</th>
								  <th></th>
                              </tr>
							  </thead>
							  <tbody>
			<?php $kd=$kode;
			$s=mysql_query("SELECT * FROM dtlclaim WHERE kode_claim='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jml'];
			$total=@$total+$subt; ?>
							  <tr>
							  <td><?php echo $sql['nama_claim']; ?></td><td>Rp. <?php echo number_format($subt); ?></td><td></td>
							  </tr>
							  <?php } ?>
<tr>
<td><b>Sub TOTAL</b></td><td><b>Rp. <?php echo number_format(@$total); ?></b></td><td></td>
</tr>
<tr>
<td colspan="3"><b>Lampiran</b></td>
</tr>
<?php
$k=mysql_query("SELECT * FROM dtlimgclaim WHERE kode_claim='$kd'");
$no = 1;
			while($kql=mysql_fetch_array($k)){
?>
<tr>
<td></td>
<td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#<?php echo $no; ?>"><?php echo $kd; ?> - <?php echo $no; ?></button>
<div class="col-lg-12">
                        <div class="modal fade" id="<?php echo $no; ?>" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H1"><?php echo $kql['img_claim']; ?></h4>
                                        </div>
                                        <div class="modal-body">

										<img src="<?php echo $kql['img_claim']; ?>" width="100%" />
                                        </div>
                                        <div class="modal-footer">
<a class="btn btn-primary" href="<?php echo $kql['img_claim']; ?>" target="_blank">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
</td>
<td></td>
</tr>
<?php
$no++;
 } ?>
</tbody>
</table>
<a class="btn btn-danger" href="?page=clain-marketing">Keluar</a>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>