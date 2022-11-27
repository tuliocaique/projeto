<?php

namespace App\Models;

use Projeto\Model;

/**
 * @property $nome
 * @property $id
 * @property $nis
 */
class Cidadao extends Model
{

    public $table = 'cidadao';
    /* Esse array possui os campos da tabela do banco de dados, toda a consulta e execuções no banco de dados
    é realizado pela classe Model, essa classe é responsável por transformar os valores desse array em atributos dinamicamente  */
    public $fields = [
        'id',
        'nome',
        'nis',
    ];

    public function __construct()
    {
        parent::__construct();
        parent::query(
            "CREATE TABLE IF NOT EXISTS cidadao (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(150) NOT NULL,
                nis VARCHAR(11) NOT NULL UNIQUE
            )"
        );
    }

}