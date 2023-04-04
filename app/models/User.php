<?php 

namespace app\models;

class User extends AppModel
{
    public $attributes = [
        "fullname" => "",
        "login" => "",
        "email" => "",
        "password" => "",
        "age" => "",
        "position" => ""
    ];

    public function unique()
    {
        $user = \R::findOne('user', 'WHERE login = ? OR email = ?', [$this->attributes['login'], $this->attributes['email']]);

        if ($user) {
            if($user->login == mb_strtolower($this->attributes['login'])) $this->errors[] = "Указанный логин уже занят";
            
            if($user->email == mb_strtolower($this->attributes['email'])) $this->errors[] = "E-mail уже используется";
            
            return false;
        }

        return true;
    }

    public function validate() {
        $err = false;
        $position = ["Разработчик", "Менеджер", "Бухгалтер", "Редактор"];

        if (mb_strlen($this->attributes['fullname']) < 6): 
            $this->errors[] = "ФИО должно содержать не менее 6 символов"; 
            $err = true;
        endif;

        if (mb_strlen($this->attributes['login']) < 4):
            $this->errors[] = "Логин должен содержать не менее 4 символов"; 
            $err = true;
        endif;

        if  (!preg_match("/[0-9a-z]+@[a-z]/", $this->attributes['email'])):
            $this->errors[] = "Некорректный e-mail"; 
            $err = true;
        endif;

        if (mb_strlen($this->attributes['password']) < 6):
            $this->errors[] = "Пароль должен содержать не менее 6 символов";
            $err = true;
        endif;

        if ($this->attributes['age'] < 18 || $this->attributes['age'] > 65):
            $this->errors[] = "Некорректный возраст";
            $err = true;
        endif;

        if (!in_array($this->attributes['position'], $position)):
            $this->errors[] = "Некорректная должность"; 
            $err = true;
        endif;

        if ($err) return false;
        
        return true;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }
}

?>