<?php 
$today = date("Ymd");
$query = "SELECT max(kode_stok) AS last FROM tbltambah_stok WHERE kode_stok LIKE 'STO$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNosupplier = $data['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "STO";
$nou  = $char.$today.sprintf("%04s", $b);
?>
<section>
<div class="container">
<div class="row">
<div class="col-sm-12">
<form action="?page=add-stok" method="POST">
<input type="hidden" value="<?php echo $nou;?>" name="kode">
<input type="hidden" value="Persediaan" name="ketmod">
<input type="hidden" value="stok" name="ktg">
<input type="hidden" value="<?php echo date("Y-m-d");?>" name="tanggal">
<a class="btn btn-success" href="?page=add-barang"><i class="icon-plus"></i> Jenis Barang</a>
<a class="btn btn-primary" href="?page=pembelian-barang"><i class="icon-plus"></i> Pembelian Barang</a>
<a class="btn btn-warning" href="?page=konversi"><i class="icon-plus"></i> Konversi</a>
<button type="submit" class="btn btn-info"><i class="icon-plus"></i> Stok Produk</button>
</form>
</div>
</div>
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-tags"></i> Persediaan Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Barcode</th>
                                            <th>Nama Barang</th>
                                            <th>Banyaknya</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$dataPerPage=10;
$jumlah_record=mysql_query("SELECT COUNT(*) FROM stok_bahan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $dataPerPage);
$page = (isset($_GET['nom'])) ? (int)$_GET['nom'] : 1;
$start = ($page - 1) * $dataPerPage;	
$query = mysql_query("SELECT * FROM stok_bahan ORDER BY nama_bahan ASC LIMIT $start, $dataPerPage");
$no = 1;
while ($data = mysql_fetch_array($query)) {
?>
    	<tr>
        	<td class="numeric"><?php echo $no; ?></td>
		<td><?php echo $data['brcode']; ?></td>
		<td><?php echo $data['nama_bahan']; ?></td>
        	<td><?php echo $data['jumlah']; ?> <?php echo $data['satuan']; ?></td>
        	<td>Rp. <?php echo number_format($data['harga_per']); ?> / <?php echo $data['satuan']; ?></td>
                <td>Rp. <?php echo number_format($data['hargaj']); ?> / <?php echo $data['satuan']; ?></td>
		<td>Rp. <?php echo number_format($data['jumlah']*$data['harga_per']); ?>;</td>
<td>
<?php if ($data['harga_per']==0) { } else {?>
	<a class="btn btn-primary btn-xs" href="?page=edit-barang&id=<?php echo $data['id_bahan']; ?>"><i class="icon-pencil"></i></a>
<?php } ?>
    <a class="btn btn-danger btn-xs" href="?page=delete-barang&id=<?php echo $data['id_bahan']; ?>"><i class="icon-trash "></i></a>
</td>
        </tr>
    <?php 
		$no++;
	} 
	?>    
                                    </tbody>
                                </table>
<ul class="pagination pagination-xs left">
<?php 
$quxery   = "SELECT COUNT(*) AS jumData FROM stok_bahan";
$hasil  = mysql_query($quxery);
$data     = mysql_fetch_array($hasil);

$jumData = $data['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data

$jumPage = ceil($jumData/$dataPerPage);

// menampilkan link previous

if ($noPage > 1) echo  "<li><a href='?page=stok-bahan&nom=".($noPage-1)."'>Prev</a><li>";

// memunculkan nomor halaman dan linknya

for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
         {   
            if (($showPage == 1) && ($page != 2))  echo "..."; 
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <li><a href='?page=stok-bahan&nom=".$page."'>".$page."</a></li> ";
            $showPage = $page;          
         }
}

// menampilkan link next

if ($noPage < $jumPage) echo "<li><a href='?page=stok-bahan&nom=".($noPage+1)."'>Next</a></li>";
?>
</ul>
<table class="table table-striped table-bordered table-hover">
<tr><td colspan="2"><h3><b>Total</b></h3></td><td  colspan="5" style="text-align:right"><h3><b>Rp. <?php
$qry_jumlah_a=mysql_query("SELECT SUM(jumlah*harga_per) FROM stok_bahan");
        $data_a=mysql_fetch_array($qry_jumlah_a);
        $jumlah_jumlahjual=$data_a[0];
        echo number_format($jumlah_jumlahjual); 
        ?></b></h3></td>
		</tr></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>