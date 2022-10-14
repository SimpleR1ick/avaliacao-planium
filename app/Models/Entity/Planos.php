<?php

namespace App\Models\Entity;


class Planos extends Json {
  
    /**
     * Methodo responsavel por retornar os registros dos planos
     * @return array
     */
    public static function getPlansRegisters() {
        // DECLARAÇÃO DE VARIAVEL
        $registros = [];

        // OBTEM TODOS OS PLANOS
        $planos = parent::getCotentent('plans');

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

    