<?php

namespace App\Controller\Api;

use Exception;
use App\Utils\Json;
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
        // POST VARS
        $plano   = $postVars['plano'];
        $pessoas = $postVars['beneficiarios'];

        // BUSCA OS PLANOS
        $planos = EntityPlano::getPlansRegisters();

        // VERIFICA SE O PLANO EXISTE
        if (!EntityPlano::getIfPlanExists($planos, $plano)) {
            throw new Exception("O plano ".$plano." não foi encontrado", 404);
        } 
        // NOVA INSTANCIA DE DADDOS PARA PROPOSTA
        $obDadosProposta = new EntityDadosProposta;

        // SETANDO OS ATRIBUTOS
        $obDadosProposta->registro = $plano;
        $obDadosProposta->quantidade = count($pessoas);
        $obDadosProposta->beneficiarios = $pessoas;

        // CADASTRANDO OS BENEFICIARIOS
        $obDadosProposta->cadastrar();

        // PASSANDO A UMA VARIAVEL O OBJETO DA PROPOSTA COMO ARRAY
        $proposta = (array)$obDadosProposta;

        // OBTENDO CONTEUDO DAS TABELAS PRECOS E PLANOS
        $precos = Json::getContent('prices');
        $planos = Json::getContent('plans');

        // DECLARAÇÃO DE VARIAVEIS
        $total = 0;
        $codigo = 0;
        $valores = [];
        $qtdVidas = $proposta['quantidade'];

        // BUSCA OS DADOS DO PLANO DO REGISTRO ESCOLHIDO
        foreach ($planos as $plano) {
            // VERIFICA SE O REGUSTRI ATUAL E IGUAL AO REGISTRO DO ESCOLHIDO
            if ($plano['registro'] == $proposta['registro']) { 
                $codigo = $plano['codigo'];
                break;
            }
        }
        // BUSCA OS VALORES DO PLANO NA TABELA DE PREÇOS
        foreach ($precos as $preco) {
            // VERIFICA O CODIGO ATUAL E IGUAL O CODIGO DO PLANO ESCOLHIDO
            if ($preco['codigo'] == $codigo && $preco['minimo_vidas'] <= $qtdVidas) {
                // EXTRAI AS FAIXAS DE PRECO
                $valores = [
                    'faixa1' => $preco['faixa1'],
                    'faixa2' => $preco['faixa2'],
                    'faixa3' => $preco['faixa3']
                ];
                break;
            }
        }
        // BUSA OS VALORES DOS PREÇOS E ADICIONA AOS USUARIOS
        foreach ($proposta['beneficiarios'] as $chave => $pessoa) {
            // VERFICA FAIXA 1
            if ($pessoa['idade'] <= 17) {
                $preco = $valores['faixa1']; 

            // VERIFICA FAIXA 2
            } else if ($pessoa['idade'] > 17 && $pessoa['idade'] < 40) {
                $preco = $valores['faixa2'];

            // VERIFICA FAIXA 3
            } else if ($pessoa['idade'] > 40) {
                $preco = $valores['faixa3'];
            }
            // ADICIONA A CADA PESSOA O VALOR DE ACORDO COM A IDADE
            $proposta['beneficiarios'][$chave]['preco'] = $preco;

            // SOMA AO TOTAL PREÇO DO BENEFICIARIO
            $total += $preco;
        }
        // ADCIONA A CHAVE COM O TOTAL DO PLANO
        $proposta['total'] = $total;
        
        // ARAMAZENA OS DADOS DA PROPOSTA
        Json::setContent('proposta', $proposta);

        return $proposta;
    }
}