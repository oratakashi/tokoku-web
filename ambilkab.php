<?php if(!empty($_GET['provinsi'])) {
session_start();
include('include/config.php'); 
$provinsi = $_GET['provinsi'];
echo "<option value='Semua'>-- Pilih Semua Kabupaten/Kota --</option>";
$query = mysql_query("SELECT * FROM regencies WHERE province_id='$provinsi'");
while ($data = mysql_fetch_array($query)) {
    echo '<option value="'.$data['id'].'">'.$data['name'].'</option>';
}
} else {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../\">");
}
?>