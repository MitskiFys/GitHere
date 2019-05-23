<?php

namespace application\models;

use application\core\Model;

class Json extends Model
{

    public $error;

    public function getIosJson() {
            $id = $_POST['do'];

        switch($id){
            case 'login':
                $params =[
                    'login'=>$_POST['login'],
                    'password'=>$_POST['password'],
                ];
                $result = $this->db->row("SELECT id,login,name,surname FROM users WHERE login =:login AND password =:password",$params);
                if (!empty($result)){
                    return json_encode($result);} else {return $result;}
                break;
            case 'idlist':
                $params =[
                    'uid'=>$_POST['uid'],
                ];
                $result = $this->db->row("SELECT id,name FROM lists WHERE uid=:uid",$params);
                if (!empty($result)){
                    return json_encode($result);} else {return $result;}
                break;
            case 'addproduct':
                $params =[
                    'uid'=>$_POST['uid'],
                    'name'=>$_POST['name'],
                ];
                $this->db->query("INSERT INTO lists VALUES (NULL, :uid, :name)", $params);
                break;
            case 'deleteproduct':
                $params =[
                    'id'=>$_POST['id'],
                ];
                $this->db->query('DELETE FROM lists WHERE id = :id',$params);
                break;
        }


    }

    public function getAndroidJson($route){
        preg_match_all('/login|idlist|addproduct|deleteproduct/',parse_url($_SERVER['REQUEST_URI'])['path'],$matches);
        $do = $matches[0][0];
        switch($do){
            case 'login':
                $params =[
                    'login'=>$route['login'],
                    'password'=>$route['password'],
                ];
                $result = $this->db->row("SELECT id,login,name,surname FROM users WHERE login =:login AND password =:password",$params);
                if (!empty($result)){
                    return json_encode($result);} else {return $result;}
                break;
            case 'idlist':
                $params =[
                    'uid'=>$route['uid'],
                ];
                $result = $this->db->row("SELECT id,name FROM lists WHERE uid=:uid",$params);
                if (!empty($result)){
                    return json_encode($result);} else {return $result;}
                break;
            case 'addproduct':
                $params =[
                    'uid'=>$route['uid'],
                    'name'=>$route['name'],
                ];
                $this->db->query("INSERT INTO lists VALUES (NULL, :uid, :name)", $params);
                break;
            case 'deleteproduct':
                $params =[
                    'id'=>$route['id'],
                ];
                $this->db->query('DELETE FROM lists WHERE id = :id',$params);
                break;
        }

    }


}