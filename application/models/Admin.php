<?php

namespace application\models;

use application\core\Model;

class Admin extends Model
{

    public $error;

    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if ($config['login'] != $post['login'] or $config['password']!=$post['password']) {
            $this->error ='Проверьте введеные данные';
            return false;
        } else return true;
    }

    public function postValidate($post, $type){
        $nameLen = iconv_strlen($post['name']);
        $descriptionLen = iconv_strlen($post['description']);
        $textLen = iconv_strlen($post['text']);
        if ($nameLen < 1 or $nameLen > 100) {
            $this->error = 'Название должно содержать от 3 до 100 симовлов';
            return false;
        } elseif ($descriptionLen < 1 or $descriptionLen > 100) {
            $this->error = 'Описание должно содержать от 3 до 100 симовлов';
            return false;
        } elseif ($textLen < 10 or $textLen > 5000) {
            $this->error = 'Текст должен содержать от 10 до 5000 симовлов';
            return false;
        }
        if (empty($_FILES['img']['tmp_name']) and  $type == 'add'){
          $this->error = 'Требуется изображение';
        return false;
        }
        $this->error =$type;

        return true;
    }

    public function postAdd($post){
        $params =[
            'name'=>$post['name'],
            'description'=>$post['description'],
            'text'=>$post['text'],
        ];
        $this->db->query("INSERT INTO posts VALUES (NULL, :name, :description, :text)", $params);
        return $this->db->lastInsertId();
    }

    public function postEdit($post, $id){
        $params =[
            'id'=>$id,
            'name'=>$post['name'],
            'description'=>$post['description'],
            'text'=>$post['text'],
        ];
        $this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);
    }

    public function postUploadImage($path, $id){
//        $img = new Imagick($path);
//        $img->cropThumbnailImage(1024,1024);
//        $img->setImageCompressionQuality(80);
//        $img->writeImage('C:/xampp/htdocs/public/materials/'.$id.'.jpg');
        move_uploaded_file($path,'C:/xampp/htdocs/public/materials/'.$id.'.jpg');
    }

    public function isPostExists($id){
        $params = [
            'id'=> $id,
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id',$params);
    }

    public function postDelete($id){
        $params = [
            'id'=> $id,
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id',$params);
        unlink('C:/xampp/htdocs/public/materials/'.$id.'.jpg');
    }

    public function postData($id){
        $params = [
            'id'=> $id,
        ];
        return $this->db->row('SELECT * FROM posts WHERE id = :id',$params);
    }

}