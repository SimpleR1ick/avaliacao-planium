<?php

namespace App\Models\Entity;

use App\Utils\Json;

class Plano {
  
    /**
     * Nome do registro do plano
     * @var string
     */
    public $registro;

    /**
     * Nome do plano
     * @var string
     */
    public $nome;

    /**
     * Codigo do plano
     * @var integer
     */
    public $codigo;

    /**
     * Methodo responsavel por retornar os registros dos planos
     * @return array
     */
    public static function getPlansRegisters() {
        // DECLARAÇÃO DE VARIAVEL
        $registros = [];

        // OBTEM TODOS OS PLANOS
        $planos = Json::getContent('plans');

        // PERCORRE OS PLANOS E OBTEM OS REGISTROS DE CADA
        foreach ($planos as $plano) {
            $registros[] = $plano['registro'];
        }
        // RETORNA OS REGISTROS DOS PLANOS
        return $registros;
    }

    /** Methodo responsavel por verificar se um plano existe */
    public static function getIfPlanExists($planos, $plano) {
        // DECLARAÇÃO DE VARIAVEL
        $existe = false;

        // VERIFICA SE O PLANO EXISTE
        foreach ($planos as $indice) {
            if ($indice == $plano) {
                $existe = true;
            }
        }
        // RETORNA O RESULTADO
        return $existe;
    }
}

    