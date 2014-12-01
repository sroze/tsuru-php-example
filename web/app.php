<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\DoctrineServiceProvider;
use App\Controller\StatusController;

$app = new Silex\Application();
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_pgsql',
        'host'      => getenv('PG_HOST'),
        'dbname'    => getenv('PG_DATABASE'),
        'user'      => getenv('PG_USER'),
        'password'  => getenv('PG_PASSWORD'),
        'charset'   => 'utf8',
    ),
));

$app->get('/', function() {
    return new Response('PHP application is working successfully !');
});

$app->mount('/status', new StatusController());
$app->run();
