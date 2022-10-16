<?php 

namespace App\Models\Entity;
use App\Utils\Json;

class Proposta {

    /**
     * Instancia de DadosProposta
     * @var DadosProposta
     */
    private $proposta = [];

    public static function setProposta($obDadosProposta) {
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
