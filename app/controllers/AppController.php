<?php

namespace app\controllers;

use app\models\AppModel;

class AppController extends \cnotes\base\Controller
{

    public function __construct($route)
    {
        parent::__construct($route);

        new AppModel;
    }
}

?>