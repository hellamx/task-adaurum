<?php 

namespace app\controllers;

use app\models\User;

class UserController extends AppController 
{
    public function indexAction()
    {
        if (!isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Доступно только для авторизованных пользователей</li>";
            location("/");
        endif;

        $this->setMeta("Аккаунт пользователя", "CompanyNotes", "CompanyNotes");
    }

    public function signupAction()
    {
        if (isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Вы уже авторизованы</li>";
            location("/");
        endif;

        $this->setMeta("Регистрация нового пользователя", "CompanyNotes", "CompanyNotes");

        if (!empty($_POST) and isAjax()) {
            $user = new User();
            $user->load($_POST);

            if (!$user->validate()) {
                echo $user->getErrors();
                die;
            }

            if (!$user->unique()) {
                echo $user->getErrors();
                die;    
            }

            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            $user->save("user");

            echo "<ul class='alertSuccess fade'>";
                    echo "<li>Успешно</li>";
            echo "</ul>";

            die;
        }
    
    }

    public function loginAction()
    {
        if (isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Вы уже авторизованы</li>";
            location("/");
        endif;

        $this->setMeta("Авторизация пользователя", "CompanyNotes", "CompanyNotes");

        if (!empty($_POST) and isAjax()) {
            $user = new User();

            $login = fieldClear($_POST['login']);
            $password = fieldClear($_POST['password']);
            $response = '';

            if (mb_strlen($login) < 4) $user->errors[] = "Логин должен быть не менее 4 символов";
            if (mb_strlen($password) < 6) $user->errors[] = "Пароль должен быть не менее 6 символов";

            if (!empty($user->errors)) {
                $response = $user->getErrors();
                $json = json_encode([$response, false]);
                echo $json;
                die;
            }

            $userdata = \R::findOne("user", "WHERE login = ?", [$login]);
            
            if ($userdata) {
                
                if (password_verify($password, $userdata->password)) {
                    $response = "<ul class='alertSuccess fade'>";
                        $response .= "<li>Успешно <br>Вы будете перенаправлены через 3 сек.</li>";
                    $response .= "</ul>";

                    foreach($userdata as $k => $v) {
                        if($k != "password") {
                            $_SESSION['user'][$k] = $v;
                        }
                    }

                    $json = json_encode([$response, true]);
                    echo $json;
                } else {
                    $user->errors[] = "Неверный логин или пароль";
                    $response = $user->getErrors();

                    $json = json_encode([$response, false]);
                    echo $json;
                }

            } else {
                $user->errors[] = "Пользователь не найден";
                $response = $user->getErrors();
                
                $json = json_encode([$response, false]);
                echo $json;
                die;
            }

            die;
        }
    }

    public function resetAction()
    {
        if (isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Вы уже авторизованы</li>";
            location("/");
        endif;

        if (!empty($_POST) && isAjax()) {
            $user = new User();

            $login =  fieldClear($_POST['login']);

            if (mb_strlen($login) < 4) {
                $user->errors[] = "Логин должен быть не менее 4 символов";
                echo $user->getErrors();
                die;
            }
            
            $userdata = \R::findOne("user", "WHERE login = ?", [$login]);
            if ($userdata) {

                $timestamp = time() + 3600;
                $hash = hash("sha256", $userdata->password . rand(1, 1000));
                $user_id = $userdata->id;
                
                $link = PATH . "/user/auth?key=" . $hash;
                
                \R::exec("DELETE FROM password_reset WHERE user_id = ?", [$user_id]);
                $query = \R::exec("INSERT INTO password_reset (timestamp, hash, user_id) VALUES (?, ?, ?)", [$timestamp, $hash, $user_id]);

                if ($query) {
                    // отправка $link на почту
                    // ***********************
                    echo $link;

                    echo "<ul class='alertSuccess fade'>";
                        echo "<li>На ваш E-mail адрес отправлено письмо с ссылкой для сброса пароля<br>Ссылка действительна один час</li>";
                    echo "</ul>";
                } else { 
                    $user->errors[] = "Неизвестная ошибка";
                    echo $user->getErrors();
                    die;
                }
                
            } else {
                $user->errors[] = "Пользователь не найден";
                echo $user->getErrors();
                die;
            }

        } else {
            throw new \Exception("Страница не найдена", 404);
        }

        die;
    }

    public function authAction()
    {

        if (isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Вы уже авторизованы</li>";
            location("/");
        endif;

        if ($_POST && isAjax()) {
            $user = new User();

            // Смена пароля
            if (mb_strlen($_POST['password']) < 6) {
                $user->errors[] = "Пароль должен быть не менее 6 символов";
                echo $user->getErrors();
                die;
            }
            
            $password = fieldClear($_POST['password']);
            $user_id = $_SESSION['user_reset_id'];

            $new_password = password_hash($password, PASSWORD_DEFAULT);
            $query = \R::exec("UPDATE user SET password = ? WHERE id = ?", [$new_password, $user_id]);
                
            if ($query) {
                \R::exec("DELETE FROM password_reset WHERE user_id = ?", [$user_id]);
                echo "<ul class='alertSuccess fade'>";
                    echo "<li>Пароль успешно изменен</li>";
                echo "</ul>";
            }

            unset($_SESSION['user_id']);
            die;

        }

        if (isset($_GET['key']) && !isAjax()) {

            // Проверка ссылки-сброса пароля

            $key = fieldClear($_GET['key']);
            $db = \R::findOne('password_reset', "WHERE hash = ?", [$key]);
            
            if ($db && $db->timestamp > time()) {
                $this->setMeta("Изменение пароля |  CompanyNotes");
                $_SESSION['user_reset_id'] =  $db->user_id;

            } else {
                throw new \Exception("Страница не существует", 404);
            }

        } else {
            throw new \Exception("Страница не существует", 404);
        }
    }

    public function logoutAction()
    {
        User::logout();
        $_SESSION['alert'] = "<li class='alertSuccess'>Успешно</li>";
        location("/");
    }
}

?>