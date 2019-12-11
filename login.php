<?php 
include_once 'config/database.php';
// redirect if already login
if(@$_SESSION['allowLogSystemFixPhone']=="logAlready"){
	header("location: admin/");
}


// logout
if(isset($_GET['action'])){
  if($_GET['action'] == "logout"){
    session_destroy();
    header("Refresh:0; url=index.php");
  }
}

// login
if(isset($_POST['btnlogin'])){
  $name = trim($connect->real_escape_string(@$_POST['txtname']));
  $pass = trim($connect->real_escape_string(@$_POST['txtpass']));
  $pass = md5($pass);
  $enctypt_password = sha1(md5($pass)).sha1("0962195196");

  $stm = "SELECT * FROM tbl_pos_user WHERE username='{$name}' AND password='{$enctypt_password}'";
  $user = $connect->query($stm);
  if(mysqli_num_rows($user)==1){
    $user_data = mysqli_fetch_object($user);
    $_SESSION['user'] = $user_data;
    $_SESSION['allowLogSystemFixPhone'] = "logAlready";

    // echo $_SESSION['user']->user_email  ** example when u want to user session

    header("location: admin/dashboard/");
  }else{
    $sms = '<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Error!</strong> invalid account ...
		</div>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="assets/global/plugins/bootstrap/css/bootstrap.css">
	<style type="text/css" media="screen">
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);
		.login-page {
		  width: 360px;
		  padding: 8% 0 0;
		  margin: auto;
		}
		.form {
		  position: relative;
		  z-index: 1;
		  background: #FFFFFF;
		  max-width: 360px;
		  margin: 0 auto 100px;
		  padding: 45px;
		  text-align: center;
		  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}
		.form input {
		  font-family: "Roboto", sans-serif;
		  outline: 0;
		  background: #f2f2f2;
		  width: 100%;
		  border: 0;
		  margin: 0 0 15px;
		  padding: 15px;
		  box-sizing: border-box;
		  font-size: 14px;
		}
		.form button.btn_log {
		  font-family: "Roboto", sans-serif;
		  text-transform: uppercase;
		  outline: 0;
		  background: #4CAF50;
		  width: 100%;
		  border: 0;
		  padding: 15px;
		  color: #FFFFFF;
		  font-size: 14px;
		  -webkit-transition: all 0.3 ease;
		  transition: all 0.3 ease;
		  cursor: pointer;
		}
		.form button.btn_log:hover,.form button.btn_log:active,.form button.btn_log:focus {
		  background: #43A047;
		}
		.form .message {
		  margin: 15px 0 0;
		  color: #b3b3b3;
		  font-size: 12px;
		}
		.form .message a {
		  color: #4CAF50;
		  text-decoration: none;
		}
		.form .register-form {
		  display: none;
		}
		.container {
		  position: relative;
		  z-index: 1;
		  max-width: 300px;
		  margin: 0 auto;
		}
		.container:before, .container:after {
		  content: "";
		  display: block;
		  clear: both;
		}
		.container .info {
		  margin: 50px auto;
		  text-align: center;
		}
		.container .info h1 {
		  margin: 0 0 15px;
		  padding: 0;
		  font-size: 36px;
		  font-weight: 300;
		  color: #1a1a1a;
		}
		.container .info span {
		  color: #4d4d4d;
		  font-size: 12px;
		}
		.container .info span a {
		  color: #000000;
		  text-decoration: none;
		}
		.container .info span .fa {
		  color: #EF3B3A;
		}
		body {
		  background: #ddd; 
		 /* fallback for old browsers */
		 /* background: -webkit-linear-gradient(right, #76b852, #8DC26F);
		  background: -moz-linear-gradient(right, #76b852, #8DC26F);
		  background: -o-linear-gradient(right, #76b852, #8DC26F);
		  background: linear-gradient(to left, #76b852, #8DC26F);*/
		  font-family: "Roboto", sans-serif;
		  -webkit-font-smoothing: antialiased;
		  -moz-osx-font-smoothing: grayscale;      
		}
	</style>
	<script type="text/javascript" src="assets/global/plugins/jquery.min.js"></script>
</head>
<body>
	<div class="login-page">
	  <div class="form">
	  	<?= @$sms ?>
	    <form class="login-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	      <input type="text" placeholder="username" name="txtname" autocomplete="off" <?= ((@$_GET['username']=='')?('autofocus'):('')) ?> value="<?= @$_GET['username'] ?>" />
	      <input type="password" placeholder="password" name="txtpass" autocomplete="off" autofocus="" value="" />
	      <button type="submit" class="btn_log" name="btnlogin">login</button>
	    </form>
	  </div>
	</div>
	<div style="max-width: 100%; overflow-x: auto; text-align: center; white-space: nowrap;" >
		<?php 
			$v_get_user = $connect->query("SELECT * FROM tbl_pos_user");
			while ($row_get_user = mysqli_fetch_object($v_get_user)) {
				echo '<a href="'.$_SERVER['PHP_SELF'].'?username='.$row_get_user->username.'"><div style="width: 150px; display: inline-block; margin: auto 5px;">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h5 class="panel-title">'.$row_get_user->username.'</h5>
						</div>
						<div class="panel-body" style="padding: 0px;">
							<img src="img/img_user/login.png" class="img img-responsive img-thumbnail" alt="" style="border-radius: 0px;">
						</div>
					</div>
				</div></a>';
			}
		?>
	</div>
	<script type="text/javascript" src="assets/global/plugins/bootstrap/js/bootstrap.js"></script>
</body>
</html>
<?php 
	mysqli_close($connect);
?>
