<?php 

$id         = $_POST['id'];
$kategori   = $_POST['kategori'];
$keterangan = $_POST['keterangan'];

if ($kategori=='kt1'){

$query = mysql_query("update tbltranslain set keterangan='$keterangan', kategori='$kategori' where id_trnlain='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">");
}
} else if ($kategori=='kt2') {
	
$query = mysql_query("update tbltranslain set keterangan='$keterangan', kategori='$kategori' where id_trnlain='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">");
}
} else {
	
$query = mysql_query("update tbltranslain set keterangan='$keterangan', kategori='$kategori' where id_trnlain='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">");
}
}

?>