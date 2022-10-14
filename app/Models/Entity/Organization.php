<?php
namespace App\Models\Entity;

class Organization{
    
    /**
     * ID da organização
     * @var integer
     */
    public $id = 1;

    /**
     * Nome da organização
     * @var string
     */
    public $name = 'Planium';

    /**
     * Site da organização
     * @var string
     */
    public $site = 'https://www.planium.io/wordpress/';

    /**
     * Descrição da organização
     * @var string
     */
    public $description = "Modernizamos o relacionamento das operadoras com seus clientes. Ofertas personalizadas em um processo intuitivo e completamente digital.";
}
