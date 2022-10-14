<?php

namespace App\Models\Entity;

class Precos {

    /**
     * Methodo responsavel por retornar os dados dos planos
     * @return mixed
     */
    public static function getPrecos() {
        $planosFile = getenv('DIR').'prices.json';

        // VERIFICA A EXISTENCIA DO ARQUIVO
        if (!file_exists($planosFile)) {
            return false;
        }
        // OBTEM O CONTEUDO DO ARQUIVO
        $content = file_get_contents($planosFile);

        // RETORNA UM ARRAY COM OS DADOS
        return json_decode($content, true);
    }
}