<?php
session_start();
include('include/config.php'); 
include('class/class.phpmailer.php');
if (!empty($_POST['submit'])){ 
$username = trim(htmlspecialchars(mysql_escape_string($_POST['username'])));
$password = trim(htmlspecialchars(mysql_escape_string($_POST['password'])));
$perintah_query=mysql_query("SELECT * FROM tab_user WHERE username = BINARY'{$username}' AND password = md5('{$password}') AND status='1'"); 
	if($hasil_cek=mysql_num_rows($perintah_query))
	{
	//sukess
	$datauser=mysql_fetch_array($perintah_query);
	$_SESSION['user'] = $_POST['username'];
    $_SESSION['id'] = $datauser['id'];
	$_SESSION['nama'] = $datauser['fullname'];
	$_SESSION['level'] = $datauser['level'];
	
	$now = date("Y-m-d H:i:s");
	$lastlog=mysql_query("UPDATE tab_user SET lastlogin = '$now' WHERE id = '{$_SESSION['id']}'"); 

    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php\">");
	} else 
	{   
// gagal login
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?err=yes\">");
	}
	}
?>
<?php
if (empty($_SESSION['user'])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TokoKu | Toko Ritel System Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
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
<?php if(!empty($_GET['registration'])&&$_GET['registration']=='pick') { ?>
<section id="registration" class="container">
<!--<fieldset class="registration-form">-->
<!--<a href="" class="btn btn-success btn-circle"><i class="icon-file-text-alt icon-lg"></i><br>Paket Free 14 Hari</a>-->
<!--<a href="" class="btn btn-primary btn-circle"><i class="icon-book icon-lg"></i><br>Paket Bundling</a>-->
<!--</fieldset>-->
<div style="text-align: center">TokoKu</div>
        <form class="center" method="" action="">
            <fieldset class="registration-form">
                <div class="form-group">
<a href="?registration=yes&paket=1" class="btn btn-success btn-circle"><i class="icon-file-text-alt icon-lg"></i><br>Paket Free 14 Hari</a>
<a href="?registration=yes&paket=2" class="btn btn-primary btn-circle"><i class="icon-book icon-lg"></i><br>Paket Bundling</a>
                </div>
            </fieldset>
        </form>
</section><!--/#registration-->
<?php } else if(!empty($_GET['registration'])&&$_GET['registration']=='yes') {
    if(!empty($_POST['regis'])) {
        $iduser = (strtotime("now"));
        $perusahaan = trim(htmlspecialchars(mysql_escape_string($_POST['namausaha'])));
        $fullname = trim(htmlspecialchars(mysql_escape_string($_POST['fullname'])));
        $email = trim(htmlspecialchars(mysql_escape_string($_POST['email'])));
        $notelp = $_POST['notelp'];
        $alamat =trim(htmlspecialchars(mysql_escape_string($_POST['alamat'])));
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $plan = $_POST['paket'];
        
        if($plan == 2) {
            $ketpaket = "paket Bundling sebesar Rp. 1.200.000.";
        } else if($plan == 12) {
            $ketpaket = "paket 1 Tahun sebesar Rp. 899.900.";
        } else if($plan == 3) {
            $ketpaket = "paket 3 Bulan sebesar Rp. 269.700.";
        } else if($plan == 1) {
            $ketpaket = "paket free 14 hari.";
        } 
        
        $usernama = trim(htmlspecialchars(mysql_escape_string($_POST['usernama'])));
        $sandikata = md5(trim(htmlspecialchars(mysql_escape_string($_POST['sandikata']))));
        $pesan = "Terima Kasih Atas Kunjungannya";
        $tgl_reg = date("Y-m-d H:i:s");
        
$perintah_cek=mysql_query(" SELECT * FROM setting WHERE perusahaan = '$perusahaan'"); 
	if(mysql_num_rows($perintah_cek) > 0) {
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?registration=yes&paket=$plan&error=perusahaan\">"); 
	} else {
        
        $reg1 = mysql_query("INSERT INTO tab_user(id, fullname, username, password, email, no_tlp, provi, kotab, alamat, plan, tgl_reg) VALUES ('$iduser','$fullname','$usernama','$sandikata','$email','$notelp','$provinsi','$kota','$alamat','$plan','$tgl_reg')") or die(mysql_error());
        $reg2 = mysql_query("INSERT INTO setting(iduser, perusahaan, alamat, tlp, namap, pesan) VALUES ('$iduser','$perusahaan','$alamat','$notelp','$fullname','$pesan')") or die(mysql_error());
    
    if($reg1 && $reg2) {
$emailf = $email;
$subject = "Aktivasi Akun Toko Ritel System";
$message = "
<html>
<head>
<title>Aktivasi Akun Toko Ritel System</title>
</head>
<body>
<p>Kepada Yth Bapak/Ibu ".$fullname."</p>
<p></p>
<p>Assalamu’alaikum warahmatullahi wabarakatuh</p>
<p></p>
<p>Terima Kasih Anda telah melakukan pendaftaran Akun Toko Ritel System dengan detail sebagai berikut  :</p>
<p>ID Akun : ".$iduser."</p>
<p>Nama Akun : ".$_POST['usernama']."</p>
<p>Password : ".$_POST['sandikata']."</p>
<p></p>
<p>Jangan lupa untuk melakukan aktivasi akun melalui link berikut :</p>
<p><a href='https://aplikasiku.co.id/ritel/index.php?activation=".$iduser."&token=".$sandikata."'>Konfirmasi Aktivasi Akun Toko Ritel System</a></p>
<p></p>
<p>Demikian informasi dari kami. Terima kasih telah bergabung bersama layanan jasa kami.</p>
<p></p>
<p>Terima Kasih,</p>
</body>
</html>
";

$watsapmsg = "
Pendaftaran berhasil silahkan buka email Anda pada Kotak Masuk / Spam untuk mengaktifkan akun Anda!

Terimakasih atas pemesanan layanan Aplikasiku.co.id dengan pilihan ".$ketpaket." Untuk selanjutnya pembayaran dapat melalui rekening berikut :

BCA
an Yose Sano Hendarsyah
No Rek : 0770558964

Mandiri
an Yose Sano Hendarsyah
No Rek : 1380004673922

BNI Syariah
an PT ICHWAN MEDIA SOLUSI
No Rek : 0913485024

BRI
an Yose Sano Hendarsyah
No Rek : 688401010988533

BRI
an PT ICHWAN MEDIA SOLUSI
No Rek : 687601011295530

BTN
an Yose Sano Hendarsyah
No Rek : 7072090685

Mohon untuk segera melakukan konfirmasi pembayaran melalui nomor whattsapp ini dengan melampirkan bukti pembayaran.
Terimakasih...
";

//$sendwatsapp = mysql_escape_string("https://api.whatsapp.com/send?phone=6281915301662&text=".rawurlencode($watsapmsg));

// // Always set content-type when sending HTML emailagn
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // More headers
// $headers .= 'From: <info@ichwan-ms.com>' . "\r\n";
// // $headers .= 'Cc: example@example' . "\r\n";
// mail($to,$subject,$message,$headers);

// $mail = new PHPMailer; 
// $mail->IsSMTP();
// $mail->SMTPSecure = 'ssl'; 
// $mail->Host = "aplikasiku.co.id";//"smtp.gmail.com"; //host masing2 provider email
// //$mail->SMTPDebug = 2;
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// $mail->Username = "info@aplikasiku.co.id";//"noreply@aplikasiku.co.id"; //user email
// $mail->Password = "En+AN=p6kP4i";//"Vb*aZ)3!NZF^"; //password email 
// $mail->SetFrom("info@aplikasiku.co.id","Aplikasiku Mail System"); //set email pengirim
// $mail->Subject = "Aktivasi Akun Toko Ritel System"; //subyek email
// $mail->AddAddress($emailf);  //tujuan email
// $mail->MsgHTML($message);

// if($mail->Send()) { 
    
//     // echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?registration=yes&reg=berhasil\">"); 
    // echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=https://api.whatsapp.com/send?phone=6281915301662&text=".rawurlencode($watsapmsg)."\">"); 
    
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php\">");
    
    
// }

    }
	}
}
?>
<script type="text/javascript" src="js/jquery-tklks.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=provinsi>
  $("#provinsi").change(function(){
    var provinsi = $("#provinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "provinsi="+provinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });

});

</script>
<section id="registration" class="container">
<?php if (!empty($_GET['reg']) && $_GET['reg'] == 'berhasil') { ?>
<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<strong>Pendaftaran berhasil silahkan buka email Anda pada Kotak Masuk / Spam untuk mengaktifkan akun Anda!</strong>
</div>
<?php } ?>
<?php if (!empty($_GET['error']) && $_GET['error'] == 'perusahaan') { ?>
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<strong>Nama Perusahaan yang anda input sudah didaftarkan oleh akun lain!</strong>
</div>
<?php } ?>
<div style="text-align: center">TokoKu</div>
        <form class="center" method="POST" action="">
            <fieldset class="registration-form">
                <div class="form-group">
                    <input type="text" name="namausaha" placeholder="Nama Usaha" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" placeholder="Nama Pemilik Usaha" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Alamat Email" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="text" name="notelp" placeholder="Nomor Telepon" class="form-control" required>
                </div>
                
                <div class="form-group">
				                                
				                                    
<select class="form-control" name="provinsi" id="provinsi" required="required">
<option selected disabled>-Pilih Provinsi-</option>
<?php $query = mysql_query("SELECT * FROM provinces");
while ($data = mysql_fetch_array($query)) { ?>
<option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>
<?php } ?>
						</select>
				                                
				                            </div>
<div class="form-group">
<select name="kota" id="kota" class="form-control" required="required">
<option selected disabled>-Pilih Kota-</option>
</select>
				                                
				                            </div>
				    <div class="form-group">
                    <input type="text" name="alamat" placeholder="Alamat Usaha" class="form-control" required>
                </div> 
<?php if(!empty($_GET['paket']) && $_GET['paket'] == 1) { ?>
<input type="hidden" name="paket" value="1" class="form-control" required>
<?php } else { ?>
                <div class="form-group">
<select name="paket" id="paket" class="form-control" required="required">
<option value="2">-Pilih Paket-</option>
<option value="2">Paket Bundling - 1.200.000</option>
<option value="12">Paket 1 Tahun - 899.900</option>
<option value="3">Paket 3 Bulan - 269.700</option>
<!--<option value="6">Paket 6 Bulan - 539.400</option>
<option value="9">Paket 9 Bulan - 809.100</option>
<option value="12">Paket 1 Tahun - 1.078.000</option>-->

</select>
      </div>
<?php } ?>
                <div class="form-group">
                    <input type="text" id="namauser" name="usernama" placeholder="Username" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="password" id="katasandi" name="sandikata" placeholder="Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <button  type="submit" name="regis" value="Sign Up" class="btn btn-success btn-md btn-block">Sign Up</button>
                </div>
                <span>Sudah Punya Akun? <a href="index.php">Sign In</a></span>

            </fieldset>
        </form>
    </section><!--/#registration-->
<?php } else if(!empty($_GET['activation']) && !empty($_GET['token'])) {
$id = $_GET['activation'];
$token = $_GET['token'];
$activation = mysql_query("UPDATE tab_user SET status='1' WHERE id='$id' AND password='$token' AND status='0'") or die(mysql_error());
if($activation) {
    echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=index.php?msg=actived\">");
}

} else { ?>
<section id="registration" class="container">
<div style="text-align: center">TokoKu</div>
        <form class="center" method="post" action="index.php">
            <fieldset class="registration-form">
                <div class="form-group">
                    <input type="text" id="username" name="username" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                    <button  type="submit" name="submit" value="LOG IN" class="btn btn-success btn-md btn-block">Login</button>
                </div>
                <span>Belum Punya Akun? <a href="?registration=pick">Sign Up</a></span>

            </fieldset>
        </form>
    </section><!--/#registration-->
<?php } ?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php
}
else 
{
	if(!empty($_GET['page'])) 
{
	if(file_exists("hala/".$_GET['page'].".php")) 
	{
	include('include/header.php');	
	include("hala/".$_GET['page'].".php");
    include('include/footer.php');	
	} else 
	{
	include('include/header.php');	
	include("hala/errors_404.php");
    include('include/footer.php');
	}

} else
{
include('include/header.php');
include('hala/intro.php');
include('include/footer.php');
}
}
?>