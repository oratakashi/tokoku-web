<?php
$perusahaan= $_POST['perusahaan'];
$alamat = $_POST['alamat'];
$namap = $_POST['namap'];
$tlp = $_POST['tlp'];
$tempo = $_POST['tempo'];
$pesan = $_POST['pesan'];
$no_id = date("His");

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
			
			$query = mysql_query("update setting set perusahaan='$perusahaan', alamat='$alamat', tlp='$tlp', namap='$namap', logo='$folder$newfilename', pesan='$pesan', jatuhtempo='$tempo'") or die(mysql_error());

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
	
$query = mysql_query("update setting set perusahaan='$perusahaan', alamat='$alamat', tlp='$tlp', namap='$namap', pesan='$pesan', jatuhtempo='$tempo'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=pengaturan&messages=success\">"); }	
}
?>