<?php if(!empty($_GET['act']) && $_GET['act']=='import') {
if(!empty($_POST['importbtn'])) {    
include('include/excel_reader2.php'); 

$iduser = $_SESSION['id'];
$satuan = "Pcs";

$data = new Spreadsheet_Excel_Reader($_FILES['dataimport']['tmp_name']);
$hasildata = $data->rowcount($sheet_index=0);
// default nilai 
$sukses = 0;
$gagal = 0;
 
for ($i=2; $i<=$hasildata; $i++) {
$today = date("Ymd");
$queoo = "SELECT max(kode_stok) AS last FROM tbltambah_stok WHERE kode_stok LIKE 'STO$today%'";
$hasol = mysql_query($queoo);
$nata  = mysql_fetch_array($hasol);
$lastNosupplier = $nata['last'];
$lastNoUrut = substr($lastNosupplier, 11, 15);
$b    = $lastNoUrut + 1;
$char = "STO";
$nou  = $char.$today.sprintf("%04s", $b);
    
$barcode = mysql_escape_string($data->val($i,1)); 
$namabar = mysql_escape_string($data->val($i,2));
$jumlah = preg_replace("/[^0-9]/", "",$data->val($i,3));
$haper = preg_replace("/[^0-9]/", "",$data->val($i,4)); 
$haum = preg_replace("/[^0-9]/", "",$data->val($i,5));
$hagro = preg_replace("/[^0-9]/", "",$data->val($i,6));
$total = $jumlah * $haper;
  
$query1 = mysql_query("INSERT INTO stok_bahan (iduser,brcode, nama_bahan, jumlah, satuan, harga_per, total, hargaj, hargag1, hargag2, discount, expired) values('$iduser','$barcode','$namabar','$jumlah','$satuan','$haper','$total','$haum','$hagro','','','')") or die(mysql_error());
if (!empty($jumlah) && !empty($haper)) {
$qrlast = mysql_query("SELECT * FROM stok_bahan WHERE iduser='$iduser' AND brcode='$barcode' AND nama_bahan='$namabar'") or die(mysql_error());
$datalast  = mysql_fetch_array($qrlast);
$id_bahan = $datalast['id_bahan'];

$query2 = mysql_query("INSERT INTO tbltambah_stok (kode_stok, iduser, ketmod, tanggal, total) values('$nou','$iduser','Persediaan', NOW(),'$total')") or die(mysql_error());
$query3 = mysql_query("INSERT INTO dtltambah_stok (kode_stok, id_bahan, iduser, nama_bahan, harga, jumlah, tgl) values('$nou','$id_bahan','$iduser','$namabar','$haper','$jumlah', NOW())") or die(mysql_error());
} else { }


if ($hasildata) $sukses++;
else $gagal++;
 
}

echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?page=stok-barang&success=$sukses&gagal=$gagal\">");

}
?>
<section>
<div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="icon-download"></i> Import Data Barang
                        </div>
                        <div class="panel-body">
                            <form name="import-barang" action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="Barcode">File Import</label>
                                    <input type="file"  name="dataimport" placeholder="Data Import">
                                    <small><b>*) Jika Data lebih Dari 100 baris mohon dibagi menjadi 2 file agar tidak terjadi error dalam import data!</b></small>
                                </div>
                                <div class="form-group">
                                   <a class="btn btn-success btn-xs" href="https://aplikasiku.co.id/ritel/Template_File_Import_Barang.xls"><i class="icon-file"></i> Template File Import</a> 
                                </div>
                                <a class="btn btn-danger" href="?page=stok-barang"><i class="icon-remove"></i> Batal</a>
                                <button type="submit" name="importbtn" value="1" class="btn btn-primary">Import</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php } else {
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
<div class="col-md-9 col-sm-9">
<form action="?page=add-stok" method="POST">
<input type="hidden" value="<?php echo $nou;?>" name="kode">
<input type="hidden" value="<?php echo $_SESSION['id'];?>" name="iduser">
<input type="hidden" value="Persediaan" name="ketmod">
<input type="hidden" value="stok" name="ktg">
<input type="hidden" value="<?php echo date("Y-m-d");?>" name="tanggal">
<a class="btn btn-success" href="?page=add-barang"><i class="icon-plus"></i> Stok Produk</a>
<!--<a class="btn btn-primary" href="?page=pembelian-barang"><i class="icon-plus"></i> Pembelian Barang</a>
<a class="btn btn-warning" href="?page=konversi"><i class="icon-plus"></i> Konversi</a>-->
<button type="submit" class="btn btn-info"><i class="icon-plus"></i> Tambah Stok</button>
<a class="btn btn-default" href="?page=stok-barang&act=import"><i class="icon-download"></i> Import Barang</a>
</form>

</div>
<div class="col-md-3 col-sm-3">
<form role="form" class="horizontal" name="pencarian" action="" method="POST">
                <input type="text" name="cari">
                <button type="submit"><i class="icon-search"></i> Cari</button>
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
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Banyaknya</th>
                                            <th>HPP</th>
                                            <th>Harga Jual</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
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
//$query = mysql_query("SELECT * FROM stok_bahan ORDER BY nama_bahan ASC LIMIT $offset, $dataPerPage");
$no = 1;
while (@$data = mysql_fetch_array($query)) {
    $atel = $data['jumlah']*$data['harga_per'];
    $sumjum = @$sumjum+$atel;
?>
    	<tr>
        	<td class="numeric"><?php echo $no+$offset; ?></td>
			<td><?php echo $data['brcode']; ?></td>
			<td><?php echo $data['nama_bahan']; ?></td>
        	<td><?php echo $data['jumlah']; ?> <?php echo $data['satuan']; ?></td>
        	<td><?php if ($data['harga_per']==0) { ?>
			<a class="btn btn-danger btn-xs" href="?page=edit-barang&id=<?php echo $data['id_bahan']; ?>">Harga Beli Kosong</a>
			<?php } else {?>
			Rp. <?php echo number_format($data['harga_per']); ?> / <?php echo $data['satuan']; ?><?php } ?>
			</td>
            <td>Rp. <?php echo number_format($data['hargaj']); ?> / <?php echo $data['satuan']; ?></td>
			<td>Rp. <?php echo number_format($data['jumlah']*$data['harga_per']); ?>;</td>
<td>
<?php if ($data['harga_per']==0) {?>
<a class="btn btn-primary btn-xs" href="?page=edit-barang&id=<?php echo $data['id_bahan']; ?>"><i class="icon-pencil"></i></a>
<?php } else {?>
	<a class="btn btn-primary btn-xs" href="?page=edit-barang&id=<?php echo $data['id_bahan']; ?>"><i class="icon-pencil"></i></a>
<?php } ?>
    <a class="btn btn-danger btn-xs" href="?page=delete-barang&id=<?php echo $data['id_bahan']; ?>"><i class="icon-trash "></i></a>
	<!--<a class="btn btn-primary btn-xs" href="result-bar.php?id=<?php echo $data['brcode']; ?>" target="_blank"><i class="icon-print"></i> Bar</a>
	<a class="btn btn-primary btn-xs" href="qrcode.php?id=<?php echo $data['brcode']; ?>" target="_blank"><i class="icon-print"></i> QR</a>-->
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
$quxery   = "SELECT COUNT(*) AS jumData FROM stok_bahan WHERE iduser='{$_SESSION['id']}'";
$hasilx  = mysql_query($quxery);
$datax     = mysql_fetch_array($hasilx);

$jumData = $datax['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data

$jumPage = ceil($jumData/$dataPerPage);

// menampilkan link previous

if ($noPage > 1) echo  "<li><a href='?page=stok-barang&nom=".($noPage-1)."'>Prev</a><li>";

// memunculkan nomor halaman dan linknya

for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) {   
            if ((@$showPage == 1) && ($page != 2))  echo "<li><a href='#'>...</a></li>"; 
            if ((@$showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "<li><a href='#'>...</a></li>";
            if ($page == $noPage) echo "<li class='active'><a href='#'>".$page."</a></li>";
            else echo " <li><a href='?page=stok-barang&nom=".$page."'>".$page."</a></li> ";
            $showPage = $page;          
         }
}

// menampilkan link next

if ($noPage < $jumPage) echo "<li><a href='?page=stok-barang&nom=".($noPage+1)."'>Next</a></li>";
?>
</ul>
<table class="table table-striped table-bordered table-hover">
<tr><td colspan="2"><h3><b>Total</b></h3></td><td  colspan="5" style="text-align:right"><h3><b>Rp. <?php

        echo number_format(@$sumjum); 
        ?></b></h3></td>
		</tr></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php } ?>