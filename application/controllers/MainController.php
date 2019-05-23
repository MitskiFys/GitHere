<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller {

	public function indexAction() {
	    $pagination= new Pagination($this->route, $this->model->postsCount());
	    //debug($this->model->postList($this->route));
        if (!empty($_SESSION['authorize']['id'])) {
            $vars = [
                'pagination' => $pagination->get(),
                'list' => $this->model->postList($this->route),
                'name' => 'Здравствуйте, '.$this->model->currentName($_SESSION['authorize']['id']).'!',
            ];
        } else {
            $vars = [
                'pagination' => $pagination->get(),
                'list' => $this->model->postList($this->route),
                'name' =>'',
            ];
        }
	    //debug($vars['name']);
		$this->view->render('Главная страница', $vars);
	}

    public function aboutAction() {
        $this->view->render('О проекте');
    }

    public function contactAction() {
	    if (!empty($_POST)){
	        if (!$this->model->contactValidate($_POST)){
                $this->view->message('error',$this->model->error);
            }
	        mail('paduza@virtual-email.com','Сообщение из блога',$_POST['name'].'|'.$_POST['email'].'|'.$_POST['text']);
	        $this->view->message('success','Сообщение отправленно администратору');
        }
        $this->view->render('Связь с нами');
    }

    public function postAction() {
        $adminModel = new Admin;
        if (!$adminModel->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $vars = [
            'data' => $adminModel->postData($this->route['id'])[0],
        ];
        $this->view->render('Пост', $vars);
    }



    public function jsonAction() {
        $result = $this->model->getJson();
        echo($result);
    }

}