<section id="blog" class="container">
        <div class="row">
      
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="blog">
                    <div class="blog-item">

                        <div class="blog-content">
						
<?php
$id = $_GET['barcode'];
$it = $_GET['id'];
$query = mysql_query("select * from stok_bahan where id_bahan='$it'") or die(mysql_error());
$data = mysql_fetch_array($query);
    ini_set('display_errors',1);
    error_reporting(E_ALL|E_STRICT);
    include 'Code128.php';
    $code = isset($_GET['barcode']) ? $_GET['barcode'] :$id; 
    //header("Content-type: image/svg+xml");
    echo "<div class='text-center'>".draw($code);
echo "<h5>Nama Barang : ".$data['nama_bahan']."</h5><br>";
?>
<a class="btn btn-primary" href="result-bar.php?id=<?php echo $it?>&barcode=<?php echo $id?>" target="_blank"><i class="icon-print"></i> Print Code</a></div>
                    
                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->