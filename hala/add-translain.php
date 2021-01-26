<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

<div class="blog-content">
<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Jenis Transaksi Lainnya</h4>
<form role="form" name="input-translain" action="?page=insert-translain" method="post">			
	<div class="form-group">
    <label for="kategori">Kategori Jenis Transaksi</label>
        <select class="form-control" name="kategori" data-rel="chosen" required="required">
			<option value="kt1">Inventaris</option>
			<option value="kt2">Biaya dibayar dimuka</option>
			<option value="kt3">Biaya-biaya</option>
			<option value="kt4">Hutang</option>
			<option value="kt5">Biaya atas pendapatan</option>
			<option value="kt6">Pendapatan lainnya</option>
			<option value="kt7">Biaya atas pendapatan lainnya</option>
                        <option value="kt8">Biaya Operasional Sales</option>
		</select>
    </div>
    <div class="form-group">
    <label for="translain">Keterangan</label>
        <input type="text" class="form-control" name="keterangan" placeholder="Nama Transaksi Lainnya" required="required">
    </div>
		
    <a class="btn btn-danger" href="?page=add-trans-lain"><i class="icon-remove"></i> Batal</a>
    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
</form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->