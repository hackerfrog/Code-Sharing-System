<?php

	function userBar() {
?>
		<div class="userbar">
			<div class="container">
				<div class="pull-left logo">
					<a href="index.php">
						<img src="core/img/logo2.png" alt="0=={:;:;:;:;:;:;:>">
					</a>
				</div>
				<div class="pull-right">
					<ul>
						<li>
							<a href="explore.php">Explore</a>
						</li>
						<?php
							if (isset($_SESSION['userId']) and isset($_SESSION['userSalt'])) {
						?>
						<li>
							<a href="#accountDrop" onclick="accountDrop()" class="accountBtn">Account</a>
							<div id="accountShow" class="drop-content drop show hide">
								<ul class="ul-down">
									<li>
										<a href="">Profile</a>
									</li>
									<li class="seprator"></li>
									<li>
										<a href="">My Codes</a>
									</li>
									<li>
										<a href="new.php">New Code</a>
									</li>
									<li class="seprator"></li>
									<li>
										<a href="">Settings</a>
									</li>
								</ul>
							</div>
						</li>
						<li>
							<a href="logout.php">Logout</a>
						</li>
						<?php
							} else {
						?>
						<li>
							<a href="login.php">Login</a>
						</li>
						<li>
							<a href="register.php">Register</a>
						</li>
						<?php
							}
						?>
					</ul>
				</div>
				<div class="pull-clear"></div>
			</div>
		</div>
		<script type="text/javascript">
			function accountDrop() {
				document.getElementById('accountShow').classList.toggle("hide");
			}
			window.onclick = function(event) {
				if(!event.target.matches('.accountBtn')) {
					var drop = document.getElementsByClassName('drop-content');
					var i;
					for(i=0; i<drop.length; i++) {
						var openDrop = drop[i];
						if (openDrop.classList.contains('show')) {
							openDrop.classList.add('hide');
						}
					}
				}
			}
		</script>
<?php
	}

	function footer() {
?>
		<div class="footer skew-top">
			<div class="container">
				<div class="pull-left">
					<img class="logo" src="core/img/logo2.png">
				</div>
				<div class="pull-right"></div>
				<div class="pull-clear"></div>
			</div>
		</div>
<?php
	}

?>