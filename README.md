Welcome to Silex Skeleton!
===================


Created as bare Silex 2.0 project, it will grow including new functionalities, mostly based on Dependency Injection.

----------

Tag 1.0
-------------
Bare **Silex** composer.json but including some capabilities as:

> **New:**

> - Creation of a dummy new HelloServiceProvider extending from ServiceProviderInterface.
> - SQLite Database connection as a service, but with no provider
> - An exemple of basic Controllers (BarController.php and FooController.php) without no user of providers
> - Use of the ControllerProviderInterface to mounts several groups of routes

Branch 2
-------------
Doctrine2 is a ORM and it uses its own database abstraction layer called DBAL. In fact DBAL isn’t a pure database abstraction layer. It’s built over PDO. It’s a set of PHP classes we can use that gives us features not available with ‘pure’ PDO. If we use Doctrine2 we’re using DBAL behind the scene, but we don’t need to use Doctrine2 to use DBAL. We can use DBAL as a database abstraction layer without any ORM. Obiously this extra PHP layer over our PDO extension needs to pay a fee.

> **New:**

> - **DoctrineServiceProvider for DBAL** (not Doctrine, because Doctrine ORM integration is not supplied in Silex) used in HelloControllerProvider.

Branch 3
-------------
The **MonologServiceProvider** provides a default logging mechanism through Jordi Boggiano's Monolog library. It will log requests and errors and allow you to add logging to your application. This allows you to debug and monitor the behaviour, even in production.
Extension for custom lineformatting as you can configure Monolog (like adding or changing the handlers) before using it by extending the monolog service.

Branch 4
-------------
The **Asset component** manages URL generation and versioning of web assets such as CSS stylesheets, JavaScript files and image files. The AssetServiceProvider provides a way to manage URL generation and versioning of web assets such as CSS stylesheets, JavaScript files and image files. Named packages are registered in container and also a EmptyVersionStrategy Package as exemple of injection without need of provider. These objects can be called from anywhere where container $app is available. With Symfony Twig Bridge also available in Twig templates.

Branch 5
-------------
The **TranslationServiceProvider** provides a service for translating your application into different languages.
Having your translations in PHP files can be inconvenient. This recipe will show you how to load translations from external YAML files.

composer require symfony/translation
composer require symfony/config symfony/yaml

Branch 6
-------------
The **SwiftmailerServiceProvider** provides a service for sending email through the Swift Mailer library.

You can use the mailer service to send messages easily. By default, it will attempt to send emails through SMTP.

composer require swiftmailer/swiftmailer

Most used commands
-------------
> - php56 -S localhost:8888 -t web/
> - git checkout -b 4
> - git push origin 4