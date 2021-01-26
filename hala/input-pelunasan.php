<?php
$kode       = $_POST['kode'];
$pelunasan  = $_POST['bayar'];

$returjual = mysql_query("select * from dtlretur_jual where kode_rejual='$kode'");
$ada = mysql_fetch_assoc($returjual); 
if ($ada) {

$qret = mysql_query("select * from tblretur_jual where kode_rejual='$kode'");
$retj = mysql_fetch_array($qret);
$retur = $retj['total'];

$qrr = mysql_query("select * from tblpenjualan where kode_penjualan='$kode'");
$de = mysql_fetch_array($qrr);
$total      = $de['total']-$retur;
$bayar      = $pelunasan+$de['bayar'];
$tgl        = date("Y-m-d");
$kurang     = $total-$bayar;
	
$sql1       = mysql_query("update tblpenjualan set bayar='{$bayar}', kurang='{$kurang}' where kode_penjualan='{$kode}'");
$sql2       = mysql_query("insert into dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$pelunasan','$tgl')");
} else {
	
$qrr = mysql_query("select * from tblpenjualan where kode_penjualan='$kode'");
$de = mysql_fetch_array($qrr);

$total      = $de['total'];
$bayar      = $pelunasan+$de['bayar'];
$tgl        = date("Y-m-d");
if ($bayar < $total) {
$kurang     = $total-$bayar;
$sql1       = mysql_query("update tblpenjualan set bayar='{$bayar}', kurang='{$kurang}' where kode_penjualan='{$kode}'");
$sql2       = mysql_query("insert into dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$pelunasan','$tgl')");
} else if ($bayar > $total) {
$kembalian  = $bayar-$total;
$sql1       = mysql_query("update tblpenjualan set bayar='{$total}', kurang='0', kembalian='{$kembalian}' where kode_penjualan='{$kode}'");
$sql2       = mysql_query("insert into dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$pelunasan','$tgl')");
} else {
$kurang     = $total-$bayar;
$sql1       = mysql_query("update tblpenjualan set bayar='{$bayar}', kurang='{$kurang}' where kode_penjualan='{$kode}'");
$sql2       = mysql_query("insert into dtlpelunasan (kode_penjualan,bayar,tgl) values ('$kode','$pelunasan','$tgl')");
}
}
?>
<script language="javascript">
	document.location='?page=pelunasan&kode=<?php echo $kode; ?>';
</script>