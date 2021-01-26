<?php if(!empty($_GET['act']) && $_GET['act']=='add') {
if(!empty($_POST['adduser'])) {
        $iduser = (strtotime("now"));
        $perusahaan = mysql_escape_string($_POST['namausaha']);
        $fullname = mysql_escape_string($_POST['fullname']);
        $email = mysql_escape_string($_POST['email']);
        $notelp = $_POST['notelp'];
        $alamat = mysql_escape_string($_POST['alamat']);
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $usernama = $_POST['usernama'];
        $sandikata = md5($_POST['sandikata']);
        $pesan = "Terima Kasih Atas Kunjungannya";
        
        $reg1 = mysql_query("INSERT INTO tab_user(id, fullname, username, password, email, no_tlp, provi, kotab, alamat) VALUES ('$iduser','$fullname','$usernama','$sandikata','$email','$notelp','$provinsi','$kota','$alamat')") or die(mysql_error());
        $reg2 = mysql_query("INSERT INTO setting(iduser, perusahaan, alamat, tlp, namap, pesan) VALUES ('$iduser','$perusahaan','$alamat','$notelp','$fullname','$pesan')") or die(mysql_error());
    if($reg1 && $reg2) {
$to = $email;
$subject = "Aktivasi Akun Toko Ritel System";
$message = "
<html>
<head>
<title>Aktivasi Akun Toko Ritel System</title>
</head>
<body>
<p>Kepada Yth Bapak/Ibu ".$fullname."</p>
<p></p>
<p>Assalamu’alaikum warahmatullahi wabarakatuh</p>
<p></p>
<p>Terima Kasih Anda telah melakukan pendaftaran Akun Toko Ritel System dengan detail sebagai berikut  :</p>
<p>ID Akun : ".$iduser."</p>
<p>Nama Akun : ".$_POST['usernama']."</p>
<p>Password : ".$_POST['sandikata']."</p>
<p></p>
<p>Jangan lupa untuk melakukan aktivasi akun melalui link berikut :</p>
<p><a href='https://aplikasiku.co.id/ritel/index.php?activation=".$iduser."&token=".$sandikata."'>Konfirmasi Aktivasi Akun Toko Ritel System</a></p>
<p></p>
<p>Demikian informasi dari kami. Terima kasih telah bergabung bersama layanan jasa kami.</p>
<p></p>
<p>Terima Kasih,</p>
</body>
</html>
";
// Always set content-type when sending HTML emailagn
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@ichwan-ms.com>' . "\r\n";
// $headers .= 'Cc: example@example' . "\r\n";
mail($to,$subject,$message,$headers);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=user-list&reg=berhasil\">");
    }
}
?>
<script type="text/javascript" src="js/jquery-tklks.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=provinsi>
  $("#provinsi").change(function(){
    var provinsi = $("#provinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "provinsi="+provinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });

});

</script>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-pencil"></i> Add User</h4>
                <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="namausaha" placeholder="Nama Usaha" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" placeholder="Nama Pemilik Usaha" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Alamat Email" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="notelp" placeholder="Nomor Telepon" class="form-control" required>
                </div>
                
                <div class="form-group">
				                                
				                                    
<select class="form-control" name="provinsi" id="provinsi" required="required">
<option selected disabled>-Pilih Provinsi-</option>
<?php $query = mysql_query("SELECT * FROM provinces");
while ($data = mysql_fetch_array($query)) { ?>
<option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>
<?php } ?>
						</select>
				                                
				                            </div>
<div class="form-group">
<select name="kota" id="kota" class="form-control" required="required">
<option selected disabled>-Pilih Kota-</option>
</select>
				                                
				                            </div>
				<div class="form-group">
                    <input type="text" name="alamat" placeholder="Alamat Usaha" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" id="namauser" name="usernama" placeholder="Username" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="password" id="katasandi" name="sandikata" placeholder="Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <a class="btn btn-danger" href="?page=user-list"><i class="icon-remove"></i> Batal</a>
                    <button  type="submit" name="adduser" value="Submit" class="btn btn-success">Submit</button>
                </div>
                
        </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='edit') {
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM tab_user LEFT JOIN setting ON tab_user.id=setting.iduser WHERE tab_user.id='$id'") or die(mysql_error());
$data = mysql_fetch_array($query);
if(!empty($_POST['edituser'])) {
        $iduser = $_POST['iduser'];
        $perusahaan = mysql_escape_string($_POST['namausaha']);
        $fullname = mysql_escape_string($_POST['fullname']);
        $email = mysql_escape_string($_POST['email']);
        $notelp = $_POST['notelp'];
        $alamat = mysql_escape_string($_POST['alamat']);
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $usernama = $_POST['usernama'];
        $sandikata = md5($_POST['sandikata']);
        if(!empty($_POST['sandikata'])) {
        $reg1 = mysql_query("UPDATE tab_user SET fullname='$fullname', password='$sandikata', email='$email', no_tlp='$notelp', provi='$provinsi', kotab='$kota', alamat='$alamat' WHERE id='$iduser'") or die(mysql_error());
        } else {
        $reg1 = mysql_query("UPDATE tab_user SET fullname='$fullname', email='$email', no_tlp='$notelp', provi='$provinsi', kotab='$kota', alamat='$alamat' WHERE id='$iduser'") or die(mysql_error());
        }
        $reg2 = mysql_query("UPDATE setting SET perusahaan='$perusahaan', alamat='$alamat', tlp='$notelp', namap='$fullname' WHERE iduser='$iduser'") or die(mysql_error());
    
    if($reg1 && $reg2) {
        echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=user-list\">");
    }
}

