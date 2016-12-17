<?php
use Hello\Provider;
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

$app->register(new \Hello\Provider\HelloServiceProvider(), array(
    'hello.default_name' => 'Igor',
));

$app->register(new Silex\Provider\MonologServiceProvider(), array(
   // 'monolog.logfile' => __DIR__.'/../log/development.log',
    'monolog.level' => Logger::ERROR
));

//Ejemplo de extension de monolog para formateo especifico
$app->extend('monolog', function($monolog, $app) {
	// the default date format is "Y-m-d H:i:s"
	$dateFormat = "Y n j, g:i a";
	// the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
	$output = "%datetime% > %level_name% > %message% %context% %extra%\n";
	// finally, create a formatter
	$formatter = new LineFormatter($output, $dateFormat);

	// Create a handler
	$stream = new StreamHandler(__DIR__.'/../log/development.log', Logger::DEBUG);
	$stream->setFormatter($formatter);
	// bind it to a logger object
	$monolog = new Logger('security');
    $monolog->pushHandler($stream);

    return $monolog;
});

$app['database.dsn'] = 'sqlite:'.__DIR__.'/../data/database.sqlite';

$app['pdo'] = function($app) {
    return new PDO($app['database.dsn']);
};
