<?php
$qry = mysql_query("SELECT * FROM setting WHERE iduser='{$_SESSION['id']}'");
$dta  = mysql_fetch_array($qry);
?>
<section id="error">
        <div class="container">
            <div class="row">
<h4>Selamat Datang, <?php echo $_SESSION['nama']; ?></h4>
<h4>Di Aplikasi <?php echo $dta['perusahaan'];?></h4>
<br>
<?php $level = $_SESSION['level'];
switch ($level){
case $level == 'adminsp' : ?>
<a href="?page=penjualan" class="btn  btn-circle"><i class="icon-ok-circle icon-lg"></i>
                            <br>Penjualan</a>
<!-- <a href="?page=pembelian-barang" class="btn btn-primary btn-circle"><i class="icon-picture icon-lg"></i>
                            <br>Pembelian</a>
<a href="?page=price-list" class="btn  btn-circle"><i class="icon-group icon-lg"></i>
                            <br>Daftar Harga</a>-->
<a href="?page=rekap-penjualan" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Rekap Penjualan</a>
<a href="?page=rekap-laba-rugi" class="btn  btn-circle"><i class="icon-book icon-lg"></i>
                            <br>Laporan Laba Rugi</a>
<!--<a href="?page=alert-list" class="btn btn-default btn-circle"><i class="icon-file-text-alt icon-lg"></i>
                            <br>Persediaan Habis</a>-->
<?php
break;
case $level == 'admin' : ?>
<a href="?page=penjualan" class="btn  btn-circle"><i class="icon-ok-circle icon-lg"></i>
                            <br>Penjualan</a>
<!--<a href="?page=pembelian-barang" class="btn btn-primary btn-circle"><i class="icon-picture icon-lg"></i>
                            <br>Pembelian</a>
<a href="?page=price-list" class="btn  btn-circle"><i class="icon-group icon-lg"></i>
                            <br>Daftar Harga</a>-->
<a href="?page=rekap-penjualan" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Rekap Penjualan</a>
<a href="?page=rekap-laba-rugi" class="btn  btn-circle"><i class="icon-book icon-lg"></i>
                            <br>Laporan Laba Rugi</a>
<!--<a href="?page=alert-list" class="btn btn-default btn-circle"><i class="icon-file-text-alt icon-lg"></i>
                            <br>Persediaan Habis</a>-->
<?php
break;
case $level == 'ksgrosir' : ?>
<a href="?page=penjualan" class="btn  btn-circle"><i class="icon-ok-circle icon-lg"></i>
                            <br>Penjualan</a>
<a href="?page=price-list" class="btn  btn-circle"><i class="icon-group icon-lg"></i>
                            <br>Daftar Harga</a>
<a href="?page=rekap-penjualan" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Rekap Penjualan</a>
<a href="?page=alert-list" class="btn  btn-circle"><i class="icon-file-text-alt icon-lg"></i>
                            <br>Persediaan Habis</a>
<?php
break;
case $level == 'minimart' : ?>
<a href="?page=penjualan" class="btn  btn-circle"><i class="icon-ok-circle icon-lg"></i>
                            <br>Penjualan</a>
<a href="?page=price-list" class="btn  btn-circle"><i class="icon-group icon-lg"></i>
                            <br>Daftar Harga</a>
<a href="?page=rekap-penjualan" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Rekap Penjualan</a>
<a href="?page=alert-list" class="btn  btn-circle"><i class="icon-file-text-alt icon-lg"></i>
                            <br>Persediaan Habis</a>
<?php
break;
case $level == 'gudang' : ?>
<a href="?page=stok-barang" class="btn  btn-circle"><i class="icon-dropbox icon-lg"></i>
                            <br>Persediaan</a>
<a href="?page=list-order" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Order</a>
<?php
break;
case $level == 'kurir' : ?>
<a href="?page=surat-jalan" class="btn  btn-circle"><i class="icon-credit-card icon-lg"></i>
                            <br>Surat Jalan</a>
<a href="?page=list-order" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Order</a>
<?php
break;
case $level == 'sales' : ?>
<a href="?page=list-customers" class="btn  btn-circle"><i class="icon-ok-circle icon-lg"></i>
                            <br>Daftar Pelanggan</a>
<!--<a href="?page=daily-report" class="btn  btn-circle"><i class="icon-group icon-lg"></i>
                            <br>Daily Activity Report</a>-->
<a href="?page=list-order" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Purchase Order</a>
<!--<a href="?page=clain-marketing" class="btn btn-info btn-circle"><i class="icon-book icon-lg"></i>
                            <br>Claim Operational</a>-->
<a href="?page=price-list" class="btn  btn-circle"><i class="icon-file-text-alt icon-lg"></i>
                            <br>Price List</a>
							<?php
break;
case $level == 'hsales' : ?>
<a href="?page=list-customers" class="btn  btn-circle"><i class="icon-ok-circle icon-lg"></i>
                            <br>Prospek</a>
<a href="?page=quotation" class="btn  btn-circle"><i class="icon-picture icon-lg"></i>
                            <br>Quotation</a>
<a href="?page=daily-report" class="btn  btn-circle"><i class="icon-group icon-lg"></i>
                            <br>Daily Activity Report</a>
<a href="?page=list-order" class="btn  btn-circle"><i class="icon-lock icon-lg"></i>
                            <br>Purchase Order</a>
<a href="?page=clain-marketing" class="btn  btn-circle"><i class="icon-book icon-lg"></i>
                            <br>Claim Operational</a>
<a href="?page=price-list" class="btn  btn-circle"><i class="icon-file-text-alt icon-lg"></i>
                            <br>Price List</a>
<?php
}?>

            </div>
        </div>
</section>