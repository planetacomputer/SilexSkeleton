<?php
use Hello\Provider;

$app->register(new \Hello\Provider\HelloServiceProvider(), array(
    'hello.default_name' => 'Igor',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../data/database.sqlite',
    ),
));
