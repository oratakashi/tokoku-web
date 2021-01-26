<html>
<?php
include('include/config.php');
include('include/bar128.php');
$it = $_GET['id'];
$query = mysql_query("select * from stok_bahan where brcode='$it'") or die(mysql_error());
$data = mysql_fetch_array($query);
//echo bar128(stripslashes($_GET['id']));
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>CODE <?php echo $it;?> </title>
<style>
body {
	font-family:Calibri, Helvetica, sans-serif;
}
</style>
</head>
<body bgcolor="white">
<center>
<table cellspacing="5" cellpadding="5" style="border: 1px solid #808080;"><tr style="text-align: center; border: 1px solid #D1D1D1;"><td><?php echo bar128(stripslashes($_GET['id']));
?><!--<img alt="<?php echo $it;?>" src="barcode.php?codetype=Code128&size=100&text=<?php echo $it;?>&print=true" />--></td>
</tr>
<tr><td style="text-align: center;"><span style="font-size: 12;"><?php echo $data['nama_bahan'];?></span></td></tr>
</table>
</center>
</body>
</html>
<script>
window.print();
</script>