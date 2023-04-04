<?php
namespace cnotes\base;

use cnotes\Db;

class Model 
{
    public $attributes = [];
    public $errors = [];
    public $db;

    public function __construct()
    {
        $this->db = Db::instance();
    }

    public function load($data)
    {
        foreach($this->attributes as $k => $v) {
            if (isset($data[$k])) {
                $this->attributes[$k] = fieldClear($data[$k]);
            }
        }
    }

    public function save($tableName, $lastId = false)
    {
        $table = \R::dispense($tableName);
        foreach($this->attributes as $k => $v) {
            $table->$k = $v;
        }
        if($lastId) return [\R::store($table), $table->id];
        return \R::store($table);
    }

    public function getErrors()
    {
        $errors = "<ul class='alertError fade'>";
        foreach ($this->errors as $k => $v) {
            $errors .= "<li>" . $v . "</li>";
        }
        $errors .= "</ul>";
        return $errors;
    }

}

?>