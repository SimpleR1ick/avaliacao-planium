<?php

namespace App\Models\Entity;

class Planos {
    /**
     * Methodo responsavel por retornar os dados dos planos
     * @return mixed
     */
    public static function getPlanos() {
        $planosFile = getenv('DIR').'plans.json';

        // VERIFICA A EXISTENCIA DO ARQUIVO
        if (!file_exists($planosFile)) {
            return false;
        }
        // OBTEM O CONTEUDO DO ARQUIVO
        $content = file_get_contents($planosFile);

        // RETORNA UM ARRAY COM OS DADOS
        return json_decode($content, true);
    }

    /**
     * Methodo responsavel por retornar os registros dos planos
     * @return array
     */
    public static function getRegistrosPlanos() {
        // DECLARAÇÃO DE VARIAVEL
        $registros = [];

        // OBTEM TODOS OS PLANOS
        $planos = self::getPlanos();

        // PERCORRE OS PLANOS E OBTEM OS REGISTROS DE CADA
        foreach ($planos as $plano) {
            $registros[] = $plano['registro'];
        }
        // RETORNA OS REGISTROS DOS PLANOS
        return $registros;
    }

    /** Methodo responsavel por verificar se um plano existe */
    public static function getPlanoExiste($planos, $plano) {
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

    