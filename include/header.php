<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mini Market Toko Saya Tawangmangu">
    <meta name="author" content="">
    <title>TokoKu | Aplikasi Ritel System </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!-- PAGE LEVEL STYLES -->
<link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<link href="assets/css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
<link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
<link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
<link rel="stylesheet" href="assets/plugins/colorpicker/css/colorpicker.css" />
<link rel="stylesheet" href="assets/plugins/tagsinput/jquery.tagsinput.css" />
<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
<link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
    <!-- END PAGE LEVEL  STYLES -->

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="images/apli-logo-n.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
<?php $level = $_SESSION['level'];
switch ($level){
case $level == 'adminsp' : ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=penjualan">Penjualan</a>
            </li>
			<!--<li>
                <a href="?page=front-page" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;">Monitor Penjualan</a>
            </li>-->
            <li>
                <a href="?page=pembelian-barang">Pembelian</a>
            </li>
            <!--<li>
                <a href="?page=add-barang">Tambah Voucher & Perdana</a>
            </li>
			<li>
                <a href="?page=deposit-pulsa">Deposit Pulsa</a>
            </li>-->
            <li>
                <a href="?page=trans-lain">Jurnal Cash</a>
            </li>
            <!--<li>
                <a href="?page=trans-noncash">Transaksi Non-Cash</a>
            </li>
            <li>
                <a href="?page=quotation">Quotation</a>
            </li>
            <li>
                <a href="?page=daily-report">Daily Report Activity</a>
            </li>
             <li>
                <a href="?page=list-order">Order</a>
            </li>
            <li>
                <a href="?page=purchase-order">Purchase Order</a>
            </li>
			<li>
                <a href="?page=surat-jalan">Surat Jalan</a>
            </li>
			<li>
                <a href="?page=kwitansi">Kwitansi</a>
            </li>
             <li>
                <a href="?page=clain-marketing">Claim Operational Marketing</a>
            </li>-->
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=satuan-barang">Satuan Barang</a>
            </li>
            <!--<li>
                <a href="?page=modal-awal">Modal</a>
            </li>-->
			
            <li>
                <a href="?page=stok-barang">Persediaan</a>
            </li>
			<li>
                <a href="?page=list-supplier">Supplier</a>
            </li>
			<!--<li>
                <a href="?page=list-inventaris">Daftar Inventaris</a>
            </li>-->
            <li>
                <a href="?page=price-list">Daftar Harga</a>
            </li>
			<!--<li>
                <a href="?page=pulsa-list">List Pulsa</a>
            </li>
            <li>
                <a href="?page=provide-mgr">Provider</a>
            </li>-->
            <li>
                <a href="?page=list-customers">Pelanggan</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
	     <li>
                <a href="?page=add-trans-lain">Nama Perkiraan</a>
            </li>
            <li>
                <a href="?page=user-list">Management User</a>
            </li>
            <li>
                <a href="?page=vendor-list">Management Vendor</a>
            </li>
            <li>
                <a href="?page=pass-mod">Ganti Password</a>
            </li>
            <li>
                <a href="?page=pengaturan">Konfigurasi Profile</a>
            </li>
			<li>
                <a href="?page=del-penjualan">Hapus Penjualan</a>
            </li>
            <li>
                <a href="?page=printqrmulti">Cetak Label Harga</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <!--<li>
                <a href="?page=kas">Arus Kas</a>
            </li>-->
            <li>
                <a href="?page=rekap-utang">Piutang</a>
            </li>
            <li>
                <a href="?page=rekap-penjualan">Penjualan</a>
            </li>
			<li>
                <a href="?page=rekap-pembelian">Pembelian</a>
            </li>
			<!--<li>
                <a href="?page=history-saldo">History Saldo</a>
            </li>-->
			<!--<li>
                <a href="?page=rekap-hpp">HPP</a>
            </li>-->
            <li>
                <a href="?page=rekap-pengeluaran">Transaksi Cash</a>
            </li>
			<!--<li>
                <a href="?page=rekap-noncash">Transaksi Non-Cash</a>
            </li>
			<li>
                <a href="?page=ppn">PPN</a>
            </li>-->
			<li>
                <a href="?page=hutang">Hutang</a>
            </li>
	<!--		<li>
                <a href="?page=rekap-laba-rugi">Laba Rugi</a>
            </li>
<li>
                <a href="?page=neraca">Neraca</a>
            </li>
            <!--<li><a href="?page=grafik-penjualan">Grafik Penjualan</a></li>-->
            <!--<li><a href="?page=grafik-laba-rugi">Grafik Laba Rugi</a></li>-->
        </ul>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
<?php
break;
case $level == 'admin' : ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=penjualan">Penjualan</a>
            </li>
			<!--<li>
                <a href="?page=penjualan-pulsa">Penjualan</a>
            </li>
			<li>
                <a href="?page=front-page" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;">Monitor Penjualan</a>
            </li>
            <li>
                <a href="?page=add-barang">Tambah Voucher & Perdana</a>
            </li>
			<li>
                <a href="?page=deposit-pulsa">Deposit Pulsa</a>
            </li>-->
            <li>
                <a href="?page=trans-lain">Jurnal Kas</a>
            </li>
            <!--<li>
                <a href="?page=trans-noncash">Transaksi Non-Cash</a>
            </li>
            <li>
                <a href="?page=quotation">Quotation</a>
            </li>
            <li>
                <a href="?page=daily-report">Daily Report Activity</a>
            </li>
             <li>
                <a href="?page=list-order">Order</a>
            </li>
            <li>
                <a href="?page=purchase-order">Purchase Order</a>
            </li>
			<li>
                <a href="?page=surat-jalan">Surat Jalan</a>
            </li>
			<li>
                <a href="?page=kwitansi">Kwitansi</a>
            </li>
             <li>
                <a href="?page=clain-marketing">Claim Operational Marketing</a>
            </li>-->
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=satuan-barang">Satuan Barang</a>
            </li>
			
            <li>
                <a href="?page=stok-barang">Product & Stok</a>
            </li>
			<!--<li>
                <a href="?page=saldo-pulsa">Saldo Pulsa</a>
            </li>-->
			<!--<li>
                <a href="?page=list-supplier">Supplier</a>
            </li>
			<li>
                <a href="?page=list-inventaris">Daftar Inventaris</a>
            </li>
            <li>
                <a href="?page=price-list">Daftar Harga</a>
            </li>-->
            <li>
                <a href="?page=add-trans-lain">Nama Perkiraan</a>
            </li>
			<!--<li>
                <a href="?page=pulsa-list">List Pulsa</a>
            </li>
            <li>
                <a href="?page=provide-mgr">Provider</a>
            </li>-->
            <li>
                <a href="?page=data-pelanggan">Pelanggan</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
	     <!--<li>
                <a href="?page=add-trans-lain">Nama Transaksi lainnya</a>
            </li>
            <li>
                <a href="?page=user-list">Management User</a>
            </li>-->
            
            <li>
                <a href="?page=pass-mod">Ganti Password</a>
            </li>
            <li>
                <a href="?page=pengaturan">Konfigurasi Profile</a>
            </li>
			<li>
                <a href="?page=printqrmulti">Cetak Label</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <!--<li>
                <a href="?page=kas">Arus Kas</a>
            </li>
            <li>
                <a href="?page=rekap-utang">Piutang</a>
            </li>-->
            <li>
                <a href="?page=rekap-penjualan">Penjualan</a>
            </li>
			<!--<li>
                <a href="?page=rekap-jual-pulsa">Penjualan Pulsa</a>
            </li>
			<li>
                <a href="?page=history-saldo">History Saldo</a>
            </li>-->
			<!--<li>
                <a href="?page=rekap-hpp">HPP</a>
            </li>-->
            <li>
                <a href="?page=rekap-pengeluaran">Jurnal Kas</a>
            </li>
			<!--<li>
                <a href="?page=rekap-noncash">Transaksi Non-Cash</a>
            </li>
			<li>
                <a href="?page=ppn">PPN</a>
            </li>
			<li>
                <a href="?page=hutang">Hutang</a>
            </li>-->
			<li>
                <a href="?page=rekap-laba-rugi">Laba Rugi</a>
            </li>
<!--<li>
                <a href="?page=neraca">Neraca</a>
            </li>
            <!--<li><a href="?page=grafik-penjualan">Grafik Penjualan</a></li>-->
            <!--<li><a href="?page=grafik-laba-rugi">Grafik Laba Rugi</a></li>-->
        </ul>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
<?php
break;
case $level == 'ksgrosir' : ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=penjualan">Penjualan</a>
            </li>
			<li>
                <a href="?page=front-page" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;">Monitor Penjualan</a>
            </li>
            <!--<li>
                <a href="?page=pembelian-barang">Pembelian</a>
            </li>
            <li>
                <a href="?page=trans-lain">Transaksi Cash</a>
            </li>
            <li>
                <a href="?page=trans-noncash">Transaksi Non-Cash</a>
            </li>
            <li>
                <a href="?page=quotation">Quotation</a>
            </li>
            <li>
                <a href="?page=daily-report">Daily Report Activity</a>
            </li>
             <li>
                <a href="?page=list-order">Order</a>
            </li>
            <li>
                <a href="?page=purchase-order">Purchase Order</a>
            </li>
			<li>
                <a href="?page=surat-jalan">Surat Jalan</a>
            </li>
			<li>
                <a href="?page=kwitansi">Kwitansi</a>
            </li>
             <li>
                <a href="?page=clain-marketing">Claim Operational Marketing</a>
            </li>-->
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=satuan-barang">Satuan Barang</a>
            </li>
            <!--<li>
                <a href="?page=modal-awal">Modal</a>
            </li>
            <li>
                <a href="?page=stok-barang">Persediaan Barang</a>
            </li>			
	    <li>
                <a href="?page=list-supplier">Supplier</a>
            </li>
			<li>
                <a href="?page=list-inventaris">Daftar Inventaris</a>
            </li>-->
            <li>
                <a href="?page=price-list">Daftar Harga</a>
            </li>
            <li>
                <a href="?page=alert-list">Persediaan Hampir Habis</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
	     <!--<li>
                <a href="?page=add-trans-lain">Jenis Transaksi lainnya</a>
            </li>
            <li>
                <a href="?page=user-list">Management User</a>
            </li>
            
			<li>
                <a href="?page=pengaturan">Konfigurasi</a>
            </li>-->
            <li>
                <a href="?page=pass-mod">Ganti Password</a>
            </li>
			<li>
                <a href="?page=printqrmulti">Cetak Multi QR Code</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <!--<li>
                <a href="?page=kas">Arus Kas</a>
            </li>
            <li>
                <a href="?page=rekap-utang">Piutang</a>
            </li>-->
            <li>
                <a href="?page=rekap-penjualan">Penjualan</a>
            </li>
			<!--<li>
                <a href="?page=rekap-pembelian">Pembelian</a>
            </li>
			<li>
                <a href="?page=rekap-hpp">HPP</a>
            </li>
            <li>
                <a href="?page=rekap-pengeluaran">Transaksi Cash</a>
            </li>
        <li>
                <a href="?page=rekap-noncash">Transaksi Non-Cash</a>
            </li>
			<li>
                <a href="?page=ppn">PPN</a>
            </li>
			<li>
                <a href="?page=hutang">Hutang</a>
            </li>
			<li>
                <a href="?page=rekap-laba-rugi">Laba Rugi</a>
            </li>
			<li>
                <a href="?page=neraca">Neraca</a>
            </li>
            <li><a href="?page=grafik-penjualan">Grafik Penjualan</a></li>
            <li><a href="?page=grafik-laba-rugi">Grafik Laba Rugi</a></li>-->
        </ul>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
<?php
break;
case $level == 'minimart' : ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=penjualan">Penjualan</a>
            </li>
			<li>
                <a href="?page=front-page" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;">Monitor Penjualan</a>
            </li>
            <!--<li>
                <a href="?page=pembelian-barang">Pembelian</a>
            </li>
            <li>
                <a href="?page=trans-lain">Transaksi Cash</a>
            </li>
            <li>
                <a href="?page=trans-noncash">Transaksi Non-Cash</a>
            </li>
            <li>
                <a href="?page=quotation">Quotation</a>
            </li>
            <li>
                <a href="?page=daily-report">Daily Report Activity</a>
            </li>
             <li>
                <a href="?page=list-order">Order</a>
            </li>
            <li>
                <a href="?page=purchase-order">Purchase Order</a>
            </li>
			<li>
                <a href="?page=surat-jalan">Surat Jalan</a>
            </li>
			<li>
                <a href="?page=kwitansi">Kwitansi</a>
            </li>
             <li>
                <a href="?page=clain-marketing">Claim Operational Marketing</a>
            </li>-->
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=satuan-barang">Satuan Barang</a>
            </li>
            <!--<li>
                <a href="?page=modal-awal">Modal</a>
            </li>
            <li>
                <a href="?page=stok-barang">Persediaan Barang</a>
            </li>			
	    <li>
                <a href="?page=list-supplier">Supplier</a>
            </li>
			<li>
                <a href="?page=list-inventaris">Daftar Inventaris</a>
            </li>-->
            <li>
                <a href="?page=price-list">Daftar Harga</a>
            </li>
            <li>
                <a href="?page=alert-list">Persediaan Hampir Habis</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
	     <!--<li>
                <a href="?page=add-trans-lain">Jenis Transaksi lainnya</a>
            </li>
            <li>
                <a href="?page=user-list">Management User</a>
            </li>
            
			<li>
                <a href="?page=pengaturan">Konfigurasi</a>
            </li>-->
            <li>
                <a href="?page=pass-mod">Ganti Password</a>
				
            </li>
			<li>
                <a href="?page=printqrmulti">Cetak Multi QR Code</a>
            </li>
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <!--<li>
                <a href="?page=kas">Arus Kas</a>
            </li>
            <li>
                <a href="?page=rekap-utang">Piutang</a>
            </li>-->
            <li>
                <a href="?page=rekap-penjualan">Penjualan</a>
            </li>
			<!--<li>
                <a href="?page=rekap-pembelian">Pembelian</a>
            </li>
			<li>
                <a href="?page=rekap-hpp">HPP</a>
            </li>
            <li>
                <a href="?page=rekap-pengeluaran">Transaksi Cash</a>
            </li>
        <li>
                <a href="?page=rekap-noncash">Transaksi Non-Cash</a>
            </li>
			<li>
                <a href="?page=ppn">PPN</a>
            </li>
			<li>
                <a href="?page=hutang">Hutang</a>
            </li>
			<li>
                <a href="?page=rekap-laba-rugi">Laba Rugi</a>
            </li>
			<li>
                <a href="?page=neraca">Neraca</a>
            </li>
            <li><a href="?page=grafik-penjualan">Grafik Penjualan</a></li>
            <li><a href="?page=grafik-laba-rugi">Grafik Laba Rugi</a></li>-->
        </ul>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
<?php
break;
case $level == 'vendor' : ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=vendor-member">Managemen Member</a>
            </li>
            
        </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan
        <b class="caret hidden-phone"></b>
    </a>
        <ul class="dropdown-menu">
            <li>
                <a href="?page=rekap-penjualan">Penjualan</a>
            </li>
            <li>
                <a href="?page=rekap-pengeluaran">Jurnal Kas</a>
            </li>
			<li>
                <a href="?page=rekap-laba-rugi">Laba Rugi</a>
            </li>
        </ul>
</li>
<li>
<a href="logout.php">Logout</a>
</li>
<?php } ?>	
                </ul>
            </div>
        </div>
    </header><!--/header-->