<?php

namespace Projeto;
class Request
{
    private $method;

    public function __construct($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function isGet()
    {
        return $this->method == 'GET';
    }

    public function isPost()
    {
        return $this->method == 'POST';
    }

    public function getQueryParams($key = null)
    {
        $params = explode('?', $_SERVER['REQUEST_URI']);
        if(!empty($params) && sizeof($params) > 1) {
            $params = $params[1];
            $params = explode('&', $params);
            $params = array_map(function ($item) {
                return explode('=', $item);
            }, $params);

            $query_params = [];
            foreach ($params as $param) {
                if(isset($param[0], $param[1])) {
                    $query_params[$param[0]] = $param[1];
                }
            }

            if ($key) {
                return isset($query_params[$key]) ? $query_params[$key] : null;
            }
            return $params;
        }
        return [];
    }

    public function getData($key = null)
    {
        if ($this->isPost()) {
            if ($key) {
                return isset($_POST[$key]) ? $_POST[$key] : null;
            }
            return $_POST;
        }
        return null;
    }

    public function redirectWith($key, $message, $route, $params = [])
    {
        Flash::flash($key, $message);
        return $this->redirect($route, $params);
    }

    public function redirect($route, $params = [])
    {
        return Router::routeByName($route, $params);
    }

}