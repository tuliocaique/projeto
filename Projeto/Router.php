<?php

namespace Projeto;
class Router
{

    private static $Router = null;
    private $rotas = [];

    protected function __construct()
    {
        /* Retornando o array contendo as rotas do projeto */
        $rotas_raw = require '..' . DIRECTORY_SEPARATOR . 'config/rotas.php';
        $rotas = [];

        /* Percorrendo cada rota definida para organização do array de rotas */
        foreach ($rotas_raw as $key => $value) {
            /* Quebrando o nome da rota em um array */
            $key_explode = explode('/', $key);
            /* Deletando a primeira posição do array, pois ela é vazia */
            unset($key_explode[0]);

            $url = [];
            $params = [];
            /* Percorrendo cada parte da rota por exemplo /usuario/deletar/:id */
            foreach ($key_explode as $pos => $explode) {
                /* Verificando se a parte da rota não é um parametro */
                if (substr($explode, 0, 1) != ":") {
                    /* Adicionando a parte da rota ao array de url */
                    $url[] = $explode;
                } else {
                    /* Adicionando o regex do parametro da rota */
                    $url[] = "([a-zA-Z0-9]+)";
                    /* Adicionando a parte da rota ao array de parametros */
                    $params[$pos] = $explode;
                }
            }

            /* Adicionando a rota ao array de rotas de forma organizada */
            $rotas[] = [
                /* Controller que será instanciado ao acessar essa rota */
                'controller'   => $value['controller'],
                /* Método que será chamado ao acessar essa rota */
                'action'       => $value['action'],
                /* Url completa da rota. Ex: /usuario/deletar/([a-zA-Z0-9]+) */
                'url_complete' => "/" . implode("/", $url),
                /* Array de url */
                'url'          => $url,
                /* Array de parametros */
                'params'       => $params,
                'name'         => $value['name']
            ];
        }

        $this->rotas = $rotas;
    }

    public static function routeByName($route_name, $params = [])
    {
        if (self::$Router == null) {
            self::$Router = new Router();
        }
        $Router = self::$Router;
        foreach ($Router->rotas as $rota) {
            if ($rota['name'] == $route_name) {

                if (!empty($params)) {
                    $i = 0;
                    foreach ($rota['params'] as $key => $value) {
                        $rota['url'][$key - 1] = $params[$i++];
                    }

                    return implode('/', $rota['url']);
                }

                return $rota['url_complete'];
            }
        }
        return null;
    }

    protected static function callController($REQUEST_URI)
    {
        if (self::$Router == null) {
            self::$Router = new Router();
        }
        $Router = self::$Router;

        /* Pegando a url atual */
        $REDIRECT_URL = $_SERVER['REDIRECT_URL'];
        /* Quebrando a url atual em um array */
        $URL_SPLIT = explode('/', $REDIRECT_URL);
        /* Deletando a primeira posição do array, pois ela é vazia */
        unset($URL_SPLIT[0]);

        /* Verificando se a url atual é uma rota definida */
        foreach ($Router->rotas as $key => $value) {
            /* Quantidade de partes definidas na rota */
            $count_url = count($value['url']);
            /* Quantidade de parametros definidas na rota */
            $count_params = count($value['params']);
            /* Verifica se a rota digitada é igual a rota definida */
            if (preg_match("%{$value['url_complete']}%", $REDIRECT_URL, $matches) && $count_url == count($URL_SPLIT)) {
                /* Instanciando o controller */
                $controller = new $value['controller'];
                $action = $value['action'];
                $params = [];
                foreach ($value['params'] as $pos => $param) {
                    $params[] = $URL_SPLIT[$pos];
                }
                /* Chamando o método do controller */
                /** @var View|string $view */
                $view = $controller->$action(new Request($_SERVER['REQUEST_METHOD']), ...$params);
                if (isset($view) && $view instanceof View) {
                    $view->render();
                    return true;
                } else if (isset($view)) {
                    header("Location: {$view}");
                    return true;
                }
            }
        }

        return false;
    }
}
