<?php
$submiter 	= $_SESSION[nama];
$tgl		= date("Y-m-d");
$no_id   	= $_POST['kode'];
$folder 	= "lampiran-claim/";
	
$filename = $_FILES["lampiran"]["name"];
$filesize = $_FILES["lampiran"]["size"];
$fileupld = $_FILES["lampiran"]["tmp_name"];

$file_basename      = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext           = substr($filename, strripos($filename, '.')); // get file name
$allowed_file_types = array('.jpg','.jpeg','.png','.gif','.pdf');	


	if (in_array($file_ext,$allowed_file_types) && ($filesize < 1200000))
	{	
		// Rename file
		$newfilename = $no_id."-".date("His"). $file_ext;
		if (file_exists($folder . $newfilename))
		{
			// file already exists error
			echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=inp-claim&error=double\">"); 
		}
		else
		{		
			move_uploaded_file($fileupld, $folder . $newfilename);
			
			$query = mysql_query("insert into dtlimgclaim values('$no_id', '$folder$newfilename', '$tgl', '$submiter', 'N')") or die(mysql_error());

            if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=inp-claim&messages=success\">"); }
		}
	}
	elseif (empty($file_basename))
	{	
		// file size error
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=inp-claim&error=kode\">"); 
	} 
	elseif ($filesize > 1200000)
	{	
		// file size error
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=inp-claim&error=size\">"); 
	}
	else
	{
		// file type error
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?page=inp-claim&error=type\">"); 
	}

?>