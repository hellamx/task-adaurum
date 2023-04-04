<?php

namespace app\controllers;

class SearchController extends AppController 
{
    public function indexAction()
    {
        $this->setMeta("Результаты поиска");
        if (!empty(fieldClear($_GET['s'])) && isset($_GET['s'])) {
            $query = fieldClear($_GET['s']);
        } else {
            $query = null;
        }

        $userQuery = fieldClear($_GET['s']);
        if($query) {
            $company = \R::find('company', "name LIKE ?", ["%{$query}%"]);
            $this->set($company);
        }
        \cnotes\App::$app::set("searchQuery", $userQuery);
    }

    public function resultsAction()
    {
        if(isAjax()) {
            $query = !empty(fieldClear($_GET['query'])) ? fieldClear($_GET['query']) : null;
            if ($query) {
                $company = \R::getAll("SELECT id, name FROM company WHERE name LIKE ? LIMIT 5", ["%{$query}%"]);
                echo json_encode($company);
            }
        }

        die;
    }
}


?>