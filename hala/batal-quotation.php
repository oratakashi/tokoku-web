<?php
$kode = $_GET['kode'];
$sql  = mysql_query("delete from tblquotation where kode_quotation='{$kode}'");
$del  = mysql_query("delete from dtlquotation where kode_quotation='{$kode}'");

?>
<script language="javascript">
	document.location='?page=quotation';
</script>