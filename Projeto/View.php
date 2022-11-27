<?php

namespace Projeto;
class View
{

    private $view;
    private $data;

    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render()
    {
        extract($this->data);
        require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "{$this->view}.php";
    }

}