<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Main;
use application\lib\pagination;


class AccountController extends Controller {

    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'default';
    }

    public function loginAction() {
        if (isset($_SESSION['authorize']['id'])){
            $this->view->redirect(' ');
        }
        if (!empty($_POST)){
            if (!$result = $this->model->loginValidate($_POST)){
                $this->view->message('error',$this->model->error);
            } else {
                $_SESSION['authorize']['id'] = $result;
                $this->view->location(' ');
            }
        }
        $this->view->redirect(' ');
    }


    public function logoutAction() {
        unset($_SESSION['authorize']['id']);
        unset($_SESSION['authorize']);
        $this->view->redirect(' ');
    }

    public function registerAction() {
        if (!isset($_SESSION['authorize']['id'])) {
            if (!empty($_POST)) {
                if(!$result = $this->model->registerValidate($_POST)){
                $this->view->message('error',$this->model->error);
                }elseif ($result) {
                    $_SESSION['authorize']['id'] = $this->model->addToDb($_POST);
                    $this->view->location('account/register');
                }
            }
        } else {
            $this->view->render('Регистрация');
            header("refresh: 3; url=/ ");
        }
    }

    public function listAction(){
        $pagination= new Pagination($this->route, $this->model->listCount());
        //debug($this->model->postList($this->route));
        $vars = [
            'pagination'=>$pagination->get(),
            'list'=> $this->model->listList($this->route),
        ];
        //debug($vars);
        $this->view->render('Посты',$vars);
    }

    public function addAction()
    {
        //debug($_POST);
        if (!empty($_POST['name'])){
            $nameLen=iconv_strlen($_POST['name']);
            if ($nameLen < 3){
                $this->view->message('error','Название не может быть меньше 3 символов');
            } else{
                $this->model->addProductToList($_POST);
                $this->view->location('account/list');
            }

        } else {
            $this->view->message('error','Поле не может быть пустым');
        }
    }

    public function deleteAction() {
        if (!$this->model->isProductExists($this->route['id'])){
            $this->view->errorCode(404);
        }
        $this->model->prodDelete($this->route['id']);
        $this->view->redirect('account/list');
    }
}