<?php

	class Languages {

		private $table		= "lang";
		private $con;

		private $lang;
		private $script;
		private $mode;
		private $ext;

		public function __construct($db) {
			$this->con = $db;
		}

		// Getters
		public function getLang()	{	return $this->lang;		}
		public function getScript()	{	return $this->script;	}
		public function getMode()	{	return $this->mode;		}
		public function getExt()	{	return $this->ext;		}

		// Setters
		public function setLang($lang)		{	$this->lang 	= $lang;	}
		public function setScript($script)	{	$this->script 	= $script;	}
		public function setMode($mode)		{	$this->mode 	= $mode;	}
		public function setExt($ext) 		{	$this->ext 		= $ext;		}


		public function langOptions() {
			$sql 	= 	"SELECT
							*
						FROM
							$this->table
						ORDER BY
							lang
						";
			$stmt	= $this->con->prepare($sql);
			$stmt->execute();

			$row	= $stmt->fetchAll();

			return json_encode($row);
		}
	}

?>