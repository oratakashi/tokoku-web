<?php
if(isset($_POST['cari'])) {	$br = $_POST['brg'];}
$kode    = @$_POST['kode_jualpulsa'];
$pelanggan= @$_POST['pelanggan'];
$tanggal = date("Y-m-d");

if (isset($_POST['kode_jualpulsa'])){
	("kode");
	$_SESSION['kode']=$kode;
	$_SESSION['pelanggan']=$pelanggan;
	$insert=mysql_query("INSERT INTO tbljualpulsa (kode_jualpulsa,pelanggan,tgl) values ('$kode','$pelanggan','$tanggal')");
}
?>
<section>
        <div class="container">
            <div class="row">
	    <div class="col-lg-12">
<?php 
if (!empty($_GET['error']) && $_GET['error'] == 'tidak-cukup') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Saldo pulsa tidak mencukupi</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'habis') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Saldo pulsa habis</strong>	
			</div>
</div>
<?php
;
} else if (!empty($_GET['error']) && $_GET['error'] == 'barang') {
?>
<div class="text-center">
<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon-warning-sign"></i> <strong>Harga jual belum ada</strong>	
			</div>
</div>
<?php
;
}
?>
            </div>
            </div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <i class="icon-user"></i> Penjualan Pulsa 
            </div>
    <div class="panel-body">
<form name="cari" method="POST" action="">
<?php $select=mysql_query("SELECT * FROM tbl_listpulsa WHERE hbelip !='0'"); ?>
    <table>
        <tr>
            <td><select class="form-control chzn-select" tabindex="2" name="brg" data-rel="chosen" required="required">
                    <option disabled>- Pilih -</option>
                    <?php while ($bar=mysql_fetch_array($select)) { ?>
                    <option value="<?php echo $bar['codepul'] ?>"><?php echo $bar['codepul'] ?> - <?php echo $bar['provide']." ".$bar['nomp']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <button type="submit" name="cari" value="cari" class="btn btn-success btn-xs">Tambahkan <i class="icon-plus-sign"></i></button>
            </td>
        </tr>
    </table>
</form>
<br>
<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th colspan="2">No.Order</th> 
            <th colspan="2">Pelanggan</th>
        </tr>
    </thead>
    <tbody>				  
        <tr>
            <td><?php echo $tanggal ; ?></td>
            <td colspan="2"><?php echo $_SESSION['kode'] ; ?></td>
            <td colspan="2"><?php echo $_SESSION['pelanggan'] ; ?></td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th> 
            <th>Sub Total (Rp)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
<form action="?page=inputing-jualpulsa" method="POST">
    <?php $kd=$_SESSION['kode'];
			$jnspelanggan=$_SESSION['pelanggan'];
			$s=mysql_query("SELECT * FROM dtljualpulsa WHERE kode_jualpulsa='$kd'");
			while($sql=mysql_fetch_array($s)){
			$subt=$sql['jumlah']*$sql['harga'];
			$te=$sql['jumlah']*1;
			$total=@$total+$subt;
            $item=@$item+$te;
    ?>
        <tr>
            <td><?php echo $sql['provide']." Rp.".number_format($sql['nomin']); ?></td>
            <td><?php echo $sql['jumlah']; ?></td><td>Rp. <?php echo number_format($sql['harga']);?></td>
            <td>Rp. <?php echo number_format($subt); ?></td>
            <td><a class="btn btn-danger btn-xs" href="?page=del-input-jualpulsa&kode=<?php echo $sql['kode_jualpulsa']; ?>&nama=<?php echo $sql['idpulsa']; ?>">Hapus <i class="icon-trash "></i></a></td>
        </tr>
            <?php } ?>
        <tr>
            <td><input type="text" class="form-control" name="nama_barang" value="<?php echo @$br;?>" required="required"></td>
            <td colspan="2"><input type="text" class="form-control" name="jumlah" required="required"></td>
            <td><input type="hidden" name="kode" value="<?php echo $kd; ?>"></td>
            <td><button type="submit" class="btn btn-success">Tambahkan <i class="icon-plus-sign"></i></button></td>
        </tr>
</form>
<?php 
$tm=mysql_fetch_assoc(mysql_query("SELECT * FROM tbljualpulsa WHERE kode_jualpulsa='$kd' and total!=0")); 
if ($tm){
	$gt=mysql_fetch_array(mysql_query("SELECT * FROM tbljualpulsa WHERE kode_jualpulsa='$kd'")); 
?>
        <tr>
            <td></td>
            <td colspan="2"><b>ITEM</b></td><td colspan="2"><b><?php echo @$item; ?></b></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><h2>TOTAL</h2></td>
            <td colspan="2"><h2>Rp. <?php echo number_format($gt['total']-$gt['ongkos']+$gt['potongan']); ?></h2></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><b>BAYAR</b></td><td colspan="2"><b>Rp. <?php echo number_format($gt['bayar']); ?></b></td>
        </tr>
<?php if ($gt['kurang']==0) {?>
        <tr>
            <td></td>
            <td colspan="2"><b>KEMBALIAN</b></td>
            <td colspan="2"><b>Rp. <?php echo number_format($gt['kembalian']); ?></b></td>
        </tr>
<?php } else {?>
        <tr>
            <td></td>
            <td colspan="2"><b>KURANG BAYAR</b></td>
            <td colspan="2"><b>Rp. <?php echo number_format($gt['kurang']); ?></b></td>
        </tr>
<?php } ?>
    </tbody>
</table>
<a class="btn btn-danger" href="?page=penjualan-pulsa"><i class="icon-times"></i> Close</a>
<a class="btn btn-default" href="invoice-pls.php?kode=<?php echo $kd; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;"><i class="icon-print"></i> Print</a>
<?php } else { ?>
        <tr>
            <td></td>
            <td colspan="2"><b>ITEM</b></td>
            <td colspan="2"><b><?php echo @$item; ?></b></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><h2>TOTAL</h2></td>
            <td colspan="2"><h2>Rp. <?php echo number_format(@$total); ?></h2></td>
        </tr>
<form action="?page=akhir-jualpulsa" method="POST">
        <tr>
            <td></td>
            <td colspan="2"><b>BAYAR</b></td>
            <td colspan="2"><b><input type="text" name="bayar" class="form-control"></b></td>
        </tr>
    </tbody>
</table>
<input type="hidden" name="kode" value="<?php echo $kd; ?>">
<input type="hidden" name="total" value="<?php echo $total; ?>">
<?php $temu=mysql_fetch_assoc(mysql_query("SELECT * FROM dtljualpulsa WHERE kode_jualpulsa='$kd'")); 
if ($temu){ ?>
<button type="submit" class="btn btn-primary">Selesai <i class="icon-share-alt"></i></button>
<?php } else { ?>
<a class="btn btn-danger" href="?page=batal-jualpulsa&kode=<?php echo $kd; ?>"><i class="icon-remove"></i> Batal</a>
<?php } ?>
</form>
<?php } ?>
				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>