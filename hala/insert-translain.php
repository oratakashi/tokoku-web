<?php
$kategori   = $_POST['kategori'];
$keterangan = $_POST['keterangan'];

if ($kategori=='kt1'){

$query1 = mysql_query("insert into tbltranslain values('', '{$_SESSION['id']}', '$keterangan', '$kategori')") or die(mysql_error());
$query2 = mysql_query("insert into tbltranslain values('', '{$_SESSION['id']}', 'Depresiasi $keterangan', '$kategori')") or die(mysql_error());
$query3 = mysql_query("insert into tbltranslain values('', '{$_SESSION['id']}', 'Beban Depresiasi $keterangan', 'kt3')") or die(mysql_error());

if ($query1&&$query2&&$query3) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">");
}
} else if ($kategori=='kt2') {
	
$query1 = mysql_query("insert into tbltranslain values('', '{$_SESSION['id']}', '$keterangan dibayar dimuka', '$kategori')") or die(mysql_error());
$query2 = mysql_query("insert into tbltranslain values('', '{$_SESSION['id']}', 'Beban $keterangan', 'kt3')") or die(mysql_error());

if ($query1&&$query2) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">");
}
} else {
	
$query = mysql_query("insert into tbltranslain values('', '{$_SESSION['id']}', '$keterangan', '$kategori')") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=add-trans-lain\">");
}
}
?>