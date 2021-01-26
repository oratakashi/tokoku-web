<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];

$s=mysql_query("select * from dtlpo where kode_po='$kode' and nama_barang='$nama'");
$dt=mysql_fetch_array($s);
$jumlah=$dt['jumlah'];

if ($sql=mysql_query("delete from dtlpo where kode_po='$kode' and nama_barang='$nama'")) {
	?>
<script language="javascript">
	document.location='?page=inp-po';
</script>
<?php
}
?>
