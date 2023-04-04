<?php 

namespace app\models;

class Company extends AppModel
{
    public $attributes = [
        "name" => "",
        "inn" => "",
        "content" => "",
        "director" => "",
        "address" => "",
        "phone" => ""
    ];

    public function validate($data)
    {
        $response = true;
        foreach($data as $k => $v) {
            if (mb_strlen($data[$k]) < 3) $response = false; 
        }

        if (!$response) $this->errors[] = "Заполните все поля (Не менее 3 символов)"; 
        return $response;
    }

    public function unique()
    {
        $company = \R::findOne('company', 'WHERE name = ?', [$this->attributes['name']]);

        if ($company) {
            $this->errors[] = "Такая компания уже существует";
            return false;
        }

        return true;
    }
}

?>