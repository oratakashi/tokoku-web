<?
if($_GET['bar']){
include 'bar128.php';
echo bar128(stripslashes($_GET['bar']));
//fungsi stripslashes buat menghilankan tanda \
}
?>
<title>Percobaan Barcode128</title>
<body>
<form name='form' action='<?=$_SERVER['PHP_SELF']?>'>
Bar Code : <input type='text' name='bar' value='<?=$_GET['bar']?>'>&nbsp;
<input type='submit' value='Buat Kode'>
</form>
</body>
