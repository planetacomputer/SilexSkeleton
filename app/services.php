<?php
use Hello\Provider;

$app->register(new \Hello\Provider\HelloServiceProvider(), array(
    'hello.default_name' => 'Igor',
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$app['swiftmailer.options'] = array(
    'host' => 'ssl://smtp.gmail.com',
    'port' => '465',
    'username' => '****',
    'password' => '****',
    'encryption' => null,
    'auth_mode' => null
);


$app['database.dsn'] = 'sqlite:'.__DIR__.'/../data/database.sqlite';

$app['pdo'] = function($app) {
    return new PDO($app['database.dsn']);
};
