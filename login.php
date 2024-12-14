<?php
   include("setting/koneksi.php");
   $error = "";
   session_start();
   $delete_this_aja = null;
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
	  $mypassword = mysqli_real_escape_string($db,$_POST['password']);
	  
	  $hash_pass = md5($mypassword);
      
      $sql = "SELECT username FROM t_account WHERE username = '$myusername' and password = '$hash_pass'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
      $count = mysqli_num_rows($result);
	
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
     
		 header("location:form/dashboard.php");
      }else {
         $error = "Username atau Password anda salah!";
      }
   }
?>
<html>
   
   <head>
		<title>Login | Perpustakaan</title>
		<link href="template/css/bootstrap.min.css" rel="stylesheet" />
		<link href="template/css/sb-admin-2.css" rel="stylesheet" />
		<script src="template/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="template/alert.css">
   </head>
   <body>
   <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Perpustakaan Daffabot</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <fieldset>
                            <?php if ($error != "") { ?>
                                <div class="form-group">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $error; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            <?php } ?>

                            <br>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="username, contoh : ARY" name="username" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="psw">Belum punya akun? <a href="register.php">Daftar disini</a></span>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   </body>
</html>