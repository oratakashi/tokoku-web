<?php 

$id           = $_POST['idcustomers'];
$namacustomers = $_POST['namacustomers'];
$namaperh = $_POST['namaperh'];
$project = $_POST['project'];
$status         = $_POST['status'];
$alamat       = $_POST['alamat'];
$telp         = $_POST['telp'];
$surel          = $_POST['email'];

$query = mysql_query("update tblcustomers set nama_customers='$namacustomers', persh='$namaperh', proyek='$project', jenis='$status', alamat_customers='$alamat', telp='$telp', surel='$surel' where id_customers='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=list-customers\">"); }


?>