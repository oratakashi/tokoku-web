<?php
$iduser = $_SESSION['id'];
$id_supplier = $_POST['idsupplier'];
$namasupplier= $_POST['namasupplier'];
$alamat      = $_POST['alamat'];
$telp        = $_POST['telp'];

$query = mysql_query("insert into tblsupplier values('$id_supplier', '$iduser', '$namasupplier', '$alamat', '$telp')") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=list-supplier\">");
}
?>