<?php
$idbarang = $_POST['id_barang'];
$se = mysql_query("select * from stok_bahan where id_bahan='{$idbarang}'");
$pi = mysql_fetch_array($se);
$namabarang = $pi['nama_bahan'];
$satlama = $pi['satuan'];
?>
<section id="blog" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">
                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Konversi Barang</h4>
<form role="form" name="konvert2" action="?page=konvert-step3" method="post">
<div class="form-group">
    <label for="Nama Barang">Nama Barang</label>
    <input type="text" class="form-control" name="namabarang" value="<?php echo $namabarang;?>" readonly>
<input type="hidden" class="form-control" name="idbarang" value="<?php echo $idbarang;?>">
</div>
<div class="form-group">
    <label for="Nama Barang">Barcode</label>
    <input type="text" class="form-control" name="barcode">
</div>
<div class="form-group">
    <label for="namabaru">Nama Baru</label>
    <input type="text" class="form-control" name="namabaru">
</div>
<div class="form-group">
    <label for="JMLa">Jumlah <?php echo $satlama;?></label>
    <input type="text" class="form-control" name="jmla">
</div>
<div class="form-group">
    <label for="JMLb">Jumlah Baru</label>
    <input type="text" class="form-control" name="jmlb">
</div>
<div class="form-group">
    <label for="Satbaru">Satuan Baru</label>
    <input type="text" class="form-control" name="satbaru">
</div>
        <button type="button" class="btn btn-danger" onclick="history.back();"><i class="icon-arrow-left"></i> Back</button>

        <button type="submit" class="btn btn-primary">OK <i class="icon-arrow-right"></i></button>
</form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
</section><!--/#blog-->