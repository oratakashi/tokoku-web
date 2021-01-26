<?php
$kode=$_GET['kode'];
$nama=$_GET['nama'];

$s=mysql_query("select * from dtlquotation where kode_quotation='$kode' and nama_barang='$nama'");
$dt=mysql_fetch_array($s);

if ($sql=mysql_query("delete from dtlquotation where kode_quotation='$kode' and nama_barang='$nama'")) {
?>
<script language="javascript">
	document.location='?page=inp-quotation';
</script>
<?php
}
?>
