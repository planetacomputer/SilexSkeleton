<?php
use Hello\Provider;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


$app->register(new \Hello\Provider\HelloServiceProvider(), array(
    'hello.default_name' => 'Igor',
));

//Registramos Named Packages con ayuda del provider de Silex
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1',
    'assets.version_format' => '%s?version=%s',
    'assets.named_packages' => array(
        'css' => array('version' => 'css2', 'base_path' => '/css'),
        'images' => array('base_path' => '/img')
    )
));

/*Inyectamos un package de tipo EmptyVersionStrategy, 
	sin ayuda del AssetServiceProvider*/
$app['assetStaticPackage'] = function($app) {
    return new Package(new EmptyVersionStrategy());
};

$app['database.dsn'] = 'sqlite:'.__DIR__.'/../data/database.sqlite';

$app['pdo'] = function($app) {
    return new PDO($app['database.dsn']);
};
