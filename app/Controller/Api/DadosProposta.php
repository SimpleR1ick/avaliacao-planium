<?php

namespace App\Controller\Api;

use Exception;
use App\Models\Entity\Plano as EntityPlano;
use App\Models\Entity\DadosProposta as EntityDadosProposta;


class DadosProposta extends Api {

    /**
     * Methodo Responsavel por cadastrar os dados de uma proposta de plano
     * @param \App\Http\Request $request
     */
    public static function setNewDadosProposta($request) {
        // OBTENDO AS VARIAVEIS DO POST
        $postVars = $request->getPostVars();

        // VALIDA OS CAMPOS OBRIGATORIOS
        if (!isset($postVars['plano']) and !isset($postVars['beneficiarios'])) {
            throw new Exception("Os campos 'plano' e 'beneficiarios' são obrigatorios", 400);
        }
        // BUSCA OS PLANOS
        $planos = EntityPlano::getPlansRegisters();

        // POST VARS
        $plano   = $postVars['plano'];
        $pessoas = $postVars['beneficiarios'];

        // VERIFICA SE O PLANO EXISTE
        if (!EntityPlano::getIfPlanExists($planos, $plano)) {
            throw new Exception("O plano ".$plano." não foi encontrado", 404);
        } 
        // NOVA INSTANCIA DE DADDOS PARA PROPOSTA
        $obDadosProposta = new EntityDadosProposta;

        // SETANDO OS ATRIBUTOS
        $obDadosProposta->plano = $plano;
        $obDadosProposta->quantidade = count($pessoas);
        $obDadosProposta->beneficiarios = $pessoas;

        // CADASTRANDO OS BENEFICIARIOS
        $obDadosProposta->cadastrar();
    }
}