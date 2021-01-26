<?php

$id_customers  = $_POST['idcustomers'];
$namacustomers = $_POST['namacustomers'];
$namaperh = $_POST['namaperh'];
$project = $_POST['project'];
$alamat        = $_POST['alamat'];
$telp          = $_POST['telp'];
$surel          = $_POST['email'];
$submiter      = $_POST['submiter'];

$query = mysql_query("insert into tblcustomers values('$id_customers', '$namacustomers', '$namaperh', '$project', '$alamat', 'pelanggan', '$telp', '$surel','$submiter')") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=list-customers\">");
}
?>