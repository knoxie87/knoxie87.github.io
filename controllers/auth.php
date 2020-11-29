<?php
require_once 'models/model.class.php';
class AuthController extends Model
{
    public function _construct()
    {
        parent::_construct();
    }
    public function register($user)
    {
        $salt = uniqid(mt_rand(),true);
        $pepper = "sfl%-36**8gdrg&80?";
        $password = $salt . $_POST["password"] . $pepper;
        $hash = hash('sha512',$password);

        $sql = "INSERT into users (username, passwd, salt) VALUES (:username,:passwd,:salt)";
        $arr = array('username'=>$user['username'],'passwd'=>$hash,'salt'=>$salt);


        $this->insert($sql,$arr);
        if($_SESSION["error_message"]=="not an error"){
            unset($_SESSION["error_message"]);
            header("Location: /login_form");
        }
        else if (isset($_SESSION["error_message"])) {
            header("Location: /register_form");
        }else {
            header("Location: /login_form");
        }

    }
    public function authenticate($user)
    {
        unset($_SESSION["error_message"]);
        $salt = $this->getSaltValue($user["username"]);
        $pepper = "sfl%-36**8gdrg&80?";
        $password = $salt . $_POST["password"] . $pepper;
        $hash = hash('sha512',$password);
        $select = "SELECT count(*) as count,id,role from users
                where username = :username
                and passwd = :passwd";
        $stmt = $this->db->prepare($select);
        $stmt->bindvalue(':username',$_POST['username'],SQLITE3_TEXT);
        $stmt->bindvalue(':passwd',$hash,SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        if ($row['count']>0 && $row['role']==='admin'){
            $_SESSION['loggedin']= true;
            $_SESSION['username'] = $_POST['username'];
            header("Location: /admin/admin_dashboard");
            exit();
        }else if($row['count']>0 && $row['role']==='team_admin')
        {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $POST['username'];
            $_SESSION['id'] = $row['id'];
            header("Location: /admin/team_dashboard");
            exit();

        }else{
            $_SESSION['error_message'] = "Sorry we don't have that user!";
            header("Location: /login_form");
        }
    }
    private function getSaltValue($username)
    {
        $select = "SELECT salt from users
        where username = :username";
        $stmt = $this->db->prepare($select);
        $stmt->bindvalue(':username',$username,SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        return $row['salt'];

    }
    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
}