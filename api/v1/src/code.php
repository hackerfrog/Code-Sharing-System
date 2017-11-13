<?php

	class Code {

		private $table		= "code";
		private $con;

		private $title;
		private $code;
		private $lang;
		private $user;
		private $datetime;
		private $privacy;

		public function __construct($db) {
			$this->con = $db;
		}

		public function insertCode($data) {
			if (empty($data->code) or
				empty($data->lang) or
				empty($data->privacy) or
				empty($data->title)) {
				
				$ret['status'] 	= 'error';
				$ret['code']	= '100';
				return json_encode($ret);
			} else {
				$this->title 	= htmlspecialchars(strip_tags($data->title));
				$this->code 	= $data->code;
				$this->lang 	= $data->lang;
				$this->user 	= $_SESSION['userId'];
				$this->privacy 	= $data->privacy;

				$sql	= 	"INSERT INTO
								$this->table
							(
								title, code, lang, user, privacy
							)
							VALUES
							(
								:title, :code, :lang, :user, :privacy
							)";

				$stmt	= $this->con->prepare($sql);
				$stmt->bindParam(':title', 		$this->title);
				$stmt->bindParam(':code',		$this->code);
				$stmt->bindParam(':lang',		$this->lang);
				$stmt->bindParam(':user',		$this->user);
				$stmt->bindParam(':privacy',	$this->privacy);

				if ($stmt->execute()) {
					$ret['status']	= 'ok';
					$ret['code']	= '201';
					return json_encode($ret);
				} else {
					$ret['status']	= 'error';
					$ret['code']	= '100';
					return json_encode($ret);
				}
			}
		}

		public function explore() {
			$sql	= 	"SELECT
							*
						FROM
							$this->table
						WHERE
							privacy = 'pub'";
			if (isset($_SESSION['userId'])) {
				$sql 	= 	"SELECT
							*
						FROM
							$this->table
						WHERE
							privacy = 'pub' OR privacy = 'pro' OR (user = {$_SESSION['userId']})";
			}
			$stmt	= $this->con->prepare($sql);
			$stmt->execute();

			$row	= $stmt->fetchAll();

			return json_encode($row);

		}

	}

?>