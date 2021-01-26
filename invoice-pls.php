<?php
include('include/config.php');
$qry = mysql_query("SELECT * FROM setting");
$dta  = mysql_fetch_array($qry);
$jatem =$dta['jatuhtempo'];
$pesan =$dta['pesan'];
$notr  = $_GET['kode'];
$kasa = @$_GET['kasa'];
$query = mysql_query("SELECT * ,DATE_ADD(tgl, INTERVAL $jatem DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tgl, INTERVAL $jatem DAY), CURDATE()) as selisih FROM tbljualpulsa WHERE kode_jualpulsa='$notr'");
$data  = mysql_fetch_array($query);
$pelanggan=$data['pelanggan'];
$que = mysql_query("SELECT * FROM tblcustomers WHERE nama_customers='$pelanggan'");
$dat  = mysql_fetch_array($que);

?>
<html>
<head>
<meta charset="UTF-8" />
<title>INVOICE | <?php echo $notr; ?></title>
<meta charset="UTF-8" />
    <title>INVOICE | <?php echo $notr; ?></title>
     <style>
body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:4px;
}
h1 {
	margin-bottom:10px;
	font-size:10px;
}

table {
	/*padding:1px;*/
}
a, a img {
	border:none;
}

#content {
	padding:2px;
	width:1280px;
	/*height:100%;*/
	position:relative;
	overflow:hidden;
}
#content h1 {
	padding:2px;
	font-size:14px;
}

/* Table style */
#content table.list {
	width:100%;
	border:1px solid #000000;
	/*
	border-left:1px solid #ededed;
	border-bottom:1px solid #ededed;
	*/
	margin-bottom:12px;
	margin:0 auto;
}
#content table.list th {
	font-size:12px;
	font-weight:bold;
	text-align:left;
	height:24px;
	/*background:url(images/bg-th.jpg) repeat-y;*/
	/*background-color:#666666;*/
	/*border:1px solid #000000;*/
	border-bottom:1px solid #000000;
	/*
	border-left:1px solid #ededed;
	border-width:1px 1px 1px 0;
	*/
	color:#000000;
	padding:0 3px;
}
#content table.list  td {
	height:24px;
	/*border-right:1px solid #ededed;*/
	padding:0 2px;
	font-size:24px;
	color:#666666;
}
#content table.list tr.row0 {
	background:#F5F5F5;
}
#content table.list tr.row1 {
	background:#fff;
}

</style>
</head>
<body onload="javascript:self.print()">
<table width="350px" align="center" cellspacing="0" cellpadding="0">
<tr>
	<td style="border:0px solid #000000;" colspan="2" align="center">
	<img src="<?php echo $dta['logo']; ?>" height="0px" alt="LOGO" /><br>
	<font size="6"><strong><?php echo $dta['perusahaan']?></strong></font><br><?php echo $dta['alamat']?> <br>Telp: <?php echo $dta['tlp']?></td>
</tr>
	<tr>
	<td style="border:0px solid #000000;">Tanggal</p></td>
	<td align="right" style="border:0px solid #000000;"><?php 
$ttgl=$data['tgl'];
$tltgl=date_create($ttgl);
echo date_format($tltgl,"d/m/Y"); ?></td>
</tr>
<tr>
	<td style="border:0px solid #000000;">No. Transaksi</p></td>
	<td align="right" style="border:0px solid #000000;"><?php echo $notr; ?></td>
</tr>
<tr>
	<td style="border-top:2px solid #000000;" colspan="2">
		<table width="350px" align="center" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-top:1px solid #000000;">NAMA</td>
				<td style="border-top:1px solid #000000;">HARGA</td>
				<td align="right" style="border-top:1px solid #000000;">JML</td>
			</tr>
<?php
$s=mysql_query("SELECT * FROM dtljualpulsa WHERE kode_jualpulsa='$notr'");
$no=1;
while($sql=mysql_fetch_array($s)){
$subt=$sql['jumlah']*($sql['harga']);
$total=@$total+$subt;
$sppn=$sql['jumlah']*$sql['ppn'];
$ppn= @$ppn+$sppn;
$te=$sql['jumlah']*1;
$item=@$item+$te;

$nmbrg=$sql['nama_barang'];

$quad=mysql_query("select * from stok_bahan where nama_bahan='$nmbrg'");
$zql=mysql_fetch_array($quad);

$batch=$zql['brcode'];
$exp=date_create($zql['expired']);
$satuan=$zql['satuan'];
?>
			<tr>
				<td><?php echo strtoupper($sql['provide']." ".$sql['nomin'] ); ?></td>
				<td align="right"><?php echo number_format($sql['harga']);?></td><td align="right">X <?php echo $sql['jumlah']; ?></td>
				<td align="right"><?php echo number_format($sql['harga']*$sql['jumlah']);?></td>
			</tr>
<?php 
$no++;
} ?>
			<tr><td style="border-top:1px solid #000000;">TOTAL</td>
			<td style="border-top:1px solid #000000;">ITEM</td>
				<td style="border-top:1px solid #000000;"><?php echo $item; ?></td>
				<td style="border-top:1px solid #000000;" align="right"><?php echo number_format($total); ?></td>
			</tr>
<tr>
				<td colspan=2></td>
				<td>DISKON</td>
				<td align="right"><?php echo number_format($data['potongan']); ?></td>
			</tr>
<tr>
				<td colspan=2></td>
				<td>TOTAL</td>
				<td align="right"><?php echo number_format($total-$data['potongan']); ?></td>
			</tr>
			<tr>
				<td colspan=2></td>
				<td>BAYAR</td>
				<td align="right"><?php echo number_format($data['bayar']); ?></td>
			</tr>

<?php
if ($total<($data['bayar']+$data['kembalian'])){
?>
			<tr>
				<td colspan=2></td>
				<td>KEMBALIAN</td>
				<td align="right"><?php echo number_format($data['kembalian']); ?></td>
			</tr>
<?php
} else if ($total>($data['bayar']+$data['kembalian'])){
?>
			<tr>
				<td colspan=2></td>
				<td><font color="red">KURANG</font></td>
				<td align="right"><?php echo number_format($data['kurang']); ?></td>
			</tr>
<?php
} else {}
?>
			<tr>
				<td style="border-top:1px solid #000000;" colspan=4 align="center"><?php echo $pesan;?><br><br><?php echo $kasa;?><br></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<td style="border-top:1px solid #000000;" colspan=4 align="center"><br></td>
			</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>