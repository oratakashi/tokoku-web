<?php 
$today = date("Ymd");
$query = "SELECT max(id_supplier) AS last FROM tblsupplier WHERE id_supplier LIKE 'SPL$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "SPL";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Tambah Supplier</h4>
<form role="form" name="input-supplier" action="?page=insert-supplier" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="idsupplier" value="<?php echo $nou;?>" readonly>
                    </div>
                        <div class="form-group">
                        <label for="namabahan">Nama Supplier</label>
                        <input type="text" class="form-control" name="namasupplier" placeholder="Enter Nama Supplier" required="required">
                    </div>				
		   <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Enter Alamat" required="required">
                    </div>
<div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input type="text" class="form-control" name="telp" placeholder="Enter No. Telp" required="required">
                    </div>			
                    <a class="btn btn-danger" href="?page=list-supplier"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>

                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->