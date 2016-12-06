<?php

namespace MyApp\Controller;

require_once __DIR__.'/../../../vendor/autoload.php';
class BarController{

    public function indexAction(){
  /*  	$sql = 'SELECT * FROM people_to_spam';
	    $texto = '<br>';
	    foreach ($app['pdo']->query($sql) as $row) {
	    	$texto .= '-'.$row['email'].'<br>';
	    }
        */
$app = new Silex\Application();
        return "Bar indexAction!".$texto;
    }

    public function showAction($id){
        return "Bar show: $id!";
    }

}