?>
<script type="text/javascript" src="js/jquery-tklks.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=provinsi>
  $("#provinsi").change(function(){
    var provinsi = $("#provinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "provinsi="+provinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });

});

</script>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-pencil"></i> Edit User</h4>
                <form method="POST" action="">
                <input type="hidden" name="iduser" value="<?php echo $data['id']; ?>" class="form-control" required>
                <div class="form-group">
                    <input type="text" name="namausaha" placeholder="Nama Usaha" value="<?php echo $data['perusahaan']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" placeholder="Nama Pemilik Usaha" value="<?php echo $data['fullname']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Alamat Email" value="<?php echo $data['email']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="notelp" placeholder="Nomor Telepon" value="<?php echo $data['no_tlp']; ?>" class="form-control" required>
                </div>
                
                <div class="form-group">
				                                
				                                    
<select class="form-control" name="provinsi" id="provinsi" required="required">
<option disabled>-Pilih Provinsi-</option>
<?php $querys = mysql_query("SELECT * FROM provinces");
while ($datas = mysql_fetch_array($querys)) { ?>
<option value="<?php echo $datas['id'];?>" <?php if($data['provi']==$datas['id']) { echo 'selected';} ?>><?php echo $datas['name'];?></option>
<?php } ?>
						</select>
				                                
				                            </div>
<div class="form-group">
<select name="kota" id="kota" class="form-control" required="required">
<option disabled>-Pilih Kota-</option>
<?php $queryz = mysql_query("SELECT * FROM regencies WHERE province_id='{$data['provi']}'");
while ($dataz = mysql_fetch_array($queryz)) { ?>
<option value="<?php echo $dataz['id'];?>" <?php if($data['kotab']==$dataz['id']) { echo 'selected';} ?>><?php echo $dataz['name'];?></option>
<?php } ?>
</select>
				                                
				                            </div>
				<div class="form-group">
                    <input type="text" name="alamat" placeholder="Alamat Usaha" value="<?php echo $data['alamat']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" id="namauser" name="usernama" placeholder="Username" value="<?php echo $data['username']; ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <input type="password" id="katasandi" name="sandikata" placeholder="Kosongkan jika tidak ingin diganti" class="form-control">
                </div>
                <div class="form-group">
                    <a class="btn btn-danger" href="?page=user-list"><i class="icon-remove"></i> Batal</a>
                    <button  type="submit" name="edituser" value="Sunting" class="btn btn-success">Sunting</button>
                </div>
                
        </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->
<?php } else if(!empty($_GET['act']) && $_GET['act']=='delete') {
$id = $_GET['id'];
$delete1=mysql_query("DELETE FROM tab_user WHERE id = '$id'") or die(mysql_error());
$delete2=mysql_query("DELETE FROM setting WHERE iduser = '$id'") or die(mysql_error());
if($delete1 && $delete2) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=user-list\">");
}
} else if(!empty($_GET['act']) && $_GET['act']=='active') {
$id = $_GET['id'];
$val = $_GET['val'];
$updst=mysql_query("UPDATE tab_user SET status = '$val' WHERE id = '$id'") or die(mysql_error());
if($updst) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=user-list\">");
}
} else { ?>
<section>
        <div class="container">
		<!--<div class="row">
			<div class="col-lg-12">
			<a class="btn btn-success" href="?page=add-user"><i class="icon-plus"></i> Add User</a>
			</div>
        </div>-->
            <div class="row">
				<div class="col-lg-12">
				    <?php if (!empty($_GET['reg']) && $_GET['reg'] == 'berhasil') { ?>
<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<strong>Pendaftaran berhasil link aktivasi sudah dikirim ke email pendaftar</strong>
</div>
<?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> User List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Nama Usaha</th>
                                            <th>Username</th>
                                            <th>Telp</th>
                                            <th>Kota</th>
                                            <th>Provinsi</th>
                                            <th>Plan</th>
                                            <th>Status</th>
                                            <th>Last Login</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
if ($_SESSION['level']=='adminsp')
{        $query = mysql_query("SELECT *, regencies.name AS kotab, provinces.name AS provi FROM tab_user LEFT JOIN regencies ON tab_user.kotab=regencies.id LEFT JOIN provinces ON tab_user.provi=provinces.id LEFT JOIN setting ON tab_user.id=setting.iduser WHERE tab_user.level ='admin' ORDER BY tab_user.tgl_reg DESC ") or die(mysql_error());
} else { $query = mysql_query("SELECT * FROM tab_user WHERE level ='admin' ORDER BY id ASC ") or die(mysql_error());
}
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
		    
$plan = $data['plan'];
        
        if($plan == 2) {
            $ketpaket = "paket Bundling sebesar Rp. 1.200.000.";
        } else if($plan == 12) {
            $ketpaket = "paket 1 Tahun sebesar Rp. 899.900.";
        } else if($plan == 3) {
            $ketpaket = "paket 3 Bulan sebesar Rp. 269.700.";
        } else if($plan == 1) {
            $ketpaket = "paket free 14 hari.";
        } 
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		    <td><?php echo $data['fullname']; ?></td>
		    <td><?php echo $data['perusahaan']; ?></td>
        	<td><?php echo $data['username']; ?></td>
        	<td><?php echo $data['no_tlp']; ?></td>
			<td><?php echo $data['kotab']; ?></td>
			<td><?php echo $data['provi']; ?></td>
			<td><?php echo $ketpaket; ?></td>
        	<td><?php if($data['status']=='0') { ?>
        	<a class="btn btn-default btn-xs" href="?page=user-list&act=active&id=<?php echo $data['iduser'];?>&val=1">Inactive</a>
        	<?php } else if($data['status']=='1') { ?>
        	<a class="btn btn-success btn-xs" href="?page=user-list&act=active&id=<?php echo $data['iduser'];?>&val=2">Actived</a>
        	<?php } else if($data['status']=='2') { ?>
        	<a class="btn btn-warning btn-xs" href="?page=user-list&act=active&id=<?php echo $data['iduser'];?>&val=1">Suspended</a>
        	<?php } else { } ?></td>
        	<td><?php if($data['lastlogin']=='0000-00-00 00:00:00') { echo "-";} else {
        	echo date_format(date_create($data['lastlogin']),"d M Y H:i:s");
        	} ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=user-list&act=edit&id=<?php echo $data['iduser']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=user-list&act=delete&id=<?php echo $data['iduser']; ?>"><i class="icon-trash "></i></a>
			</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php } ?>