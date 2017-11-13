<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/config.php';
require 'src/database.php';
require 'src/users.php';

session_start();

$app 	= new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$app->get('/user/{id}/{salt}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $salt = $request->getAttribute('salt');

    var_dump($id . ' ' . $salt);

    return $response;
});

$app->post('/login', function (Request $request, Response $response) {

	$config = new Config();
	$goto 	= $config->link();

	$data 	= (object) $request->getParsedBody();

	$db 	= new database();
	$db 	= $db->connect();
	$user 	= new User($db);
	$result	= json_decode($user->login($data));

	if ($result->status == 'error') {
		$goto	= $config->link('login', $result->code);
	} elseif ($result->status == 'ok') {
    	$_SESSION['userId'] 	= $result->data->id;
    	$_SESSION['userSalt']	= $result->data->salt;
		$goto	= $config->link('login', $result->code);
	}

	return $response->withHeader('location', $goto);

});

$app->post('/register', function(Request $request, Response $response) {

	$config = new Config();
	$goto 	= $config->link();

	$data 	= (object) $request->getParsedBody();

	$db 	= new database();
	$db 	= $db->connect();
	$user 	= new User($db);
	$result	= json_decode($user->add($data));

	if ($result->status == 'error') {
		$goto	= $config->link('register', $result->code);
	} elseif ($result->status == 'ok') {
		$goto	= $config->link('login', $result->code);
	}

	return $response->withHeader('location', $goto);

});

$app->post('/new', function(Request $request, Response $response) {

	$config = new Config();
	$goto	= $config->link();

	$data 	= (object) $request->getParsedBody();

	$db 	= new database();
	$db 	= $db->connect();

	var_dump($data);

	return $response;

});

$app->run();
?>