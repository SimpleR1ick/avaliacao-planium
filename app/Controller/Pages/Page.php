<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page {

    /**
     * Méthodo responsavel por rendenizar o topo da pagina
     * @return string
     */
    private static function getHeader() {
        return View::render('pages/header');
    }

    /**
     * Méthodo responsavel por rendenizar o rodape da pagina
     * @return string
     */
    private static function getFooter() {
        return View::render('pages/footer');
    }

    /**
     * Metodo responsavel por retornar o contéudo (view) da pagina generica
     * 
     * @return string 
     */
    public static function getPage($title, $content) {
        
        return View::render('pages/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}