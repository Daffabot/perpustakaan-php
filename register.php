<?php
session_start();
if (isset($_SESSION['login_user'])!="") {
 header("Location: index.php");
}
require_once 'setting/koneksi.php';

$error = null;

if(isset($_POST['btn-signup'])) {
 
 $uname = strip_tags($_POST['username']);
 $upass = strip_tags($_POST['password']);
 
 $uname = $db->real_escape_string($uname);
 $upass = $db->real_escape_string($upass);
 
 $hashed_password = md5($upass);
 
 $check_account = $db->query("SELECT username FROM t_account WHERE username='$uname'");
 $count=$check_account->num_rows;
 
 if ($count==0) {
  
  //id_p_role 3, karena otomatis menjadi anggota jika register
  $query = "INSERT INTO t_account(id_p_role, username, password, create_date, create_by) VALUES(3,'$uname','$hashed_password', curdate(),'adm')";
  
	//echo $query;
  if ($db->query($query)) {
	header("location: login.php");
	
  }else {
   $error = "terjadi kesalahan !";
  }
  
 } else {
  
  
  $error = "maaf, username sudah dipakai anggota lain!";
   
 }
 
 $db->close();
}
?>
<html>
<head>
<title>Registrasi | Perpustakaan</title>
	<link rel="stylesheet" type="text/css" href="template/alert.css">
	<script src="template/js/jquery-3.7.1.min.js"></script>
	<link href="template/css/bootstrap.min.css" rel="stylesheet" />
	<link href="template/css/sb-admin-2.css" rel="stylesheet" />
	<script src="template/js/bootstrap.min.js"></script>
</head>
	<body>
	<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title mb-0">Silahkan Mendaftar di Perpustakaan Daffabot</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <fieldset>
                            <?php if ($error != "") { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                            <br>
                            <i>Gunakan inisial dengan 3 karakter</i>
                            <br>
                            <input type="text" maxlength="3" class="form-control mt-2" onkeypress="return isNumber(event)" placeholder="username, contoh : ARY" name="username" required />
                            <br>
                            <input type="password" maxlength="15" class="form-control mt-2" id="password" placeholder="Password" onkeypress="checkPassStrength()" name="password" required />
                            <br>
                            Password Level: <label id="passstrength">-</label>
                            <br>
                            <button type="submit" name="btn-signup" class="btn btn-primary btn-block w-100 mt-3">Create Account</button>
                            <br>Sudah Punya Akun? <a href="login.php">Login di sini</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	console.log("masuk cuy");
$('#password').keyup(function(e) {
	console.log("diketik");
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Medium!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Weak!');
     }
     return true;
});

function isNumber(event){
  var charCode = (event.which) ? event.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57))
   return true;
 return false;
}
</script>
</body>
</html>