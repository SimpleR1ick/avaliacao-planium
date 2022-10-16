<?php

namespace App\Controller\Pages;

use App\Utils\Json;
use App\Utils\View;
use App\Models\Entity\Organization;
use App\Models\Entity\Plano as EntityPlano;
use App\Models\Entity\Proposta as EntityProposta;
use App\Models\Entity\DadosProposta as EntityDadosProposta;
use Exception;

class Home extends Page{

    /**
     * Metodo responsavel por retornar o contéudo (view) da pagina home
     * 
     * @return string 
     */
    public static function getHome($request){

        $obOrganization = new Organization;

        // VIEW DA HOME
        $content =  View::render('pages/home',[
            'name' => $obOrganization->name,
            'status' => self::getStatus($request)
        ]);

        // RETORNA A VIEW DA PAGINA
        return parent::getPage('Home', $content);
    }

    /**
     * Methodo responsavel por retornar a menagem de status
     * @param \App\Http\Request
     * @return string
     */
    private static function getStatus($request) {
        // DECLARAÇÃO DE VARIAVEL
        $msg = '';

        // QUERY PARAMS
        $queryParams = $request->getQueryParams();

        if (!isset($queryParams['status'])) return $msg;

        // MENSAGENS DE STATUS
        switch ($queryParams['status']) {
            case 'created':
                $msg = 'Proposta criada com sucesso!';
                break;

            case 'notexists':
                $erro = 'O plano não foi encontrado!';
                break;
        }
        // EXIBE A MENSAGEM DE ERRO
        if (!empty($erro)) {
            return Alert::getError($erro);
        }
        // EXIBE A MENSAGEM DE SUCESSO
        return Alert::getSucess($msg); 
    }

    /**
     * Methodo Responsavel por cadastrar os dados de uma proposta de plano
     * @param \App\Http\Request $request
     */
    public static function setDadosProposta($request) {
        // DECLARAÇÃO DE VARIAVEIS
        $plano = '';
        $pessoas = [];
        $dados = [];

        // OBTEM AS VARIAVEIS DO POST
        $postVars = $request->getPostVars();

        // VALIDA OS CAMPOS OBRIGATORIOS
        if (!isset($postVars['plano'])) {
            throw new Exception("O campo 'plano' e obrigatorio!", 400);
        }
        // OBTENDO O PLANO E REMOVENDO SUA CHAVE DO ARRAY
        $plano = $postVars['plano'];

        // BUSCA OS PLANOS
        $planos = EntityPlano::getPlansRegisters();

        // VERIFICA SE O PLANO EXISTE
        if (!EntityPlano::getIfPlanExists($planos, $plano)) {
            $request->getRouter()->redirect('/?status=notexists');
        } 
        // REMOVE A CHAVE PLANO DO ARRAY DO POST
        array_shift($postVars);

        // EXTRAI SOMENTE AS PESSOAS
        foreach ($postVars as $value) {
            $dados[] = $value; 
        }
        // UTILIZA OS DADOS EXTRAIDOS E SEPARA AS PESSOAS
        for ($i = 0; $i < count($postVars); $i+=2) {
            $pessoas[] = [
                'nome' => $dados[$i],
                'idade' => $dados[$i+1]
            ];
        }
        // NOVA INSTANCIA DE DADDOS PARA PROPOSTA
        $obDadosProposta = new EntityDadosProposta;

        // SETANDO OS ATRIBUTOS
        $obDadosProposta->registro = $plano;
        $obDadosProposta->quantidade = count($postVars)-2;
        $obDadosProposta->beneficiarios = $pessoas;

        Json::setContent('beneficiarios', $obDadosProposta);

        EntityProposta::setProposta($obDadosProposta);

        // REDIRECIONA O USUARIO
        $request->getRouter()->redirect('/?status=created');
    }
}