<?php

use App\Http\Response; 
use App\Controller\Api;

// ROTA POST DA PORPOSTA
$obRouter->post('/api/v1/dados_proposta', [
    'middlewares' => [
        'api'
    ],
    function($request) {
        return new Response(200, Api\DadosProposta::setNewDadosProposta($request), 'application/json');
    }
]);