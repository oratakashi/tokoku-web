<?php 

$id         = $_POST['id'];
$jenis      = $_POST['jenis'];
$jumlah     = $_POST['jumlah'];


$query = mysql_query("update modal set ketmod='$jenis', jmlmod='$jumlah' where idmod='$id'") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=modal-awal\">"); }


?>