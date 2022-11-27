<?php

namespace Projeto;

use PDO;

class Model
{

    /**
     * @var \PDO
     */
    private static $conn;

    public function __construct()
    {
        Model::connect();
    }

    public static function connect()
    {
        if (Model::$conn == null) {
            Model::$conn = (new Conexao())->getConnection();
        }
    }

    /**
     * @param $id
     * @return Model|null
     */
    public static function get($id)
    {
        Model::connect();
        $class = get_called_class();
        $class_vars = get_class_vars($class);
        $fields = $class_vars['fields'];

        $prepare = Model::$conn->prepare("SELECT * FROM {$class_vars['table']} WHERE id = :id");
        $prepare->bindParam(':id', $id);
        $prepare->execute();
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $obj = new $class();
            foreach ($fields as $field) {
                $obj->$field = $result[$field];
            }
            return $obj;
        }
        return null;
    }

    /**
     * @return Model[]|null
     */
    public static function all()
    {
        return self::find();
    }

    public function delete()
    {
        if (isset($this->id)) {
            return Model::$conn->prepare("DELETE FROM {$this->table} WHERE id = :id")
                ->execute([':id' => $this->id]);
        }
        return false;
    }

    /**
     * @param string|null $where
     * @param array $values
     * @return Model[]|null
     */
    public static function find(string $where = null, array $values = [])
    {
        return self::findResult(get_called_class(), $where, $values);
    }

    private static function findResult($class, $where = null, array $values = [])
    {
        Model::connect();
        $class_vars = get_class_vars($class);
        $fields = $class_vars['fields'];

        if ($where != null && !empty($values)) {
            $prepare = Model::$conn->prepare("SELECT * FROM {$class_vars['table']} WHERE {$where}");
            foreach ($values as $key => $value) {
                $prepare->bindValue($key, $value);
            }
        } else {
            $prepare = Model::$conn->query("SELECT * FROM {$class_vars['table']}");
        }
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            $result = array_map(function ($item) use ($fields, $class) {
                $obj = new $class();
                foreach ($fields as $field) {
                    $obj->$field = $item[$field];
                }
                return $obj;
            }, $result);
            return $result;

        }

        return null;
    }

    /**
     * @param string|null $where
     * @param array $values
     * @return Model|null
     */
    public static function first(string $where = null, array $values = [])
    {
        $results = Model::findResult(get_called_class(), $where, $values);
        if ($results) {
            return $results[0];
        }
        return null;
    }

    public function save()
    {
        if (isset($this->id)) {
            return $this->update($this->id);
        } else {
            return $this->insert();
        }
    }

    /**
     * @return Model
     */
    public static function newEntity()
    {
        $class = get_called_class();
        $class_vars = get_class_vars($class);
        $fields = $class_vars['fields'];
        $obj = new $class();
        foreach ($fields as $field) {
            $obj->$field = null;
        }
        return $obj;
    }

    private function insert()
    {
        $class = get_called_class();
        $class_vars = get_class_vars($class);
        $fields = $class_vars['fields'];
        $values = null;
        $insert = null;

        foreach ($fields as $field) {
            if (isset($this->$field)) {
                if ($values != null) {
                    $values .= ", '{$this->$field}'";
                } else {
                    $values = "'{$this->$field}'";
                }
                $insert[] = $field;
            }
        }

        if ($values != null) {
            $insert = implode(',', $insert);
            $result = Model::$conn->prepare("INSERT INTO {$class_vars['table']} ({$insert}) VALUES ({$values})")->execute();
            if ($result) {
                $this->id = Model::$conn->lastInsertId();
                return true;
            }
        }
        return false;
    }

    private function update($id)
    {
        $class = get_called_class();
        $class_vars = get_class_vars($class);
        $fields = $class_vars['fields'];
        $update = [];

        foreach ($fields as $field) {
            $update[] = "{$field} = '{$this->$field}'";
        }

        if (!empty($update)) {
            $update = implode(',', $update);
            return Model::$conn->prepare("UPDATE {$class_vars['table']} SET {$update} WHERE id = {$id}")->execute();
        }

        return false;
    }

    public function query($string)
    {
        return Model::$conn->query($string)->execute();
    }
}