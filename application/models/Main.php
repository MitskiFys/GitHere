<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{

    public $error;

    public function contactValidate($post)
    {
        $nameLen = iconv_strlen($post['name']);
        $textLen = iconv_strlen($post['text']);
        if ($nameLen < 1 or $nameLen > 20) {
            $this->error = 'Имя должно содержать от 3 до 20 симовлов';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Введен некореткный E-mail';
            return false;
        } elseif ($textLen < 10 or $textLen > 500) {
            $this->error = 'Сообщение должно содержать от 10 до 500 симовлов';
            return false;
        }
        return true;
    }

    public function postsCount(){
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function postList($route){
        $max = 10;
        if(isset($route['page'])){
        $pag = $route['page'];
        }else{
            $pag = 1;
        }
        $params = [
            'max' => $max,
            'start' => (($pag)-1)*$max,
        ];
        //debug($this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params));
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function currentName($id){
        $params = [
            'id' => $id,
            ];
        return $this->db->column('SELECT name FROM users WHERE id=:id', $params);
    }

    public function login(){
        return $this->db->getOne('SELECT id WHERE login = ?s and password = ?s',$login,$pass);
    }
	public function getJson() {
        $id = $_POST['do'];
        //$id ='idlist';
        //$login = $_POST["login"];
        //$password = $_POST["password"];
//        $params = [
//            'login'=>$login,
//            'password'=>$password,
//        ];
       // $sql = "SELECT * FROM user WHERE login =:login AND password =:password",$params;
        //$sql="SELECT * FROM user WHERE id=\"".$id."\"";
        //debug($inj2);
//        $this->db->query("INSERT INTO user VALUES (NULL, 'lol','lol','lol8','".$inj."')");
//        $result = $this->db->row("SELECT * FROM user WHERE login =:login AND password =:password",$params);
//		return json_encode($result);

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


}