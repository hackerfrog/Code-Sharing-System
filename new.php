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
        <script src="vendor/codemirror/addon/selection/active-line.js"></script>
        <script src="vendor/codemirror/addon/display/placeholder.js"></script>

    </head>

    <body>
        <?php
			userBar();
        ?>

        <div class="skew-block newcode bg-white">
            <div class="text-center">
                <h3>New Code</h3>
            </div>
            <div class="container">
                <form method="post" action="api/v1/new">
                    <label>Title</label>
                    <input type="text" name="title">
                    <label>Code</label>
                    <textarea id="codemirror" class="CodeMirror" name="code" placeholder="Your code goes here..."></textarea>
                    <label>Language</label>
                    <select name="lang">
                        <?php
                            getLangOptions();
                        ?>
                    </select>
                    <label>Privacy</label>
                    <select name="privacy">
                        <option value="pub">Public</option>
                        <option value="pro">Protected</option>
                        <option value="pri">Private</option>
                    </select>
                    <div class="text-center">
                        <input type="submit" value="Post Code">
                    </div>
                </form>
            </div>
        </div>
        
        <?php
			footer();
		?>
        <script type="text/javascript">
            var editor = CodeMirror.fromTextArea(document.getElementById("codemirror"), {
            lineNumbers: true,
            indentUnit: 4,
            lineWrapping: true,
            styleActiveLine: true,
            viewportMargin: Infinity
            });
        </script>
    </body>

    </html>