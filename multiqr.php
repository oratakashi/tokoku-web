<?php
include('include/config.php');
?>
<html>
<head>
<meta charset="UTF-8" />
<title>Multiple QR code</title>
<meta charset="UTF-8" />
</head>
<body onload="javascript:self.print()">
<table align="center" cellspacing="2" cellpadding="5" style="border: 1px solid #808080;">
<?php
$s=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 0, 5");
if(mysql_num_rows($s) > 0) {
$displays='true'; 
} else {
$displays='none'; 
}
?>
<tr style="display:<?php echo $displays; ?>;">
<?php
$s=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 0, 5");
while($sql=mysql_fetch_array($s)){
?>
<td width="20%" style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $sql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $sql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $sql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($sql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
<?php
$a=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 5, 5");
if(mysql_num_rows($a) > 0) {
$displaya='true'; 
} else {
$displaya='none'; 
}
?>
<tr style="display:<?php echo $displaya; ?>;">
<?php
$a=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 5, 5");
while($aql=mysql_fetch_array($a)){
?>
<td style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $aql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $aql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $aql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($aql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
<?php
$b=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 10, 5");
if(mysql_num_rows($b) > 0) {
$displayb='true'; 
} else {
$displayb='none'; 
}
?>
<tr style="display:<?php echo $displayb; ?>;">
<?php
$b=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 10, 5");
while($bql=mysql_fetch_array($b)){
?>
<td style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $bql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $bql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $bql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($bql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
<?php
$c=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 15, 5");
if(mysql_num_rows($c) > 0) {
$displayc='true'; 
} else {
$displayc='none'; 
}
?>
<tr style="display:<?php echo $displayc; ?>;">
<?php
$c=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 15, 5");
while($cql=mysql_fetch_array($c)){
?>
<td style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $cql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $cql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $cql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($cql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
<?php
$d=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 20, 5");
if(mysql_num_rows($d) > 0) {
$displayd='true'; 
} else {
$displayd='none'; 
}
?>
<tr style="display:<?php echo $displayd; ?>;">
<?php
$d=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 20, 5");
while($dql=mysql_fetch_array($d)){
?>
<td style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $dql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $dql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $dql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($dql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
<?php
$e=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 25, 5");
if(mysql_num_rows($e) > 0) {
$displaye='true'; 
} else {
$displaye='none'; 
}
?>
<tr style="display:<?php echo $displaye; ?>;">
<?php
$e=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 25, 5");
while($eql=mysql_fetch_array($e)){
?>
<td style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $eql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $eql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $eql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($eql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
<?php
$f=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 30, 5");
if(mysql_num_rows($f) > 0) {
$displayf='true'; 
} else {
$displayf='none'; 
}
?>
<tr style="display:<?php echo $displayf; ?>;">
<?php
$f=mysql_query("select * from tblmultiqr LEFT JOIN stok_bahan ON tblmultiqr.qrid=stok_bahan.brcode limit 30, 5");
while($fql=mysql_fetch_array($f)){
?>
<td style="border: 1px solid #808080;" align="center" valign="middle">
<img width="150" src="<?php echo $fql['imgqr'];?>" /><br>
<span style="font-size: 12;"><?php echo $fql['qrid'];?></span><br>
<span style="font-size: 12;"><?php echo $fql['namabarang'];?></span><br>
<span style="font-size: 12;">Rp. <?php echo number_format($fql['hargaj']);?></span><br>
</td>
<?php
}
?>
</tr>
</table>
</body>
</html>
