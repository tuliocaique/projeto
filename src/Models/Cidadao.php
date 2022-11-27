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