<?php

	include "_config.php";

	$config->checkSession($_SESSION);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register - Code Sword</title>

		<link rel="stylesheet" type="text/css" href="core/css/main.css">
	</head>
	<body>
		<?php
			userBar();
		?>
		<div class="login-area skew-block">
			<div class="login-box">
				<span class="head">Register</span>
				<form action="api/v1/register" method="post">

					<?= $config->codeExpand($_GET); ?>
					
					<label>Full Name</label>
					<input type="text" name="name" placeholder="Full Name">
					<label>Email</label>
					<input type="email" name="email" placeholder="Email Address">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password">
					<label>Confirm Password</label>
					<input type="password" name="cpassword" placeholder="Confirm Password">
					<input type="submit" name="register" value="Register">
				</form>
			</div>
		</div>
		<?php
			footer();
		?>
	</body>
</html>