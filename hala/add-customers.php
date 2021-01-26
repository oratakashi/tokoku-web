<?php 
$today = date("Ymd");
$query = "SELECT max(id_customers) AS last FROM tblcustomers WHERE id_customers LIKE 'CSM$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "CSM";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section id="blog" class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            <div class="blog">
                <div class="blog-item">
                    <div class="blog-content">
                        
                        <h4 class="mb"><i class="icon-plus-sign"></i> Tambah Pelanggan</h4>
                            
                            <form role="form" name="input-customers" action="?page=insert-customers" method="post">
                                <input type="hidden" name="submiter" value="<?php echo $_SESSION['nama'];?>" readonly>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="idcustomers" value="<?php echo $nou;?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="namabahan">Nama Pelanggan</label>
                                        <input type="text" class="form-control" name="namacustomers" placeholder="Enter Nama Pelanggan" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="Nama Perusahaan">Nama Perusahaan</label>
                                        <input type="text" class="form-control" name="namaperh" placeholder="Enter Nama Perusahaan" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="Project">Project</label>
                                        <input type="text" class="form-control" name="project" placeholder="Enter Project" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" placeholder="Enter Alamat" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">No. Telp</label>
                                        <input type="text" class="form-control" name="telp" placeholder="Enter No. Telp" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                    </div>	
                                        <a class="btn btn-danger" href="?page=list-customers"><i class="icon-remove"></i> Batal</a>
                                        <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                            </form>
                            
                    </div>
                </div><!--/.blog-item-->
            </div>
        </div><!--/.col-md-8-->
    </div><!--/.row-->
</section><!--/#blog-->