<?php 
$id = $_GET['id'];
$query = mysql_query("select * from tab_user where id='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-pencil"></i> Edit User</h4>
                    <form role="form"name="edit-user" action="?page=update-user" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" disabled >
                    </div>
					<div class="form-group">
                        <label for="Username">Fullname</label>
                        <input type="text" class="form-control" name="fullname" value="<?php echo $data['fullname']; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin diganti">
                    </div>
<div class="form-group">
					<label for="Level">Level</label>
					<select style="width: 250px;" class="form-control" name="level">
<option value="">-</option>
<!--<option value="sales"<?php //if ($data['level']=='sales'){echo 'selected';} ?>>Sales</option>
<option value="hsales"<?php //if ($data['level']=='hsales'){echo 'selected';} ?>>Head Sales</option>
<option value="kurir"<?php //if ($data['level']=='kurir'){echo 'selected';} ?>>Delivery</option>
<option value="gudang"<?php //if ($data['level']=='gudang'){echo 'selected';} ?>>Gudang</option>-->
<option value="minimart"<?php if ($data['level']=='minimart'){echo 'selected';} ?>>Kasir Minimarket</option>
<option value="ksgrosir"<?php if ($data['level']=='ksgrosir'){echo 'selected';} ?>>Kasir Grosir</option>
<option value="admin"<?php if ($data['level']=='admin'){echo 'selected';} ?>>Admin</option>
<?php if ($_SESSION[level]=='adminsp'){ ?>
						<option value="adminsp"<?php if ($data['level']=='adminsp'){echo 'selected';} ?>>Admin Super</option>
						</select>
<?php } else { ?> </select> <?php } ?>
						
</div>
                    <div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>" />
                    </div>
					<div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>" />
                    </div>
					<div class="form-group">
                        <label for="NoTelp">No.Telp</label>
                        <input type="text" class="form-control" name="no_hp" value="<?php echo $data['no_tlp']; ?>" />
                    </div>
                    <a class="btn btn-danger" href="?page=user-list"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->