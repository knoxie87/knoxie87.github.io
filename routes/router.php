<?php
require_once 'config/config.php';

$request = $_SERVER['REQUEST_URI'];

if (strpos($request, 'admin')!==false){
        if (!$_SESSION['loggedin']) {
            require 'app/views/index.php';
        }else {
            require_once 'routes/admin_router.php';
        }
} else {
switch ($request) {
    case '/':
        require 'views/index.html';
        break;
    case '/api/teams':
        $tc = new TeamController;
        $tc->index();
    break;
    case '/api/players/?team_id=' . $_GET['team_id']:
        $pc = new PlayerController;
        $pc->byTeam($_GET['team_id']);
    break;
    case '/api/coach/?team_id=' . $_GET['team_id']:
        $tc = new CoachController;
        $tc->show($_GET['team_id']);
    break;
    case '/api/players/?player_id=' . $_GET['player_id']:
        $bc = new PlayerController;
        $bc->byPlayer($_GET['player_id']);
    break;
    case '/register_form':
        require 'views/register_form.php';
    break;
    case '/login_form':
        require 'views/login_form.php';
    break;
    case '/register':
        $auth = new AuthController;
        $auth->register($_POST);
    break;
    case '/authenticate':
        $auth = new AuthController;
        $auth ->authenticate($_POST);
        break;
    case '/logout':
        $auth = new AuthController;
        $auth->logout();
    break;
    default:
        require 'views/404.html';
        break;
    }
}