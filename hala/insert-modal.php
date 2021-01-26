<?php
$today = date("Y-m-d");
$jenis      = $_POST['jenis'];
if ($jenis=='Kas'){
$kategori="kas";
} else if ($jenis=='Tambah Kas'){
$kategori="tks";
} else {
$qry_jenis  = mysql_query("SELECT kategori FROM tbltranslain WHERE keterangan ='$jenis'");
$data_jenis = mysql_fetch_array($qry_jenis);
$kategori   = $data_jenis[0];
}
$jumlah     = $_POST['jumlah'];

$query = mysql_query("insert into modal values('', '$jenis', '$kategori', '$jumlah', '$today')") or die(mysql_error());

if ($query) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=modal-awal\">");
}
?>