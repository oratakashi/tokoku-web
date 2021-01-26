<?php
$brcode     = $_POST['brcode'];
$id_barang = $_POST['id_barang'];
$update = mysql_query("UPDATE stok_bahan SET brcode='$brcode' WHERE id_bahan='$id_barang'") or die(mysql_error());
if ($update) { echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=result-bar&id=$id_barang&barcode=$brcode\">");
}
?>