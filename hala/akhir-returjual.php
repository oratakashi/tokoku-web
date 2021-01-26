<?php
$kode  = $_POST['kode'];
$total = $_POST['total'];
$tgl   = date("Y-m-d");

$select=mysql_query("SELECT kurang FROM tblpenjualan WHERE kode_penjualan='$kode'");
$pilih=mysql_fetch_array($select);
$kurang=$pilih[0];
$sisa=$kurang-$total;

if ($kurang == 0){
	
$today = date("Ymd");
$query = "SELECT max(kode_tran) AS last FROM tbltransaksi WHERE kode_tran LIKE 'TRL$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRL";
$nou  = $char.$today.sprintf("%04s", $b);


	$sql1 = mysql_query("update tblretur_jual set total='$total' where kode_rejual='$kode'");
	$sql2 = mysql_query("insert into tbltransaksi (kode_tran,total,tgl) values ('$nou','$total','$tgl')");
	$sql3 = mysql_query("insert into dtltransaksi (kode_tran,nama_tran,ctg,nominal,tgl) values ('$nou','Retur Penjualan','rtr','$total','$tgl')");
	
} else {
	
$today = date("Ymd");
$query = "SELECT max(kode_ncs) AS last FROM tblnoncash WHERE kode_ncs LIKE 'TRN$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "TRN";
$nou  = $char.$today.sprintf("%04s", $b);

if ($kurang < $total) {
	
$turah=$total-$kurang;
	
	$sql1= mysql_query("update tblpenjualan set kurang='0' where kode_penjualan='$kode'");
	$sql2 = mysql_query("insert into tbltransaksi (kode_tran,total,tgl) values ('$nou','$turah','$tgl')");
	$sql3 = mysql_query("insert into dtltransaksi (kode_tran,nama_tran,ctg,nominal,tgl) values ('$nou','Retur Penjualan','rtr','$turah','$tgl')");
	$sql4= mysql_query("insert into tblnoncash (kode_ncs,totaldeb,totalcrd,tgl) values ('$nou','$kurang','$kurang','$tgl')");
	$sql5= mysql_query("insert into dtlnoncash (kode_ncs,nama_ncs,debet,tgl) values ('$nou','Retur Penjualan','$kurang','$tgl')");
	$sql6= mysql_query("insert into dtlnoncash (kode_ncs,nama_ncs,kredit,tgl) values ('$nou','Piutang','$kurang','$tgl')");
	
} else {
	
	
	$sql1= mysql_query("update tblpenjualan set kurang='$sisa' where kode_penjualan='$kode'");
	$sql2= mysql_query("update tblretur_jual set total='$total' where kode_rejual='$kode'");
	$sql3= mysql_query("insert into tblnoncash (kode_ncs,totaldeb,totalcrd,tgl) values ('$nou','$total','$total','$tgl')");
	$sql4= mysql_query("insert into dtlnoncash (kode_ncs,nama_ncs,debet,tgl) values ('$nou','Retur Penjualan','$total','$tgl')");
	$sql5= mysql_query("insert into dtlnoncash (kode_ncs,nama_ncs,kredit,tgl) values ('$nou','Piutang','$total','$tgl')");
}
}
?>
<script language="javascript">
	document.location='?page=rekap-penjualan';
</script>