<?php

namespace App\Models\Entity;

class DadosProposta {

    /**
     * Codigo do plano
     * @var string
     */
    public $plano;

    /**
     * Registro do plano
     * @var int
     */
    public $quantidade;

    /**
     * Nome do plano
     * @var array
     */
    public $beneficiarios;

    /**
     * Methodo responsavel por salvar os dados da proposta
     */
    public function cadastrar() {
        // OBTEM O CAMINHO DO ARQUIVO
        $file = getenv('DIR').'beneficiarios.json';

        // CONTEUDO DO ARQUIVO
        $content = [
            'plano' => $this->plano,
            'quantidade' => $this->quantidade,
            'beneficiarios' => $this->beneficiarios
        ];
        // RETORNA O OBJETO EM JSON
        $data = json_encode($content, JSON_PRETTY_PRINT);

        // ESCREVE OS DADOS DA PROPOSTA NO ARQUIVO
        file_put_contents($file, $data);
    }
}