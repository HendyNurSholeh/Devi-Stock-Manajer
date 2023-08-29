<?php 	
	session_start();
	if(isset($_SESSION["loginAdmin"])){
	   header("Location: home.php");
	   exit;
	} elseif (isset($_SESSION["loginOwner"])){
		header("Location: ../../owner/views/home.php");
		exit;
	 }
	require "../controllers/LoginController.php";
	$result = "";
	if(isset($_POST["submit"])){
		$result = isSuccessLogin($_POST["username"], $_POST["password"]);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style_login.css">
</head>
<body>
	<form action="" method="post">
		<section>
			<div class="form-box">
				<div class="form-value">
					<form action="" method="post">
						<h2>Login</h2>
						<div class="inputbox">
							<img src="../../assets/img/username.png" width="20px">
							<input type="text" name="username" required>
							<label form="">Username</label>
						</div>
						<div class="inputbox">
							<img src="../../assets/img/pw.png" width="20px">
							<input type="password" name="password" required>
							<label form="">Password</label>
						</div>
						<div class="salah">
							<?php if($result === 'invalidUsername'): ?>
									<p>Username/Email Salah!!</p>
							<?php endif; ?>
							<?php if($result === "invalidPassword"): ?>
									<p>Password Salah!!</p>
							<?php endif; ?>
						</div>
						<button type="submit" name="submit">Login</button>
						<div class="registrasi">
							<p>Belum Punya Akun <a href="">Registrasi</a></p>
						</div>
					</form>
				</div>
			</div>
		</section>
	</form>
</body>