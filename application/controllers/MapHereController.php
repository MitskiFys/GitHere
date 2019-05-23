<?php

namespace application\controllers;

use application\core\Controller;

class MapHereController extends Controller {

    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'maphere';
    }

    public function viewAction() {
        $this->view->render('Карта');
    }


}