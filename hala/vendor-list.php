<?php if(!empty($_GET['act']) && $_GET['act']=='add') {
    if(!empty($_POST['regis'])) {
        $iduser = (strtotime("now"));
        $perusahaan = trim(htmlspecialchars(mysql_escape_string($_POST['namausaha'])));
        $fullname = trim(htmlspecialchars(mysql_escape_string($_POST['fullname'])));
        $email = trim(htmlspecialchars(mysql_escape_string($_POST['email'])));
        $notelp = $_POST['notelp'];
        $alamat =trim(htmlspecialchars(mysql_escape_string($_POST['alamat'])));
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $plan = 0;
        $usernama = trim(htmlspecialchars(mysql_escape_string($_POST['usernama'])));
        $sandikata = md5(trim(htmlspecialchars(mysql_escape_string($_POST['sandikata']))));
        $pesan = "Terima Kasih Atas Kunjungannya";
        $tgl_reg = date("Y-m-d H:i:s");
        
$perintah_cek=mysql_query(" SELECT * FROM setting WHERE perusahaan = '$perusahaan'"); 

if(mysql_num_rows($perintah_cek) > 0) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=vendor-list&act=add&error=perusahaan\">"); 
} else {
    
$reg1 = mysql_query("INSERT INTO tab_user(id, fullname, username, password, level, email, no_tlp, provi, kotab, alamat, status, plan, tgl_reg) VALUES ('$iduser','$fullname','$usernama','$sandikata','vendor','$email','$notelp','$provinsi','$kota','$alamat','1','$plan','$tgl_reg')") or die(mysql_error());
$reg2 = mysql_query("INSERT INTO setting(iduser, perusahaan, alamat, tlp, namap, pesan) VALUES ('$iduser','$perusahaan','$alamat','$notelp','$fullname','$pesan')") or die(mysql_error());
    
if($reg1==true && $reg2==true) {
    if($_POST['regis'] == '1') {
        echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=vendor-list&act=add&reg=berhasil\">"); 
    } else if($_POST['regis'] == '2') {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=vendor-list\">"); 
    }
}
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
<section>
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
				    <?php if (!empty($_GET['reg']) && $_GET['reg'] == 'berhasil') { ?>
                    <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Pendaftaran berhasil</strong>
                    </div>
                    <?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-user"></i> Vendor List
                        </div>
                        <div class="panel-body">
<form method="POST" action="">
            <fieldset class="form">
                <div class="form-group">
                    <input type="text" name="namausaha" placeholder="Nama Vendor" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" placeholder="Nama Pemilik Vendor" class="form-control" required>
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
                    <input type="text" name="alamat" placeholder="Alamat Vendor" class="form-control" required>
                </div> 
<?php if(!empty($_GET['paket']) && $_GET['paket'] == 1) { ?>
<input type="hidden" name="paket" value="1" class="form-control" required>
<?php } else { ?>
                <div class="form-group">
<select name="paket" id="paket" class="form-control" required="required">
<option value="2">-Pilih Paket-</option>
<option value="2">Paket Bundling - 1.200.000</option>
<option value="12">Paket 1 Tahun - 899.900</option>
<option value="3">Paket 3 Bulan - 269.700</option>
<!--<option value="6">Paket 6 Bulan - 539.400</option>
<option value="9">Paket 9 Bulan - 809.100</option>
<option value="12">Paket 1 Tahun - 1.078.000</option>-->

</select>
      </div>
<?php } ?>
                <div class="form-group">
                    <input type="text" id="namauser" name="usernama" placeholder="Username" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="password" id="katasandi" name="sandikata" placeholder="Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <a href="?page=vendor-list" class="btn btn-danger btn-md">Tutup</a>
                    <button  type="submit" name="regis" value="1" class="btn btn-primary btn-md">Simpan & Tambah</button>
                    <button  type="submit" name="regis" value="2" class="btn btn-success btn-md">Simpan & Selesai</button>
                </div>
                

            </fieldset>
        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php } else { ?>
<section>
        <div class="container">
		<div class="row">
			<div class="col-lg-12">
			<a class="btn btn-success" href="?page=vendor-list&act=add"><i class="icon-plus"></i> Add Vendor</a>
			</div>
        </div>
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
                            <i class="icon-user"></i> Vendor List
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
                                            <th>Status</th>
                                            <th>Last Login</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php	
        $query = mysql_query("SELECT *, regencies.name AS kotab, provinces.name AS provi FROM tab_user LEFT JOIN regencies ON tab_user.kotab=regencies.id LEFT JOIN provinces ON tab_user.provi=provinces.id LEFT JOIN setting ON tab_user.id=setting.iduser WHERE tab_user.level ='vendor' ORDER BY tab_user.tgl_reg DESC ") or die(mysql_error());
		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		    <td><?php echo $data['fullname']; ?></td>
		    <td><?php echo $data['perusahaan']; ?></td>
        	<td><?php echo $data['username']; ?></td>
        	<td><?php echo $data['no_tlp']; ?></td>
			<td><?php echo $data['kotab']; ?></td>
			<td><?php echo $data['provi']; ?></td>
        	<td><?php if($data['status']=='0') { ?>
        	<a class="btn btn-default btn-xs" href="?page=vendor-list&act=active&id=<?php echo $data['iduser'];?>&val=1">Inactive</a>
        	<?php } else if($data['status']=='1') { ?>
        	<a class="btn btn-success btn-xs" href="?page=vendor-list&act=active&id=<?php echo $data['iduser'];?>&val=2">Actived</a>
        	<?php } else if($data['status']=='2') { ?>
        	<a class="btn btn-warning btn-xs" href="?page=vendor-list&act=active&id=<?php echo $data['iduser'];?>&val=1">Suspended</a>
        	<?php } else { } ?></td>
        	<td><?php if($data['lastlogin']=='0000-00-00 00:00:00') { echo "-";} else {
        	echo date_format(date_create($data['lastlogin']),"d M Y H:i:s");
        	} ?></td>
        	<td><a class="btn btn-primary btn-xs" href="?page=vendor-list&act=edit&id=<?php echo $data['iduser']; ?>"><i class="icon-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="?page=vendor-list&act=delete&id=<?php echo $data['iduser']; ?>"><i class="icon-trash "></i></a>
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