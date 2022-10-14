<?php
require __DIR__.'/../vendor/autoload.php';

use App\Utils\Environment;
use App\Http\Middleware\Queue as MiddlewareQueue;

// CARREGA VARIAVEIS DE AMBIENTE
Environment::load(__DIR__.'/../');

// DEFINE A CONSTANTE DE URL DO PROJETO
define('URL', getenv('URL'));

// DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setMap([
    'maintenence'          => \App\Http\Middleware\Maintenence::class,
    'api'                  => \App\Http\Middleware\Api::class,
    'cache'                => \App\Http\Middleware\Cache::class,
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES EM TODAS AS ROTAS
MiddlewareQueue::setDefault([
    'maintenence'
]);