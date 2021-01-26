<?php if(!empty($_GET['id'])) {
include('include/config.php');
$id = $_GET['id'];

$que = mysql_query("SELECT * FROM tblregister WHERE idreg='$id'");
$dat  = mysql_fetch_array($que);

?>
<tr>
<td><h2>Kode Peserta :</h2></td>
</tr>
<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL|E_STRICT);
    include 'Code128.php';
    $code = isset($_GET['code']) ? $_GET['code'] :$id; 
    //header("Content-type: image/svg+xml");
    echo draw($code);
?>
<html>
<head>
<meta charset="UTF-8" />
<title>Detail Data Peserta #<?php echo $id;?></title>

     <style>
body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
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
	font-size:12px;
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
<!--<body onload="javascript:self.print()">-->
<body>
<p>Dear <?php echo $dat['namalengkap'];?>,</p>
<p>&nbsp;</p>
<p>Selamat! Kamu telah terdaftar dalam Kemayoran Sehat, yang akan diadakan pada :</p>
<table border="0">
<tbody>
<tr>
<td>Tanggal</td>
<td>:</td>
<td>20, Maret 2016</td>
</tr>
<tr>
<td>Waktu</td>
<td>:</td>
<td>06.00 - Selesai</td>
</tr>
<tr>
<td>Lokasi</td>
<td>:</td>
<td>Jl. Benyamin Soeb (Bunderan Ondel-ondel)-Kemayoran SmartCity, Jakarta</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
</tr>
<!--<tr>
<td><h2>Kode Peserta</h2></td>
<td><h2>:</h2></td>
<td><h2><?php echo $id;?></h2></td>
</tr>-->
</tbody>
</table>
<p>Print dan tunjukkan email konfirmasi ini pada saat regsitrasi ulang di acara.</p>
<p>Berikut adalah detail pendaftaran kami :</p>
<table border="0">
<tbody>
<tr>
<td>Nama Pendaftar</td>
<td>:</td>
<td><?php echo $dat['namalengkap'];?></td>
</tr>
<tr>
<td>Jenis Kelamin</td>
<td>:</td>
<td><?php echo $dat['gender'];?></td>
</tr>
<tr>
<td>No. KTP/SIM</td>
<td>:</td>
<td><?php echo $dat['noktp'];?></td>
</tr>
<tr>
<td>Usia</td>
<td>:</td>
<td><?php echo $dat['usia'];?></td>
</tr>
<tr>
<td>Telepon/HP</td>
<td>:</td>
<td><?php echo $dat['telp'];?></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><?php echo $dat['email'];?></td>
</tr>
<tr>
<td>Pekerjaan</td>
<td>:</td>
<td><?php echo $dat['pekerjaan'];?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>Terima kasih atas dukungan kamu terhadap acara Kemayoran Sehat dan mewujudkanKemayoran Sehat,</p>
<p>Kami tunggu Kehadiran Anda,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Panitia</p>
<p>Kemayoran Sehat</p>
<p>&nbsp;</p>
</body>
</html>
<?php } else {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../\">");
} ?>