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

    public function render($name = null)
    {
        extract($this->data);
        if (!$name) {
            $name = $this->view;
        }
        require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "{$name}.php";
    }

    public function css($name)
    {
        $links = null;
        if (is_array($name)) {
            foreach ($name as $css) {
                $links .= "<link rel='stylesheet' href='/public/css/{$css}.css'>\n";
            }
        } else {
            $links = "<link rel='stylesheet' href='/public/css/{$name}.css'>";
        }

        return $links;
    }

    public function script($name)
    {
        $links = null;
        if (is_array($name)) {
            foreach ($name as $css) {
                $links .= "<script src='/public/js/{$css}.js'></script>\n";
            }
        } else {
            $links = "<script src='/public/js/{$name}.js'></script>";
        }

        return $links;
    }
}