<?php 

$id           = $_POST['idsupplier'];
$namasupplier = $_POST['namasupplier'];
$alamat       = $_POST['alamat'];
$telp         = $_POST['telp'];


$query = mysql_query("update tblsupplier set nama_supplier='$namasupplier', alamat_supplier='$alamat', telp='$telp' where id_supplier='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=list-supplier\">"); }


?>