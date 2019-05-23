<?php

namespace application\lib;

use PDO;

class Db {

	protected $db;
	
	public function __construct() {
		$config = require 'application/config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	}

	public function query($sql, $params = []) {
	    //debug($params);
        $stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
			    if (is_int($val)){
			        $type = PDO::PARAM_INT;
                } else {
			        $type = PDO::PARAM_STR;
                }
			    //debug($stmt);
				$stmt->bindValue(':'.$key, $val, $type);
            }
            //debug($stmt);
        }
        $stmt->execute();
        //debug($stmt);
        return $stmt;
	}

	public function row($sql, $params = []) {
	    //debug($params);
		$result = $this->query($sql, $params);
        //$heh=$result->fetchAll(PDO::FETCH_ASSOC);
        //debug($heh);
        return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

	public function lastInsertId(){
	    return $this->db->lastInsertId();
    }


}