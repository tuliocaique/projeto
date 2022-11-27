<?php

namespace Projeto;

class Controller
{
    public function view($view, $data = [])
    {
        return new View($view, $data);
    }
}