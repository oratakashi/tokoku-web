<?php

$kode = $_POST['kode'];
$ket = $_POST['ket'];
$tgl = date("Y-m-d");

$query = mysql_query("insert into dtlactivity values('$kode', '$tgl', '$ket')") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=daily-report\">");
}
?>