<?php 
if(!empty($_POST['pengatur'])) {
$perusahaan= $_POST['perusahaan'];
$alamat = $_POST['alamat'];
$namap = $_POST['namap'];
$tlp = $_POST['tlp'];
$tempo = $_POST['tempo'];
$pesan = $_POST['pesan'];
$no_id = strtotime("now");

$folder  = "logo/";
$filename = $_FILES["logo"]["name"];
$filesize = $_FILES["logo"]["size"];
$fileupld = $_FILES["logo"]["tmp_name"];

if (!empty($filename)){
$file_basename      = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext           = substr($filename, strripos($filename, '.')); // get file name
$allowed_file_types = array('.jpg','.jpeg','.png');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 500000))
	{	
		// Rename file
		$newfilename = $no_id . $file_ext;
		if (file_exists($folder . $newfilename))
		{
			// file already exists error
			echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&error=double\">"); 
		}
		else
		{		
			move_uploaded_file($fileupld, $folder . $newfilename);
			
			$query = mysql_query("UPDATE setting SET perusahaan='$perusahaan', alamat='$alamat', tlp='$tlp', namap='$namap', logo='$folder$newfilename', pesan='$pesan', jatuhtempo='$tempo' WHERE iduser='{$_SESSION['id']}'") or die(mysql_error());

            if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&messages=success\">"); }
		}
	}
	elseif (empty($file_basename))
	{	
		// file size error
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&error=empty\">"); 
	} 
	elseif ($filesize > 500000)
	{	
		// file size error
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&error=size\">"); 
	}
	else
	{
		// file type error
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&error=type\">"); 
	}
} else {
$query = mysql_query("UPDATE setting SET perusahaan='$perusahaan', alamat='$alamat', tlp='$tlp', namap='$namap', pesan='$pesan', jatuhtempo='$tempo' WHERE iduser='{$_SESSION['id']}'") or die(mysql_error());
if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&messages=success\">"); }	
}
}
$query = mysql_query("SELECT * FROM setting WHERE iduser='{$_SESSION['id']}'") or die(mysql_error());
$data = mysql_fetch_array($query);
?>
<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						<h4 class="mb"><i class="icon-pencil"></i> Pengaturan Profile</h4>
                    <form role="form"name="pengaturan" action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="Perusahaan">ID Member</label>
                        <input type="text" class="form-control" readonly="readonly" value="<?php echo $data['iduser']; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="Perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="perusahaan" value="<?php echo $data['perusahaan']; ?>" >
                    </div>
					<div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <textarea id="autosize" name="alamat" class="form-control"><?php echo $data['alamat']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="Pemilik">Pimpinan</label>
                        <input type="text" class="form-control" name="namap" value="<?php echo $data['namap']; ?>" />
                    </div>
					<div class="form-group">
                        <label for="NoTelp">No.Telp</label>
                        <input type="text" class="form-control" name="tlp" value="<?php echo $data['tlp']; ?>" />
                    </div>
<div class="form-group">
                        <label for="Logo">Logo</label>
                        <input type="file" name="logo" />
                    </div>
<div class="form-group">
                        <label for="Jatem">Jatuh Tempo</label>
                        <input type="text" class="form-control" name="tempo" value="<?php echo $data['jatuhtempo']; ?>" />
                    </div>
<div class="form-group">
                        <label for="Pesan">Pesan</label>
                        
						<textarea class="form-control" name="pesan" col="5"><?php echo $data['pesan']; ?></textarea>
                    </div>
                    <a class="btn btn-danger" href="index.php"><i class="icon-remove"></i> Batal</a>
                    <button type="submit" name="pengatur" value="OK" class="btn btn-primary">OK <i class="icon-share-alt"></i></button>
                </form>
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->