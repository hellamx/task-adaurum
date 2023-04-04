<?php 

namespace app\controllers;

use app\models\Note;

class NoteController extends AppController
{
    public function addAction()
    {
        if (!isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Доступно только для авторизованных пользователей</li>";
            location("/");
        endif;

        if (!empty($_POST) && isAjax()) {

            $note = new Note();
            $note->load($_POST);

            $note->attributes['user_id'] = $_SESSION['user']['id'];
            $note->attributes['user_name'] = $_SESSION['user']['fullname'];

            if (!$note->validate($note->attributes['field'], $note->attributes['company_id'])) {
                $response = $note->getErrors();
                $json = json_encode([$response, false]);
                echo $json;
                die;
            }

            $db = $note->save("notes", true);

            $isMain = !empty($_POST['main']) ? fieldClear($_POST['main']) : false;
            if ($note && !$isMain) {
                $response = "<div style='display: none' class='note__main wrapperDelete fade'>
                    <h3 class='note__main--title'>Примечание</h3>
                    <div class='note__main--wrap'>
                        <div class='note__desc'>
                            <div class='note__main--info'>
                                <p>Пользователь: <span>" . $_SESSION['user']['fullname'] . "</span></p>
                                <p>Дата: <span>". date("Y-m-d h:m:s") . "</span></p>
                            </div>
                            <div class='note__main--text'>
                                <p>Текст примечания: <span>" . $note->attributes['text'] . "</span></p>
                            </div>
                            <a class='btnDelete viewDeleteBtn' data-delete='" . $db[1] . "' href='#!'><img src='/icons/delete.svg' alt='Удалить'>Удалить</a>
                        </div>
                    </div>
                </div>";
                
            } else {
                $response = "<div style='display: none' class='comments__wrapper wrapperDelete'>
                <span class='comments__wrapper--title'>Комментарий</span>
                <div class='comments__main'>
                    <div class='comments__wrapper--info'>
                        <p>Дата: <span>". date("Y-m-d h:m:s") . "</span></p>
                        <p>Пользователь: <span>" . $_SESSION['user']['fullname'] . "</span></p>
                    </div>
                    <div class='comments__wrapper--text'>
                        <p>Текст примечания: <span>" . $note->attributes['text'] . "</span></p>
                    </div>
                    <a class='viewDeleteBtn' data-delete='" . $db[1] . "' href='#!'><img src='/icons/delete.svg' alt='Удалить'>Удалить</a>
                </div>
            </div>";
            }
            
            $json = json_encode([$response, true]);
            echo $json;

        } else {
            throw new \Exception("Страница не найдена", 404);
        }

        die;
    }

    public function deleteAction()
    {
        if (!isLogin()):
            $_SESSION['alert'] = "<li class='alertError'>Доступно только для авторизованных пользователей</li>";
            location("/");
        endif;

        $id = fieldClear($_POST['id']);
        $delete = \R::exec("DELETE FROM notes WHERE id = ?", [$id]);

        if ($delete) {
            echo true;
        } else {
            echo 'Запись не найдена';
        }
        die;
    }
}

?>