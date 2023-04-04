<?php

namespace app\controllers;

use cnotes\App;
use app\models\Pagination;

class MainController extends AppController
{
    public function indexAction ()
    {

        $this->setMeta("CompanyNotes", "CompanyNotes", "CompanyNotes");

        $total = \R::count("company");
        $page = isset($_GET['page']) ? (int)fieldClear($_GET['page']) : 1;
        $perpage = App::$app::get("pagination");

        $pagination = new Pagination($page, $perpage, $total);

        $start = $pagination->getStart();
        
        App::$app::set("companyPagination", $pagination);

        $data = \R::findAll("company", "ORDER BY id DESC LIMIT {$start}, {$perpage}");
        $this->set($data);
    
    }
}

?>