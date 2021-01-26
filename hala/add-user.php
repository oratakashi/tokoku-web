    <section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-plus-sign"></i> Add User</h4>
                    <form role="form"name="input-user" action="?page=insert-user" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter username" required="required">
                    </div>
					<div class="form-group">
                        <label for="Username">Fullname</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Enter fullname" required="required">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required="required">
                    </div>
<div class="form-group">
					<label for="Level">Kategori Level</label>
					<select style="width: 250px;" class="form-control" name="level">
						<option value="">-</option>
						<option value="minimart">Kasir Counter</option>
						<option value="ksgrosir">Kasir Grosir</option>
						<option value="admin">Admin</option>
<?php if ($_SESSION[level]=='adminsp'){ ?>
						<option value="adminsp">Admin Super</option>
						</select>
<?php } else { ?> </select> <?php } ?>
						
</div>
                    <div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Enter alamat">
                    </div>
					<div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                    </div>
					<div class="form-group">
                        <label for="NoTelp">No.Telp</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="Enter no.telp">
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