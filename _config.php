<?php

	include_once '_subpages.php';
	include_once 'api/v1/src/config.php';
	include_once 'api/v1/src/database.php';
	include_once 'api/v1/src/languages.php';
	include_once 'api/v1/src/code.php';

	$config		= new Config();
	
	$db 		= new Database();
	$db 		= $db->connect();

	$lang 		= new Languages($db);
	$code		= new Code($db);

	function getLangOptions() {
		global $lang;
		$data = json_decode( $lang->langOptions() );
		foreach ($data as $row) {
			echo '<option value="' . $row->id . '">' . $row->lang . '</option>';
		}
	}

	function getLangName($code) {
		global $lang;
		return $lang->langName($code);
	}

	function privacyIcon($type) {
		if ($type == 'pub') {
			return '<img title="Public" class="privacy" src="core/img/globe.png">';
		} elseif ($type == 'pro') {
			return '<img title="Protected" class="privacy" src="core/img/lock.png">';
		} elseif ($type == 'pri') {
			return '<img title="Private" class="privacy" src="core/img/private.png">';
		}
	}

	function getExplore() {
		global $code;
		$data = json_decode( $code->explore() );
		foreach ($data as $row) {
?>
	<div class="code">
		<div class="link">
			<span class="lang"><?= getLangName($row->lang); ?></span>
			<a href="#"><?= $row->title; ?></a>
		</div>
		<textarea id="codemirror-<?= $row->id; ?>" class="CodeMirror"><?= $row->code; ?></textarea>
		<div class="opts">
			<span class="privacy"><?= privacyIcon($row->privacy); ?></span>
			<span class="datetime"><?= date('j F Y', strtotime($row->datetime)); ?></span>
		</div>
	</div>

    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(document.getElementById("codemirror-<?= $row->id; ?>"), {
        lineNumbers: true,
        indentUnit: 4,
        lineWrapping: true,
        styleActiveLine: true,
        viewportMargin: Infinity,
        readOnly: true
        });
    </script>
<?php
		}
	}

	session_start();

?>