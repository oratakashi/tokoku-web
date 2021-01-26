<?php 
$id = $_SESSION['id'];
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
<input type="hidden" name="level" value="<?php echo $data['level']; ?>" />
<div class="form-group">
                        <label for="Username">ID User</label>
                        <input type="text" class="form-control" value="<?php echo $data['id']; ?>" disabled >
                    </div>
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
                        <label for="Alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>" />
                    </div>
					<div class="form-group">
                        <label for="NoTelp">No.Telp</label>
                        <input type="text" class="form-control" name="no_hp" value="<?php echo $data['no_tlp']; ?>" />
                    </div>
                    <a class="btn btn-danger" <?php if ($_SESSION['level']=='adminsp') {?>href="?page=user-list"<?php } else { ?>href="index.php"<?php }?>><i class="icon-remove"></i> Batal</a>
                    <button type="submit" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->