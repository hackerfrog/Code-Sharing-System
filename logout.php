<?php

include '_config.php';

session_start();
		
unset($_SESSION["userId"]);
unset($_SESSION["userSalt"]);

header('location: ' . $config->link());

?>