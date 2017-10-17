<?php

	include '_config.php';

	$config->checkSession($_SESSION);

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

			footer();
		?>
    </body>

    </html>