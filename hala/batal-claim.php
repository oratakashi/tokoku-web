<?php
$kode  	= $_GET['kode'];
$file	=mysql_query("SELECT img_claim FROM dtlimgclaim WHERE kode_claim='{$kode}'");
while($ql=mysql_fetch_array($file)){
$img=$ql[0];
$kv=array($img);
foreach($kv as $kc){
$query = unlink($kc);
}
}
$sql1=mysql_query("delete from tblclaim where kode_claim='{$kode}'");
$sql2=mysql_query("delete from dtlclaim where kode_claim='{$kode}'");
$sql3=mysql_query("delete from dtlimgclaim where kode_claim='{$kode}'");
?>
<script language="javascript">
	document.location='?page=clain-marketing';
</script>