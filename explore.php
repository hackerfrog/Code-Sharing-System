<?php

	include '_config.php';

    if(!$config->checkSession($_SESSION))
        header('location: ' . $config->link('login'));

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Code Sword</title>
        <link rel="stylesheet" type="text/css" href="core/css/main.css">

        <script src="vendor/codemirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="vendor/codemirror/lib/codemirror.css">
        <script src="vendor/codemirror/mode/javascript/javascript.js"></script>
    </head>

    <body>
        <?php
			userBar();
        ?>
        <div class="container">
        <?php

            getExplore();

        ?>
        </div>
        <?php

			footer();
		?>
    </body>

    </html>