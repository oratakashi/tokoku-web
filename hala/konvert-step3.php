<?php
$idbarang = $_POST['idbarang'];
$namabaru = $_POST['namabaru'];
$barcode = $_POST['barcode'];
$jmla = $_POST['jmla'];
$jmlb = $_POST['jmlb'];
$satbaru = $_POST['satbaru'];
$se = mysql_query("select * from stok_bahan where id_bahan='{$idbarang}'");
$pi = mysql_fetch_array($se);
$namabarang = $pi['nama_bahan'];
$satlama = $pi['satuan'];
$harga_per =$pi['harga_per'];
$hpp =($harga_per*$jmla)/$jmlb;
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="blog">
                    <div class="blog-item">
                        <div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Konversi</h4>
<table class="table table-bordered table-striped table-condensed">		
<form role="form" name="akhir-konversi" action="?page=akhir-konversi" method="POST">
<tr><td colspan="3"><b>Barcode<b></td><td style="text-align: right;"><b><?php echo $barcode; ?><b></td></tr>
<tr><td colspan="3"><b>Nama Baru<b></td><td style="text-align: right;"><b><?php echo $namabaru; ?><b></td></tr>
<tr><td colspan="3"><b>Jumlah A<b></td><td style="text-align: right;"><b><?php echo $jmla;?> <?php echo $satlama;?><b></td></tr>
<tr><td colspan="3"><b>Jumlah B<b></td><td style="text-align: right;"><b><?php echo $jmlb;?> <?php echo $satbaru;?><b></td></tr>
<tr><td colspan="3"><b>HPP<b></td><td style="text-align: right;"><b>Rp. <?php echo number_format($hpp); ?><b></td></tr>
<tr><td colspan="3"><b>Harga Jual<b></td><td style="text-align: right;"><input type="text" class="form-control" name="hjual"></td></tr>
<input type="hidden" value="<?php echo $idbarang; ?>" name="idbarang">
<input type="hidden" value="<?php echo $barcode; ?>" name="barcode">
<input type="hidden" value="<?php echo $namabaru; ?>" name="namabaru">
<input type="hidden" value="<?php echo $jmla; ?>" name="jmla">
<input type="hidden" value="<?php echo $jmlb; ?>" name="jmlb">
<input type="hidden" value="<?php echo $hpp; ?>" name="hpp">
<input type="hidden" value="<?php echo $satbaru; ?>" name="satbaru">
</table>
<a href="?page=konversi" class="btn btn-danger"><i class="icon-arrow-left"></i> Batal</a>

<button type="submit" class="btn btn-primary">
								Selesai <i class="icon-arrow-right"></i>
								</button>
							</form>
						</div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->