<?php

require __DIR__ . '/../vendor/autoload.php';


use ComposerIncludeFiles\SimpleCurrencyProvider;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\Dotenv\Dotenv;

$request = Request::createFromGlobals();

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../var',
]);

/*
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');
*/

$rateProvider = $request->query->get('rate_provider');
if ($rateProvider) {
    try {
        // be great show factory pattern here because possible
        // different instantiation classes for other rate providers
        // now it is simple
        switch ($rateProvider) {
            case 'eu':
                $currency = new SimpleCurrencyProvider('https://api.exchangeratesapi.io/latest');
                break;
            case 'us':
                $currency = new SimpleCurrencyProvider('http://data.fixer.io/api/latest?access_key=' . $_ENV['FIXER_TOKEN']);
                break;
            default:
                throw new Exception("Broken Provider", 500);
        }

        $currency->setCurrencyFromProvider();
        header('Content-Type: application/json');
        echo json_encode($currency->getCurrency());
    } catch (Exception $exception) {
        echo $exception->getMessage();
        exit();
    }


} else {
    echo $twig->render('index.html.twig');
}
