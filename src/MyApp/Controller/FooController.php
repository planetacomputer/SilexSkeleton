<?php
namespace MyApp\Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Symfony\Component\Validator\Constraints as Assert;

class FooController{
	//Controller with DI $app container available
	public function indexAction(Request $request, Application $app){
	    
    	$email = $request->get('email');
    	$errors = $app['validator']->validate($email, new Assert\Email());
	    if (count($errors) > 0) {
	        return (string) $errors;
	    } else {
	        return 'The email is valid';
	    }

        //return "Foo indexAction!";
    }

    public function showAction($id){
        return "Foo show: $id!";
    }

}