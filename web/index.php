<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

$app = new Silex\Application();
$app['debug'] = true;
require __DIR__.'/../app/services.php';

//Validator test, using DI
$app->get('/validate/{email}', function ($email) use ($app) {
    $errors = $app['validator']->validate($email, new Assert\Email());
    if (count($errors) > 0) {
        return (string) $errors;
    } else {
        return 'The email is valid';
    }
});

//Validator test2, without using DI
$app->get('/validator', function (Request $request) use ($app) {
    $name = $request->get('name');
    $validator = Validation::createValidator();
    $violations = $validator->validate($name, array(
    new Length(array('min' => 10)),
    new NotBlank(),
    ));

if (0 !== count($violations)) {
    // there are errors, now you can show them
    foreach ($violations as $violation) {
        return $violation->getMessage().'<br>';
    }
}
else{
    return "OK!";
}
});


//To controllers with no $app available
$app->get("/bar", "MyApp\\Controller\\BarController::indexAction");
$app->get("/bar/show/{id}", "MyApp\\Controller\\BarController::showAction");

//Scaling: to controller with $app available
//$app->get("/foo", "MyApp\\Controller\\FooController::indexAction");

//Scaling: to controller with $app available, and shortening url with
//"controller" function help
$app->get("/foo", controller("foo/index"));

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

function controller($shortName)
{
    list($shortClass, $shortMethod) = explode('/', $shortName, 2);

    return sprintf('MyApp\Controller\%sController::%sAction', ucfirst($shortClass), $shortMethod);
}

