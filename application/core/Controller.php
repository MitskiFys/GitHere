<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;

	public function __construct($route) {
		$this->route = $route;
		if (!$this->checkAcl()) {
			View::errorCode(403);
            //sleep(5);

		}
		$this->view = new View($route);
		//debug($route['controller']);
		$this->model = $this->loadModel($route['controller']);
	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		//debug('application/acl/'.$this->route['controller'].'.php');
        //debug($_SESSION['authorize']['id']);
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
			return true;
		}
		elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {

			return true;
		}
		elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
	    //debug($this->acl[$key]);
		return in_array($this->route['action'], $this->acl[$key]);
	}

}