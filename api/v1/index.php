<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'src/database.php';

$app = new \Slim\App;

$app->get('/user/{id}/{salt}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $salt = $request->getAttribute('salt');

    var_dump($id . ' ' . $salt);

    return $response;
});

$app->post('/login', function (Request $request, Response $response) {
	var_dump($request->getParsedBody());
});

$app->post('/register', function(Request $request, Response $response) {
	$data = (object) $request->getParsedBody();
	var_dump($data);
});

$app->run();
?>