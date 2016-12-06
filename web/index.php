<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;
require __DIR__.'/../app/services.php';

//To controllers with no $app available
$app->get("/bar", "MyApp\\Controller\\BarController::indexAction");
$app->get("/bar/show/{id}", "MyApp\\Controller\\BarController::showAction");


$blogPosts = array(
    1 => array(
        'date'   => '2011-03-29',
        'author' => 'igorw',
        'title'  => 'Using Silex',
        'body'   => '...',
    ),
);

//Anonymous controller
$app->get('/blog', function () use ($blogPosts) {
	return new Response('Gracias por tus comentarios', 201);
});

//Anonymous controller
$app->get('/hello', function (Request $request) use ($app) {
    $name = $request->get('name');
    return $app['hello']($name);
});

//To a ControllerProvider with a specific path
$app->mount('/path', new MyApp\Controller\HelloControllerProvider());

//To a ControllerProvider with root path
$app->mount('/', new MyApp\Controller\HelloControllerProvider());


$app->run();

