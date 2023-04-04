<?php 

namespace app\models;

class Note extends AppModel 
{
    public $attributes = [
        "user_id" => "",
        "user_name" => "",
        "text" => "",
        "field" => "",
        "company_id" => ""
    ];

    public $fields = ["main", "address", "inn", "director", "content", "phone"];

    public function validate($field, $company_id)
    {
        if (mb_strlen($this->attributes['text']) < 4): $this->errors[] = "Сообщение должно содержать не менее 4 символов"; 
            return false;
        endif;

        if (!in_array($field, $this->fields)): $this->errors[] = "Некорректное поле field"; 
            return false;
        endif;

        $company = \R::findOne("company", "WHERE id = ?", [$company_id]);
        if (!$company): $this->errors[] = "Компания не найдена";
            return false;
        endif;

        return true;
    }

    public static function getField($company_id, $field) 
    {
        $data = \R::findAll("notes", "WHERE company_id = ? AND field = ? ORDER BY id DESC", [$company_id, $field]);
        if ($data) return $data;
        return false;
    }
}

?>