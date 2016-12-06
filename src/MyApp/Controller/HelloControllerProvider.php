<?php
namespace MyApp\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class HelloControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            //return $app->redirect('/maria');
            $sql = 'SELECT * FROM people_to_spam';
		    $texto = '<br>';
		    foreach ($app['db']->query($sql) as $row) {
		    	$texto .= '-'.$row['email'].'<br>';
		    }
            return new Response($texto, 201);
        });

        $controllers->get('/maria', function (Application $app) {
        	return new Response("maria", 201);
        });	

        return $controllers;
    }
}