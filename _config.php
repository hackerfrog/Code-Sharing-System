<?php

	include_once '_subpages.php';
	include_once 'api/v1/src/config.php';
	include_once 'api/v1/src/database.php';
	include_once 'api/v1/src/languages.php';

	$config		= new Config();
	
	$db 		= new Database();
	$db 		= $db->connect();

	$lang 		= new Languages($db);

	function getLangOptions() {
		global $lang;
		$data = json_decode( $lang->langOptions() );
		foreach ($data as $row) {
			echo '<option value="' . $row->id . '">' . $row->lang . '</option>';
		}
	}

	session_start();

?>