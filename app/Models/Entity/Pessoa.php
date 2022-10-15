<?php

namespace App\Models\Entity;

class Pessoa {
    
    /**
     * Nome da pessoa
     * @var string
     */
    public $nome;

    /**
     * Idade da pessoa
     * @var integer
     */
    public $idade;

    public function __construct($nome, $idade) {
        $this->nome  = $nome;
        $this->idade = $idade;
    }
}