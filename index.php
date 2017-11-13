<?php

	include '_config.php';

	if($config->checkSession($_SESSION))
        header('location: ' . $config->link('explore'));

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Code Sword</title>
        <link rel="stylesheet" type="text/css" href="core/css/main.css">
    </head>

    <body>
        <?php
			userBar();
            homeBody();
			footer();
		?>
    </body>

    </html>