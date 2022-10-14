<?php

namespace App\Controller\Api;

class Api {
    
    /**
     * Methodo responsavel retornar os detalhes da API
     * @param \App\Http\Request
     * @return array
     */
    public static function getDetails($request) {
        return [
            'nome'   => 'API - PLANIUM',
            'versao' => 'v1.0.0',
            'autor'  => 'Henrique Dalmagro',
        ];
    }
}