<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{

    public $error;

    public function loginValidate($post)
    {
        $params =[
            'login'=>$post['login'],
            'password'=>$post['password'],
        ];
        if(empty($result = $this->db->row('SELECT id FROM users WHERE login = :login AND password = :password',$params))){
            $this->error ='Проверьте введеные данные';
            return false;
        }else{
            return $result['0']['id'];
        }
    }

    public function registerValidate($path){
        $nameLen =iconv_strlen($path['name']);
        $surnameLen =iconv_strlen($path['surname']);
        $loginLen = iconv_strlen($path['login']);
        $email =$path['email'];
        $passwordLen =iconv_strlen($path['firstPassword']);
        $password =$path['firstPassword'];
        $secondPassword =$path['secondPassword'];

        if ($nameLen<2 or $nameLen>15){
            $this->error = "Имя должно содержать от 2 до 15 символов";
            return false;
        } elseif ($surnameLen<2 or $surnameLen>15){
            $this->error = "Фамилия должна содержать от 2 до 15 символов";
            return false;
        } elseif ($loginLen<2 or $loginLen>15){
            $this->error = "Логин должен содержать от 2 до 15 символов";
            return false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->error = "Введен некоректный E-mail";
            return false;
        }elseif ($passwordLen<5){
            $this->error = "Пароль не может быть меньше 5 символов";
            return false;
        } elseif ($password != $secondPassword){
            $this->error = "Пароли не совпадают";
            return false;
        }else {
            $this->error = "все ок";
            return true;
        }

    }

    public function addToDb($post){
        $params =[
            'name'=>$post['name'],
            'surname'=>$post['surname'],
            'login'=>$post['login'],
            'email'=>$post['email'],
            'password'=>$post['firstPassword'],
        ];

        $this->db->query('INSERT INTO users VALUES (NULL, :name, :surname, :login, :email, :password)',$params);
        return $this->db->lastInsertId();
    }

    public function listCount(){
        return $this->db->column('SELECT COUNT(id) FROM lists');
    }

    public function listList($route){
        $max = 10;
        if(isset($route['page'])){
            $pag = $route['page'];
        }else{
            $pag = 1;
        }
        $params = [
            'max' => $max,
            'start' => (($pag)-1)*$max,
            'uid'=>$_SESSION['authorize']['id'],
        ];
        //debug($this->db->row('SELECT * FROM lists WHERE uid=:uid LIMIT :start, :max', $params));
        return $this->db->row('SELECT * FROM lists WHERE uid=:uid LIMIT :start, :max', $params);
    }

    public function addProductToList($post){
        $params =[
            'uid'=>$_SESSION['authorize']['id'],
            'name'=>$post['name'],
        ];
        $this->db->query("INSERT INTO lists VALUES (NULL, :uid, :name)", $params);
        //return $this->db->lastInsertId();
    }

    public function isProductExists($id){
        $params = [
            'id'=> $id,
        ];
        return $this->db->column('SELECT id FROM lists WHERE id = :id',$params);
    }

    public function prodDelete($id){
        $params = [
            'id'=> $id,
        ];
        $this->db->query('DELETE FROM lists WHERE id = :id',$params);
    }

    public function postUploadImage($path, $id){
//        $img = new Imagick($path);
//        $img->cropThumbnailImage(1024,1024);
//        $img->setImageCompressionQuality(80);
//        $img->writeImage('C:/xampp/htdocs/public/materials/'.$id.'.jpg');
        move_uploaded_file($path,'C:/xampp/htdocs/public/materials/'.$id.'.jpg');
    }




}