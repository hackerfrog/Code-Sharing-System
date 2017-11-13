<?php
	
	class Config {

		private $domain		= "http://localhost/Code-Sharing-System/";
		private $index		= "index.php";
		private $login		= "login.php";
		private $register	= "register.php";
		private $explore	= "explore.php";
		private $new		= "new.php";

		private $code;

		public function link($to = '/', $code = 0) {
			if ($code) {
				$code 	= '?code=' . $code;
			} else {
				$code 	= '';
			}

			switch ($to) {
				case '/':
					return $this->domain . $code;
					break;
				case 'index':
					return $this->domain . $this->index . $code;
					break;
				case 'login':
					return $this->domain . $this->login . $code;
					break;
				case 'register':
					return $this->domain . $this->register . $code;
					break;
				case 'explore':
					return $this->domain . $this->explore . $code;
					break;
				case 'new':
					return $this->domain . $this->new . $code;
			}
		}

		function __construct() {
			$this->code['100']	= 'All fields are mandatory.';
			$this->code['101']	= 'Password don\'t match.';
			$this->code['102']	= 'Your Email address is alredy in use.';
			$this->code['103']	= 'Unable to register user.';
			$this->code['104']	= 'Wrong email or password.';

			$this->code['200']	= 'You have been registered.';
			$this->code['201']  = 'Your code is published.';
		}

		public function getError($code) {
			return $this->code[$code];
		}

		public function codeExpand($get) {
			if (isset($get['code'])) {
				if ($get['code'] >= 100 and $get['code'] < 200) {
					// ERROR (100 - 199)
					return '<span class="error">' . $this->getError($get['code']) . '</span>';
				} elseif ($get['code'] >= 200 and $get['code'] < 300) {
					// STATUS OK (200 - 299)
					return '<span class="success">' . $this->getError($get['code']) . '</span>';
				} elseif ($get['code'] >= 300 and $get['code'] < 400) {
					// WARNINGS (300 - 399)
					return '<span class="warning">' . $this->getError($get['code']) . '</span>';
				}
			}
		}

		public function checkSession($session) {
			if (isset($session['userId']) and isset($session['userSalt'])) {

				include_once 'users.php';
				include_once 'database.php';

				$db 	= new database();
				$db 	= $db->connect();
				$user 	= new User($db);

				return $user->sessionAuth($session['userId'], $session['userSalt']);
			}
		}

	}

?>