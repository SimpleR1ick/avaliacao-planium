<?php

namespace App\Utils;
use Exception;

class Json {
    
    /**
     * Methodo responsavel por obter o caminho de um arquivo json
     * @return string
     */
    private static function getFilePath($name) {
        return getenv('DIR').$name.'.json';
    }

    /**
     * Methodo responsavel por retornar os dados de um arquivo
     * @param string $name
     * @return array
     */
    public static function getContent($name) {
        // BUSCA O CAMINHO DO ARQUIVO
        $path = self::getFilePath($name);

        // VERIFICA A EXISTENCIA DO ARQUIVO
        if (!file_exists($path)) {
            throw new Exception("O arquivo ".$path." não existe!");
        }
        // OBTEM O CONTEUDO DO ARQUIVO
        $content = file_get_contents($path);

        // RETORNA UM ARRAY COM OS DADOS
        return json_decode($content, true);
    }

    /**
     * Methodo responsavel por escrever os dados em um arquivo
     * @param string $name
     */
    public static function setContent($name, $content) {
        // BUSCA O CAMINHO DO ARQUIVO
        $path = self::getFilePath($name);

        // VERIFICA A EXISTENCIA DO ARQUIVO
        if (!file_exists($path)) {
            throw new Exception("O arquivo ".$path." não existe!");
        }
        // RETORNA O OBJETO EM JSON
        $data = json_encode($content, JSON_PRETTY_PRINT);

        // ESCREVE OS DADOS DA PROPOSTA NO ARQUIVO
        file_put_contents($path, $data);
    }
}

    