<?php

namespace App\Models\Entity;

class Preco {

    /**
     * Codigo do plano
     * @var integer
     */
    public $codigo;
    
    /**
     * Quantidade minima de pessoas
     * @var integer
     */
    public $minimo_vidas;

    /**
     * Preço da faixa 1
     * @var float
     */
    public $faixa1;

    /**
     * Preço da faixa 2
     * @var float
     */
    public $faixa2;

    /**
     * Preço da faixa 3
     * @var float
     */
    public $faixa3;
}