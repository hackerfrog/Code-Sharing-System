<?php

	include '_config.php';

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Code Sword</title>
        <link rel="stylesheet" type="text/css" href="core/css/main.css">

        <script src="vendor/codemirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="vendor/codemirror/lib/codemirror.css">
        <script src="vendor/codemirror/mode/javascript/javascript.js"></script>

        <style type="text/css">
            .CodeMirror {
                height: 150px;
                display: block;
                max-height: 300px;
            }
        </style>
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