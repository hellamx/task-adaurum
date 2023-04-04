<?php 

namespace app\controllers;

use app\models\Company;

class CompanyController extends AppController 
{

    public function indexAction()
    {
        if (isset($this->route['alias'])) {
            $id = fieldClear($this->route['alias']);
        } else {
            throw new \Exception("Страница не найдена", 404);
        }

        \cnotes\App::$app::set("cnote_id", $id);

        $data = \R::findOne("company", "WHERE id = ?", [$id]);

        if ($data) {

            $this->set($data);
            $this->setMeta($data->name . " | CompanyNotes", "CompanyNotes", "CompanyNotes");

            $notes = \R::findAll("notes", "WHERE company_id = ? ORDER BY id DESC", [$id]);
            \cnotes\App::$app::set("notes", $notes);

            if (isLogin()) $_SESSION['listenerCount'] = \R::count("notes", "user_id != ? AND company_id = ?", [$_SESSION['user']['id'], fieldClear($id)]);
        
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public function addAction()
    {
        if (!isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Добавлять компании могут только авторизованные пользователи</li>";
            location("/");
        endif;
        
        $this->setMeta("Добавление новой компании", "CompanyNotes", "CompanyNotes");

        if (!empty($_POST) and isAjax()) {
            $company = new Company();
            
            $company->load($_POST);
            $company->attributes['inn'] = intVal($company->attributes['inn']);

            if (!$company->attributes['inn']): 
                $company->errors[] = "Некорректный ИНН";
                echo $company->getErrors();
                die;
            endif;

            if (!$company->validate($company->attributes) || !$company->unique()) {
                echo $company->getErrors();
            } else {
                $company->save("company");
                if ($company) {
                    echo "<ul class='alertSuccess fade'>
                            <li>Компания успешно добавлена</li>
                          </ul>";
                }
            }
            die;
        }
    }

    public function deleteAction()
    {
        if (!isLogin()) {
            $_SESSION['alert'] = "<li class='alertError'>Доступно только для авторизованных пользователей</li>";
            location("/");
        }

        $id = (int)fieldClear($_GET['id']);
    
        if ($id) {
            if(\R::exec("DELETE FROM company WHERE id = ?", [$id])) {
                \R::exec("DELETE FROM notes WHERE company_id = ?", [$id]);
                $_SESSION['alert'] = "<li class='alertSuccess'>Компания удалена</li>";
                location("/");
            } else {
                throw new \Exception("Неизвестная ошибка", 404);
            }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public function listenerAction()
    {
        if (!isAjax()) throw new \Exception("Страница не найдена", 404);
        if (empty($_POST['company_id'])) throw new \Exception("Страница не найдена", 404);

        $company_id = fieldClear($_POST['company_id']);
        $response = [
            "isAdd" => false,
            "address" => false,
            "inn" => false,
            "director" => false,
            "content" => false,
            "phone" => false,
            "main" => false
        ];

        $check = \R::count("notes", "user_id != ? AND company_id = ?", [$_SESSION['user']['id'], $company_id]);

        if ($_SESSION['listenerCount'] < $check) {
            $response['isAdd'] = true;
            $_SESSION['listenerCount'] = $check;

            $data = \R::findOne("notes", "company_id = ? ORDER BY id DESC LIMIT 1", [$company_id]);

            $htmlToNote = "<div class='note__main wrapperDelete fade'>
                            <h3 class='note__main--title'>Примечание</h3>
                            <div class='note__main--wrap'>
                                <div class='note__desc'>
                                    <div class='note__main--info'>
                                        <p>Пользователь: <span>" . $data->user_name . "</span></p>
                                        <p>Дата: <span>". $data->date . "</span></p>
                                    </div>
                                    <div class='note__main--text'>
                                        <p>Текст примечания: <span>" . $data->text . "</span></p>
                                    </div>
                                    <a class='btnDelete viewDeleteBtn' data-delete='" . $data->id . "' href='#!'><img src='/icons/delete.svg' alt='Удалить'>Удалить</a>
                                </div>
                            </div>
                        </div>";
            $htmlToMain = "<div class='comments__wrapper wrapperDelete'>
                            <span class='comments__wrapper--title'>Комментарий</span>
                            <div class='comments__main'>
                                <div class='comments__wrapper--info'>
                                    <p>Дата: <span>". $data->date . "</span></p>
                                    <p>Пользователь: <span>" . $data->user_name . "</span></p>
                                </div>
                                <div class='comments__wrapper--text'>
                                    <p>Текст примечания: <span>" . $data->text . "</span></p>
                                </div>
                                <a class='viewDeleteBtn' data-delete='" . $data->id . "' href='#!'><img src='/icons/delete.svg' alt='Удалить'>Удалить</a>
                            </div>
                        </div>";

            foreach ($response as $k => $v) {
                if ($k == $data['field'] && $k != "main"): $response[$k] = $htmlToNote;
                elseif($k == $data['field']): $response[$k] = $htmlToMain;
                endif;
            }
        }

        $json = json_encode($response);
        echo $json;
        
        die;
    }
}

?>