<?php
include 'library/auth.php';

if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
	$username = $_COOKIE['username'];
	$token = $_COOKIE['token'];

	if(verify_session($username, $token)){
		header("Location: /home.php");
	}
}

if(isset($_POST['username']) and isset($_POST['password'])){
	if(do_login($_POST['username'], $_POST['password'])){
		header("Location: /home.php");
	} else {
		$flag = 0;
	}
} else {
	$flag = -1;
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v4.1.1">
	<title>Signin Template</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

	<!-- Bootstrap core CSS -->
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<!-- Custom styles for this template -->
	<link href="signin.css" rel="stylesheet">
</head>
<body class="text-center">
	<form class="form-signin" action="signin.php" method="POST">
		<?php
		if($flag == 0) {
			?>
			<div class="alert alert-danger" role="alert">
				Your username or password did not match.
				<?php
				if($flag != -1){
					include '_show_up.php';
				}
				?>
			</div>
			<?php
		} else if(isset($_GET['signup'])){
			if($_GET['signup'] == 'success'){
			?>
				<div class="alert alert-success" role="alert">
				Signup success, you can login now!
				</div>
			<?php
			}
		}
		?>
		<img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<label for="inputusername" class="sr-only">Username</label>
		<input name="username" type="text" id="inputusername" class="form-control" placeholder="Username" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<a href="/signup.php">No account? Signup :)</a>
		<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
	</form>
</body>
</html>
