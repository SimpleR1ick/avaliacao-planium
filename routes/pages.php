<?php 

use App\Http\Response;
use App\Controller\Pages;

// ROTA HOME
$obRouter->get('/', [
    function($request) {
        return new Response(200, Pages\Home::getHome($request));
    }
]);

// ROTA HOME
$obRouter->post('/', [
    function($request) {
        return new Response(200, Pages\Home::setDadosProposta($request));
    }
]);

// ROTA SOBRE
$obRouter->get('/sobre', [
    function() {
        return new Response(200, Pages\About::getAbout());
    }
]);
