<?php
require_once 'models/model.class.php';

class UserController extends Model 
{
  public function construct()
  {
     parent:: construct();
  }

  public function index() {
    $arr = null;
    $sql = "SELECT * from users ORDER BY username asc";
    $this->all($sql);
  }
  public function destroy($id){
    $sql = 'DELETE from users where id = :id';
    $this->delete($sql,$id);
  }
  public function updateuser($user){

    $salt = uniqid(mt_rand(),true);
    $pepper = "sfl%-36**8gdrg&80?";
    $password = $salt . $_POST["password"] . $pepper;
    $hash = hash('sha512',$password);

    $sql = "INSERT into users (role,username, passwd, salt,avatar,active) VALUES (:role,:username,:passwd,:salt,:avatar,:active)";
    $arr = array('username'=>$user['username'],'passwd'=>$hash,'salt'=>$salt,'avatar'=>$user['avatar'],'active'=>$user['active'],'role'=>$user['role']);

    $this->insert($sql,$arr);
    
    
    if($_SESSION["error_message"]=="not an error"){
      echo "successful";
      }else{
        echo($_SESSION["error_message"]);
     }
  }
  public function show($id){
    $sql = "SELECT * from users where id = :id";
    $this->findOne($sql,$id);
  }
  public function modify($user){

    if(!isset($user["active"])){
      $active = null;
    }else{
      $active = $user["active"];
    }
    $sql = "UPDATE users set role = :role, username = :username, avatar = :avatar, active = :active where id = :id";
    $arr = array('username'=>$user['username'],'avatar'=>$user['avatar'],'active'=>$user['active'],'role'=>$user['role'],'id'=> $user['id']);
    $this->update($sql,$arr);
    if($_SESSION["error_message"]=="not an error"){
      echo "successful";
      }else{
        echo($_SESSION["error_message"]);
      }
  }
  public function updatepass($user){

    $salt = uniqid(mt_rand(),true);
    $pepper = "sfl%-36**8gdrg&80?";
    $password = $salt . $_POST["password"] . $pepper;
    $hash = hash('sha512',$password);

    $sql = "UPDATE users set salt=:salt, passwd = :passwd where id = :id";
    $arr = array('passwd'=>$hash,'salt'=>$salt,'id'=> $user['id']);


    $this->update($sql,$arr);
     if($_SESSION["error_message"]=="not an error"){
       echo "successful";
      }else{
        echo($_SESSION["error_message"]);
      }
   }
     
}
