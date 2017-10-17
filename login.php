<?php

	include "_config.php";

	if($config->checkSession($_SESSION))
        header('location: ' . $config->link('explore'));

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login - Code Sword</title>

		<link rel="stylesheet" type="text/css" href="core/css/main.css">
	</head>
	<body>
		<?php
			userBar();
		?>
		<div class="login-area skew-block">
			<div class="login-box">
				<span class="head">Login</span>
				<form action="api/v1/login" method="post">

					<?= $config->codeExpand($_GET); ?>
				
					<label>Email</label>
					<input type="email" name="email" placeholder="Email Address">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password">
					<input type="submit" name="login" value="Login">
				</form>
				<div class="after text-center">
					Nah! I Need account - <a href="register.php">Register</a> now.
				</div>
			</div>
		</div>
		<?php
			footer();
		?>
	</body>
</html>