<?php if(!empty($_GET['chart'])) {
include ("src/jpgraph.php");
include ("src/jpgraph_pie.php");
include ("src/jpgraph_pie3d.php");
include ("include/config.php");

        $qry_jumlah_1=mysql_query("SELECT COUNT(jumlah) FROM dtlpenjualan WHERE nama_barang LIKE 'Bahan A'");
        $data_1=mysql_fetch_array($qry_jumlah_1);
        $total_1=$data_1[0];
		
		$qry_jumlah_2=mysql_query("SELECT COUNT(jumlah) FROM dtlpenjualan WHERE nama_barang LIKE 'Bahan B'");
        $data_2=mysql_fetch_array($qry_jumlah_2);
        $total_2=$data_2[0];
	
        $qry_jumlah_3=mysql_query("SELECT COUNT(jumlah) FROM dtlpenjualan WHERE nama_barang LIKE 'Bahan C'");
        $data_3=mysql_fetch_array($qry_jumlah_3);
        $total_3=$data_3[0];
		
		$qry_jumlah_4=mysql_query("SELECT COUNT(jumlah) FROM dtlpenjualan WHERE nama_barang LIKE 'Bahan D'");
        $data_4=mysql_fetch_array($qry_jumlah_4);
        $total_4=$data_2[0];
	
        $qry_jumlah_5=mysql_query("SELECT COUNT(jumlah) FROM dtlpenjualan WHERE nama_barang LIKE 'Bahan E'");
        $data_5=mysql_fetch_array($qry_jumlah_5);
        $total_5=$data_5[0];

$data = array($total_1,$total_2,$total_3,$total_4,$total_5);

$graph = new PieGraph(400,300,"auto");
$graph->SetShadow();
$graph->title->Set(" ");
$p1 = new PiePlot3D($data);
//besarnya pie
$p1->SetSize(0.35);
$p1->SetLegends(array("Bahan A","Bahan B","Bahan C","Bahan D","Bahan E"));
$graph->Add($p1);
$graph->Stroke();

} else {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../\">");
}
?>