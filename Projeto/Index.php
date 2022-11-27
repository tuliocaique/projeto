<?php

namespace Projeto;
/* Iniciando o autoload do composer */
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

class Index extends Router
{

    public function __construct()
    {
        parent::__construct();
        if (preg_match('%^/public/(.*)%', $_SERVER['REQUEST_URI'])) {
            $folder = explode('/', $_SERVER['REQUEST_URI']);
            $path = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . implode(DIRECTORY_SEPARATOR, $folder);
            if (file_exists($path)) {
                echo file_get_contents($path);
            } else {
                require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "404.php";
            }
        } else if (!Router::callController($_SERVER['REQUEST_URI'])) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "404.php";
        }
    }

}

new Index();
