<section>
        <div class="container">
<div class="row"><div class="col-md-2 col-sm-2">
<b>Pencarian : </b>
        </div>
		<div class="col-md-3 col-sm-3">
<form role="form" name="pencarian" action="" method="POST">
<div class="form-group">
                <input class="form-control" type="text" name="cari">
</div>
<div class="form-group">
                <button type="submit" class="btn btn-success"><i class="icon-search"></i> Cari</button>
</div>
                </form>
        </div>
			<div class="col-md-7 col-sm-7">
			<a target="blank" class="btn btn-success pull-right" href="exp-pdf.php?rd=<?php echo date("His");?>"><i class="icon-print"></i> Export PDF</a><br><br></div>
        </div>
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Daftar Harga
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NAMA BARANG</th>
                                            <th>QTY</th>
                                            <th>HARGA JUAL UMUM</th>
											<th>HARGA JUAL GROSIR</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$dataPerPage=10;
if(isset($_GET['nom']))
{
    $noPage = $_GET['nom'];
} 
else $noPage = 1;
$offset = ($noPage - 1) * $dataPerPage;
if (!empty($_POST['cari'])) {
$carinama = mysql_query("SELECT * FROM stok_bahan WHERE nama_bahan LIKE '%{$_POST['cari']}%' AND iduser='{$_SESSION['id']}' ORDER BY nama_bahan ASC LIMIT $offset, $dataPerPage");
$temunama=mysql_fetch_assoc($carinama);

$caribrcode = mysql_query("SELECT * FROM stok_bahan WHERE brcode = '{$_POST['cari']}' AND iduser='{$_SESSION['id']}' ORDER BY nama_bahan ASC LIMIT $offset, $dataPerPage");
$temubrcode=mysql_fetch_assoc($caribrcode);

if ($temunama) {
$query = mysql_query("SELECT * FROM stok_bahan WHERE nama_bahan LIKE '%{$_POST['cari']}%' AND iduser='{$_SESSION['id']}' ORDER BY nama_bahan ASC LIMIT $offset, $dataPerPage");
} else if ($temubrcode){
$query = mysql_query("SELECT * FROM stok_bahan WHERE brcode = '{$_POST['cari']}' AND iduser='{$_SESSION['id']}' ORDER BY nama_bahan ASC LIMIT $offset, $dataPerPage");
}
} else {
$query = mysql_query("SELECT * FROM stok_bahan WHERE iduser='{$_SESSION['id']}' ORDER BY nama_bahan ASC LIMIT $offset, $dataPerPage");
}

		$no = 1;
		while ($data = mysql_fetch_array($query)) {
	?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['nama_bahan']; ?></td>
        	<td><?php echo $data['jumlah']; ?> <?php echo $data['satuan']; ?></td>
                <td align="right">Rp. <?php echo number_format($data['hargaj']); ?></td>
				<td align="right">Rp. <?php echo number_format($data['hargag1']); ?></td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<ul class="pagination pagination-xs left">
<?php 
$quxery   = "SELECT COUNT(*) AS jumData FROM stok_bahan WHERE iduser='{$_SESSION['id']}'";
$hasilx  = mysql_query($quxery);
$datax     = mysql_fetch_array($hasilx);

$jumData = $datax['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data

$jumPage = ceil($jumData/$dataPerPage);

// menampilkan link previous

if ($noPage > 1) echo  "<li><a href='?page=price-list&nom=".($noPage-1)."'>Prev</a><li>";

// memunculkan nomor halaman dan linknya

for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if ((@$showPage == 1) && ($page != 2))  echo "<li><a href='#'>...</a></li>"; 
            if ((@$showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "<li><a href='#'>...</a></li>";
            if ($page == $noPage) echo "<li class='active'><a href='#'>".$page."</a></li>";
            else echo " <li><a href='?page=price-list&nom=".$page."'>".$page."</a></li> ";
            $showPage = $page;          
         }
}

// menampilkan link next

if ($noPage < $jumPage) echo "<li><a href='?page=price-list&nom=".($noPage+1)."'>Next</a></li>";
?>
</ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
