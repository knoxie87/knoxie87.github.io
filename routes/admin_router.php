<?php

switch ($request) {
    case '/admin/admin_dashboard':
         require 'views/admin/admin_dashboard.php';
         break;
    case '/admin/team_dashboard':
        require 'views/admin/team_dashboard.php';
        break;
     case '/admin/users';
     $users = new UserController;
     $users->index();
     break;
     case '/admin/user/delete/?id='. $_GET["id"]:
          $user = new UserController;
          $user->destroy($_GET["id"]);
     break;
     case '/admin/user/add';
          $auth = new UserController;
          $auth->updateuser($_POST);
     break;
     case '/admin/user/edit';
     $auth = new UserController;
     $auth->modify($_POST);
     break;
     case '/admin/user/updatepassword';
     $auth = new UserController;
     $auth->updatepass($_POST);
     break;
     case '/admin/user/?id='. $_GET["id"]:
          $user = new UserController;
          $user->show($_GET["id"]);
     break;
}