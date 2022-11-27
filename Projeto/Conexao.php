<?php

namespace Projeto;

use Exception;
use PDO;

class Conexao
{

    private $conn;

    function __construct()
    {

        $database_config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'config/database.php';
        try {
            $this->conn = new PDO('mysql:host=' . $database_config['host'] . ';dbname=' . $database_config['database'], $database_config['user'], $database_config['password']);
        } catch (Exception $e) {
            echo 'ERROR CODE: ' . $e->getCode() . ' MESSAGE:: ' . $e->getMessage();
            die();
        }
    }

    function getConnection()
    {
        return $this->conn;
    }

}