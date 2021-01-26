<?php
$kode       = $_POST['kode'];
$pelunasan  = $_POST['bayar'];

$qrr=mysql_query("select * from tblpembelian_bahan where kode_pembelian='$kode'");
$de=mysql_fetch_array($qrr);
$total      = $de['total'];
$bayar      = $pelunasan+$de['bayar'];
$tgl        = date("Y-m-d");
$kurang     = $total-$bayar;
$sql1       = mysql_query("update tblpembelian_bahan set bayar='{$bayar}', kurang='{$kurang}' where kode_pembelian='{$kode}'");
$sql2       = mysql_query("insert into dtlhutang (kode_pembelian,bayar,tgl) values ('$kode','$pelunasan','$tgl')");

?>
<script language="javascript">
	document.location='?page=pelunasan-utang&kode=<?php echo $kode; ?>';
</script>