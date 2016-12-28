<?php
use Hello\Provider;
use Symfony\Component\Translation\Loader\YamlFileLoader;

//Registramos el component translator
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

//Registramos traducciones mediante el componente extra YAML
$app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', '../locales/en.yml', 'en');
    $translator->addResource('yaml', '../locales/de.yml', 'de');
    $translator->addResource('yaml', '../locales/fr.yml', 'fr');
    //Tambien se podria hacer con XLIFF
    //$translator->addResource('xliff', __DIR__.'/locales/en.xlf', 'en');

    return $translator;
});

$app->register(new \Hello\Provider\HelloServiceProvider(), array(
    'hello.default_name' => 'Igor',
));

$app['database.dsn'] = 'sqlite:'.__DIR__.'/../data/database.sqlite';

$app['pdo'] = function($app) {
    return new PDO($app['database.dsn']);
};
