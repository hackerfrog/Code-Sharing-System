<?php

	class User {

		private $table		= "users";
		private $con;

		private $email;
		private $password;
		private $name;
		private $doj;
		private $active;
		private $salt;
		private $settings;

		public function __construct($db) {
			$this->con 	= $db;
		}

		// Getters
		public function getEmail()				{ return $this->email;		}
		public function getName()				{ return $this->name;		}
		public function getDoj()				{ return $this->doj;		}
		public function getActive()				{ return $this->active;		}
		public function getSalt()				{ return $this->salt;		}
		public function getSettings()			{ return $this->settings;	}

		// Setters
		public function setEmail($email)		{ $this->email		= $email;		}
		public function setPassword($password)	{ $this->password 	= $password;	}
		public function setName($name)			{ $this->name 		= $name;		}
		public function setDoj($doj)			{ $this->doj 		= $doj;			}
		public function setActive($active)		{ $this->active 	= $active;		}
		public function setSalt($salt)			{ $this->salt 		= $salt;		}
		public function setSettings($settings)	{ $this->settings 	= $settings;	}

		// Functions

		public function exists($email) {
			$sql	= 	"SELECT
							COUNT(*) AS num
						FROM
							$this->table
						WHERE
							email = :email";
			$stmt	= $this->con->prepare($sql);
			$stmt->bindParam('email', $email);
			$stmt->execute();

			$row	= (object) $stmt->fetch(PDO::FETCH_ASSOC);

			return ($row->num > 0) ? true : false;
		}

		public function auth($email, $password) {
			$sql	=	"SELECT
							*
						FROM
							$this->table
						WHERE
							email = :email
							AND
							password = :password";
			$stmt 	= $this->con->prepare($sql);
			$stmt->bindParam('email', $email);
			$stmt->bindParam('password', $password);
			$stmt->execute();

			$row	= (object) $stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() > 0) {
				$result['status']	= 'ok';
				$result['data']		= $row;
				return json_encode($result);
			} else {
				return false;				
			}
		}

		public function updateSalt($id) {
			$sql	=	"UPDATE
							$this->table
						SET
							salt = :salt
						WHERE
							id = :id";
			$stmt	= $this->con->prepare($sql);
			$salt 	= md5($id . '_' . time());
			$this->setSalt($salt);
			$stmt->bindParam('salt', $salt);
			$stmt->bindParam('id', $id);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function login($data) {
			if (empty($data->email)		or
				empty($data->password)) {
				
				$ret['status'] 	= 'error';
				$ret['code']	= '100';
				return json_encode($ret);

			} else {
				$res 	= $this->auth($data->email, $data->password);
				$result = json_decode($res);

				if ($result->status == 'ok') {
					$this->updateSalt($result->data->id);
					$result->data->salt 	= $this->getSalt();
					return json_encode($result);
				} else {
					$ret['status'] 	= 'error';
					$ret['code']	= '104';
					return $res;
				}


			}
		}

		public function add($data) {
			if (empty($data->name)		or
				empty($data->email)		or
				empty($data->password)	or
				empty($data->cpassword)) {

				$ret['status'] 	= 'error';
				$ret['code']	= '100';
				return json_encode($ret);

			} elseif ($data->password != $data->cpassword) {
				$ret['status'] 	= 'error';
				$ret['code']	= '101';
				return json_encode($ret);

			} else {

				$this->email 	= htmlspecialchars(strip_tags($data->email));
				$this->password = htmlspecialchars(strip_tags($data->password));
				$this->name 	= htmlspecialchars(strip_tags($data->name));

				if ($this->exists($this->email)) {
					$ret['status']	= 'error';
					$ret['code']	= '102';
					return json_encode($ret);
				} else {

					$sql	= 	"INSERT INTO
									$this->table
								(
									email, password, name
								)
								VALUES
								(
									:email, :password, :name
								)";

					$stmt	= $this->con->prepare($sql);
					$stmt->bindParam(':email', 		$this->email);
					$stmt->bindParam(':password',	$this->password);
					$stmt->bindParam(':name',		$this->name);

					if ($stmt->execute()) {
						$ret['status']	= 'ok';
						$ret['200']		= '200';
						return json_encode($ret);
					} else {
						$ret['status']	= 'error';
						$ret['code']	= '103';
						return json_encode($ret);
					}

				}

			}
		}

		public function sessionAuth($id, $salt) {
			$sql	=	"SELECT
							COUNT(*) AS num
						FROM
							$this->table
						WHERE
							id = :id
							AND
							salt = :salt";
			$stmt	= $this->con->prepare($sql);
			$stmt->bindParam('id', $id);
			$stmt->bindParam('salt', $salt);
			$stmt->execute();
			$row 	= (object) $stmt->fetch(PDO::FETCH_ASSOC);

			if ($row->num > 0) {
				return true;
			} else {
				return false;
			}

		}

	}

?>