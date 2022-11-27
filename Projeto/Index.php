<?php

namespace Projeto;
/* Iniciando o autoload do composer */
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

class Index extends Router
{

    public function __construct()
    {
        parent::__construct();
        if (!Router::callController($_SERVER['REQUEST_URI'])) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "404.php";
        }
    }

}

new Index();
