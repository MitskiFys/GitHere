<?php

namespace application\controllers;

use application\core\Controller;

class JsonController extends Controller {

    public function iosjsonAction() {
        $result = $this->model->getIosJson();
        echo($result);
    }

    public function androidjsonAction(){
        $result = $this->model->getAndroidJson($this->route);
        echo($result);
    }

}