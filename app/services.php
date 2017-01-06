<?php
use Hello\Provider;

$app->register(new \Hello\Provider\HelloServiceProvider(), array(
    'hello.default_name' => 'Igor',
));

$app['database.dsn'] = 'sqlite:'.__DIR__.'/../data/database.sqlite';

$app['pdo'] = function($app) {
    return new PDO($app['database.dsn']);
};
//Registering Validator service
$app->register(new Silex\Provider\ValidatorServiceProvider());